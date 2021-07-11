<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 7/15/17
 * Time: 6:04 PM
 */
Route::group(['namespace' => 'Usama\MyFatoorah\Controllers'], function () {
    Route::group(['middleware' => 'api'], function () {
        Route::post('api/myfatoorah/payment', 'MyFatoorahPaymentController@makePaymentApi')->name('myfatoorah.api.payment.create');
    });


    Route::group(['middleware' => ['web', 'auth']], function () {
        Route::post('myfatoorah/payment', 'MyFatoorahPaymentController@makePayment')->name('myfatoorah.web.payment.create');
    });
    Route::group(['middleware' => ['web']], function () {
        Route::get('myfatoorah/result', 'MyFatoorahPaymentController@result')->name('myfatoorah.web.payment.result');
        Route::get('myfatoorah/error', 'MyFatoorahPaymentController@error')->name('myfatoorah.web.payment.error');
    });
});





