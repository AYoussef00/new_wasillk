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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->date('pickup_date'); // تاريخ الاستلام
            $table->time('pickup_time'); // وقت الاستلام
            $table->date('return_date'); // تاريخ الإرجاع
            $table->time('return_time'); // وقت الإرجاع
            $table->string('pickup_location'); // مكان الاستلام
            $table->string('return_location'); // مكان الإرجاع
            $table->decimal('total_amount', 10, 2); // المبلغ الإجمالي
            $table->decimal('deposit_amount', 10, 2)->default(0); // مبلغ التأمين
            $table->enum('status', ['pending', 'confirmed', 'active', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable(); // ملاحظات
            $table->json('driver_license')->nullable(); // رخصة القيادة
            $table->json('insurance_info')->nullable(); // معلومات التأمين
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
