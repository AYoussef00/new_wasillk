# 🚗 Wasilk Cars API Documentation

## Overview
This API provides comprehensive access to car rental data including cars, pricing, features, images, and categories.

## Base URL
```
http://127.0.0.1:8000/api
```

## Authentication
Currently, no authentication is required for these endpoints.

---

## 📋 Endpoints

### 1. Get All Cars
**GET** `/cars`

Returns all available cars with full details, pricing, and images.

#### Query Parameters (Optional Filters)
- `category_id` - Filter by category ID
- `brand` - Filter by brand name
- `transmission` - Filter by transmission type (أوتوماتيك, يدوي)
- `fuel_type` - Filter by fuel type (بنزين, ديزل, كهربائي, هجين)
- `min_price` - Minimum daily rate
- `max_price` - Maximum daily rate
- `seats` - Number of seats
- `year` - Car year
- `featured` - Show only featured cars (true/false)

#### Example Request
```bash
curl "http://127.0.0.1:8000/api/cars?category_id=1&featured=true"
```

#### Example Response
```json
{
  "success": true,
  "message": "تم جلب السيارات بنجاح",
  "data": [
    {
      "id": 12,
      "brand": {
        "ar": "مرسيدس",
        "en": "Mercedes"
      },
      "model": {
        "ar": "فئة S",
        "en": "S-Class"
      },
      "year": 2024,
      "color": {
        "ar": "أسود",
        "en": "Black"
      },
      "transmission": "أوتوماتيك",
      "fuel_type": "بنزين",
      "seats": 5,
      "doors": 4,
      "pricing": {
        "daily_rate": 800,
        "weekly_rate": 4800,
        "monthly_rate": 16000,
        "currency": "SAR"
      },
      "license_plate": "GHI-789",
      "vin": "3VWDX7AJ5DM123456",
      "mileage": 5000,
      "description": {
        "ar": "سيارة فاخرة من الدرجة الأولى مع أحدث التقنيات",
        "en": "First-class luxury car with latest technology"
      },
      "features": [
        "مقاعد جلدية",
        "نظام صوت فاخر",
        "مكيف هواء",
        "نظام ملاحة",
        "مقاعد مسخنة"
      ],
      "images": [
        "http://127.0.0.1:8000/storage/images/cars/mercedes-s-class-1.jpg",
        "http://127.0.0.1:8000/storage/images/cars/mercedes-s-class-2.jpg"
      ],
      "status": "available",
      "is_featured": true,
      "is_active": true,
      "category": {
        "id": 2,
        "name_ar": "سيارات فاخرة",
        "name_en": "Luxury Cars",
        "description_ar": "سيارات فاخرة عالية الجودة",
        "description_en": "High-quality luxury cars"
      },
      "created_at": "2025-08-26 16:45:02",
      "updated_at": "2025-08-26 16:45:02"
    }
  ],
  "total": 1,
  "filters": {
    "categories": [...],
    "brands": [...],
    "transmissions": [...],
    "fuel_types": [...],
    "seats_options": [...],
    "years": [...]
  }
}
```

---

### 2. Get Specific Car
**GET** `/cars/{id}`

Returns detailed information about a specific car.

#### Example Request
```bash
curl "http://127.0.0.1:8000/api/cars/12"
```

#### Example Response
```json
{
  "success": true,
  "message": "تم جلب تفاصيل السيارة بنجاح",
  "data": {
    "id": 12,
    "brand": {
      "ar": "مرسيدس",
      "en": "Mercedes"
    },
    "model": {
      "ar": "فئة S",
      "en": "S-Class"
    },
    "year": 2024,
    "color": {
      "ar": "أسود",
      "en": "Black"
    },
    "transmission": "أوتوماتيك",
    "fuel_type": "بنزين",
    "seats": 5,
    "doors": 4,
    "pricing": {
      "daily_rate": 800,
      "weekly_rate": 4800,
      "monthly_rate": 16000,
      "currency": "SAR"
    },
    "license_plate": "GHI-789",
    "vin": "3VWDX7AJ5DM123456",
    "mileage": 5000,
    "description": {
      "ar": "سيارة فاخرة من الدرجة الأولى مع أحدث التقنيات",
      "en": "First-class luxury car with latest technology"
    },
    "features": [
      "مقاعد جلدية",
      "نظام صوت فاخر",
      "مكيف هواء",
      "نظام ملاحة",
      "مقاعد مسخنة"
    ],
    "images": [
      "http://127.0.0.1:8000/storage/images/cars/mercedes-s-class-1.jpg",
      "http://127.0.0.1:8000/storage/images/cars/mercedes-s-class-2.jpg"
    ],
    "status": "available",
    "is_featured": true,
    "is_active": true,
    "category": {
      "id": 2,
      "name_ar": "سيارات فاخرة",
      "name_en": "Luxury Cars",
      "description_ar": "سيارات فاخرة عالية الجودة",
      "description_en": "High-quality luxury cars"
    },
    "created_at": "2025-08-26 16:45:02",
    "updated_at": "2025-08-26 16:45:02"
  }
}
```

---

### 3. Get Featured Cars
**GET** `/cars/featured/list`

Returns all featured cars.

#### Example Request
```bash
curl "http://127.0.0.1:8000/api/cars/featured/list"
```

#### Example Response
```json
{
  "success": true,
  "message": "تم جلب السيارات المميزة بنجاح",
  "data": [...],
  "total": 3
}
```

