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

Route::get('/', 'StarWars\HomeController@homeRoute');
Route::get('/home', 'StarWars\HomeController@homeRoute');

Route::get('/{category}/{id}', 'StarWars\EntityController@entity')
    ->where('category', 'people|vehicles|planets|starships|species|films')
    ->where('id', '[0-9]+');

Route::get('/{category}', 'StarWars\EntityController@entities')
    ->where('category', 'people|vehicles|planets|starships|species|films');