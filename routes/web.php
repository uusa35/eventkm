<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderPaid;
use function Composer\Autoload\includeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

Route::group(['namespace' => 'Backend', 'prefix' => 'backend', 'as' => 'backend.', 'middleware' => ['auth', 'onlyActiveUsers', 'country', 'dashboard']], function () {
    // Backend :: super + admin
    Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['admin']], function () {
        Route::resource('activity', 'ActivityController');
        Route::resource('role', 'RoleController');
        Route::resource('privilege', 'PrivilegeController');
        Route::resource('setting', 'SettingController');
        Route::get('backup/db', ['as' => 'backup.db', 'uses' => 'HomeController@BackupDB']);
        Route::get('export/translations', ['as' => 'export.translation', 'uses' => 'HomeController@exportTranslations']);
        Route::get('clear/image', 'HomeController@clearImage')->name('image.clear');
        Route::resource('country', 'CountryController');
        Route::resource('currency', 'CurrencyController');
        Route::resource('category', 'CategoryController');
        Route::get('trashed/category', 'CategoryController@trashed')->name('category.trashed');
        Route::get('restore/category/{id}', 'CategoryController@restore')->name('category.restore');
        Route::resource('group', 'CategoryGroupController');
        Route::resource('property', 'PropertyController');
        Route::resource('user', 'UserController');
        Route::get('trashed/user', 'UserController@trashed')->name('user.trashed');
        Route::get('restore/user/{id}', 'UserController@restore')->name('user.restore');
        Route::resource('color', 'ColorController');
        Route::resource('size', 'SizeController');
        Route::resource('coupon', 'CouponController');
        Route::resource('survey', 'SurveyController');
        Route::resource('questionnaire', 'QuestionnaireController');
        Route::resource('question', 'QuestionController');
        Route::resource('answer', 'AnswerController');
        Route::resource('report', 'ReportController');
        Route::resource('brand', 'BrandController');
        Route::resource('page', 'PageController');
        Route::resource('term', 'TermController');
        Route::resource('order', 'OrderController');
        Route::get('status/order', 'OrderController@changeStatus')->name('order.status');
        Route::get('search/order', 'OrderController@search')->name('order.search');
        Route::resource('tag', 'TagController');
        Route::resource('newsletter', 'NewsletterController');
        Route::resource('faq', 'FaqController');
        Route::resource('commercial', 'CommercialController');
        Route::resource('comment', 'CommentController');
        Route::resource('notification', 'NotificationController');
        Route::resource('policy', 'PolicyController');
        Route::resource('coupon', 'CouponController');
        Route::resource('role', 'RoleController');
        Route::resource('color', 'ColorController');
        Route::resource('term', 'TermController');
        Route::resource('answer', 'AnswerController');
        Route::resource('day', 'DayController');
        Route::resource('aboutus', 'AboutusController');
        Route::resource('area', 'AreaController');
        Route::resource('device', 'DeviceController');
        // addons + items
        Route::resource('addon', 'AddonController');
        Route::get('trashed/addon', 'AddonController@trashed')->name('addon.trashed');
        Route::get('restore/addon/{id}', 'AddonController@restore')->name('addon.restore');
        Route::resource('item', 'ItemController');
        Route::get('trashed/item', 'ItemController@trashed')->name('item.trashed');
        Route::get('restore/item/{id}', 'ItemController@restore')->name('item.restore');
    });
    // Backend :: companies // Designers accordingly
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('activate', 'HomeController@toggleActivate')->name('activate');
    Route::get('access/dashboard', 'HomeController@toggleAccessDashBoard')->name('access.dashboard');
    Route::get('language/{locale}', 'HomeController@changeLanguage')->name('language.change');
    Route::get('reset/password', 'UserController@getResetPassword')->name('reset.password');
    Route::post('reset/password', 'UserController@postResetPassword')->name('reset');
    Route::resource('user', 'UserController')->only(['edit', 'update', 'show', 'index']);
    Route::resource('product', 'ProductController');
    Route::get('product/trashed', 'ProductController@trashed')->name('product.trashed');
    Route::get('product/restore/{id}', 'ProductController@restore')->name('product.restore');
    Route::resource('attribute', 'ProductAttributeController');
    Route::get('trashed/attribute', 'ProductAttributeController@trashed')->name('attribute.trashed');
    Route::resource('service', 'ServiceController');
    Route::get('trashed/service', 'ServiceController@trashed')->name('service.trashed');
    Route::get('restore/service/{id}', 'ServiceController@restore')->name('service.restore');
    Route::resource('timing', 'TimingController');
    Route::resource('classified', 'ClassifiedController');
    Route::get('trashed/classified', 'ClassifiedController@trashed')->name('classified.trashed');
    Route::get('restore/classified/{id}', 'ClassifiedController@restore')->name('classified.restore');
    Route::get('property/attach', 'PropertyController@getAttach')->name('property.attach');
    Route::post('property/attach', 'PropertyController@postAttach')->name('property.attach');
    Route::get('property/dettach', 'PropertyController@detach')->name('property.detach');
    Route::resource('slide', 'SlideController');
    Route::resource('video', 'VideoController');
    Route::resource('branch', 'BranchController');
    Route::resource('order', 'OrderController')->except(['destroy']);
    Route::resource('image', 'ImageController')->only(['index', 'destroy']);
    Route::resource('tag', 'TagController');
    Route::resource('product', 'ProductController');
    Route::resource('package', 'ShipmentPackageController');
    Route::resource('collection', 'CollectionController');
    Route::resource('post', 'PostController');
    Route::get('trashed/product', 'ProductController@trashed')->name('product.trashed');
    Route::get('restore/product/{id}', 'ProductController@restore')->name('product.restore');
    Route::get('testing', function () {
        $order = Order::first();
        return Notification::send(User::first(), new OrderPaid($order));

    });
});

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.', 'middleware' => ['country']], function () {
    include('./routes/home.php');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('favorite', 'FavoriteController@index')->name('favorite.index');
        Route::get('favorite/add/product/{id}', 'FavoriteController@addProduct')->name('favorite.product.add');
        Route::get('favorite/add/service/{id}', 'FavoriteController@addService')->name('favorite.service.add');
        Route::get('favorite/add/classified/{id}', 'FavoriteController@addClassified')->name('favorite.classified.add');
        Route::get('favorite/remove/product/{id}', 'FavoriteController@removeProduct')->name('favorite.product.remove');
        Route::get('favorite/remove/service/{id}', 'FavoriteController@removeService')->name('favorite.service.remove');
        Route::get('favorite/remove/classified/{id}', 'FavoriteController@removeClassified')->name('favorite.classified.remove');
        Route::resource('survey', 'SurveyController')->only(['show', 'store']);
        Route::resource('classified', 'ClassifiedController')->only(['create', 'store', 'edit', 'update', 'delete']);
        Route::get('classified/category/choose', 'ClassifiedController@chooseCategory')->name('classified.choose');
        Route::get('property/attach', 'PropertyController@getAttach')->name('property.attach');
    });
    Route::resource('product', 'ProductController');
    Route::get('product/{id}/{name}', 'ProductController@show')->name('product.show.name');
    Route::get('compare/product/', 'ProductController@compare')->name('product.compare');
    Route::get('compare/product/add/{id}', 'ProductController@addToComparison')->name('product.compare.add');
    Route::get('compare/product/remove/{id}', 'ProductController@removeFromComparison')->name('product.compare.remove');
    Route::resource('service', 'ServiceController');
    Route::get('classified/{id}/{name}', 'ClassifiedController@show')->name('classified.show.name');
    Route::resource('classified', 'ClassifiedController')->only(['index', 'show']);
    Route::resource('collection', 'CollectionController')->only(['index', 'show']);
    Route::get('service/{id}/{name}', 'ServiceController@show')->name('service.show.name');
    Route::post('cart/add/service', 'CartController@addService')->name('cart.add.service');
    Route::post('cart/add/product', 'CartController@addProduct')->name('cart.add.product');
    Route::get('cart/remove/{id}', 'CartController@removeItem')->name('cart.remove');
    Route::get('cart/clear', 'CartController@clearCart')->name('cart.clear');
    Route::post('cart/coupon', 'CartController@applyCoupon')->name('cart.coupon');
    Route::get('cart/checkout', 'CartController@getCheckout')->name('cart.checkout');
    Route::post('cart/checkout', 'CartController@postCheckout')->name('cart.checkout');
    Route::post('cart/store', 'CartController@checkout')->name('cart.store');
    Route::resource('cart', 'CartController')->only(['index', 'show']);
    // checkout.review is order.show
    Route::resource('order', 'OrderController');
    Route::get('view/invoice/{id}', 'OrderController@viewInvoice')->name('invoice.show');
    Route::get('view/invoice/pdf/{id}', 'OrderController@pdfInvoice')->name('invoice.pdf');
    Route::get('order/cash/delivery/{id}', 'OrderController@cashOnDeliveryReceived')->name('order.cash.delivery');
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::get('search/user', 'UserController@search')->name('user.search');
    Route::get('user/{id}/{name}', 'UserController@show')->name('user.show.name');
    Route::resource('page', 'PageController')->only(['show']);
    Route::get('page/{id}/{name}', 'PageController@show')->name('page.show.name');
    Route::resource('post', 'PostController')->only(['show', 'index']);
    Route::get('post/{id}/{name}', 'PostController@show')->name('post.show.name');
    Route::resource('newsletter', 'NewsletterController');
    Route::get('search/all', 'HomeController@search')->name('search');
    Route::get('search/product', 'ProductController@search')->name('product.search');
    Route::get('search/set', 'ServiceController@setDateAndArea')->name('service.set');
    Route::get('search/service/clear', 'ServiceController@getClearSearch')->name('service.clear');
    Route::get('search/product/clear', 'ProductController@getClearSearch')->name('product.clear');
    Route::get('search/service', 'ServiceController@search')->name('service.search');
    Route::get('search/classified', 'ClassifiedController@search')->name('classified.search');
    Route::get('currency/{currency}', 'HomeController@changeCurrency')->name('currency.change');
    Route::get('language/{locale}', 'HomeController@changeLanguage')->name('language.change');
    Route::get('country/set', 'HomeController@setCountry')->name('country.set');
    Route::get('element/linking', 'HomeController@handleDeepLinking')->name('deep.linking');
    Route::resource('fan', 'FanController')->only(['create', 'index']);
});

