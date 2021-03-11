<?php

use App\Events\MyEvent;
use App\Http\Resources\ColorLightResource;
use App\Http\Resources\ProductAttributeLightResource;
use App\Http\Resources\ProductLightResource;
use App\Http\Resources\UserResource;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/authenticated', function (Request $request) {
    return response()->json(new UserResource($request->user()), 200);
});
Route::group(['namespace' => 'Api'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::resource('favorite', 'FavoriteController')->only(['index', 'store']);
        Route::resource('user', 'UserController')->only(['update']);
        Route::resource('fan', 'FanController')->only(['store']);
        Route::resource('rating', 'RatingController');
        Route::resource('comment', 'CommentController')->only(['store']);
        Route::post('reauthenticate', 'UserController@reAuthenticate');
        Route::resource('classified', 'ClassifiedController')->only(['store', 'update', 'destroy']);
        Route::resource('address','AddressController')->only(['store','update','destroy']);
    });
    Route::get('location/address', 'GeoLocationController@getAddressFromLocation')->name('location.address');
    Route::get('country/ip', 'CountryController@getUserCountry');
    Route::resource('user', 'UserController')->only(['index', 'show']);
    Route::resource('role', 'RoleController')->only(['index']);
    Route::post('authenticate', 'UserController@authenticate');
    Route::get('google/authenticate', 'UserController@googleAuthenticate');
    Route::post('register', 'UserController@register');
    Route::resource('category', 'CategoryController')->only(['index', 'show']);
    Route::resource('product', 'ProductController')->only(['index', 'show']);
    Route::resource('collection', 'CollectionController')->only(['index', 'show']);
    Route::resource('classified', 'ClassifiedController');
    Route::resource('service', 'ServiceController')->only(['index', 'show']);
    Route::get('cart/items', 'ProductController@getProductForCart');
    Route::get('search/service', 'ServiceController@search');
    Route::get('search/product', 'ProductController@search');
    Route::get('search/classified', 'ClassifiedController@search');
    Route::get('search/user', 'UserController@search');
    Route::resource('branch', 'BranchController')->only(['index']);
    Route::resource('brand', 'BrandController')->only(['index', 'show']);
    Route::resource('timing', 'TimingController')->only(['index']);
    Route::get('local/branch', 'BranchController@getLocalBranches');
    Route::get('timing/list', 'TimingController@getTimingList');
    Route::resource('setting', 'SettingController')->only(['index']);
    Route::resource('commercial', 'CommercialController')->only(['index']);
    Route::resource('slide', 'SlideController')->only(['index']);
    Route::resource('video', 'VideoController')->only(['index', 'show']);
    Route::resource('country', 'CountryController')->only(['index', 'show']);
    Route::resource('device', 'DeviceController')->only(['store']);
    Route::resource('coupon', 'CouponController')->only(['show']);
    Route::resource('comment', 'CommentController')->only(['index']);
    Route::resource('page', 'PageController')->only(['index']);
    Route::resource('tag', 'TagController')->only(['index']);
    Route::resource('color', 'ColorController')->only(['index']);
    Route::resource('size', 'SizeController')->only(['index']);
    Route::post('map/event', function (Request $request) {
        event(new MyEvent($request->message, $request->id));
        return response()->json(['message' => $request->message, 'id' => $request->id], 200);

    });
});
Route::resource('order', 'Api\OrderController')->only(['store']);
//Route::get('size', function () {
//    $productAttribute = ProductAttribute::where(['product_id' => request()->product_id, 'color_id' => request()->color_id])->where('qty', '>', 0)->with('size')->get();
//    return response()->json($productAttribute, 200);
//});

Route::get('colors', function () {
    return ProductAttribute::where([
        'product_id' => request()->product_id,
        'size_id' => request()->size_id,
    ])->with('color')->get()->pluck('color')->unique()->pluck('id')->toArray();
});

Route::get('qty', 'Api\ProductController@getQty');

// getList of colors according to size for ProductShowScreen
Route::get('color/list', 'Api\ProductController@getColorList');

// get ProductAttribute according to size and color selected in ProductShowScrren
Route::get('attribute/qty', function () {
    $productAttribute = ProductAttribute::where(['product_id' => request()->product_id, 'size_id' => request()->size_id, 'color_id' => request()->color_id])->first();
    return response()->json(new ProductAttributeLightResource($productAttribute), 200);
});

// homekey special routes
//Route::resource('homekey/category', 'Api\Homekey\CategoryController')->only(['index', 'show']);
Route::post('attributes', function () {
    $product = Product::whereId(request()->product_id)->with('product_attributes.color', 'product_attributes.size')->first();
    if ($product && $product->hasRealAttributes) {
        $attributes = ProductAttribute::where('product_id', request()->product_id)->with('color', 'size')->get();
        return response()->json(ProductAttributeLightResource::collection($attributes), 200);
    }
    return response()->json(['message' => 'no_attributes'], 200);
});


