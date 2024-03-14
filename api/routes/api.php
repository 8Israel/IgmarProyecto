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
    Route::get('/friends', [AmigoController::class, 'show']);//Muestra los amigos del usuario logueado
    Route::delete('/friends/delete/{id}', [AmigoController::class, 'destroy']);//Elimina amigos del usuario logueado indicando su usuario en la ruta
    Route::post('/friends/agregate/{id}', [AmigoController::class, 'store']);//Agrega al usario indicado en la ruta como amigo del usuario logueado

    Route::get('/inventario', [InventarioJugadorController::class, 'index']);//Edita el inventario del usuario logueado
    Route::put('/inventario/update', [InventarioJugadorController::class, 'update']);//Muestra el inventario del usuario logueado

    Route::get('/estadisticas', [EstadisticasController::class, 'index']);//Muestra las estadisticas del usuario logueado

    Route::post('/clan/create', [ClanController::class, 'store']);// Crea un nuevo clan y asigna al usuario logueado como lider
    Route::get('/clan/show/misclanes', [ClanController::class, 'show']);// Muestra los clanes en los que el usuario logueado es el lider
    Route::delete('/clan/delete/{id}', [ClanController::class, 'delete']);//desactiva el clan indicado en la ruta solo si el usuario logueado es el lider
    Route::get('/clan/userClans', [ClanMiembroController::class,'getUserClans']);// devuelve todos los clanes a los que el usuario logueado pertenece

    Route::post('/clan/miembros/join/{id}', [ClanMiembroController::class,'store']);//ingresa al clan el usuario logeado
    Route::delete('/clan/miembros/delete/{id}', [ClanMiembroController::class,'destroy']);// elimina al usuario logueado del clan indicado en la ruta
    
    Route::post('/misiones/completar/{id}', [MisionesCompletadasController::class,'Store']);//completar Misiones, User
    Route::get('/misiones/show/misionesCompletas', [MisionesCompletadasController::class,'showMisionesComplete']);//Mostrar misiones completas, User
    Route::get('/misiones/show/misionesIncompletas', [MisionesCompletadasController::class,'showMisionesInComplete']);//Mostrar misiones incompletas, User

});

//  ADMIN
Route::group([
    'middleware' => ['api', 'activate', 'check.role:admin', 'verificado'],
    'prefix' => 'user'
], function ($router) {
    Route::put('/update/{id}', [UserController::class, 'update']);// Actualiza la informacion del usuario indicado en la ruta
    Route::delete('/delete/{id}', [UserController::class, 'delete']);// Desactiva a el usuario indicado en la ruta

    Route::get('/estadisticas/{id}', [EstadisticasController::class, 'index']);// Muestra las estadisticas del usuario indicado en la ruta
    Route::get('/inventario/{id}', [InventarioJugadorController::class, 'index']);// Muestra el inventario del usuario indicado en la ruta

    Route::post('/clan/create/{id}', [ClanController::class, 'store']);// Crea un clan y asigna al usuario indicado en la ruta como lider
    Route::get('/clan/show/clanesUsuario/{id}', [ClanController::class, 'show']);// Muestra los clanesque le pertenecen a el usuario indicado en la ruta
    Route::delete('/clan/delete/{id}', [ClanController::class, 'deleteAdmin']);// Desactiva el clan indicado en la ruta
    Route::get('/clan/userClans/{idUser}', [ClanMiembroController::class,'getUserClans']);// Muestra los clanes en los que esta el usuario indicado en la ruta

    Route::put('/clan/miembros/update/{id}/{idUser}', [ClanMiembroController::class,'update']);// actualiza el rol del usuario
    Route::post('/clan/miembros/join/{id}/{idUser}', [ClanMiembroController::class,'store']);// Ingresa a el usuario indicado en la ruta en el clan indicado en la ruta
    Route::delete('/clan/miembros/delete/{id}/{idUser}', [ClanMiembroController::class,'destroy']);//Elimina a el usuario indicado en la ruta del clan indicado en la ruta

    Route::post('/armas/create', [ArmaController::class, 'store']);// Crea armas nuevas
    Route::delete('/armas/delete/{id}', [ArmaController::class, 'destroy']);// Borra el arma indicada en la ruta
    Route::put('/armas/update/{id}', [ArmaController::class, 'update']);// Actualiza el arma indicado en la ruta

    Route::post('/heroes/create', [HeroeController::class, 'store']);// Crea heroes nuevos
    Route::delete('/heroes/delete/{id}', [HeroeController::class, 'destroy']);// Borra a el heroe indicado en la ruta
    Route::put('/heroes/update/{id}', [HeroeController::class, 'update']);// Actualiza a el heroe indicadp en la ruta

    Route::get('/misiones/index', [MisionController::class,'index']);
    Route::post('/misiones/create', [MisionController::class,'store']);//Crear misiones
    Route::put('/misiones/update/{id}', [MisionController::class,'update']);//actualizar misiones
    Route::delete('/misiones/delete/{id}', [MisionController::class,'destroy']);//Eliminar misiones
    
    Route::get('/recompensas/index', [RecompensaController::class,'index']);// Muestra las recompensas
    Route::post('/recompensas/create', [RecompensaController::class,'store']);// Crea recompensas
    Route::put('/recompensas/update/{id}', [RecompensaController::class,'update']);// Actualiza recompensas
    Route::delete('/recompensas/delete/{id}', [RecompensaController::class,'destroy']);// Borra recompensas


    Route::post('/misiones/show/misionesCompletas/{id}', [MisionesCompletadasController::class,'showMisionesComplete']);//Mostrar misiones completas por usuarios, Admin
    Route::get('/misiones/show/misionesIncompletas/{id}', [MisionesCompletadasController::class,'showMisionesInComplete']);//Mostrar misiones incompletas por usuarios, Admin
});

//  ADMIN Y USERS
Route::group([
    'middleware' => ['api', 'activate', 'check.role:admin,user', 'verificado'],
    'prefix' => 'user'
], function ($router) {
    Route::put('/clan/update/{id}', [ClanController::class, 'update']);//actualiza el nombre del clan
    Route::get('/clan/miembros/index/{id}', [ClanMiembroController::class,'index']);// Muestra a los miembros del clan indicado en la ruta
    Route::get('/index/{id?}', [UserController::class, 'index']);// Muestra a todos los usuario con la oportunidad de diltrar por el usuario indicado en la ruta
});

//  RUTAS GLOBALES
Route::group([
    'middleware' => ['api', 'activate', 'check.role:admin,guest,user', 'verificado'],
    'prefix' => 'user'
], function ($router) {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);//regresa la informacion del usuario

    Route::get('/clan/show/all/{id?}', [ClanController::class, 'index']); // Muestra todos los clanes activos
    Route::get('/armas/index/{id?}', [ArmaController::class, 'index']);// Muestra todas las armas y puedes filtrar por el arma indicada en la ruta
    Route::get('/heroes/index/{id?}', [HeroeController::class, 'index']);// Muestra todoslos herores y puedes filtrar por el heroe indicado en la ruta
    Route::get('/misiones/show', [MisionController::class,'index']);//Mostrar todas las misiones, User, Admin,Guest

});
//BASURA
Route::resource('misiones-completadas', MisionesCompletadasController::class);
