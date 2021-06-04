<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\CondominoController;
use App\Http\Controllers\CondominioController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\CargoGeneralController;
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

Route::prefix('/{condominio_id}/condominos')->group(function () {
    Route::get('/edit/{id}', [CondominoController::class, 'getEdit'])->name('edit-condomino');
    Route::post('/edit/{id}', [CondominoController::class, 'postEdit']);

    Route::get('/pagos/{condomino_id}', [PagosController::class, 'getIndex'])->name('pagos');
    Route::get('/pagar/{condomino_id}', [PagosController::class, 'getCreate'])->name('create-pago');
    Route::post('/pagar/{condomino_id}', [PagosController::class, 'postCreate']);

    Route::get('/cargos/{condomino_id}', [CargoController::class, 'getIndex'])->name('cargos');
    Route::get('/cargo/{condomino_id}', [CargoController::class, 'getCreate'])->name('create-cargo');
    Route::post('/cargo/{condomino_id}', [CargoController::class, 'postCreate']);

    Route::get('/panel', [CondominoController::class, 'getIndex'])->name('condominos');
    Route::get('', [CondominoController::class, 'getIndex'])->name('condominos');
    Route::get('/{id}', [CondominoController::class, 'getShow'])->name('show-condomino');
});

Route::prefix('condominios')->group(function () {
    Route::get('/create', [CondominioController::class, 'getCreate'])->name('create-condominio');
    Route::post('/create', [CondominioController::class, 'postCreate']);
    Route::get('/edit/{id}', [CondominioController::class, 'getEdit'])->name('edit-condominio');
    Route::post('/edit/{id}', [CondominioController::class, 'postEdit']);
    Route::get('', [CondominioController::class, 'getIndex'])->name('condominios');
});

Route::prefix('pago')->group(function () {
    Route::get('/{id}', [PagosController::class, 'getComprobante'])->name('show-pago');
    Route::get('/edit/{id}', [PagosController::class, 'getEdit'])->name('edit-pago');
    Route::post('/edit/{id}', [PagosController::class, 'postEdit']);
});

Route::prefix('cargo')->group(function () {
    Route::get('/{id}', [CargoController::class, 'getComprobante'])->name('show-cargo');
    Route::get('/edit/{id}', [CargoController::class, 'getEdit'])->name('edit-cargo');
    Route::post('/edit/{id}', [CargoController::class, 'postEdit']);

});

Route::get('/quejas', [QuejasController::class, 'getIndex'])->name('quejas');

Route::get('/documentos', [DocumentosController::class, 'getIndex'])->name('documentos');
Route::get('/proyectos', [ProyectosController::class, 'getIndex'])->name('proyectos');

Route::get('/cargosgenerales', [CargoGeneralController::class, 'getIndex'])->name('cargos-generales');

Route::get('/cargosgenerales/create', [CargoGeneralController::class, 'getCreate'])->name('create-cargo-general');
Route::post('/cargosgenerales/create', [CargoGeneralController::class, 'postCreate']);
Route::get('/cargosgenerales/edit/{id}', [CargoGeneralController::class, 'getEdit'])->name('edit-cargo-general');
Route::post('/cargosgenerales/edit/{id}', [CargoGeneralController::class, 'postEdit']);

Route::get('/cargosgenerales/schedule/{id}', [CargoGeneralController::class, 'createCalendario'])->name('schedule-cargo-general');
Route::get('/cargosgenerales/unschedule/{id}', [CargoGeneralController::class, 'deleteCalendario'])->name('unschedule-cargo-general');

Route::get('/cargosgenerales/{id}', [CargoGeneralController::class, 'getShow'])->name('show-cargo-general');
Route::get('/cargosgenerales/drop/{id}', [CargoGeneralController::class, 'delete'])->name('delete-cargo-general');

Route::get('/facturas', [FacturaController::class, 'getIndex'])->name('last-facturas');
Route::get('/facturas/condomino/{condomino_id}', [FacturaController::class, 'getFacturasCondomino'])->name('show-facturas');
Route::get('/facturas/generar', [FacturaController::class, 'getGenerate'])->name('generate-facturas');
Route::post('/facturas/generar', [FacturaController::class, 'postGenerate']);
Route::get('/facturas/{id}/', [FacturaController::class, 'getShow'])->name('show-factura');

Route::get('/configuracion', [ConfiguracionController::class, 'getIndex'])->name('configuracion');

Route::get('/reservaciones', [ReservacionController::class, 'getCalendar'])->name('reservaciones');

Route::prefix('profile')->group(function() {
    Route::get('', [ProfileController::class, 'getIndex'])
        ->middleware('auth')
        ->name('profile');
    Route::get('/pagos', [ProfileController::class, 'getPagos'])
        ->middleware(['auth', 'signed'])
        ->name('account-pagos');
    Route::get('/seguridad', [ProfileController::class, 'getSeguridad'])
        ->middleware(['auth', 'signed'])
        ->name('account-seguridad');
    Route::get('/notificaciones', [ProfileController::class, 'getNotificaciones'])
        ->middleware(['auth', 'signed'])
        ->name('account-notificaciones');
});

Route::prefix('email')->group(function () {
    Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verificationHandler'])
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');
    Route::get('/verify', [EmailVerificationController::class, 'verifyEmail'])
        ->middleware('auth')
        ->name('verification.notice');
    Route::post('/verification-notification', [EmailVerificationController::class, 'resendEmailVerification'])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');
});

Auth::routes();
