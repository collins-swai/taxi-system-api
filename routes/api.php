<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CarBookingController;

// User registration and authentication routes
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('logout', [RegisterController::class, 'logout'])->middleware('auth:api');

// CRUD operations for cars
Route::apiResource('cars', CarController::class);

// Order management routes
Route::post('/orders/{order}/ship', [OrderController::class, 'shipOrder']);

Route::apiResource('bookings', CarBookingController::class);

Route::prefix('bookings')->group(function () {
    Route::post('/', [CarBookingController::class, 'create']);
    Route::get('/', [CarBookingController::class, 'index']);
    Route::get('/{id}', [CarBookingController::class, 'show']);
    Route::put('/{id}', [CarBookingController::class, 'update']);
    Route::delete('/{id}', [CarBookingController::class, 'destroy']);
});