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

Route::redirect('/', '/home');

Route::get('/home', 'StarWarsController@homeRequest');
Route::get('/query', 'StarWarsController@queryRequest');

Route::get('/{category}', 'StarWarsController@entitiesRequest')
    ->where('category', 'people|vehicles|planets|starships|species|films');

Route::get('/{category}/{id}', 'StarWarsController@entityRequest')
    ->where('category', 'people|vehicles|planets|starships|species|films');