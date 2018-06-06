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



Route::get('users', 'UserController@fetchAll');
Route::get('users/{user}', 'UserController@fetch');
Route::post('users', 'UserController@create');
Route::patch('users/{user}', 'UserController@update');

Route::get('groups', 'GroupController@fetchAll');
Route::get('groups/{group}', 'GroupController@fetch');
Route::post('groups', 'GroupController@create');
Route::patch('groups/{group}', 'GroupController@update');
