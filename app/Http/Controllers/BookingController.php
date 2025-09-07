<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookings()->with('car.category')->latest()->paginate(10);

        return Inertia::render('Bookings/Index', [
            'bookings' => $bookings,
        ]);
    }

    public function create(Car $car)
    {
        return Inertia::render('Bookings/Create', [
            'car' => $car->load('category'),
        ]);
    }

    public function store(Request $request, Car $car)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
            'id_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'license_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'notes' => 'nullable|string',
        ]);

        // حساب المدة والمبلغ الإجمالي
        $pickupDate = \Carbon\Carbon::parse($request->pickup_date);
        $returnDate = \Carbon\Carbon::parse($request->return_date);
        $duration = $pickupDate->diffInDays($returnDate) + 1;

        $totalAmount = $car->daily_rate * $duration;

        // رفع الصور
        $idImagePath = $request->file('id_image')->store('bookings/id_images', 'public');
        $licenseImagePath = $request->file('license_image')->store('bookings/license_images', 'public');

        $booking = Booking::create([
            'user_id' => Auth::id() ?? null, // يمكن أن يكون null للزوار
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

        // توجيه للصفحة الرئيسية مع رسالة نجاح
        return redirect('/')
            ->with('success', 'تم إنشاء الحجز بنجاح! سيتم التواصل معك قريباً لتأكيد التفاصيل.');
    }

    public function show(Booking $booking)
    {
        // التأكد من أن المستخدم يملك هذا الحجز أو أنه زائر
        if (Auth::check() && $booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load('car.category');

        return Inertia::render('Bookings/Show', [
            'booking' => $booking,
        ]);
    }

    public function confirmation(Booking $booking)
    {
        $booking->load('car.category');

        return Inertia::render('Bookings/Confirmation', [
            'booking' => $booking,
        ]);
    }

    public function cancel(Booking $booking)
    {
        // التأكد من أن المستخدم يملك هذا الحجز
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // التأكد من أن الحجز يمكن إلغاؤه
        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'لا يمكن إلغاء هذا الحجز');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'تم إلغاء الحجز بنجاح');
    }
}
