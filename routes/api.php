<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\BookingController;

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

// Car API Routes
Route::prefix('cars')->group(function () {
    // Get all cars with filters
    Route::get('/', [CarController::class, 'index']);

    // Get specific car by ID
    Route::get('/{id}', [CarController::class, 'show']);

    // Get featured cars
    Route::get('/featured/list', [CarController::class, 'featured']);

    // Get cars by category
    Route::get('/category/{categoryId}', [CarController::class, 'byCategory']);

    // Search cars
    Route::get('/search/query', [CarController::class, 'search']);

    // Get available filters
    Route::get('/filters/available', [CarController::class, 'filters']);
});

// Booking API Routes
Route::prefix('bookings')->group(function () {
    // Get user bookings (requires authentication or phone number)
    Route::get('/', [BookingController::class, 'index']);
    
    // Get specific booking details
    Route::get('/{booking}', [BookingController::class, 'show']);
    
    // Cancel booking
    Route::patch('/{booking}/cancel', [BookingController::class, 'cancel']);
});

// Car booking routes
Route::prefix('cars')->group(function () {
    // Create booking for specific car
    Route::post('/{car}/book', [BookingController::class, 'store']);
});


