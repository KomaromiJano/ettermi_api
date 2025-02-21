<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\ReservationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Éttermek kezelése
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);
Route::post('/restaurants', [RestaurantController::class, 'store']);
Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy']);
Route::put('/restaurants/{id}', [RestaurantController::class, 'update']);

// Foglalások kezelése
Route::get('/reservations', [ReservationController::class, 'index']);
Route::get('/reservations/{id}', [ReservationController::class, 'show']);
Route::get('/restaurants/{id}/reservations', [ReservationController::class, 'restaurantReservations']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);
Route::put('/reservations/{id}', [ReservationController::class, 'update']);