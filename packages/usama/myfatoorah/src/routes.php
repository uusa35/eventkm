<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 7/15/17
 * Time: 6:04 PM
 */
Route::group(['middleware' => 'api'], function () {
    Route::post('api/myfatoorah/payment', 'Usama\MyFatoorah\MyFatoorahPaymentController@makePaymentApi')->name('myfatoorah.api.payment.create');
});


Route::group(['middleware' => ['web', 'auth']], function () {
    Route::post('myfatoorah/payment', 'Usama\MyFatoorah\MyFatoorahPaymentController@makePaymenmyfatoorah/paymentt')->name('myfatoorah.web.payment.create');
});
Route::group(['middleware' => ['web']], function () {
    Route::get('myfatoorah/result', 'Usama\MyFatoorah\MyFatoorahPaymentController@result')->name('myfatoorah.web.payment.result');
    Route::get('myfatoorah/error', 'Usama\MyFatoorah\MyFatoorahPaymentController@error')->name('myfatoorah.web.payment.error');
});





