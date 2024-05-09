<?php

use App\Http\Controllers\ZonasController;
use App\Http\Controllers\SectorsController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\TipoAveriasController;
use  App\Http\Controllers\AveriasController;
use App\Http\Controllers\CargosController;

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
    return view('welcome');
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
Route::middleware('auth')->group(function () {
    Route::resource('averias', AveriasController::class);
    Route::resource('zonas', ZonasController::class);
    Route::resource('tipo-averias', TipoAveriasController::class);
    Route::resource('cargos', CargosController::class);
});

Route::fallback(function () {
    return view('welcome');
});

Route::resource('averias', AveriasController::class);

// Ruta para devolver la vista index.blade.php desde la ubicación especificada


Route::resource('tipo-averias', TipoAveriasController::class);

Route::resource('sectors', SectorsController::class);

