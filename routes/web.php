<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Vista\CatalogoController;
use App\Http\Controllers\Vista\PrincipalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ======================= Itoken ============================
Route::get('/', [PrincipalController::class, 'itoken']);
Route::post('/', [PrincipalController::class, 'store']);

// ======================= Token Innovación ============================
Route::get('/token-innovacion', [PrincipalController::class, 'tokenInnovacion']);
Route::post('/token-innovacion', [PrincipalController::class, 'StoreTokenInnovacion']);

// ======================= Admin ============================
Route::get('/add-token-admin', [PrincipalController::class, 'addTokenAdmin']);
Route::post('/add-token-admin', [PrincipalController::class, 'storeAddTokenAdmin']);

// ======================= Perfil ============================
Route::get('/perfil', [PrincipalController::class, 'perfil']);
Route::post('/perfil/{id}', [PrincipalController::class, 'updatePerfil']);

// ======================= Auth ============================
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/logout', [LogoutController::class, 'store']);

// ======================= Catálago ============================
// País
Route::get('/pais', [CatalogoController::class, 'pais']);
Route::post('/pais', [CatalogoController::class, 'storePais']);
Route::patch('/pais/{id}', [CatalogoController::class, 'updatePais']);
Route::delete('/pais/{id}', [CatalogoController::class, 'destroyPais']);

// Detalle Servicio
Route::get('/detalle_servcio', [CatalogoController::class, 'DS']);
Route::post('/detalle_servcio', [CatalogoController::class, 'storeDS']);
Route::patch('/detalle_servcio/{id}', [CatalogoController::class, 'updateDS']);
Route::delete('/detalle_servcio/{id}', [CatalogoController::class, 'destroyDS']);

// Categoria giro
Route::get('/categoria_giro', [CatalogoController::class, 'CG']);
Route::post('/categoria_giro', [CatalogoController::class, 'storeCG']);
Route::patch('/categoria_giro/{id}', [CatalogoController::class, 'updateCG']);
Route::delete('/categoria_giro/{id}', [CatalogoController::class, 'destroyCG']);

// Negocio giro
Route::get('/negocio_giro', [CatalogoController::class, 'NG']);
Route::post('/negocio_giro', [CatalogoController::class, 'storeNG']);
Route::patch('/negocio_giro/{id}', [CatalogoController::class, 'updateNG']);
Route::delete('/negocio_giro/{id}', [CatalogoController::class, 'destroyNG']);


// ===============================Roles================================
Route::get('/assign', [RolController::class, 'index']);
Route::post('/assign', [RolController::class, 'store']);
Route::put('/assign/{id}', [RolController::class, 'update'])->name('role.update');
Route::delete('/assign/{id}', [RolController::class, 'destroy'])->name('role.destroy');