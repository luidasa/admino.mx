<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CondominoController;
use App\Http\Controllers\PagoController;
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

Route::get('/', function () { return view('welcome'); })->name('inicio');

Route::get('/condominos', [CondominoController::class, 'getIndex'])->name('condominos');
Route::get('/condominos/{id}', [CondominoController::class, 'getShow'])->name('show-condomino');
Route::get('/condominos/edit/{id}', [CondominoController::class, 'getEdit'])->name('edit-condomino');
Route::post('/condominos/edit/{id}', [CondominoController::class, 'postEdit']);
Route::get('/facturas/{condomino_id}', [FacturasController::class, 'getIndex'])->name('facturas');
Route::get('/facturas/{condomino_id}/{id}', [FacturasController::class, 'getShow'])->name('balance-condomino');

Route::post('/condominos/{id}/pagar', [PagosController::class, 'getCreate'])->name('create-pago');
Route::get('/condominos/{id}/pagos', [PagosController::class, 'getIndex'])->name('pagos');

Route::get('/quejas', [QuejasController::class, 'getIndex'])->name('quejas');

Route::get('/documentos', [DocumentosController::class, 'getIndex'])->name('documentos');

Route::get('/proyectos', [ProyectosController::class, 'getIndex'])->name('proyectos');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
