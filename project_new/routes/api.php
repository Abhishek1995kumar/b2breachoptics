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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('greeting', 'MessageController@index')
//       ->middleware('localization');

// Route::namespace('API')->group(function(){

// 	Route::get('push-order/{id}','api@pushorder');

// });


Route::get('push-order/{id}','api@pushorder');