<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'pickup_date',
        'return_date',
        'total_amount',
        'status',
        'notes',
        'id_image',
        'license_image',
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'return_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function getDurationAttribute()
    {
        return $this->pickup_date->diffInDays($this->return_date) + 1;
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'pending' => 'في الانتظار',
            'confirmed' => 'مؤكد',
            'active' => 'نشط',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            default => 'غير محدد'
        };
    }
}
