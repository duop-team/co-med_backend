<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\StaffController;
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
    Route::post('register', [AuthController::class, 'register']);
    Route::post('token', [AuthController::class, 'token']);
});

Route::get('news', [NewsController::class, 'index']);
Route::middleware('auth:sanctum')->post('news', [NewsController::class, 'store']);
Route::middleware('auth:sanctum')->put('news/{record}', [NewsController::class, 'update']);
Route::get('news/{record}', [NewsController::class, 'show']);
Route::middleware('auth:sanctum')->delete('news/{record}', [NewsController::class, 'destroy']);

Route::middleware('auth:sanctum')->post('staff', [StaffController::class, 'store']);
Route::middleware('auth:sanctum')->get('staff', [StaffController::class, 'index']);
Route::middleware('auth:sanctum')->delete('staff/{record}', [StaffController::class, 'destroy']);
