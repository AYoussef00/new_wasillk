<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $latestCars = Car::with('category')->available()->latest()->take(8)->get();

        return Inertia::render('Home', [
            'latestCars' => $latestCars,
            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
            ],
        ]);
    }
}
