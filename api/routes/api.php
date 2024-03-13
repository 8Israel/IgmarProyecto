<?php

use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\UserController;
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

//  RUTAS SIN SIN PROTECCION O MUY POCA
Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/verify-two-factor-code', [AuthController::class, 'verifyTwoFactorCode'])->middleware(['activate']);
    Route::post('/login', [AuthController::class, 'login'])->middleware(['activate2']);
});
Route::get('/activate/{token}', [AuthController::class, 'activate'])->name('activate');

//  USERS
Route::group([
    'middleware' => ['api', 'activate', 'check.role:user,admin', 'verificado'],
    'prefix' => 'user'
], function ($router) {
    Route::get('/friends', [AmigoController::class, 'show']);
    Route::put('/friends/delete/{id}', [AmigoController::class, 'destroy']);
    Route::post('/friends/agregate/{id}', [AmigoController::class, 'store']);

    Route::get('/inventario', [InventarioJugadorController::class, 'index']);
    Route::post('/inventario/update', [InventarioJugadorController::class, 'update']);

    Route::get('/estadisticas', [EstadisticasController::class, 'index']);

    Route::post('/clan/create', [ClanController::class, 'store']);
    Route::get('/clan/show/misclanes', [ClanController::class, 'show']);
    Route::put('/clan/delete/{id}', [ClanController::class, 'delete']);
    Route::get('/clan/userClans', [ClanMiembroController::class,'getUserClans']);

    Route::post('/clan/miembros/join/{id}', [ClanMiembroController::class,'store']);
    Route::post('/clan/miembros/delete/{id}', [ClanMiembroController::class,'destroy']);

});

//  ADMIN
Route::group([
    'middleware' => ['api', 'activate', 'check.role:admin', 'verificado'],
    'prefix' => 'user'
], function ($router) {
    Route::post('/edit/{id}', [UserController::class, 'edit']);
    Route::put('/delete/{id}', [UserController::class, 'delete']);
    Route::get('/index/{id?}', [UserController::class, 'index']);

    Route::get('/estadisticas/{id}', [EstadisticasController::class, 'index']);
    Route::get('/inventario/{id}', [InventarioJugadorController::class, 'index']);

    Route::post('/clan/create/{id}', [ClanController::class, 'store']);
    Route::get('/clan/show/clanesUsuario/{id}', [ClanController::class, 'show']);
    Route::put('/clan/delete/{id}', [ClanController::class, 'deleteAdmin']);
    Route::get('/clan/userClans/{idUser}', [ClanMiembroController::class,'getUserClans']);
    Route::post('/clan/miembros/update/{id}/{idUser}', [ClanMiembroController::class,'update']);
    Route::post('/clan/miembros/join/{id}/{idUser}', [ClanMiembroController::class,'store']);
    Route::post('/clan/miembros/delete/{id}/{idUser}', [ClanMiembroController::class,'destroy']);

    Route::post('/armas/create', [ArmaController::class, 'store']);
    Route::post('/armas/delete/{id}', [ArmaController::class, 'destroy']);
    Route::post('/armas/update/{id}', [ArmaController::class, 'update']);

    Route::post('/heroes/create', [HeroeController::class, 'store']);
    Route::post('/heroes/delete/{id}', [HeroeController::class, 'destroy']);
});

//  ADMIN Y USERS
Route::group([
    'middleware' => ['api', 'activate', 'check.role:admin,user', 'verificado'],
    'prefix' => 'user'
], function ($router) {

    Route::post('/clan/update/{id}', [ClanController::class, 'update']);
    Route::get('/clan/miembros/index/{id}', [ClanMiembroController::class,'index']);

});

//  RUTAS GLOBALES
Route::group([
    'middleware' => ['api', 'activate', 'check.role:admin,guest,user', 'verificado'],
    'prefix' => 'user'
], function ($router) {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/clan/show/all/{id?}', [ClanController::class, 'index']);
    Route::get('/armas/index/{id?}', [ArmaController::class, 'index']);
    Route::get('/heroes/index/{id?}', [HeroeController::class, 'index']);

});


//BASURA
Route::resource('misiones', MisionController::class);
Route::resource('recompensas', RecompensaController::class);
Route::resource('misiones-completadas', MisionesCompletadasController::class);
