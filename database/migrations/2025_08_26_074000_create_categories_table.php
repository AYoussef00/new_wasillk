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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar'); // اسم الفئة بالعربية
            $table->string('name_en'); // اسم الفئة بالإنجليزية
            $table->string('icon')->nullable(); // أيقونة الفئة
            $table->text('description_ar')->nullable(); // وصف الفئة بالعربية
            $table->text('description_en')->nullable(); // وصف الفئة بالإنجليزية
            $table->boolean('is_active')->default(true); // حالة الفئة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
