<?php
if (env('MOBILE_LAYOUT')) {
    Route::get('/', 'HomeController@getMobileLayout')->name('index');
    Route::get('/home', 'HomeController@getMobileLayout')->name('home');
} elseif (env('MALLR')) {
    Route::get('/', 'HomeController@getMallrHome')->name('index');
    Route::get('/home', 'HomeController@getMallrHome')->name('home');
} elseif (env('HOMEKEY')) {
    Route::get('/', 'HomeController@getHomekeyHome')->name('index');
    Route::get('/home', 'HomeController@getHomekeyHome')->name('home');
} elseif (env('EVENTKM')) {
    Route::get('/', 'HomeController@getEventKmHome')->name('index');
    Route::get('/home', 'HomeController@getEventKmHome')->name('home');
} elseif (env('BITS')) {
    Route::get('/', 'HomeController@getMallrHome')->name('index');
    Route::get('/home', 'HomeController@getMallrHome')->name('home');
} elseif (env('EXPO')) {
    Route::get('/', 'HomeController@getExpoHome')->name('index');
    Route::get('/home', 'HomeController@getExpoHome')->name('home');
} elseif (env('DAILY')) {
    Route::get('/', 'HomeController@getDailyHome')->name('index');
    Route::get('/home', 'HomeController@getDailyHome')->name('home');
} elseif (env('NASHKW')) {
    Route::get('/', 'HomeController@getNashKwHome')->name('index');
    Route::get('/home', 'HomeController@getNashKwHome')->name('home');
} elseif (env('EMAKEUP')) {
    Route::get('/', 'HomeController@getEmakeupHome')->name('index');
    Route::get('/home', 'HomeController@getEmakeupHome')->name('home');
} elseif (env('HTB')) {
    Route::get('/', 'HomeController@getMallrHome')->name('index');
    Route::get('/home', 'HomeController@getMallrHome')->name('home');
} elseif (env('HUDA')) {
    Route::get('/', 'HomeController@getMallrHome')->name('index');
    Route::get('/home', 'HomeController@getMallrHome')->name('home');
} elseif (env('DESIGNERAAT')) {
    Route::get('/', 'HomeController@getDesigneratHome')->name('index');
    Route::get('/home', 'HomeController@getDesigneratHome')->name('home');
} elseif (env('ISTORES')) {
    Route::get('/', 'HomeController@getIstoresHome')->name('index');
    Route::get('/home', 'HomeController@getIstoresHome')->name('home');
} else {
    Route::get('/', 'HomeController@getMallrHome')->name('index');
    Route::get('/home', 'HomeController@getMallrHome')->name('home');
}
