<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebControllers\OutletController;
use App\Http\Controllers\WebControllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// using breeze package for  authentication
Route::group(['middleware'=>['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('outlet', OutletController::class);
});


require __DIR__.'/auth.php';
