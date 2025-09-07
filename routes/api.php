<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarController;

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


