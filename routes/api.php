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

Route::post('login','Api\AuthController@login');
Route::post('register','Api\AuthController@register');
Route::get('logout','Api\AuthController@logout');

// Kajian
Route::group(['middleware' => ['jwtAuth']], function () {
    Route::post('kajian/create','Api\KajianController@create');
    Route::post('kajian/delete','Api\KajianController@delete');
    Route::post('kajian/update','Api\KajianController@update');
    Route::get('kajian','Api\KajianController@kajian');

    Route::post('kajian/simpan','Api\SimpankajianController@simpankajian');
});
