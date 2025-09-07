<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists
        $adminUser = User::where('email', 'info@wasillk.com')->first();

        if (!$adminUser) {
            User::create([
                'name' => 'Admin',
                'email' => 'info@wasillk.com',
                'password' => Hash::make('password123'),
                'phone' => '+966501234567',
                'address' => 'الرياض، المملكة العربية السعودية',
                'driver_license_number' => '123456789',
                'date_of_birth' => '1990-01-01',
                'email_verified_at' => now(),
            ]);

            $this->command->info('Admin user created successfully!');
        } else {
            $this->command->info('Admin user already exists!');
        }

        $this->command->info('Email: info@wasillk.com');
        $this->command->info('Password: password123');
    }
}
