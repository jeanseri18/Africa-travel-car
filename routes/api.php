<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiTransportController;
use App\Http\Controllers\Api\ApiReservationController;
Route::put('/reservations/{id}/statut', [ApiReservationController::class, 'updateStatutReservation']);
Route::get('/sous-traitant/{user_id}/gares', [ApiReservationController::class, 'getGaresBySousTraitant']);

Route::post('/reservations', [ApiReservationController::class, 'createReservation']);
Route::post('/paiements', [ApiReservationController::class, 'createPaiement']);

Route::prefix('transport')->group(function () {
    Route::get('/lieux', [ApiTransportController::class, 'getLieux']);
    Route::get('/societes', [ApiTransportController::class, 'getSocietesTransport']);
    Route::get('/destinations', [ApiTransportController::class, 'getDestinations']);
});
Route::get('/transport/gares', [ApiTransportController::class, 'getGaresByTypeDestination']);

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


Route::prefix('admin')->group(function () {
    Route::post('/login', [ApiAuthController::class, 'login']);
    Route::post('/register', [ApiAuthController::class, 'register']);
    Route::middleware('auth:sanctum')->post('/logout', [ApiAuthController::class, 'logout']);
});
