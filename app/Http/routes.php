<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/users', 'ApiController@getUsers');

Route::post('/users','ApiController@createUser');

Route::get('/empresa/registro', 'HomeController@registroEmpresa');
Route::post('/empresa/registrar', 'HomeController@registrarEmpresa');

//Route::post('/algo','ApiController@algo');
