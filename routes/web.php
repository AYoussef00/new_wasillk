<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Car routes
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

// Static pages
Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/location', function () {
    return Inertia::render('Location');
})->name('location');

// Guest booking routes
Route::middleware(['web'])->group(function () {
    Route::get('/cars/{car}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/cars/{car}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}/confirmation', [BookingController::class, 'confirmation'])->name('bookings.confirmation');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
});

// Dashboard routes (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/dashboard/cars', [DashboardController::class, 'cars'])->name('dashboard.cars');
        Route::post('/dashboard/cars', [DashboardController::class, 'storeCar'])->name('dashboard.cars.store');
        Route::get('/dashboard/bookings', [DashboardController::class, 'bookings'])->name('dashboard.bookings');
        Route::post('/dashboard/bookings/{id}/confirm', [DashboardController::class, 'confirmBooking'])->name('dashboard.bookings.confirm');
        Route::post('/dashboard/bookings/{id}/reject', [DashboardController::class, 'rejectBooking'])->name('dashboard.bookings.reject');
Route::get('/storage/{path}', function($path) {
    $filePath = storage_path('app/public/' . $path);
    if (file_exists($filePath)) {
        return response()->file($filePath);
    }
    abort(404);
})->where('path', '.*');

    // Booking management routes
    Route::post('/dashboard/bookings/{id}/confirm', [DashboardController::class, 'confirmBooking'])->name('dashboard.bookings.confirm');
    Route::post('/dashboard/bookings/{id}/reject', [DashboardController::class, 'rejectBooking'])->name('dashboard.bookings.reject');

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

require __DIR__.'/auth.php';
