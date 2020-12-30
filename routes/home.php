<?php
if (env('ABATI')) {
    Route::get('/', 'HomeController@getMobileLayout')->name('index');
    Route::get('/home', 'HomeController@getMobileLayout')->name('home');
} elseif (env('MALLR')) {
    Route::get('/', 'HomeController@getMallrHome')->name('index');
    Route::get('/home', 'HomeController@getMallrHome')->name('home');
} elseif (env('HOMEKEY')) {
        Route::get('/', 'HomeController@getHomekeyHome')->name('index');
        Route::get('/home', 'HomeController@getHomekeyHome')->name('home');
} elseif (env('ESCRAP')) {
    Route::get('/', 'HomeController@getMobileLayout')->name('index');
    Route::get('/home', 'HomeController@getMobileLayout')->name('home');
} elseif (env('ABATI')) {
    Route::get('/', 'HomeController@getMobileLayout')->name('index');
    Route::get('/home', 'HomeController@getMobileLayout')->name('home');
} elseif (env('EVENTKM')) {
    Route::get('/', 'HomeController@getEventKmHome')->name('index');
    Route::get('/home', 'HomeController@getEventKmHome')->name('home');
} elseif (env('BITS')) {
    Route::get('/', 'HomeController@getMallrHome')->name('index');
    Route::get('/home', 'HomeController@getMallrHome')->name('home');
} elseif (env('TOYS')) {
    Route::get('/', 'HomeController@getMallrHome')->name('index');
    Route::get('/home', 'HomeController@getMallrHome')->name('home');
} elseif (env('DAILY')) {
    Route::get('/', 'HomeController@getDailyHome')->name('index');
    Route::get('/home', 'HomeController@getDailyHome')->name('home');
} elseif (env('ATSPOT')) {
    Route::get('/', 'HomeController@getMobileLayout')->name('index');
    Route::get('/home', 'HomeController@getMobileLayout')->name('home');
} elseif (env('NASHKW')) {
    Route::get('/', 'HomeController@getNashKwHome')->name('index');
    Route::get('/home', 'HomeController@getNashKwHome')->name('home');
} elseif (env('EMAKEUP')) {
    Route::get('/', 'HomeController@getEmakeupHome')->name('index');
    Route::get('/home', 'HomeController@getEmakeupHome')->name('home');
} elseif (env('EXPO')) {
    Route::get('/', 'HomeController@getMobileLayout')->name('index');
    Route::get('/home', 'HomeController@getMobileLayout')->name('home');
} elseif (env('HTB')) {
    Route::get('/', 'HomeController@getMallrHome')->name('index');
    Route::get('/home', 'HomeController@getMallrHome')->name('home');
} elseif (env('HUDA')) {
    Route::get('/', 'HomeController@getMallrHome')->name('index');
    Route::get('/home', 'HomeController@getMallrHome')->name('home');
}
