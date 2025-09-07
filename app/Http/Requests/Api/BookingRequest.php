<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // السماح للجميع بالحجز
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
            'id_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'license_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'customer_name.required' => 'اسم العميل مطلوب',
            'customer_name.string' => 'اسم العميل يجب أن يكون نص',
            'customer_name.max' => 'اسم العميل لا يجب أن يتجاوز 255 حرف',
            
            'customer_phone.required' => 'رقم الهاتف مطلوب',
            'customer_phone.string' => 'رقم الهاتف يجب أن يكون نص',
            'customer_phone.max' => 'رقم الهاتف لا يجب أن يتجاوز 20 حرف',
            
            'customer_address.required' => 'عنوان العميل مطلوب',
            'customer_address.string' => 'عنوان العميل يجب أن يكون نص',
            'customer_address.max' => 'عنوان العميل لا يجب أن يتجاوز 500 حرف',
            
            'pickup_date.required' => 'تاريخ الاستلام مطلوب',
            'pickup_date.date' => 'تاريخ الاستلام يجب أن يكون تاريخ صحيح',
            'pickup_date.after_or_equal' => 'تاريخ الاستلام يجب أن يكون اليوم أو بعده',
            
            'return_date.required' => 'تاريخ الإرجاع مطلوب',
            'return_date.date' => 'تاريخ الإرجاع يجب أن يكون تاريخ صحيح',
            'return_date.after' => 'تاريخ الإرجاع يجب أن يكون بعد تاريخ الاستلام',
            
            'id_image.image' => 'صورة الهوية يجب أن تكون صورة',
            'id_image.mimes' => 'صورة الهوية يجب أن تكون من نوع jpeg, png, jpg',
            'id_image.max' => 'صورة الهوية لا يجب أن تتجاوز 2 ميجابايت',
            
            'license_image.image' => 'صورة رخصة القيادة يجب أن تكون صورة',
            'license_image.mimes' => 'صورة رخصة القيادة يجب أن تكون من نوع jpeg, png, jpg',
            'license_image.max' => 'صورة رخصة القيادة لا يجب أن تتجاوز 2 ميجابايت',
            
            'notes.string' => 'الملاحظات يجب أن تكون نص',
            'notes.max' => 'الملاحظات لا يجب أن تتجاوز 1000 حرف',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'customer_name' => 'اسم العميل',
            'customer_phone' => 'رقم الهاتف',
            'customer_address' => 'عنوان العميل',
            'pickup_date' => 'تاريخ الاستلام',
            'return_date' => 'تاريخ الإرجاع',
            'id_image' => 'صورة الهوية',
            'license_image' => 'صورة رخصة القيادة',
            'notes' => 'الملاحظات',
        ];
    }
}
