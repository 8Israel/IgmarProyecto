<?php

use App\Http\Controllers\MisionController;
use App\Http\Controllers\testwebsoket;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', [testwebsoket::class,'test']);//Mostrar todas las misiones, User, Admin,Guest

