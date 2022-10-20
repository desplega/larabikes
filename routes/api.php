<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Bike;
use App\Http\Controllers\BikeApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/bikes', function() {
    // $json = json_encode(Bike::orderBy('id', 'DESC')->get());
    // return response($json)->header('Content-Type', 'application/json');
    return response(Bike::orderBy('id', 'DESC')->get());
});

Route::get('/motos', [BikeApiController::class, 'index']);
Route::get('/moto/{bike}', [BikeApiController::class, 'show'])
    ->where('bike', '^\d+$'); // Only digits
Route::get('/motos/{campo}/{valor}', [BikeApiController::class, 'search'])
    ->where('campo', '^marca|modelo|matricula$');
Route::post('/moto', [BikeApiController::class, 'store']);
Route::put('/moto/{bike}', [BikeApiController::class, 'update'])
    ->where('bike', '^\d+$'); // Only digits;
Route::delete('/moto/{bike}', [BikeApiController::class, 'delete'])
    ->where('bike', '^\d+$'); // Only digits;
Route::fallback(function() {
    return response(['status' => 'BAD REQUEST'], 400);
});