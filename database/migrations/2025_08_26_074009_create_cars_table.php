<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('brand_ar'); // ماركة السيارة بالعربية
            $table->string('brand_en'); // ماركة السيارة بالإنجليزية
            $table->string('model_ar'); // موديل السيارة بالعربية
            $table->string('model_en'); // موديل السيارة بالإنجليزية
            $table->integer('year'); // سنة الصنع
            $table->string('color_ar'); // لون السيارة بالعربية
            $table->string('color_en'); // لون السيارة بالإنجليزية
            $table->string('transmission'); // نوع الناقل (يدوي/أوتوماتيك)
            $table->string('fuel_type'); // نوع الوقود
            $table->integer('seats'); // عدد المقاعد
            $table->integer('doors'); // عدد الأبواب
            $table->decimal('daily_rate', 10, 2); // السعر اليومي
            $table->decimal('weekly_rate', 10, 2); // السعر الأسبوعي
            $table->decimal('monthly_rate', 10, 2); // السعر الشهري
            $table->text('description_ar'); // وصف السيارة بالعربية
            $table->text('description_en'); // وصف السيارة بالإنجليزية
            $table->json('features'); // المميزات
            $table->json('images'); // صور السيارة
            $table->string('license_plate')->unique(); // رقم اللوحة
            $table->string('vin')->unique(); // رقم الهيكل
            $table->integer('mileage'); // عدد الكيلومترات
            $table->enum('status', ['available', 'rented', 'maintenance', 'unavailable'])->default('available');
            $table->boolean('is_featured')->default(false); // سيارة مميزة
            $table->boolean('is_active')->default(true); // حالة السيارة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
