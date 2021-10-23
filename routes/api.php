<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::prefix('usuario')->group(function() {
    Route::get('index','ControllerUsuario@index');
    Route::post('store','ControllerUsuario@store');
    Route::delete('delete', 'ControllerUsuario@delete');
    Route::put('update', 'ControllerUsuario@update');
});

