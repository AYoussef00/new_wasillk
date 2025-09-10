<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Check if settings already exist
        $existingSettings = Settings::first();

        if (!$existingSettings) {
            Settings::create([
                'company_name' => 'واصل لك لتأجير السيارات',
                'company_address' => 'الرياض، المملكة العربية السعودية',
                'company_phone' => '+966501234567',
                'cancellation_policy' => 'يمكن إلغاء الحجز قبل 24 ساعة من تاريخ الاستلام بدون رسوم. في حالة الإلغاء خلال 24 ساعة، سيتم خصم 50% من المبلغ.',
                'insurance_info' => 'جميع السيارات مؤمنة بالكامل ضد الحوادث والسرقة. التأمين يشمل المسؤولية المدنية والضرر المادي.',
                'rental_terms' => 'يجب أن يكون عمر المستأجر 21 سنة أو أكثر. يجب تقديم رخصة قيادة سارية المفعول وهوية شخصية. ممنوع التدخين في السيارة.',
                'location_coordinates' => [
                    'lat' => 24.7136,
                    'lng' => 46.6753
                ],
                'location_address' => 'الرياض، المملكة العربية السعودية',
                'google_maps_link' => 'https://maps.google.com/?q=24.7136,46.6753',
            ]);

            $this->command->info('Settings created successfully!');
        } else {
            $this->command->info('Settings already exist!');
        }
    }
}