---

### 4. Get Cars by Category
**GET** `/cars/category/{categoryId}`

Returns all cars in a specific category.

#### Example Request
```bash
curl "http://127.0.0.1:8000/api/cars/category/2"
```

#### Example Response
```json
{
  "success": true,
  "message": "تم جلب سيارات الفئة بنجاح",
  "data": [...],
  "total": 2,
  "category": {
    "id": 2,
    "name_ar": "سيارات فاخرة",
    "name_en": "Luxury Cars",
    "description_ar": "سيارات فاخرة عالية الجودة",
    "description_en": "High-quality luxury cars"
  }
}
```

---

### 5. Search Cars
**GET** `/cars/search/query`

Search cars by brand, model, description, or license plate.

#### Query Parameters
- `q` - Search term

#### Example Request
```bash
curl "http://127.0.0.1:8000/api/cars/search/query?q=تويوتا"
```

#### Example Response
```json
{
  "success": true,
  "message": "تم البحث بنجاح",
  "data": [...],
  "total": 3,
  "search_term": "تويوتا"
}
```

---

### 6. Get Available Filters
**GET** `/cars/filters/available`

Returns all available filter options for cars.

#### Example Request
```bash
curl "http://127.0.0.1:8000/api/cars/filters/available"
```

#### Example Response
```json
{
  "success": true,
  "message": "تم جلب الفلاتر بنجاح",
  "data": {
    "categories": [
      {
        "id": 1,
        "name_ar": "سيارات اقتصادية",
        "name_en": "Economy Cars",
        "description_ar": "سيارات اقتصادية مناسبة للاستخدام اليومي",
        "description_en": "Economy cars suitable for daily use"
      }
    ],
    "brands": ["تويوتا", "هيونداي", "مرسيدس", "بي إم دبليو", "فيراري", "هوندا"],
    "models": ["كورولا", "إلنترا", "فئة S", "فئة 7", "488", "أوديسي", "لاند كروزر", "سوناتا"],
    "transmissions": ["أوتوماتيك", "يدوي"],
    "fuel_types": ["بنزين", "ديزل", "كهربائي", "هجين"],
    "seats_options": [2, 5, 7, 8],
    "doors_options": [2, 4, 5],
    "years": [2025, 2024, 2023, 2022],
    "colors": ["اسود", "أبيض", "أزرق", "أسود", "فضي", "أحمر", "رمادي"],
    "price_range": {
      "min": 140,
      "max": 1200
    }
  }
}
```

---

## 📊 Data Structure

### Car Object
```json
{
  "id": "integer",
  "brand": {
    "ar": "string",
    "en": "string"
  },
  "model": {
    "ar": "string", 
    "en": "string"
  },
  "year": "integer",
  "color": {
    "ar": "string",
    "en": "string"
  },
  "transmission": "string",
  "fuel_type": "string",
  "seats": "integer",
  "doors": "integer",
  "pricing": {
    "daily_rate": "float",
    "weekly_rate": "float", 
    "monthly_rate": "float",
    "currency": "string"
  },
  "license_plate": "string",
  "vin": "string",
  "mileage": "integer",
  "description": {
    "ar": "string",
    "en": "string"
  },
  "features": ["string"],
  "images": ["string"],
  "status": "string",
  "is_featured": "boolean",
  "is_active": "boolean",
  "category": {
    "id": "integer",
    "name_ar": "string",
    "name_en": "string",
    "description_ar": "string",
    "description_en": "string"
  },
  "created_at": "string",
  "updated_at": "string"
}
```

---

## 🎯 Use Cases

### 1. Mobile App Integration
```javascript
// Fetch all cars
const response = await fetch('http://127.0.0.1:8000/api/cars');
const data = await response.json();

// Filter by category
const luxuryCars = await fetch('http://127.0.0.1:8000/api/cars?category_id=2');

// Search for specific brand
const toyotaCars = await fetch('http://127.0.0.1:8000/api/cars/search/query?q=تويوتا');
```

### 2. Website Integration
```javascript
// Get featured cars for homepage
const featuredCars = await fetch('http://127.0.0.1:8000/api/cars/featured/list');

// Get filters for search page
const filters = await fetch('http://127.0.0.1:8000/api/cars/filters/available');
```

### 3. Price Comparison
```javascript
// Get cars within price range
const affordableCars = await fetch('http://127.0.0.1:8000/api/cars?min_price=100&max_price=300');
```

---

## 🔧 Error Handling

All endpoints return consistent error responses:

```json
{
  "success": false,
  "message": "Error message in Arabic",
  "error": "Technical error details"
}
```

### Common HTTP Status Codes
- `200` - Success
- `404` - Car not found
- `500` - Server error

---

## 📝 Notes

1. **Images**: All image URLs are automatically converted to full URLs
2. **Language Support**: All text fields support both Arabic and English
3. **Currency**: All prices are in Saudi Riyals (SAR)
4. **Status**: Only cars with `status: "available"` and `is_active: true` are returned
5. **Features**: Car features are returned as an array of strings
6. **Categories**: Include both Arabic and English names and descriptions

---

## 🚀 Getting Started

1. **Test the API**: Use the provided curl examples or tools like Postman
2. **Integrate**: Use the endpoints in your mobile app or website
3. **Filter**: Use the available filters to narrow down results
4. **Search**: Implement search functionality using the search endpoint

For more information or support, please contact the development team.


