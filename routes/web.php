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


Route::get('/transactions/create','transactionsController@create');
Route::get('/transactions/{category?}','transactionsController@index');
Route::get ('/transactions/{transaction}','transactionsController@edit');
Route::post('/transactions','transactionsController@store');
Route::put('/transactions/{transaction}','transactionsController@update');
Route::delete('/transactions/{transaction}', 'transactionsController@destroy');

Route::get('/categories', 'categoriesController@index');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
