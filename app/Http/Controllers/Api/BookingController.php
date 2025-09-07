<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BookingRequest;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Create a new booking
     */
    public function store(BookingRequest $request, Car $car): JsonResponse
    {
        try {
            // حساب المدة والمبلغ الإجمالي
            $pickupDate = \Carbon\Carbon::parse($request->pickup_date);
            $returnDate = \Carbon\Carbon::parse($request->return_date);
            $duration = $pickupDate->diffInDays($returnDate) + 1;

            $totalAmount = $car->daily_rate * $duration;

            // رفع الصور إذا تم إرسالها
            $idImagePath = null;
            $licenseImagePath = null;

            if ($request->hasFile('id_image')) {
                $idImagePath = $request->file('id_image')->store('bookings/id_images', 'public');
            }

            if ($request->hasFile('license_image')) {
                $licenseImagePath = $request->file('license_image')->store('bookings/license_images', 'public');
            }

            // إنشاء الحجز
            $booking = Booking::create([
                'user_id' => Auth::id(), // null للزوار
                'car_id' => $car->id,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'pickup_date' => $request->pickup_date,
                'return_date' => $request->return_date,
                'total_amount' => $totalAmount,
                'notes' => $request->notes,
                'id_image' => $idImagePath,
                'license_image' => $licenseImagePath,
                'status' => 'pending',
            ]);

            // تحميل العلاقات
            $booking->load('car.category');

            return response()->json([
                'success' => true,
                'message' => 'تم إنشاء الحجز بنجاح! سيتم التواصل معك قريباً لتأكيد التفاصيل.',
                'data' => [
                    'booking' => $booking,
                    'duration' => $duration,
                    'total_amount' => $totalAmount,
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إنشاء الحجز',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get booking details
     */
    public function show(Booking $booking): JsonResponse
    {
        // التأكد من أن المستخدم يملك هذا الحجز أو أنه زائر
        if (Auth::check() && $booking->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'غير مصرح لك بالوصول لهذا الحجز'
            ], 403);
        }

        $booking->load('car.category');

        return response()->json([
            'success' => true,
            'data' => [
                'booking' => $booking
            ]
        ]);
    }

    /**
     * Get user bookings
     */
    public function index(Request $request): JsonResponse
    {
        $query = Booking::with('car.category');

        // إذا كان المستخدم مسجل دخول، عرض حجوزاته فقط
        if (Auth::check()) {
            $query->where('user_id', Auth::id());
        } else {
            // للزوار، يمكن البحث برقم الهاتف
            if ($request->has('phone')) {
                $query->where('customer_phone', $request->phone);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'يجب تسجيل الدخول أو إدخال رقم الهاتف للبحث عن الحجوزات'
                ], 400);
            }
        }

        $bookings = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => [
                'bookings' => $bookings
            ]
        ]);
    }

    /**
     * Cancel booking
     */
    public function cancel(Booking $booking): JsonResponse
    {
        // التأكد من أن المستخدم يملك هذا الحجز
        if (Auth::check() && $booking->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'غير مصرح لك بإلغاء هذا الحجز'
            ], 403);
        }

        // التأكد من أن الحجز يمكن إلغاؤه
        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return response()->json([
                'success' => false,
                'message' => 'لا يمكن إلغاء هذا الحجز في حالته الحالية'
            ], 400);
        }

        $booking->update(['status' => 'cancelled']);

        return response()->json([
            'success' => true,
            'message' => 'تم إلغاء الحجز بنجاح',
            'data' => [
                'booking' => $booking->fresh()
            ]
        ]);
    }
}
