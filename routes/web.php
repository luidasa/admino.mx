<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CondominoController;

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
Route::get('/condominos/create', [CondominoController::class, 'getCreate'])->name('create-condomino');
Route::post('/condominos/create', [CondominoController::class, 'postCreate']);


Route::get('/pagos', [PagoController::class, 'getIndex'])->name('pagos');


Route::get('/quejas', [QuejasController::class, 'getIndex'])->name('quejas');

Route::get('/documentos', [DocumentosController::class, 'getIndex'])->name('documentos');
