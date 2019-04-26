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
Route::get('/', function(){
    return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);
});

Route::post('auth/login', 'AuthController@authenticate');

Route::group(array('prefix' => 'auth', 'middleware' => ['jwt.verify']), function(){
    Route::get('me', 'AuthController@me');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::resource('jobs', 'JobsController');
    Route::resource('companies', 'CompaniesController');
});

Route::get(' ', function(){
    return redirect('api');
});