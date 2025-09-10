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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('واصل لك لتأجير السيارات');
            $table->text('company_address')->default('الرياض، المملكة العربية السعودية');
            $table->string('company_phone')->default('+966501234567');
            $table->longText('cancellation_policy')->nullable();
            $table->longText('insurance_info')->nullable();
            $table->longText('rental_terms')->nullable();
            $table->json('location_coordinates')->nullable(); // {lat: 24.7136, lng: 46.6753}
            $table->text('location_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
