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
        Schema::table('bookings', function (Blueprint $table) {
            // إزالة الأعمدة القديمة التي تسبب المشكلة
            if (Schema::hasColumn('bookings', 'pickup_time')) {
                $table->dropColumn('pickup_time');
            }
            if (Schema::hasColumn('bookings', 'return_time')) {
                $table->dropColumn('return_time');
            }
            if (Schema::hasColumn('bookings', 'pickup_location')) {
                $table->dropColumn('pickup_location');
            }
            if (Schema::hasColumn('bookings', 'return_location')) {
                $table->dropColumn('return_location');
            }
            if (Schema::hasColumn('bookings', 'deposit_amount')) {
                $table->dropColumn('deposit_amount');
            }
            if (Schema::hasColumn('bookings', 'driver_license')) {
                $table->dropColumn('driver_license');
            }
            if (Schema::hasColumn('bookings', 'insurance_info')) {
                $table->dropColumn('insurance_info');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // إعادة الأعمدة القديمة
            $table->time('pickup_time')->after('pickup_date');
            $table->time('return_time')->after('return_date');
            $table->string('pickup_location')->after('return_time');
            $table->string('return_location')->after('pickup_location');
            $table->decimal('deposit_amount', 10, 2)->default(0)->after('total_amount');
            $table->json('driver_license')->nullable()->after('notes');
            $table->json('insurance_info')->nullable()->after('driver_license');
        });
    }
};
