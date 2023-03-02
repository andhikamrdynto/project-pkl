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

Route::middleware('jwt.verify')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('jwt.verify')->group(function() {

    // jurusan api
    Route::group(['prefix' => 'jurusan'], function(){
        Route::get('/data', [App\Http\Controllers\Api\JurusanController::class, 'index']);
        Route::post('/create', [App\Http\Controllers\Api\JurusanController::class, 'store']);
        Route::post('/list', [App\Http\Controllers\Api\JurusanController::class, 'edit']);
        Route::post('/update', [App\Http\Controllers\Api\JurusanController::class, 'update']);
        Route::delete('/delete', [App\Http\Controllers\Api\JurusanController::class, 'destroy']);
    });

    // 
});

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('apilogin');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');