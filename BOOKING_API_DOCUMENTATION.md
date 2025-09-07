# Booking API Documentation

## Overview
This API allows you to create, view, and manage car bookings through RESTful endpoints.

## Base URL
```
https://wasillk.com/api
```

## Authentication
- Some endpoints require authentication using Laravel Sanctum
- For guest bookings, no authentication is required

## Endpoints

### 1. Create Booking
**POST** `/cars/{car_id}/book`

Create a new booking for a specific car.

#### Parameters
- `car_id` (path): The ID of the car to book

#### Request Body (multipart/form-data)
```json
{
    "customer_name": "أحمد محمد",
    "customer_phone": "+966501234567",
    "customer_address": "الرياض، شارع الملك فهد",
    "pickup_date": "2025-09-10",
    "return_date": "2025-09-15",
    "id_image": "file", // optional
    "license_image": "file", // optional
    "notes": "ملاحظات إضافية" // optional
}
```

#### Response (Success - 201)
```json
{
    "success": true,
    "message": "تم إنشاء الحجز بنجاح! سيتم التواصل معك قريباً لتأكيد التفاصيل.",
    "data": {
        "booking": {
            "id": 1,
            "user_id": null,
            "car_id": 1,
            "customer_name": "أحمد محمد",
            "customer_phone": "+966501234567",
            "customer_address": "الرياض، شارع الملك فهد",
            "pickup_date": "2025-09-10",
            "return_date": "2025-09-15",
            "total_amount": "750.00",
            "status": "pending",
            "notes": "ملاحظات إضافية",
            "id_image": "bookings/id_images/...",
            "license_image": "bookings/license_images/...",
            "created_at": "2025-09-07T12:00:00.000000Z",
            "updated_at": "2025-09-07T12:00:00.000000Z",
            "car": {
                "id": 1,
                "brand_ar": "تويوتا",
                "model_ar": "كورولا",
                "daily_rate": "150.00",
                "category": {
                    "id": 1,
                    "name_ar": "سيارات اقتصادية"
                }
            }
        },
        "duration": 6,
        "total_amount": 750
    }
}
```

#### Response (Error - 422)
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "customer_name": ["اسم العميل مطلوب"],
        "pickup_date": ["تاريخ الاستلام يجب أن يكون اليوم أو بعده"]
    }
}
```

### 2. Get User Bookings
**GET** `/bookings`

Get all bookings for the authenticated user or search by phone number.

#### Query Parameters
- `phone` (optional): Phone number to search for bookings (for guests)

#### Response (Success - 200)
```json
{
    "success": true,
    "data": {
        "bookings": {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "customer_name": "أحمد محمد",
                    "customer_phone": "+966501234567",
                    "pickup_date": "2025-09-10",
                    "return_date": "2025-09-15",
                    "total_amount": "750.00",
                    "status": "pending",
                    "car": {
                        "id": 1,
                        "brand_ar": "تويوتا",
                        "model_ar": "كورولا",
                        "category": {
                            "name_ar": "سيارات اقتصادية"
                        }
                    }
                }
            ],
            "per_page": 10,
            "total": 1
        }
    }
}
```

### 3. Get Booking Details
**GET** `/bookings/{booking_id}`

Get detailed information about a specific booking.

#### Parameters
- `booking_id` (path): The ID of the booking

#### Response (Success - 200)
```json
{
    "success": true,
    "data": {
        "booking": {
            "id": 1,
            "customer_name": "أحمد محمد",
            "customer_phone": "+966501234567",
            "customer_address": "الرياض، شارع الملك فهد",
            "pickup_date": "2025-09-10",
            "return_date": "2025-09-15",
            "total_amount": "750.00",
            "status": "pending",
            "notes": "ملاحظات إضافية",
            "car": {
                "id": 1,
                "brand_ar": "تويوتا",
                "model_ar": "كورولا",
                "daily_rate": "150.00",
                "category": {
                    "name_ar": "سيارات اقتصادية"
                }
            }
        }
    }
}
```

### 4. Cancel Booking
**PATCH** `/bookings/{booking_id}/cancel`

Cancel a specific booking.

#### Parameters
- `booking_id` (path): The ID of the booking to cancel

#### Response (Success - 200)
```json
{
    "success": true,
    "message": "تم إلغاء الحجز بنجاح",
    "data": {
        "booking": {
            "id": 1,
            "status": "cancelled",
            "updated_at": "2025-09-07T12:30:00.000000Z"
        }
    }
}
```

## Error Responses

### 400 Bad Request
```json
{
    "success": false,
    "message": "يجب تسجيل الدخول أو إدخال رقم الهاتف للبحث عن الحجوزات"
}
```

### 403 Forbidden
```json
{
    "success": false,
    "message": "غير مصرح لك بالوصول لهذا الحجز"
}
```

### 404 Not Found
```json
{
    "success": false,
    "message": "الحجز غير موجود"
}
```

### 500 Internal Server Error
```json
{
    "success": false,
    "message": "حدث خطأ أثناء إنشاء الحجز",
    "error": "Error details"
}
```

## Status Codes
- `pending`: في الانتظار
- `confirmed`: مؤكد
- `active`: نشط
- `completed`: مكتمل
- `cancelled`: ملغي

## Example Usage

### Create Booking with cURL
```bash
curl -X POST "https://wasillk.com/api/cars/1/book" \
  -H "Content-Type: multipart/form-data" \
  -F "customer_name=أحمد محمد" \
  -F "customer_phone=+966501234567" \
  -F "customer_address=الرياض، شارع الملك فهد" \
  -F "pickup_date=2025-09-10" \
  -F "return_date=2025-09-15" \
  -F "notes=ملاحظات إضافية"
```

### Get Bookings with cURL
```bash
curl -X GET "https://wasillk.com/api/bookings?phone=+966501234567"
```

### Cancel Booking with cURL
```bash
curl -X PATCH "https://wasillk.com/api/bookings/1/cancel"
```
