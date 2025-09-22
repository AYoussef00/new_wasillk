<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use App\Models\Category;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // إحصائيات عامة
        $stats = [
            'total_cars' => Car::count(),
            'available_cars' => Car::where('status', 'available')->count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'total_users' => User::count(),
            'total_categories' => Category::count(),
        ];

        // أحدث الحجوزات
        $recent_bookings = Booking::with(['car', 'user'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'customer_name' => $booking->customer_name ?? $booking->user?->name ?? 'غير محدد',
                    'car_name' => ($booking->car->brand_ar ?? 'تويوتا') . ' ' . ($booking->car->model_ar ?? 'كورولا'),
                    'pickup_date' => $booking->pickup_date,
                    'return_date' => $booking->return_date,
                    'total_amount' => $booking->total_amount,
                    'status' => $this->getStatusInArabic($booking->status),
                    'created_at' => $booking->created_at->format('Y-m-d H:i'),
                ];
            });

        // السيارات المتاحة
        $available_cars = Car::with('category')
            ->where('status', 'available')
            ->take(5)
            ->get()
            ->map(function ($car) {
                return [
                    'id' => $car->id,
                    'name' => ($car->brand_ar ?? 'تويوتا') . ' ' . ($car->model_ar ?? 'كورولا'),
                    'category' => $car->category->name,
                    'daily_rate' => $car->daily_rate,
                    'license_plate' => $car->license_plate,
                    'is_featured' => $car->is_featured,
                ];
            });

        // إحصائيات الحجوزات حسب الشهر
        $monthly_bookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => $this->getMonthInArabic($item->month),
                    'count' => $item->count,
                ];
            });

        return Inertia::render('Dashboard/Index', [
            'stats' => $stats,
            'recent_bookings' => $recent_bookings,
            'available_cars' => $available_cars,
            'monthly_bookings' => $monthly_bookings,
        ]);
    }

    public function cars()
    {
        $cars = Car::with('category')
            ->latest()
            ->get()
            ->map(function ($car) {
                return [
                    'id' => $car->id,
                    'name' => ($car->brand_ar ?? 'تويوتا') . ' ' . ($car->model_ar ?? 'كورولا'),
                    'category' => $car->category->name,
                    'daily_rate' => $car->daily_rate,
                    'license_plate' => $car->license_plate,
                    'status' => $this->getCarStatusInArabic($car->status),
                    'is_featured' => $car->is_featured,
                    'is_active' => $car->is_active,
                    'year' => $car->year,
                    'color' => $car->color_ar,
                    'transmission' => $car->transmission,
                    'fuel_type' => $car->fuel_type,
                    'seats' => $car->seats,
                    'created_at' => $car->created_at->format('Y-m-d'),
                ];
            });

        $categories = Category::all();

        return Inertia::render('Dashboard/Cars', [
            'cars' => $cars,
            'categories' => $categories,
            'success' => session('success'),
            'error' => session('error'),
        ]);
    }

    public function bookings()
    {
        $bookings = Booking::with(['car', 'user'])
            ->latest()
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'customer_name' => $booking->customer_name ?? $booking->user?->name ?? 'غير محدد',
                    'customer_phone' => $booking->customer_phone ?? $booking->user?->phone ?? 'غير محدد',
                    'customer_email' => $booking->user?->email ?? 'غير محدد',
                    'customer_address' => $booking->customer_address ?? $booking->user?->address ?? 'غير محدد',
                    'car_name' => ($booking->car->brand_ar ?? 'تويوتا') . ' ' . ($booking->car->model_ar ?? 'كورولا'),
                    'car_license_plate' => $booking->car->license_plate,
                    'pickup_date' => $booking->pickup_date,
                    'return_date' => $booking->return_date,
                    'total_amount' => $booking->total_amount,
                    'status' => $this->getStatusInArabic($booking->status),
                    'notes' => $booking->notes,
                    'created_at' => $booking->created_at->format('Y-m-d H:i'),
                    'is_guest' => $booking->user_id === null,
                    'id_image' => $booking->id_image,
                    'license_image' => $booking->license_image,
                ];
            });

        return Inertia::render('Dashboard/Bookings', [
            'bookings' => $bookings,
            'success' => session('success'),
            'error' => session('error'),
        ]);
    }

    public function confirmBooking($id)
    {
        $booking = Booking::findOrFail($id);

        // Check if booking is in pending status
        if ($booking->status !== 'pending') {
            return redirect()->back()->with('error', 'لا يمكن تأكيد هذا الحجز. الحجز ليس في حالة الانتظار.');
        }

        $booking->update([
            'status' => 'confirmed',
            'notes' => $booking->notes . "\nتم التأكيد في: " . now()->format('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'تم تأكيد الحجز بنجاح.');
    }

    public function rejectBooking($id)
    {
        $booking = Booking::findOrFail($id);

        // Check if booking is in pending status
        if ($booking->status !== 'pending') {
            return redirect()->back()->with('error', 'لا يمكن رفض هذا الحجز. الحجز ليس في حالة الانتظار.');
        }

        $booking->update([
            'status' => 'cancelled',
            'notes' => $booking->notes . "\nتم الرفض في: " . now()->format('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'تم رفض الحجز بنجاح.');
    }

    private function getStatusInArabic($status)
    {
        return match($status) {
            'pending' => 'في الانتظار',
            'confirmed' => 'مؤكد',
            'cancelled' => 'ملغي',
            'completed' => 'مكتمل',
            default => 'غير محدد',
        };
    }

    private function getCarStatusInArabic($status)
    {
        return match($status) {
            'available' => 'متاحة',
            'rented' => 'مستأجرة',
            'maintenance' => 'في الصيانة',
            'unavailable' => 'غير متاحة',
            default => 'غير محدد',
        };
    }

    private function getMonthInArabic($month)
    {
        $months = [
            1 => 'يناير',
            2 => 'فبراير',
            3 => 'مارس',
            4 => 'أبريل',
            5 => 'مايو',
            6 => 'يونيو',
            7 => 'يوليو',
            8 => 'أغسطس',
            9 => 'سبتمبر',
            10 => 'أكتوبر',
            11 => 'نوفمبر',
            12 => 'ديسمبر',
        ];

        return $months[$month] ?? 'غير محدد';
    }

    public function storeCar(Request $request)
    {
        // Debug: Log the request data
        \Illuminate\Support\Facades\Log::info('Car creation request:', $request->all());

        $request->validate([
            'brand_ar' => 'required|string|max:255',
            'model_ar' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:2030',
            'color_ar' => 'required|string|max:255',
            'transmission' => 'required|string|in:أوتوماتيك,يدوي',
            'fuel_type' => 'required|string|in:بنزين,ديزل,كهربائي,هجين',
            'seats' => 'required|integer|min:2|max:15',
            'doors' => 'required|integer|min:2|max:5',
            'daily_rate' => 'required|numeric|min:0',
            'weekly_rate' => 'required|numeric|min:0',
            'monthly_rate' => 'required|numeric|min:0',
            'license_plate' => 'required|string|max:255|unique:cars,license_plate',
            'description_ar' => 'nullable|string',
            'features' => 'nullable|string',
            'status' => 'required|in:available,rented,maintenance,unavailable',
            'is_featured' => 'nullable|in:0,1,true,false',
            'is_active' => 'nullable|in:0,1,true,false',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'secondary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image uploads
        $images = [];

        // Main image
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('cars/main', 'public');
            $images[] = '/storage/' . $mainImagePath;
        }

        // Secondary image
        if ($request->hasFile('secondary_image')) {
            $secondaryImagePath = $request->file('secondary_image')->store('cars/secondary', 'public');
            $images[] = '/storage/' . $secondaryImagePath;
        }

        // Parse features JSON
        $features = [];
        if ($request->features) {
            $features = json_decode($request->features, true) ?? [];
        }

        try {
            $carData = [
                'category_id' => 1, // Default category
                'brand_ar' => $request->brand_ar,
                'brand_en' => $request->brand_ar, // Use Arabic as English
                'model_ar' => $request->model_ar,
                'model_en' => $request->model_ar, // Use Arabic as English
                'year' => $request->year,
                'color_ar' => $request->color_ar,
                'color_en' => $request->color_ar, // Use Arabic as English
                'transmission' => $request->transmission,
                'fuel_type' => $request->fuel_type,
                'seats' => $request->seats,
                'doors' => $request->doors,
                'daily_rate' => $request->daily_rate,
                'weekly_rate' => $request->weekly_rate,
                'monthly_rate' => $request->monthly_rate,
                'license_plate' => $request->license_plate,
                'vin' => 'VIN-' . uniqid(), // Generate unique VIN
                'mileage' => 0, // Default mileage
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_ar, // Use Arabic as English
                'features' => $features,
                'images' => $images,
                'status' => $request->status,
                            'is_featured' => in_array($request->input('is_featured'), ['1', 'true', true], true),
            'is_active' => in_array($request->input('is_active'), ['1', 'true', true], true),
            ];

            \Illuminate\Support\Facades\Log::info('Car data to create:', $carData);

            $car = Car::create($carData);

            \Illuminate\Support\Facades\Log::info('Car created successfully:', ['id' => $car->id]);

            return redirect()->back()->with('success', 'تم إضافة السيارة بنجاح');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error creating car:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة السيارة: ' . $e->getMessage());
        }
    }

    public function editCar($id)
    {
        $car = Car::findOrFail($id);
        $categories = Category::all();

        return Inertia::render('Dashboard/EditCar', [
            'car' => $car,
            'categories' => $categories,
        ]);
    }

    public function updateCar(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'brand_ar' => 'nullable|string|max:255',
            'model_ar' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:2000|max:2030',
            'color_ar' => 'nullable|string|max:255',
            'transmission' => 'nullable|string|in:أوتوماتيك,يدوي',
            'fuel_type' => 'nullable|string|in:بنزين,ديزل,كهربائي,هجين',
            'seats' => 'nullable|integer|min:2|max:15',
            'doors' => 'nullable|integer|min:2|max:5',
            'daily_rate' => 'nullable|numeric|min:0',
            'weekly_rate' => 'nullable|numeric|min:0',
            'monthly_rate' => 'nullable|numeric|min:0',
            'license_plate' => 'nullable|string|max:255|unique:cars,license_plate,' . $id,
            'description_ar' => 'nullable|string',
            'features' => 'nullable|string',
            'status' => 'nullable|in:available,rented,maintenance,unavailable',
            'is_featured' => 'nullable|in:0,1,true,false',
            'is_active' => 'nullable|in:0,1,true,false',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'secondary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image uploads
        $images = $car->images ?? [];

        // Main image
        if ($request->hasFile('main_image')) {
            // Delete old main image if exists
            if (isset($images[0])) {
                $oldImagePath = str_replace('/storage/', '', $images[0]);
                if (file_exists(storage_path('app/public/' . $oldImagePath))) {
                    unlink(storage_path('app/public/' . $oldImagePath));
                }
            }

            $mainImagePath = $request->file('main_image')->store('cars/main', 'public');
            $images[0] = '/storage/' . $mainImagePath;
        }

        // Secondary image
        if ($request->hasFile('secondary_image')) {
            // Delete old secondary image if exists
            if (isset($images[1])) {
                $oldImagePath = str_replace('/storage/', '', $images[1]);
                if (file_exists(storage_path('app/public/' . $oldImagePath))) {
                    unlink(storage_path('app/public/' . $oldImagePath));
                }
            }

            $secondaryImagePath = $request->file('secondary_image')->store('cars/secondary', 'public');
            $images[1] = '/storage/' . $secondaryImagePath;
        }

        // Parse features JSON
        $features = [];
        if ($request->features) {
            if (is_string($request->features)) {
                $features = json_decode($request->features, true) ?? [];
            } else {
                $features = $request->features;
            }
        }

        try {
            // Simple approach - update all provided fields
            $carData = $request->only([
                'brand_ar', 'model_ar', 'year', 'color_ar', 'transmission',
                'fuel_type', 'seats', 'doors', 'daily_rate', 'weekly_rate',
                'monthly_rate', 'license_plate', 'description_ar', 'status',
                'is_featured', 'is_active'
            ]);

            // Add English versions for Arabic fields
            if (isset($carData['brand_ar'])) {
                $carData['brand_en'] = $carData['brand_ar'];
            }
            if (isset($carData['model_ar'])) {
                $carData['model_en'] = $carData['model_ar'];
            }
            if (isset($carData['color_ar'])) {
                $carData['color_en'] = $carData['color_ar'];
            }
            if (isset($carData['description_ar'])) {
                $carData['description_en'] = $carData['description_ar'];
            }

            // Handle features
            if ($request->has('features')) {
                $carData['features'] = $features;
            }

            // Handle images
            if ($request->hasFile('main_image') || $request->hasFile('secondary_image')) {
                $carData['images'] = $images;
            }

            if (empty($carData)) {
                return redirect()->back()->with('error', 'لم يتم إرسال أي بيانات للتحديث');
            }

            $car->update($carData);

            return redirect()->route('dashboard.cars')->with('success', 'تم تحديث السيارة بنجاح');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error updating car:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث السيارة: ' . $e->getMessage());
        }
    }

    public function destroyCar($id)
    {
        try {
            $car = Car::findOrFail($id);

            // Check if car has any bookings
            $hasBookings = Booking::where('car_id', $id)->exists();

            if ($hasBookings) {
                return redirect()->back()->with('error', 'لا يمكن حذف هذه السيارة لأنها مرتبطة بحجوزات موجودة.');
            }

            // Delete car images from storage
            if ($car->images) {
                $images = is_string($car->images) ? json_decode($car->images, true) : $car->images;
                if (is_array($images)) {
                    foreach ($images as $image) {
                        if (is_string($image)) {
                            $imagePath = str_replace('/storage/', '', $image);
                            if (file_exists(storage_path('app/public/' . $imagePath))) {
                                unlink(storage_path('app/public/' . $imagePath));
                            }
                        }
                    }
                }
            }

            $car->delete();

            return redirect()->back()->with('success', 'تم حذف السيارة بنجاح.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error deleting car:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف السيارة: ' . $e->getMessage());
        }
    }
}
