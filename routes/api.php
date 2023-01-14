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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('columns', ColumnController::class)->only([
    'store', 'index', 'show', 'update', 'destroy'
]);

Route::post('/columns/{column}/cards', [ColumnCardController::class, 'store']);

Route::resource('cards', ColumnController::class)->only([
    'show', 'update', 'destroy'
]);

Route::get('/auth/token/generate', [AuthController::class, 'clientToken']);
