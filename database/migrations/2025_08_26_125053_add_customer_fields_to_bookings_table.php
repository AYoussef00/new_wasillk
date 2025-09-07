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
            $table->string('customer_name')->nullable()->after('user_id');
            $table->string('customer_phone')->nullable()->after('customer_name');
            $table->text('customer_address')->nullable()->after('customer_phone');
            $table->string('id_image')->nullable()->after('customer_address');
            $table->string('license_image')->nullable()->after('id_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'customer_name',
                'customer_phone',
                'customer_address',
                'id_image',
                'license_image'
            ]);
        });
    }
};
