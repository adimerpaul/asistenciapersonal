<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
})->middleware('auth');
Route::get('/personas', function () {
    return view('home');
})->middleware('auth');
Route::get('/imprimir', function () {
    return view('home');
})->middleware('auth');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::apiResource('/persona', \App\Http\Controllers\PersonaController::class)->middleware('auth');
Route::post('/photo', [\App\Http\Controllers\PersonaController::class,'photo'])->middleware('auth');
Route::apiResource('/unit', \App\Http\Controllers\UnitController::class)->middleware('auth');
Route::apiResource('/asistencia', \App\Http\Controllers\AsistenciaController::class);
Route::apiResource('/log', \App\Http\Controllers\LogController::class);
Route::post('/buscar', [\App\Http\Controllers\AsistenciaController::class,'buscar']);
