<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::with('category')->available()->paginate(12);

        return Inertia::render('Cars/Index', [
            'cars' => $cars,
        ]);
    }

    public function show(Car $car)
    {
        $car->load('category');

        // الحصول على سيارات مشابهة
        $similarCars = Car::with('category')
            ->where('category_id', $car->category_id)
            ->where('id', '!=', $car->id)
            ->available()
            ->take(4)
            ->get();

        return Inertia::render('Cars/Show', [
            'car' => $car,
            'similarCars' => $similarCars,
        ]);
    }

    public function featured()
    {
        $featuredCars = Car::with('category')->featured()->get();

        return Inertia::render('Cars/Featured', [
            'featuredCars' => $featuredCars,
        ]);
    }
}
