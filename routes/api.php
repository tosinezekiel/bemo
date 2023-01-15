<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ColumnController;
use App\Http\Controllers\Api\CardController;

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
    'store', 'index', 'show', 'destroy'
]);

Route::post('/columns/{column}/cards', [CardController::class, 'store']);
Route::put('/columns/{column}/cards/{card}', [CardController::class, 'update']);

Route::get('/auth/token/generate', [AuthController::class, 'clientToken']);
