<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = Car::all();
        $users = User::all();

        if ($cars->isEmpty()) {
            $this->command->warn('No cars found. Please run CarSeeder first.');
            return;
        }

        // Sample bookings with images
        $bookings = [
            [
                'customer_name' => 'أحمد محمد علي',
                'customer_phone' => '+966501234567',
                'customer_address' => 'الرياض، شارع الملك فهد',
                'pickup_date' => now()->addDays(2),
                'return_date' => now()->addDays(5),
                'total_amount' => 1200.00,
                'status' => 'pending',
                'notes' => 'طلب عادي',
                'id_image' => '/storage/sample/id_card_1.jpg',
                'license_image' => '/storage/sample/license_1.jpg',
                'car_id' => $cars->first()->id,
                'user_id' => $users->first()->id ?? null,
            ],
            [
                'customer_name' => 'فاطمة أحمد',
                'customer_phone' => '+966507654321',
                'customer_address' => 'جدة، شارع التحلية',
                'pickup_date' => now()->addDays(1),
                'return_date' => now()->addDays(3),
                'total_amount' => 800.00,
                'status' => 'confirmed',
                'notes' => 'عميلة مسجلة',
                'id_image' => '/storage/sample/id_card_2.jpg',
                'license_image' => null,
                'car_id' => $cars->count() > 1 ? $cars->get(1)->id : $cars->first()->id,
                'user_id' => null, // Guest booking
            ],
            [
                'customer_name' => 'محمد عبدالله',
                'customer_phone' => '+966509876543',
                'customer_address' => 'الدمام، شارع الملك خالد',
                'pickup_date' => now()->addDays(7),
                'return_date' => now()->addDays(10),
                'total_amount' => 1500.00,
                'status' => 'pending',
                'notes' => 'حجز طويل الأمد',
                'id_image' => null,
                'license_image' => '/storage/sample/license_3.jpg',
                'car_id' => $cars->count() > 2 ? $cars->get(2)->id : $cars->first()->id,
                'user_id' => null, // Guest booking
            ],
        ];

        foreach ($bookings as $bookingData) {
            Booking::create($bookingData);
        }

        $this->command->info('Sample bookings created successfully!');
    }
}
