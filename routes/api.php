<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\UserController;
use App\Http\Controllers\ApiControllers\OutletController;

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

// public route
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

// authentication using sanctum package
// protected route
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::resource('user', UserController::class);
    Route::resource('outlet', OutletController::class);
    Route::post('/logout', [UserController::class, 'logout']);
});
