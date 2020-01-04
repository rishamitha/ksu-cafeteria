<?php

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
|
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {
        Route::get('', 'MenuController@index')->name('index');

        Route::get('create', 'MenuController@create')->name('create');
        Route::post('', 'MenuController@store')->name('store');

        Route::get('{menu}', 'MenuController@edit')->name('edit');
        Route::patch('{menu}', 'MenuController@update')->name('update');

        Route::delete('{menu?}', 'MenuController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function () {
        Route::get('', 'GalleryController@index')->name('index');

        Route::post('', 'GalleryController@store')->name('store');
        Route::patch('{gallery?}', 'GalleryController@update')->name('update');
        Route::delete('{gallery?}', 'GalleryController@destroy')->name('destroy');
    });

    Route::patch('stall/{stall}', 'StallController@update')->name('stall.update');
});

Route::group(['as' => 'auth.', 'namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login');

    Route::get('logout', 'LoginController@logout')->name('logout');

    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register')->name('register');
});
