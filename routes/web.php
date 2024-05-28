<?php

use App\Http\Controllers\ZonasController;
use App\Http\Controllers\SectorsController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\TipoAveriasController;
use  App\Http\Controllers\AveriasController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\AveriasAnonimasController;

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

Route::get('/', function () {
    return view('averiasAnonimas.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('averiasAnonimas', AveriasAnonimasController::class);

Route::middleware('auth')->group(function () {
    Route::resource('averias', AveriasController::class);
    Route::resource('zonas', ZonasController::class);
    Route::resource('tipo-averias', TipoAveriasController::class);
    Route::resource('cargos', CargosController::class);
    Route::resource('tipo-averias', TipoAveriasController::class);
    Route::resource('sectors', SectorsController::class);
    Route::resource('averias', AveriasController::class);
    Route::get('/dashboard', [AveriasController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AveriasController::class, 'dashboard2'])->name('dashboard');
    Route::get('/calendar/events', [AveriasController::class, 'calendarEvents'])->name('calendar.events');
    Route::put('averias/{averia}/data_fin', [AveriasController::class, 'updateDataFin'])->name('averias.updateDataFin');
});



Route::fallback(function () {
    return view('welcome');
});