<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\cosas;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\ArmaController;
use App\Http\Controllers\HeroeController;
use App\Http\Controllers\MisionController;
use App\Http\Controllers\RecompensaController;
use App\Http\Controllers\AmigoController;
use App\Http\Controllers\InventarioJugadorController;
use App\Http\Controllers\MisionesCompletadasController;
use App\Http\Controllers\ClanController;
use App\Http\Controllers\ClanMiembroController;


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
Route::get('activate/{token}', [AuthController::class, 'activate'])->name('activate');

Route::group([
    'middleware' => ['api', 'check.role:user,admin','activate'],
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
    'middleware' => ['api', 'user'],
    'prefix' => 'auth'
], function ($router) {

    // Rutas para guest
    Route::resource('jugadores', JugadorController::class);
    Route::resource('armas', ArmaController::class);
    Route::resource('heroes', HeroeController::class);
    Route::resource('misiones', MisionController::class);
    Route::resource('recompensas', RecompensaController::class);
    Route::resource('amigos', AmigoController::class);
    Route::resource('inventarios-jugador', InventarioJugadorController::class);
    Route::resource('misiones-completadas', MisionesCompletadasController::class);
    Route::resource('clanes', ClanController::class);
    Route::resource('clan-miembros', ClanMiembroController::class);

});
