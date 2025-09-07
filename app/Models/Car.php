<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    protected $fillable = [
        'category_id',
        'brand_ar',
        'brand_en',
        'model_ar',
        'model_en',
        'year',
        'color_ar',
        'color_en',
        'transmission',
        'fuel_type',
        'seats',
        'doors',
        'daily_rate',
        'weekly_rate',
        'monthly_rate',
        'description_ar',
        'description_en',
        'features',
        'images',
        'license_plate',
        'vin',
        'mileage',
        'status',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'daily_rate' => 'decimal:2',
        'weekly_rate' => 'decimal:2',
        'monthly_rate' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getBrandAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->brand_ar : $this->brand_en;
    }

    public function getModelAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->model_ar : $this->model_en;
    }

    public function getColorAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->color_ar : $this->color_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : $this->description_en;
    }

    public function getFullNameAttribute()
    {
        return $this->brand . ' ' . $this->model . ' ' . $this->year;
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }
}
