<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\cosas;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class,'login']);



Route::group([
    'middleware' => ['api', 'check.role:user,admin'],
    'prefix' => 'auth'
], function ($router) {

    // Rutas para administrador y user

    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});



Route::group([
    'middleware' => ['api', 'check.role:admin'],
    'prefix' => 'auth'
], function ($router) {

    //Rutas solo para administrador

});



Route::group([
    'middleware' => ['api', 'check.role:guest'],
    'prefix' => 'auth'
], function ($router) {


    //Rutas para guest

});