Auth::routes();
Route::get('auth/google', 'Auth\LoginController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('webview', function () {
    return view('webview');
});


// for development purpose only
if (app()->environment('production') || app()->environment('local')) {

    // for develoment mode only
    Route::get("testing", function (Request $request) {
        $responseAr = \GoogleMaps::load('geocoding')
            ->setParam([
                'latlng' => $request->lat . ',' . $request->long,
                'language' => 'ar'
            ])
            ->get();
    });
    Route::get('/posting/{id}/{role}', 'Frontend\HomeController@getInfo');
}
Route::get('/marwa/{scoreOne}/{scoreTow}/{scoreThree}/{attestedHours}', function ($materialScoreOne, $materialScoreTow, $materialScoreThree, $attestedHours) {
    $degreeOne = $materialScoreOne / 25;
    $degreeTow = $materialScoreTow / 25;
    $degreeThree = $materialScoreThree / 25;
    $pointOne = $degreeOne * $attestedHours;
    $pointTow = $degreeTow * $attestedHours;
    $pointThree = $degreeThree * $attestedHours;
    $semesterRate = ($pointOne + $pointTow + $pointThree) / 3;
    $collectiveRate = $semesterRate / 3;
    return response()->json(['Grade Point Average (GPA)' => round($collectiveRate, 2)], 200);
});

Route::get('/{notFound}', function () {
    abort('404', trans('message.not_found'));
});


