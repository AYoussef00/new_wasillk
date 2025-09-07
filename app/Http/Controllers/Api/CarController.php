<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    /**
     * Get all cars with full details
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Car::with('category')
                ->where('is_active', true)
                ->where('status', 'available');

            // Apply filters if provided
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            if ($request->has('brand')) {
                $query->where('brand_ar', 'like', '%' . $request->brand . '%');
            }

            if ($request->has('transmission')) {
                $query->where('transmission', $request->transmission);
            }

            if ($request->has('fuel_type')) {
                $query->where('fuel_type', $request->fuel_type);
            }

            if ($request->has('min_price') && $request->has('max_price')) {
                $query->whereBetween('daily_rate', [$request->min_price, $request->max_price]);
            }

            if ($request->has('seats')) {
                $query->where('seats', $request->seats);
            }

            if ($request->has('year')) {
                $query->where('year', $request->year);
            }

            if ($request->has('featured')) {
                $query->where('is_featured', $request->featured);
            }

            $cars = $query->get()->map(function ($car) {
                return $this->formatCarData($car);
            });

            return response()->json([
                'success' => true,
                'message' => 'تم جلب السيارات بنجاح',
                'data' => $cars,
                'total' => $cars->count(),
                'filters' => [
                    'categories' => Category::select('id', 'name_ar', 'name_en')->get(),
                    'brands' => Car::select('brand_ar')->distinct()->pluck('brand_ar'),
                    'transmissions' => ['أوتوماتيك', 'يدوي'],
                    'fuel_types' => ['بنزين', 'ديزل', 'كهربائي', 'هجين'],
                    'seats_options' => Car::select('seats')->distinct()->orderBy('seats')->pluck('seats'),
                    'years' => Car::select('year')->distinct()->orderBy('year', 'desc')->pluck('year'),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء جلب السيارات',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a specific car by ID
     */
    public function show($id): JsonResponse
    {
        try {
            $car = Car::with('category')->findOrFail($id);

            if (!$car->is_active || $car->status !== 'available') {
                return response()->json([
                    'success' => false,
                    'message' => 'السيارة غير متاحة حالياً'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'تم جلب تفاصيل السيارة بنجاح',
                'data' => $this->formatCarData($car)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'السيارة غير موجودة',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get featured cars
     */
    public function featured(): JsonResponse
    {
        try {
            $cars = Car::with('category')
                ->where('is_active', true)
                ->where('status', 'available')
                ->where('is_featured', true)
                ->get()
                ->map(function ($car) {
                    return $this->formatCarData($car);
                });

            return response()->json([
                'success' => true,
                'message' => 'تم جلب السيارات المميزة بنجاح',
                'data' => $cars,
                'total' => $cars->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء جلب السيارات المميزة',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cars by category
     */
    public function byCategory($categoryId): JsonResponse
    {
        try {
            $cars = Car::with('category')
                ->where('category_id', $categoryId)
                ->where('is_active', true)
                ->where('status', 'available')
                ->get()
                ->map(function ($car) {
                    return $this->formatCarData($car);
                });

            $category = Category::find($categoryId);

            return response()->json([
                'success' => true,
                'message' => 'تم جلب سيارات الفئة بنجاح',
                'data' => $cars,
                'total' => $cars->count(),
                            'category' => $category ? [
                'id' => $category->id,
                'name_ar' => $category->name_ar,
                'name_en' => $category->name_en,
                'description_ar' => $category->description_ar,
                'description_en' => $category->description_en
            ] : null
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء جلب سيارات الفئة',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search cars
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $query = Car::with('category')
                ->where('is_active', true)
                ->where('status', 'available');

            if ($request->has('q') && !empty($request->q)) {
                $searchTerm = $request->q;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('brand_ar', 'like', '%' . $searchTerm . '%')
                      ->orWhere('model_ar', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description_ar', 'like', '%' . $searchTerm . '%')
                      ->orWhere('license_plate', 'like', '%' . $searchTerm . '%');
                });
            }

            $cars = $query->get()->map(function ($car) {
                return $this->formatCarData($car);
            });

            return response()->json([
                'success' => true,
                'message' => 'تم البحث بنجاح',
                'data' => $cars,
                'total' => $cars->count(),
                'search_term' => $request->q
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء البحث',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get available filters for cars
     */
    public function filters(): JsonResponse
    {
        try {
            $filters = [
                'categories' => Category::select('id', 'name_ar', 'name_en', 'description_ar', 'description_en')->get(),
                'brands' => Car::select('brand_ar')->distinct()->orderBy('brand_ar')->pluck('brand_ar'),
                'models' => Car::select('model_ar')->distinct()->orderBy('model_ar')->pluck('model_ar'),
                'transmissions' => ['أوتوماتيك', 'يدوي'],
                'fuel_types' => ['بنزين', 'ديزل', 'كهربائي', 'هجين'],
                'seats_options' => Car::select('seats')->distinct()->orderBy('seats')->pluck('seats'),
                'doors_options' => Car::select('doors')->distinct()->orderBy('doors')->pluck('doors'),
                'years' => Car::select('year')->distinct()->orderBy('year', 'desc')->pluck('year'),
                'colors' => Car::select('color_ar')->distinct()->orderBy('color_ar')->pluck('color_ar'),
                'price_range' => [
                    'min' => Car::min('daily_rate'),
                    'max' => Car::max('daily_rate')
                ]
            ];

            return response()->json([
                'success' => true,
                'message' => 'تم جلب الفلاتر بنجاح',
                'data' => $filters
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء جلب الفلاتر',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Format car data for API response
     */
    private function formatCarData($car): array
    {
        // Ensure images is an array
        $images = is_string($car->images) ? json_decode($car->images, true) : $car->images;
        if (!is_array($images)) {
            $images = [];
        }

        // Ensure features is an array
        $features = is_string($car->features) ? json_decode($car->features, true) : $car->features;
        if (!is_array($features)) {
            $features = [];
        }

        return [
            'id' => $car->id,
            'brand' => [
                'ar' => $car->brand_ar,
                'en' => $car->brand_en
            ],
            'model' => [
                'ar' => $car->model_ar,
                'en' => $car->model_en
            ],
            'year' => $car->year,
            'color' => [
                'ar' => $car->color_ar,
                'en' => $car->color_en
            ],
            'transmission' => $car->transmission,
            'fuel_type' => $car->fuel_type,
            'seats' => $car->seats,
            'doors' => $car->doors,
            'pricing' => [
                'daily_rate' => (float) $car->daily_rate,
                'weekly_rate' => (float) $car->weekly_rate,
                'monthly_rate' => (float) $car->monthly_rate,
                'currency' => 'SAR'
            ],
            'license_plate' => $car->license_plate,
            'vin' => $car->vin,
            'mileage' => $car->mileage,
            'description' => [
                'ar' => $car->description_ar,
                'en' => $car->description_en
            ],
            'features' => $features,
            'images' => array_map(function($image) {
                // Ensure full URL for images
                if (str_starts_with($image, '/storage/')) {
                    return url($image);
                } elseif (str_starts_with($image, 'storage/')) {
                    return url('/' . $image);
                } else {
                    return url('/storage/' . $image);
                }
            }, $images),
            'status' => $car->status,
            'is_featured' => (bool) $car->is_featured,
            'is_active' => (bool) $car->is_active,
            'category' => $car->category ? [
                'id' => $car->category->id,
                'name_ar' => $car->category->name_ar,
                'name_en' => $car->category->name_en,
                'description_ar' => $car->category->description_ar,
                'description_en' => $car->category->description_en
            ] : null,
            'created_at' => $car->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $car->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
