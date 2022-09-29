<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;

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

// PORTADA
Route::get('/', [WelcomeController::class, 'index'])->name('portada');

// SEARCH
Route::match(['GET', 'POST'], 'bikes/search', [BikeController::class, 'search'])->name('bikes.search');

// CRUD DE MOTOS
// BikeController:class is the same as 'App\Http\Controllers\BikeController'
Route::resource('bikes', BikeController::class);

// Formulario de confirmación de eliminación (no puedes hacer más de 3 intentos de borrado por minuto)
Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])->name('bikes.delete')->middleware('throttle:3,1');

// RUTA DE FALLBACK (si ninguna ruta anterior funciona, redirige al index)
Route::fallback([WelcomeController::class, 'index']);
