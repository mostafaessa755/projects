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


Route::group(['prefix' => 'admin'], function () {





    Route::get('/','DashboardController@index');

    /* create product*/
    Route::resource('/products','ProductController');

    /*Order */
    Route::resource('/orders','OrderController');

    Route::get('/confirm/{id}','OrderController@confirm')->name('order.confirm');
    Route::get('/pending/{id}','OrderController@pending')->name('order.pending');

    /* Users */
    Route::resource('/users','usersController');

    /* Login Admin */

    Route::get('/login','AdminUserController@index')->name('login');
    Route::post('/login','AdminUserController@store');
});
