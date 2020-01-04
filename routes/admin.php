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

        Route::get('edit/{menu}', 'MenuController@edit')->name('edit');
        Route::patch('{menu}', 'MenuController@update')->name('update');
        Route::delete('{menu?}', 'MenuController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function () {
        Route::get('', 'GalleryController@index')->name('index');

        Route::get('create', function () {})->name('create');

        Route::post('', function () {
            return 'store menu';
        })->name('store');

        Route::get('edit', function () {})->name('edit');
        Route::patch('update', function () {})->name('update');
        Route::delete('delete', function () {})->name('destroy');
    });
});

Route::group(['as' => 'auth.', 'namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login');

    Route::get('logout', 'LoginController@logout')->name('logout');

    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register')->name('register');
});
