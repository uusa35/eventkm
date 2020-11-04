<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductCartResource;
use App\Http\Resources\ProductExtraLightResource;
use App\Http\Resources\ProductLightResource;
use App\Http\Resources\ProductResource;
use App\Jobs\IncreaseElementViews;
use App\Models\Product;
use App\Models\User;
use App\Services\Search\Filters;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Product::query()->active()->hasStock()->available()->hasImage()->hasAtLeastOneCategory()->activeUsers()->serveCountries();
        if (request()->has('on_home') && request()->on_home) {
            $query->onHome();
        }
        if (request()->has('on_sale') && request()->on_sale) {
            $query->onSaleOnHome();
        }
        if (request()->has('latest') && request()->latest) {
            $query->onNew();
        }
        if (request()->has('best_sale') && request()->best_sale) {
//            $query->bestSalesProducts();
//            $elements = Product::whereIn('id', Product::active()->available()->hasImage()->serveCountries()->hasStock()->bestSalesProducts())->hasAtLeastOneCategory()->with('brand', 'product_attributes', 'colors', 'sizes', 'color', 'size', 'images', 'favorites', 'user.country')->limit(self::TAKE_LESS)->orderBy('id', 'desc')->get();
            $query->whereIn('id', Product::active()->available()->hasImage()->serveCountries()->hasStock()->activeUsers()->bestSalesProducts())->hasAtLeastOneCategory()->with('brand', 'product_attributes', 'colors', 'sizes', 'color', 'size', 'images', 'favorites', 'user.country')->limit(self::TAKE_LESS)->orderBy('id', 'desc');
        }
        if (request()->has('hot_deals') && request()->hot_deals) {
            $query->onSale()->hotDeals();
//            $elements = Product::active()->available()->onSale()->hotDeals()->hasImage()->serveCountries()->hasAtLeastOneCategory()->with('brand', 'product_attributes', 'colors', 'sizes', 'color', 'size', 'images', 'user.country', 'favorites')->limit(self::TAKE_LESS)->orderby('end_sale', 'desc')->get();
        }
        $elements = $query->with('product_attributes.size', 'product_attributes.color')->orderby('id', 'desc')->paginate(self::TAKE_MIN);
        return response()->json(ProductExtraLightResource::collection($elements), 200);
    }


    public function search(Filters $filters)
    {
        $validator = validator(request()->all(), ['search' => 'nullable']);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }
        $elements = Product::active()->hasImage()->available()->hasStock()->hasAtLeastOneCategory()->filters($filters)->activeUsers()->orderBy('id', 'desc')->paginate(Self::TAKE_MIN);
        if (!$elements->isEmpty()) {
            return response()->json(ProductExtraLightResource::collection($elements), 200);
        } else {
            return response()->json(['message' => trans('general.no_products')], 400);
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
        $element = Product::active()->whereId($id)->with('images', 'user', 'shipment_package', 'color', 'size', 'videos')->with(['sizes' => function ($q) {
            return $q->orderBy('name_en', 'asc')->groupBy('id');
        }])->with(['categories' => function ($q) {
            return $q->active()->limit('2');
        }])->with(['colors' => function ($q) {
            return $q->orderBy('name_en', 'asc');
        }])->first();
        if ($element) {
            IncreaseElementViews::dispatchNow($element);
            return response(new ProductResource($element), 200);
        }
        return response()->json(['message' => trans('general.this_product_does_not_exist')], 400);
    }

    public function getProductForCart(Request $request)
    {
        if ($request->has('cart_id')) {
            $element = Product::whereId($request->product_id)->with(['product_attributes' => function ($q) {
                return $q->where('id', request()->product_attribute_id)->with('color', 'size');
            }])->with('user')->first();
        } else {
            $element = Product::whereId($request->product_id)->with('color', 'size', 'user')->first();
        }
        return response()->json(new ProductCartResource($element), 200);
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
        //
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
