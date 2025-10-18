<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'company_name',
        'company_address',
        'company_phone',
        'whatsapp_phone',
        'cancellation_policy',
        'insurance_info',
        'rental_terms',
        'location_coordinates',
        'location_address',
        'google_maps_link',
        'logo',
        'main_title',
        'sub_title',
    ];

    protected $casts = [
        'location_coordinates' => 'array',
    ];

    /**
     * Get the first settings record or create one if it doesn't exist
     */
    public static function getSettings()
    {
        return static::first() ?? static::create([
            'company_name' => 'واصل لك لتأجير السيارات',
            'company_address' => 'الدرعية - طريق الأمير عبدالله بن عبدالرحمن، الرياض، المملكة العربية السعودية',
            'company_phone' => '+966558587908',
            'whatsapp_phone' => '+966558587908',
            'cancellation_policy' => 'يمكن إلغاء الحجز قبل 24 ساعة من تاريخ الاستلام',
            'insurance_info' => 'جميع السيارات مؤمنة بالكامل',
            'rental_terms' => 'يجب أن يكون عمر المستأجر 21 سنة أو أكثر',
            'location_coordinates' => ['lat' => 24.7136, 'lng' => 46.6753],
            'location_address' => 'الدرعية - طريق الأمير عبدالله بن عبدالرحمن، الرياض، المملكة العربية السعودية',
            'google_maps_link' => 'https://maps.app.goo.gl/J1FPhWPzNBLq8qXC9?g_st=iw',
            'logo' => null,
            'main_title' => 'واصل لك لتأجير السيارات',
            'sub_title' => 'أفضل خدمة تأجير سيارات في المملكة',
        ]);
    }
}
