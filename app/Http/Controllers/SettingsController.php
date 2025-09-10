<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::getSettings();

        return Inertia::render('Settings/Index', [
            'settings' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:500',
            'company_phone' => 'nullable|string|max:20',
            'whatsapp_phone' => 'nullable|string|max:20',
            'cancellation_policy' => 'nullable|string',
            'insurance_info' => 'nullable|string',
            'rental_terms' => 'nullable|string',
            'location_address' => 'nullable|string|max:500',
            'google_maps_link' => 'nullable|url|max:1000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:500',
        ], [
            'company_name.string' => 'اسم الشركة يجب أن يكون نص',
            'company_name.max' => 'اسم الشركة لا يجب أن يتجاوز 255 حرف',

            'company_address.string' => 'عنوان الشركة يجب أن يكون نص',
            'company_address.max' => 'عنوان الشركة لا يجب أن يتجاوز 500 حرف',

            'company_phone.string' => 'رقم هاتف الشركة يجب أن يكون نص',
            'company_phone.max' => 'رقم هاتف الشركة لا يجب أن يتجاوز 20 حرف',

            'whatsapp_phone.string' => 'رقم الواتساب يجب أن يكون نص',
            'whatsapp_phone.max' => 'رقم الواتساب لا يجب أن يتجاوز 20 حرف',

            'location_address.string' => 'عنوان الموقع يجب أن يكون نص',
            'location_address.max' => 'عنوان الموقع لا يجب أن يتجاوز 500 حرف',

            'google_maps_link.url' => 'رابط جوجل ماب يجب أن يكون رابط صحيح',
            'google_maps_link.max' => 'رابط جوجل ماب لا يجب أن يتجاوز 1000 حرف',

            'logo.image' => 'الشعار يجب أن يكون صورة',
            'logo.mimes' => 'الشعار يجب أن يكون من نوع: jpeg, png, jpg, gif, svg',
            'logo.max' => 'حجم الشعار لا يجب أن يتجاوز 2 ميجابايت',

            'main_title.string' => 'العنوان الرئيسي يجب أن يكون نص',
            'main_title.max' => 'العنوان الرئيسي لا يجب أن يتجاوز 255 حرف',

            'sub_title.string' => 'العنوان الثانوي يجب أن يكون نص',
            'sub_title.max' => 'العنوان الثانوي لا يجب أن يتجاوز 500 حرف',
        ]);

        $settings = Settings::getSettings();

        $data = $request->except(['_token', '_method']);

        // Remove empty fields to keep existing values
        $data = array_filter($data, function($value) {
            return $value !== null && $value !== '';
        });

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo && file_exists(storage_path('app/public/' . $settings->logo))) {
                unlink(storage_path('app/public/' . $settings->logo));
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('settings', 'public');
            $data['logo'] = $logoPath;
        } else {
            // Keep existing logo if no new file uploaded
            unset($data['logo']);
        }

        // Only update fields that have values
        if (!empty($data)) {
            $settings->update($data);
        }

        return redirect()->back()->with('success', 'تم تحديث الإعدادات بنجاح!');
    }

    public function getPolicies()
    {
        $settings = Settings::getSettings();

        return response()->json([
            'success' => true,
            'data' => [
                'cancellation_policy' => $settings->cancellation_policy ?? 'سياسة الإلغاء غير محددة',
                'insurance_info' => $settings->insurance_info ?? 'معلومات التأمين غير محددة',
                'rental_terms' => $settings->rental_terms ?? 'شروط الإيجار غير محددة',
            ]
        ]);
    }

    public function getLocation()
    {
        $settings = Settings::getSettings();

        return response()->json([
            'success' => true,
            'data' => [
                'coordinates' => $settings->location_coordinates ?? ['lat' => 24.7136, 'lng' => 46.6753],
                'address' => $settings->location_address ?? 'الرياض، المملكة العربية السعودية',
                'google_maps_link' => $settings->google_maps_link ?? 'https://maps.google.com/?q=24.7136,46.6753',
            ]
        ]);
    }

    public function getTitles()
    {
        $settings = Settings::getSettings();

        return response()->json([
            'success' => true,
            'data' => [
                'main_title' => $settings->main_title ?? 'واصل لك لتأجير السيارات',
                'sub_title' => $settings->sub_title ?? 'أفضل خدمة تأجير سيارات في المملكة',
            ]
        ]);
    }

    public function getContactInfo()
    {
        $settings = Settings::getSettings();

        return response()->json([
            'success' => true,
            'data' => [
                'phone' => $settings->company_phone ?? '+966 55 8588 097',
                'whatsapp' => $settings->whatsapp_phone ?? '+966 55 8588 097',
                'email' => 'info@wasillk.com', // يمكن إضافة هذا الحقل لاحقاً
                'address' => $settings->company_address ?? 'الدرعية - طريق الأمير عبدالله بن عبدالرحمن، الرياض، المملكة العربية السعودية',
                'google_maps_link' => $settings->google_maps_link ?? 'https://maps.app.goo.gl/J1FPhWPzNBLq8qXC9?g_st=iw',
            ]
        ]);
    }
}
