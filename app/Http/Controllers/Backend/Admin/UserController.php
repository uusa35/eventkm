<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Requests\Backend\UserStore;
use App\Http\Requests\Backend\UserUpdate;
use App\Models\Category;
use App\Models\Product;
use App\Models\Survey;
use App\Models\User;
use App\Models\Country;
use App\Models\Role;
use App\Models\UserHelpers;
use App\Services\Traits\ImageHelpers;
use App\Services\Traits\NotificationHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Nexmo\Laravel\Facade\Nexmo;

class UserController extends Controller
{
    use ImageHelpers, NotificationHelper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('user.view', auth()->user());
        if (request()->has('role_id')) {
            $elements = User::where('role_id', request('role_id'))->with('country', 'slides', 'role', 'categories')->orderBy('id', 'desc')->paginate(env('EVENTKM') ? Self::TAKE_ALL : SELF::TAKE);
        } else {
            if (auth()->user()->isSuper) {
                $elements = User::with('country', 'slides', 'role', 'categories')->orderBy('id', 'desc')->paginate(env('EVENTKM') ? Self::TAKE_ALL : SELF::TAKE);
            } else {
                $elements = User::whereHas('role', function ($q) {
                    return $q->where(['is_admin' => false, 'is_super' => false]);
                })->with('country', 'slides', 'role', 'categories')->orderBy('id', 'desc')->paginate(env('EVENTKM') ? Self::TAKE_ALL : SELF::TAKE);
            }
        }
        return view('backend.modules.user.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('user.create');
        $countries = Country::active()->get();
        $roles = Role::active()->get();
        $categories = Category::active()->where('is_user', true)->with(['children' => function ($q) {
            return $q->where('is_user', true)->with(['children' => function ($q) {
                return $q->where('is_user', true);
            }]);
        }])->get();
        $products = Product::active()->available()->hasImage()->serveCountries()->hasStock()->get();
        $surveys = Survey::active()->hasQuestions()->get();
        return view('backend.modules.user.create', compact('countries', 'roles', 'categories', 'products', 'surveys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStore $request)
    {
        $element = User::create($request->except('image', 'bg', 'banner', 'path', 'categories', 'images', 'products', 'surveys', 'current_password'));
        $country = request()->has('country_id') ? Country::whereId(request('country_id'))->first() : null;
        if ($element) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1000', '1000'], true) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], true) : null;
            $request->hasFile('bg') ? $this->saveMimes($element, $request, ['bg'], ['1080', '1440'], true) : null;
            $request->hasFile('banner') ? $this->saveMimes($element, $request, ['banner'], ['1080', '410'], true) : null;
            $request->hasFile('path') ? $this->savePath($request, $element) : null;
            $request->has('categories') ? $element->categories()->sync($request->categories) : null;
            $request->has('products') ? $element->productGroup()->sync($request->products) : null;
            $request->has('surveys') ? $element->surveys()->sync($request->surveys) : null;
            $country ? $element->update(['country_name' => $country->slug]) : null;
            $element->update(['password' => Hash::make($request->current_password)]);
            activity()
                ->performedOn($element)
                ->causedBy(auth()->user());
            return redirect()->route('backend.admin.user.index')->with('success', trans('general.user_added'));
        }
        return redirect()->route('backend.admin.user.create')->with('error', trans('general.user_not_added'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $element = User::active()->whereId($id)->first();
        $this->authorize('user.view', $element);
        return response()->json($element, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = User::whereId($id)->with('balance', 'categories', 'productGroup')->first();
        $this->authorize('user.update', $element);
        $countries = Country::active()->get();
        $roles = Role::active()->get();
        $categories = Category::active()->where('is_user', true)->with(['children' => function ($q) {
            return $q->where('is_user', true)->with(['children' => function ($q) {
                return $q->where('is_user', true);
            }]);
        }])->get();
        $products = Product::active()->available()->hasImage()->serveCountries()->hasStock()->get();
        return view('backend.modules.user.edit', compact('element', 'roles', 'countries', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdate $request, $id)
    {
        $element = User::whereId($id)->with('categories')->first();
        $this->authorize('user.update', $element);
        $updated = $element->update($request->except('image', 'bg', 'banner', 'path', 'categories', 'images', 'products', 'surveys'));
        $country = request()->has('country_id') ? Country::whereId(request('country_id'))->first() : null;
        if ($updated) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1000', '1000'], true) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], true) : null;
            $request->hasFile('bg') ? $this->saveMimes($element, $request, ['bg'], ['1080', '1440'], true) : null;
            $request->hasFile('banner') ? $this->saveMimes($element, $request, ['banner'], ['1080', '410'], true) : null;
            $request->hasFile('path') ? $this->savePath($request, $element) : null;
            $request->has('categories') ? $element->categories()->sync($request->categories) : null;
            $element->productGroup()->sync($request->products);
            $element->surveys()->sync($request->surveys);
            $country ? $element->update(['country_name' => $country->slug]) : null;
            return redirect()->route('backend.admin.user.index')->with('success', trans('general.user_updated'));
        }
        return redirect()->route('backend.admin.user.create')->with('error', trans('general.user_is_not_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = User::whereId($id)->with('products', 'services', 'role')->first();
        $roleId = $element->role_id;
        activity()
            ->performedOn($element)
            ->causedBy(auth()->user());
        if ($element) {
            $element->update(['active' => false]);
            if (!$element->role->is_admin) {
                if ($element->delete()) {
                    return redirect()->route('backend.admin.user.index', ['role_id' => $roleId])->with('success', 'user deleted');
                }
            } elseif (auth()->user()->isSuper) {
                $deleted = $element->products->isEmpty() && $element->services->isEmpty() && $element->orders->isEmpty() ? $element->delete() : null;
                if ($deleted) {
                    return redirect()->route('backend.admin.user.index', ['role_id' => $roleId])->with('success', trans('general.user_deleted'));
                }
            }
        }
        return redirect()->back()->with('error', trans('general.user_is_not_deleted'));
    }

    public function getResetPassword(Request $request)
    {
        $validator = validator(request()->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $email = $request->email;
        return view('auth.passwords.reset', compact('email'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postResetPassword(Request $request)
    {
        $validator = validator(request()->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInputs()->withErrors($validator);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = bcrypt(request()->password);
            $user->save();
            return redirect()->route('backend.admin.user.index', ['role_id' => $user->role_id])->with('success', 'password changed');
        }
        return redirect()->back()->with('error', 'error occurred')->withInputs();
    }

    public function sendNotification(Request $request)
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'message' => 'required',
            'include_player_ids' => 'required|array'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInputs();
        }
        $this->notify(request('title'), request('message'), request('ids'));
    }

    public function trashed()
    {
        $elements = User::onlyTrashed()->paginate(Self::TAKE_MID);
        return view('backend.modules.user.index', compact('elements'));
    }

    public function restore($id)
    {
        $this->authorize('isSuper');
        $element = User::withTrashed()->whereId($id)->first();
        $element->restore();
        return redirect()->back()->with('success', 'element restored');
    }

    public function resendVerificationCode(Request $request) {
        if(strlen($request->code) < 4) {
            $element = User::whereId($request->user_id)->first();
            $code = random_int(1111, 9999);
            $element->update(['mobile_code' => $code]);
        }
         $this->sendVerificationCode($request->fullMobile, $request->code);
         return redirect()->back()->with('success', 'Mobile Verification code is send to this user');
    }
}
