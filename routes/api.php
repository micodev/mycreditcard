<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/', 'cardsController@getAllAvailableCard');

Route::get('/company', 'companysController@index');
Route::post('/company', 'companysController@store');
Route::delete('/company', 'companysController@destroyAll');
Route::put('/company/{id}', 'companysController@update');
Route::delete('/company/{id}', 'companysController@destroy');
Route::get('/company/{id}', 'companysController@show');

Route::get('/type', 'typesController@index');
Route::post('/type', 'typesController@store');
Route::delete('/type', 'typesController@destoryAll');
Route::put('/type/{id}', 'typesController@update');
Route::delete('/type/{id}', 'typesController@destroy');

Route::delete('/typeComapny/{id}', 'typesController@destroyAllCardTypesByCompany');
Route::get('/typeComapny/{id}', 'typesController@getTypesFromCompany');
Route::get('/getTypeAndCompany', 'typesController@getTypeAndCompany');
Route::get('/card', 'cardsController@index');
Route::post('/card', 'cardsController@store');
Route::delete('/card', 'cardsController@destoryAll');
Route::put('/card/{id}', 'cardsController@update');
Route::delete('/card/{id}', 'cardsController@destroy');

Route::get('/cardAvailCount/', 'cardsController@getCardCount');
Route::get('/cardType/{id}', 'cardsController@getCardByType');

Route::get('/log', 'logsController@index');
Route::post('/log', 'logsController@store');
Route::get('/log/{now}/{day}', 'logsController@show');
Route::put('/log/{id}', 'logsController@update');
Route::delete('/log/{id}', 'logsController@destroy');
Route::delete('/log', 'logsController@destoryAll');
Route::delete('/logdate/{now}', 'logsController@destroybyDate');

Route::get('/user', 'usersController@index');
Route::post('/user', 'usersController@store');
Route::delete('/user', 'usersController@destroyAll');
Route::get('/user/{id}', 'usersController@show');
Route::put('/user/{id}', 'usersController@update');
Route::delete('/user/{id}', 'usersController@destroy');