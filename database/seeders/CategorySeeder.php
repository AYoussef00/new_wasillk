<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_ar' => 'سيارات اقتصادية',
                'name_en' => 'Economy Cars',
                'icon' => 'car',
                'description_ar' => 'سيارات اقتصادية مناسبة للاستخدام اليومي',
                'description_en' => 'Economy cars suitable for daily use',
                'is_active' => true,
            ],
            [
                'name_ar' => 'سيارات فاخرة',
                'name_en' => 'Luxury Cars',
                'icon' => 'crown',
                'description_ar' => 'سيارات فاخرة عالية الجودة',
                'description_en' => 'High-quality luxury cars',
                'is_active' => true,
            ],
            [
                'name_ar' => 'سيارات رياضية',
                'name_en' => 'Sports Cars',
                'icon' => 'zap',
                'description_ar' => 'سيارات رياضية عالية الأداء',
                'description_en' => 'High-performance sports cars',
                'is_active' => true,
            ],
            [
                'name_ar' => 'سيارات عائلية',
                'name_en' => 'Family Cars',
                'icon' => 'users',
                'description_ar' => 'سيارات عائلية واسعة ومريحة',
                'description_en' => 'Spacious and comfortable family cars',
                'is_active' => true,
            ],
            [
                'name_ar' => 'سيارات الدفع الرباعي',
                'name_en' => 'SUVs',
                'icon' => 'mountain',
                'description_ar' => 'سيارات الدفع الرباعي للمغامرات',
                'description_en' => 'SUVs for adventures',
                'is_active' => true,
            ],
            [
                'name_ar' => 'سيارات تجارية',
                'name_en' => 'Commercial Vehicles',
                'icon' => 'truck',
                'description_ar' => 'سيارات تجارية للأعمال',
                'description_en' => 'Commercial vehicles for business',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            // Check if category with this name already exists
            $existingCategory = Category::where('name_ar', $category['name_ar'])->first();
            
            if (!$existingCategory) {
                Category::create($category);
            }
        }
    }
}
