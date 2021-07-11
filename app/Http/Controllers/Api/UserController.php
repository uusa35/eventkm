<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryLightResource;
use App\Http\Resources\ProductExtraLightResource;
use App\Http\Resources\UserExtraLightResource;
use App\Http\Resources\UserLightResource;
use App\Http\Resources\UserResource;
use App\Jobs\IncreaseElementViews;
use App\Models\Address;
use App\Models\Country;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Services\Search\Filters;
use App\Services\Search\UserFilters;
use App\Services\Traits\NotificationHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use NotificationHelper;

    public $element;

    public function __construct(User $user)
    {
        $this->element = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('category_id')) {
            $elements = $this->element->active()->companies()->notAdmins()->hasProducts()->whereHas('categories', function ($q) {
                return $q->where(['category_id' => request()->category_id]);
            })->paginate(self::TAKE_MIN);
        } elseif (request()->has('type')) {
            $elements = $this->element->active()->whereHas('role', function ($q) {
                return $q->where(request()->type, true);
            });
            if (request()->has('on_home')) {
                $elements = $elements->where('on_home', request()->on_home);
            }
            $elements = $elements->notAdmins()->hasProducts()->paginate(self::TAKE_MIN);
        }
        if (isset($elements) && $elements->isNotEmpty()) {
            return response()->json(UserLightResource::collection($elements), 200);
        }
        return response()->json(['message' => 'no_items'], 400);
    }

    public function search(UserFilters $filters)
    {
        $validator = validator(request()->all(), ['search' => 'nullable']);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }
        if (request()->has('is_celebrity')) {
            $elements = $this->element->filters($filters)->active()->notAdmins()->orderBy('id', 'desc')->paginate(self::TAKE_MID);
        } else {
            $elements = $this->element->filters($filters)->active()->notAdmins()->has('products','>',0)->orderBy('id', 'desc')->paginate(self::TAKE_MID);
        }
        if (!$elements->isEmpty()) {
            return response()->json(UserExtraLightResource::collection($elements), 200);
        } else {
            return response()->json(['message' => trans('general.no_users')], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $element = $this->element->whereId($id)->with('role', 'images')
            ->with(['slides' => function ($q) {
                $q->active();
            }])
            ->with(['collections' => function ($q) {
                return $q->active()->whereHas('products', function ($q) {
                    return $q->active()->hasImage()->available()->hasStock()->hasAtLeastOneCategory();
                }, '>', 0);
            }])
            ->with(['products' => function ($q) {
                return $q->active()->hasImage()->available()->hasStock()->hasAtLeastOneCategory()->with(['categories' => function ($q) {
                    return $q->active();
                }]);
            }])->with(['productGroup' => function ($q) {
                return $q->active()->hasImage()->hasStock()->hasAtLeastOneCategory()->with(['categories' => function ($q) {
                    return $q->active();
                }]);
            }])
            ->with(['classifieds' => function ($q) {
                return $q->active()->with('category');
            }])
            ->with(['comments' => function ($q) {
                return $q->active()->with('owner')->orderBy('created_at', 'desc');
            }])->with('localArea')->first();
        if ($element) {
            IncreaseElementViews::dispatch($element);
            return response()->json(new UserResource($element), 200);
        }
        return response()->json(['message' => trans('general.this_user_does_not_exist')], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $element = $request->user();
        if ($element) {
            $validate = validator($request->all(), [
                'name' => 'required|min:3|max:200',
                'email' => 'required|email|unique:users,id,' . $id,
                'mobile' => 'required|min:5|max:20',
                'country_id' => 'required|exists:countries,id',
                'address' => 'max:500|nullable',
            ]);
            if ($validate->fails()) {
                return response()->json(['message' => $validate->errors()->first()], 400);
            }
            $updated = $element->update([
                'name' => $request->name,
                'email' => $request->email,
                'slug_ar' => $request->name,
                'slug_en' => $request->name,
                'country_id' => $request->country_id,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'description_ar' => $request->description,
                'description_en' => $request->description,

            ]);
            if ($updated) {
                if (!$element->api_token) {
                    $element->update([
                        'api_token' => rand(9999999, 99999999999) . str_random(5),
                    ]);
                }
                $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1000', '1000'], true) : null;
                $element = $this->getAuthenticatedUser('id', $id);
                return response()->json(new UserResource($element), 200);
            }
            return response()->json(['message' => trans('message.user_not_updated_successfully')], 400);
        }
        return response()->json(['message' => trans('message.no_such_user')], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function authenticate(Request $request)
    {
        $validate = validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'player_id' => 'nullable|string'
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->errors()->first()], 400);
        }
        $authenticate = auth()->attempt($request->only('email', 'password'));
        if ($authenticate) {
            $element = $this->getAuthenticatedUser('email', $request->email);
            if ($element) {
                $request->has('player_id') ? $element->update(['player_id' => $request->player_id]) : null;
                return response()->json(new UserResource($element), 200);
            }
        }
        return response()->json(['message' => trans('message.invalid_username_or_password')], 400);
    }

    public function reAuthenticate(Request $request)
    {
        $element = $this->getAuthenticatedUser('id', $request->user()->id);
        if ($element) {
            $request->has('player_id') ? $element->update(['player_id' => $request->player_id]) : null;
            return response()->json(new UserResource($element), 200);
        }
        return response()->json(['message' => trans('message.invalid_username_or_password')], 400);
    }

    public function register(Request $request)
    {
        $validate = validator($request->all(), [
            'name' => 'required|min:3|max:200',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|min:5|max:12',
            'password' => 'required|min:6',
            'address' => 'max:500|nullable',
            'country_id' => 'required|exists:countries,id',
            'description' => 'min:4|max:1000|nullable',
            'role_id' => 'exists:roles,id',
            'area_id' => 'exists:areas,id'
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->errors()->first()], 400);
        }
        $element = $this->element->create([
            'name' => $request->name,
            'slug_ar' => $request->slug_ar,
            'slug_en' => $request->slug_en,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mobile' => $request->mobile,
            'player_id' => $request->has('player_id') ? $request->player_id : null,
            'country_id' => $request->country_id,
            'area_id' => $request->area_id,
            'role_id' => $request->role_id ? $request->role_id : Role::where('is_client', true)->first()->id,
            'api_token' => rand(9999999, 99999999999),
            'address' => $request->address,
            'description_ar' => $request->description,
            'description_en' => $request->description,
            'is_male' => $request->has('is_male') ? $request->is_male : false,
            'access_dashboard' => false,
            'mobile_verified' => true,
            'on_home' => false
        ]);
        if ($element) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1000', '1000'], true) : null;
            $request->hasFile('banner') ? $this->saveMimes($element, $request, ['banner'], ['1080', '410'], true) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], true) : null;
            return response()->json(new UserResource($element), 200);
        }
        return resopnse()->json(['message' => trans('message.register_unknwon_error')], 400);
    }


    public function googleAuthenticate(Request $request)
    {
        try {
            $validate = validator($request->all(), [
                'name' => 'required|min:3|max:200',
                'email' => 'required|email',
            ]);
            if ($validate->fails()) {
                return response()->json(['message' => $validate->errors()->first()], 400);
            }
            $element = $this->element->where(['email' => $request->email])->first();
            if (!$element) {
                $$element = $this->element->create([
                    'name' => $request->name,
                    'slug_ar' => $request->name,
                    'slug_en' => $request->name,
                    'api_token' => rand(9999999, 99999999999),
                    'password' => Hash::make('secret'),
                    'email' => $request->email,
                    'country_id' => Country::where('is_local', true)->first()->id,
                    'role_id' => Role::where(['is_client' => true])->first()->id
                ]);
            }
            if ($element) {
                return response()->json(new UserResource($element), 200);
            }
            return response()->json(['message' => trans('message.register_unknwon_error')], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => trans('message.register_unknwon_error')], 400);
        }
    }

    public function verifyMobileCode(Request $request)
    {
        $validate = validator($request->all(), [
            'code' => 'required|min:4',
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->errors()->first()], 400);
        }
        $element = $this->getAuthenticatedUser('mobile_code', $request->code);
        if ($element) {
            $element->update(['mobile_verified' => true]);
            return response()->json(new UserResource($element), 200);
        }
        return response()->json(['message' => trans('general.invalid_verification_code')], 400);
    }

    public function getAuthenticatedUser($colName, $value)
    {
        return $this->element->where([$colName => $value])->with(['product_favorites' => function ($q) {
            return $q->active()->hasStock()->hasImage()->available()->hasAtLeastOneCategory();
        }])->with(['orders' => function ($q) {
            return $q->paid()->orderBy('id', 'desc');
        }])->with(['classified_favorites' => function ($q) {
            return $q->active()->notExpired()->hasImage();
        }])->with(['country', 'collections'])->with(['classifieds' => function ($q) {
            return $q->active()->notExpired()->hasImage()->available()->with('items.property', 'items.categoryGroup');
        }])->with(['myFannedList' => function ($q) {
            return $q->active()->companies();
        }])->with('addresses', 'role')->with('localArea')->first();
    }

    public function resendVerificationCode(Request $request)
    {
        $element = $request->user();
        if ($element) {
            $code = random_int(1111, 9999);
            $element->update(['mobile_code' => $code]);
            $this->sendVerificationCode($element->fullMobile, $code);
            return response()->json(UserLightResource::make($element), 200);
        }
        return response()->json(['message' => 'User does not exist'], 400);
    }
}
