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

Route::get('/','blogcont@index');
Route::get('/show/{id}','blogcont@show');
Route::get('/create','blogcont@create');
Route::post('/create','blogcont@store');
Route::get('/update/{id}','blogcont@edit');
Route::post('/update/{id}','blogcont@update');
Route::get('/delete/{id}','blogcont@delete');
Route::get('/complited/{id}','blogcont@complited');


