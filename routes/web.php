<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactoController;
use Illuminate\Http\Request;

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

// Atajo para editar la última moto creada (ejemplo de cookies)
Route::get('bikes/editlast', [BikeController::class, 'editLast'])->name('bikes.editlast');

// CRUD DE MOTOS
// BikeController:class is the same as 'App\Http\Controllers\BikeController'
Route::resource('bikes', BikeController::class);

// Formulario de confirmación de eliminación (no puedes hacer más de 3 intentos de borrado por minuto)
Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])->name('bikes.delete')->middleware('adult', 'throttle:ratelimit,1');

// RUTA DE FALLBACK (si ninguna ruta anterior funciona, redirige al index)
Route::fallback([WelcomeController::class, 'index']);

// RUTA PARA EL FORMULARIO DE CONTACTO
Route::get('contacto', [ContactoController::class, 'index'])->name('contacto');
Route::post('contacto', [ContactoController::class, 'send'])->name('contacto.email');

// ZONA PARA PRUEBAS
Route::get('/prueba', function (Request $request) {
    $respuesta = 'PATH: ' . $request->path() . '<br>';
    $respuesta .= 'URL: ' . $request->url() . '<br>';
    $respuesta .= 'FULLURL: ' . $request->fullUrl() . '<br>';
    $respuesta .= 'IP CLIENTE: ' . $request->getClientIp() . '<br>';

    if ($request->has('test')) {
        if ($request->filled('test')) {
            $test = $request->query('test');
            $test2 = $request->test;
            if ($test && ($test == $test2)) {
                $respuesta .= 'Se ha recibido el parámetro "test" con valor: ' . $test;
            }
        } else {
            $respuesta .= 'Se ha recibido el parámetro "test" pero está vacío.';
        }
    } else {
        $respuesta .= 'No se ha recibido el parámetro "test".';
    }

    return $respuesta;
});

Route::get('flash', function (Request $request) {
    $param = $request->old('parametro');
    if (!$param)
        $param = 'Sin parámetro';

    $request->flashOnly('parametro');
    return $param;
});

// FIN DE ZONA PARA PRUEBAS

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
