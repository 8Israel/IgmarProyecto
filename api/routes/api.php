<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TwoFactorController;
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
use Tymon\JWTAuth\Facades\JWTAuth;
use PragmaRX\Google2FA\Google2FA;


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
Route::get('activate/{token}', [AuthController::class, 'activate'])->name('activate');
Route::post('/verify-two-factor-code', [AuthController::class, 'verifyTwoFactorCode'])->middleware(['activate']);
Route::post('login', [AuthController::class,'login'])->middleware(['activate2']);

Route::group([
    'middleware' => ['api', 'activate', 'check.role:user', 'verificado'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
<<<<<<< HEAD
    Route::post('login', [AuthController::class,'login']);
    Route::post('delete/:user_id', [AuthController::class, 'delete']);
    Route::post('/verify-two-factor-code', [AuthController::class, 'verifyTwoFactorCode']);
=======
>>>>>>> 5749a89dc800438c3b3353ff1ffbd29f28a88508

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





Route::group([
    'middleware' => ['api', 'activate', 'check.role:user', 'verificado'],
    'prefix' => 'auth'
], function ($router) {

});



Route::group([
    'middleware' => ['api', 'activate', 'check.role:user', 'verificado'],
    'prefix' => 'auth'
], function ($router) {

});
