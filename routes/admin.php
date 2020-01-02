<?php

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
|
*/
Route::get('/', 'HomeController@index');

Route::namespace('menu.')->group(function () {
    Route::get('', function () {
        return 'test';
    })->name('index');

    Route::get('create', function () {})->name('create');

    Route::post('', function () {
        return 'store menu';
    })->name('store');

    Route::get('edit', function () {})->name('edit');
    Route::patch('update', function () {})->name('update');
    Route::delete('delete', function () {})->name('destroy');
});

Auth::routes();
