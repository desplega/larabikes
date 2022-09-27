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

// CRUD DE MOTOS
Route::resource('bikes', BikeController::class);

// Formulario de confirmación de eliminación
Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])->name('bikes.delete');
