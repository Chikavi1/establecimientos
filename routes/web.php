<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);


Route::group(['middleware' => ['auth','verified']], function(){

	Route::get('/establecimientos/create','EstablecimientoController@create')->name('establecimiento.create');
	Route::post('/establecimientos','EstablecimientoController@store')->name('establecimiento.store');
	Route::get('/establecimientos/edit','EstablecimientoController@edit')->name('establecimiento.edit');
	Route::put('/establecimientos/{establecimiento}','EstablecimientoController@update')->name('establecimiento.update');


	Route::post('/imagenes/store','ImagenController@store')->name('imagenes.store');
	Route::post('/imagenes/destroy','ImagenController@destroy')->name('imagenes.destroy');

});