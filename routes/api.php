<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/name', function (Request $request) {
    return response()->json(['name' => $request->user()->name]);
});

Route::prefix('sanctum')->group(function() {
    Route::post('register', 'App\Http\Controllers\API\AuthController@register');
    Route::post('token', 'App\Http\Controllers\API\AuthController@token');
});

