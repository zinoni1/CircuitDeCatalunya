<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\TipoAveriasController;
use  App\Http\Controllers\AveriasController;

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

Route::resource('averias', AveriasController::class);

// Ruta para devolver la vista index.blade.php desde la ubicación especificada


Route::resource('tipo-averias', TipoAveriasController::class);
Route::resource('averias', AveriasController::class);
