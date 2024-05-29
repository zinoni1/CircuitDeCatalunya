<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\TipoAveriasController;
use App\Http\Controllers\AveriasController;
use App\Http\Controllers\ZonasController;
use App\Http\Controllers\SectorsController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\ChatController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('test', [ApiController::class, 'index']);
Route::get('login', [ApiController::class, 'index2']);
Route::get('verify/{email}/{password}', [ApiController::class, 'verifyCredentials']);

Route::resource('tipo-averias', TipoAveriasController::class);
Route::resource('averias', AveriasController::class);
Route::get('tipo-averias-android', [TipoAveriasController::class, 'indexAndroid']);
Route::get('averias-android', [AveriasController::class, 'indexAndroid']);
Route::get('averias-android/{id}', [AveriasController::class, 'indexAndroidId']);
Route::get('chats-android/{idUser}', [ChatController::class, 'indexAndroid']);
Route::get('chats-android/{idGrupo}/{idUser}', [ChatController::class, 'indexAndroidId']);
Route::post('enviar-miss-android', [ChatController::class, 'storeAndroid']);
Route::get('grupos-android/{idUser}', [ChatController::class, 'obtenirGrupos']);
Route::get('zonas-android', [ZonasController::class, 'indexAndroid']);
Route::get('sector-android', [SectorsController::class, 'indexAndroid']);
Route::get('cargos-android', [CargosController::class, 'indexAndroid']);
Route::post('add-averia-android', [AveriasController::class, 'storeAndroid']);
Route::post('upload-image', [ApiController::class, 'uploadImage']);
Route::post('create-user', [ApiController::class, 'createUser']);
Route::get('get-users-sinchat/{id}', [ChatController::class, 'chatsNoEmpezados']);
Route::get('get-users-grup/{id}', [ChatController::class, 'obtenirUsuarisDeCadaGrup']);
Route::get('get-ultim-grup/{id}', [ChatController::class, 'idGrupGran']);
Route::put('change-password/{id}/{pass}', [ApiController::class, 'cambiarPassword']);
Route::get('averias-pendents', [ApiController::class, 'statsPendents']);
Route::get('averias-urgents', [ApiController::class, 'averiesUrgents']);
Route::get('averias-programades', [ApiController::class, 'averiesProgramades']);
Route::put('edit-fecha/{id}', [AveriasController::class, 'editDataFin']);
