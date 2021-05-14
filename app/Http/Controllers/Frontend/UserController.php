<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Resources\UserExtraLightResource;
use App\Jobs\IncreaseElementViews;
use App\Models\Product;
use App\Models\User;
use App\Services\Search\Filters;
use App\Services\Search\UserFilters;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $validate = validator(request()->all(), [
            'type' => 'required|min:3'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->with('errors', 'Please Specify a role');
        }
        $elements = User::active()->whereHas('role', function ($q) {
            return $q->where(request()->type, true);
        })->paginate(self::TAKE_MIN);
        return view('frontend.wokiee.four.modules.user.index', compact('elements'));
    }

    public function search(UserFilters $filters)
    {
        $validator = validator(request()->all(), ['search' => 'nullable']);
        if ($validator->fails()) {
            return redirect()->route('frontend.home')->withErrors($validator->messages());
        }
        $elements = User::filters($filters)->active()->notAdmins()->hasProducts()->orderBy('id', 'desc')->paginate(Self::TAKE_MIN);
        if ($elements->isNotEmpty()) {
            return view('frontend.wokiee.four.modules.user.index', compact(
                'elements'
            ));
        } else {
            return redirect()->route('frontend.home')->with('error', trans('message.no_items_found'));
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
    public function show($id, Filters $filters)
    {
        $element = User::whereId($id)->with([
            'collections.products.product_attributes',
            'collections.products.product_attributes',
            'collections.products.user',
            'collections.products.brand',
            'collections.products.categories.children',
            'collections.products.colors',
            'collections.products.sizes',
            'images', 'fans','branches'
        ])->first();
        $services = collect([]);
        $products = collect([]);
        $collections = collect([]);
        IncreaseElementViews::dispatch($element);
        if (!request()->hasAny(['product_category_id', 'size_id', 'color_id'])) {
            $services = $element->services()->active()->hasImage()->serveCountries()->hasValidTimings()->filters($filters)->with(
                'user', 'tags', 'categories.children', 'images'
            )->paginate(Self::TAKE);
        }
        if ($element->isDesigner) {
            $productIds = $element->collections()->with(['products' => function ($q) {
                return $q->active()->hasStock();
            }])->get()->pluck('products')->flatten()->unique('id')->pluck('id')->toArray();
            $products = Product::whereIn('id', $productIds)->active()->hasStock()->filters($filters)->with([
                'product_attributes.color', 'color',
                'colors', 'sizes', 'size', 'user',
                'product_attributes.size', 'images',
                'tags', 'categories.children', 'brand',
            ])->paginate(Self::TAKE_MIN);
        } else {
            $products = $element->products()->active()->hasStock()->filters($filters)->with([
                'product_attributes.color', 'color',
                'colors', 'sizes', 'size', 'user',
                'product_attributes.size', 'images',
                'tags', 'categories.children', 'brand'
            ])->paginate(Self::TAKE_MIN);
        }
        $tags = isset($services) ? $services->pluck('tags')->flatten()->unique('id')->sortKeysDesc() : $products->pluck('tags')->flatten()->unique('id')->sortKeysDesc();
        $sizes = $products->pluck('product_attributes')->flatten()->pluck('size')->flatten()->unique('id')->sortKeysDesc();
        $colors = $products->pluck('product_attributes')->flatten()->pluck('color')->flatten()->unique('id')->sortKeysDesc();
        $brands = $products->pluck('brands')->flatten()->flatten()->unique('id')->sortKeysDesc();
        $categoriesList = isset($services) ? $services->pluck('categories')->flatten()->unique('id') : $products->pluck('categories')->flatten()->unique('id');
        $vendors = isset($services) ? $services->pluck('user')->flatten()->unique('id') : null;
        $companies = $products->pluck('user')->flatten()->unique('id');
        if ($element->isDesigner) {
            $collections = $element->collections->paginate(SELF::TAKE_LESS);
        }
        return view('frontend.wokiee.four.modules.user.show', compact(
            'element', 'products', 'collections',
            'services', 'tags', 'sizes', 'colors', 'brands', 'categoriesList',
            'vendors', 'companies'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = auth()->user();
        return view('frontend.wokiee.four.modules.user.edit', compact('element'));
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
        $element = User::whereId(auth()->id())->first();
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:80|min:5',
            'email' => [
                Rule::unique('users')->ignore($element->id),
                'required',
                'string',
                'email'
            ],
//            'password' => ['string', 'min:6', 'confirmed'],
            'mobile' => 'string|max:10|min:5',
            'country_id' => ['required', 'integer', 'exists:countries,id'],
//            'role_id' => ['required', 'integer', 'exists:roles,id'],
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors()->first());
        }
        if ($element->update($request->all())) {
            return redirect()->back()->with('success', trans('general.user_updated'));
        }
        return redirect()->back()->with('error', trans('general.user_is_not_updated'));

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

}
