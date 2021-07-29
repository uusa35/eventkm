<?php

use App\Events\MyEvent;
use App\Http\Resources\UserResource;
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
        Route::post('mobile/resend/code', 'UserController@resendVerificationCode');
        Route::resource('fan', 'FanController')->only(['store']);
        Route::resource('rating', 'RatingController');
        Route::resource('comment', 'CommentController')->only(['store']);
        Route::post('reauthenticate', 'UserController@reAuthenticate');
        Route::resource('classified', 'ClassifiedController')->only(['store', 'update', 'destroy']);
        Route::resource('address', 'AddressController')->only(['store', 'update', 'destroy']);
        Route::resource('product', 'ProductController')->only(['store', 'update']);
    });
    Route::post('authenticate', 'UserController@authenticate');
    Route::get('location/address', 'GeoLocationController@getAddressFromLocation')->name('location.address');
    Route::get('country/ip', 'CountryController@getUserCountry');
    Route::resource('user', 'UserController')->only(['index', 'show']);
    Route::resource('role', 'RoleController')->only(['index']);
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
    Route::get('search/category', 'CategoryController@search');
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
    Route::resource('faq', 'FaqController')->only(['index']);
    Route::resource('color', 'ColorController')->only(['index']);
    Route::resource('size', 'SizeController')->only(['index']);
    Route::resource('post', 'PostController')->only(['index', 'show']);
    Route::resource('currency', 'CurrencyController')->only(['index', 'show']);
    Route::post('map/event', function (Request $request) {
        event(new MyEvent($request->message, $request->id));
        return response()->json(['message' => $request->message, 'id' => $request->id], 200);

    });
    Route::get('mobile/code', 'UserController@verifyMobileCode');
    Route::post('delivery/calculation', 'OrderController@calculateDeliveryChargeForApi');
});
Route::resource('order', 'Api\OrderController')->only(['store']);
Route::get('colors', 'Api\ProductController@getColors');
Route::get('qty', 'Api\ProductController@getQty');

// getList of colors according to size for ProductShowScreen
Route::get('color/list', 'Api\ProductController@getColorList');

// get ProductAttribute according to size and color selected in ProductShowScrren
Route::get('attribute/qty', 'Api\ProductController@getAttributeQty');

// homekey special routes
//Route::resource('homekey/category', 'Api\Homekey\CategoryController')->only(['index', 'show']);
Route::post('attributes', 'Api\ProductController@getAttributes');



