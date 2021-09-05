<?php

use App\Http\Controllers\Api\AccessTokenController;
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
Route::post('auth/tokens', [AccessTokenController::class, 'store']);

Route::delete('auth/tokens',[AccessTokenController::class,'destroy'])->middleware('auth:sanctum');
Route::apiResource('categories', 'Api\CategoreyController')->middleware('auth:sanctum');
