<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ColorLightResource;
use App\Http\Resources\ProductAttributeLightResource;
use App\Http\Resources\ProductCartResource;
use App\Http\Resources\ProductExtraLightResource;
use App\Http\Resources\ProductLightResource;
use App\Http\Resources\ProductResource;
use App\Jobs\IncreaseElementViews;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Size;
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
        $elements = Product::active()->hasImage()->available()->hasStock()->hasAtLeastOneCategory()->activeUsers()->filters($filters)->orderBy('id', 'desc')->paginate(Self::TAKE_MIN);
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
        try {
            $validate = validator($request->all(), [
                'name' => 'required|min:3|max:200',
                'sku' => 'required|min:2',
                'price' => 'required|min:2',
                'description' => 'required|min:3|max:200',
//            'categories' => 'array',
            ]);
            if ($validate->fails()) {
                return response()->json(['message' => $validate->errors()->first()], 400);
            }
            $element = Product::create([
                'name_ar' => $request->name,
                'name_en' => $request->name,
                'skue' => $request->sku,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'user_id' => $request->user()->id,
                'description_ar' => $request->description,
                'description_en' => $request->description,
                'size_id' => Size::first()->id,
                'color_id' => Color::first()->id,
                'has_attributes' => false,
                'show_attributes' => true,
                'active' => true
            ]);
            if ($element) {
                $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], true) : null;
                $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], true) : null;
                $element->categories()->sync($request->categories);
                return response()->json(new ProductResource($element), 200);
            }
            return resopnse()->json(['message' => trans('message.item_not_created')], 400);
        }
        catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $element = Product::active()->whereId($id)->with('images', 'user', 'shipment_package', 'color', 'size', 'videos','brand')->with(['sizes' => function ($q) {
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

    public function getQty() {
        $elements = ProductAttribute::where([
            'product_id' => request()->product_id,
            'size_id' => request()->size_id,
        ])->select('id', 'color_id', 'qty')->get();
        return response()->json($elements, 200);
    }

    public function getColors() {
        return ProductAttribute::where([
            'product_id' => request()->product_id,
            'size_id' => request()->size_id,
        ])->with('color')->get()->pluck('color')->unique()->pluck('id')->toArray();
    }

    public function getColorList() {
        $colorIds = ProductAttribute::where(['product_id' => request()->product_id, 'size_id' => request()->size_id])->get()->pluck('color_id')->toArray();
        $colors = Color::active()->whereIn('id', $colorIds)->orderBy('name_en', 'asc')->groupBy('id')->get();
        return response()->json(ColorLightResource::collection($colors), 200);
    }

    public function getAttributeQty() {
        $productAttribute = ProductAttribute::where(['product_id' => request()->product_id, 'size_id' => request()->size_id, 'color_id' => request()->color_id])->first();
        return response()->json(new ProductAttributeLightResource($productAttribute), 200);
    }

    public function getAttributes() {
        $product = Product::whereId(request()->product_id)->with('product_attributes.color', 'product_attributes.size')->first();
        if ($product && $product->hasRealAttributes) {
            $attributes = ProductAttribute::where('product_id', request()->product_id)->with('color', 'size')->get();
            return response()->json(ProductAttributeLightResource::collection($attributes), 200);
        }
        return response()->json(['message' => 'no_attributes'], 200);
    }
}
