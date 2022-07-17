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
Route::post('/api_register', [App\Http\Controllers\API\AuthController::class, 'api_register'])->name('api_register');
Route::post('/api_login', [App\Http\Controllers\API\AuthController::class, 'api_login'])->name('api_login');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->post('/api_logout', [App\Http\Controllers\API\AuthController::class, 'api_logout']);
