<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CondominoController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\CargoController;
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

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('home');
Route::get('/panel', [App\Http\Controllers\HomeController::class, 'index'])->name('panel');


Route::get('/condominos', [CondominoController::class, 'getIndex'])->name('condominos');
Route::get('/condominos/{id}', [CondominoController::class, 'getShow'])->name('show-condomino');
Route::get('/condominos/edit/{id}', [CondominoController::class, 'getEdit'])->name('edit-condomino');
Route::post('/condominos/edit/{id}', [CondominoController::class, 'postEdit']);
Route::get('/facturas/{condomino_id}', [FacturasController::class, 'getIndex'])->name('facturas');
Route::get('/facturas/{condomino_id}/{id}', [FacturasController::class, 'getShow'])->name('balance-condomino');
Route::get('/facturas/generar', [FacturasController::class, 'getCreate'])->name('create-facturas');
Route::post('/facturas/generar', [FacturasController::class, 'postCreate']);

Route::get('/condominos/{condomino_id}/pagos', [PagosController::class, 'getIndex'])->name('pagos');
Route::get('/condominos/{condomino_id}/pagar', [PagosController::class, 'getCreate'])->name('create-pago');
Route::post('/condominos/{condomino_id}/pagar', [PagosController::class, 'postCreate']);
Route::get('/pago/{id}', [PagosController::class, 'getComprobante'])->name('show-pago');
Route::get('/pago/edit/{id}', [PagosController::class, 'getEdit'])->name('edit-pago');
Route::post('/pago/edit/{id}', [PagosController::class, 'postEdit']);

Route::get('/condominos/{condomino_id}/cargos', [CargoController::class, 'getIndex'])->name('cargos');
Route::get('/condominos/{condomino_id}/cargo', [CargoController::class, 'getCreate'])->name('create-cargo');
Route::post('/condominos/{condomino_id}/cargo', [CargoController::class, 'postCreate']);
Route::get('/cargo/{id}', [CargoController::class, 'getComprobante'])->name('show-cargo');
Route::get('/cargo/edit/{id}', [CargoController::class, 'getEdit'])->name('edit-cargo');
Route::post('/cargo/edit/{id}', [CargoController::class, 'postEdit']);

Route::get('/quejas', [QuejasController::class, 'getIndex'])->name('quejas');

Route::get('/documentos', [DocumentosController::class, 'getIndex'])->name('documentos');
Route::get('/proyectos', [ProyectosController::class, 'getIndex'])->name('proyectos');

Auth::routes();
