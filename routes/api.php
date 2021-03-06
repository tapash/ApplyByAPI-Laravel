<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TokenController;
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

//Authentication routes
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

//Authentication routes
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', [RegisterController::class, 'register']);
});

//Job routes
Route::apiResource('jobs', JobController::class);

Route::post('gen-token', [TokenController::class, 'generateToken'])->name('generate.token');

Route::post('apply', [ApplicationController::class, 'apply'])->name('apply.job');