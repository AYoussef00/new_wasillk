# منصة تأجير السيارات 🚗

منصة احترافية لتأجير السيارات مبنية بـ Laravel و Vue.js مع تصميم جميل ومتجاوب باللغة العربية.

## المميزات ✨

- **واجهة عربية احترافية**: تصميم جميل ومتجاوب باللغة العربية
- **إدارة السيارات**: إضافة وتعديل وحذف السيارات مع الصور والمواصفات
- **نظام الحجوزات**: حجز السيارات مع إدارة التواريخ والأسعار
- **فئات السيارات**: تصنيف السيارات حسب النوع (اقتصادية، فاخرة، رياضية، إلخ)
- **نظام البحث والفلترة**: بحث متقدم مع فلاتر متعددة
- **إدارة المستخدمين**: تسجيل الدخول وإدارة الحسابات
- **لوحة تحكم**: إدارة شاملة للنظام

## التقنيات المستخدمة 🛠️

### Backend
- **Laravel 12**: إطار العمل الرئيسي
- **MySQL**: قاعدة البيانات
- **Inertia.js**: ربط Laravel مع Vue.js

### Frontend
- **Vue.js 3**: إطار العمل الأمامي
- **Tailwind CSS**: تصميم الواجهة
- **TypeScript**: لغة البرمجة
- **Vite**: أداة البناء

## متطلبات النظام 📋

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL >= 8.0
- XAMPP أو أي خادم ويب محلي

## التثبيت والتشغيل 🚀

### 1. استنساخ المشروع
```bash
git clone <repository-url>
cd wasilk-new
```

### 2. تثبيت التبعيات
```bash
composer install
npm install
```

### 3. إعداد البيئة
```bash
cp .env.example .env
php artisan key:generate
```

### 4. إعداد قاعدة البيانات
```bash
# تعديل ملف .env بإعدادات قاعدة البيانات
php artisan migrate
php artisan db:seed
```

### 5. تشغيل المشروع
```bash
# تشغيل خادم التطوير
php artisan serve

# في نافذة أخرى، تشغيل Vite
npm run dev
```

### 6. الوصول للموقع
افتح المتصفح واذهب إلى: `http://localhost:8000`

## هيكل المشروع 📁

```
wasilk-new/
├── app/
│   ├── Http/Controllers/
│   │   ├── CarController.php
│   │   ├── BookingController.php
│   │   └── HomeController.php
│   └── Models/
│       ├── Car.php
│       ├── Category.php
│       ├── Booking.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── js/
│   │   ├── pages/
│   │   │   ├── Home.vue
│   │   │   ├── Cars/
│   │   │   └── Bookings/
│   │   └── app.ts
│   └── css/
│       └── app.css
└── routes/
    └── web.php
```

## الصفحات الرئيسية 📄

### الصفحة الرئيسية
- عرض السيارات المميزة
- فئات السيارات
- أحدث السيارات
- معلومات عن الخدمة

### صفحة السيارات
- قائمة جميع السيارات
- فلاتر متقدمة (السعر، الفئة، عدد المقاعد، إلخ)
- البحث في السيارات
- ترتيب النتائج

### صفحة تفاصيل السيارة
- صور السيارة
- المواصفات التفصيلية
- المميزات
- الأسعار (يومي، أسبوعي، شهري)
- زر الحجز

### نظام الحجوزات
- إنشاء حجز جديد
- إدارة الحجوزات
- تفاصيل الحجز
- إلغاء الحجز

## قاعدة البيانات 🗄️

### الجداول الرئيسية

#### categories
- `id` - المعرف
- `name_ar` - الاسم بالعربية
- `name_en` - الاسم بالإنجليزية
- `icon` - الأيقونة
- `description_ar` - الوصف بالعربية
- `description_en` - الوصف بالإنجليزية
- `is_active` - حالة الفئة

#### cars
- `id` - المعرف
- `category_id` - معرف الفئة
- `brand_ar/en` - الماركة
- `model_ar/en` - الموديل
- `year` - سنة الصنع
- `color_ar/en` - اللون
- `transmission` - نوع الناقل
- `fuel_type` - نوع الوقود
- `seats` - عدد المقاعد
- `doors` - عدد الأبواب
- `daily_rate` - السعر اليومي
- `weekly_rate` - السعر الأسبوعي
- `monthly_rate` - السعر الشهري
- `features` - المميزات (JSON)
- `images` - الصور (JSON)
- `license_plate` - رقم اللوحة
- `vin` - رقم الهيكل
- `mileage` - عدد الكيلومترات
- `status` - حالة السيارة
- `is_featured` - سيارة مميزة
- `is_active` - حالة السيارة

#### bookings
- `id` - المعرف
- `user_id` - معرف المستخدم
- `car_id` - معرف السيارة
- `pickup_date` - تاريخ الاستلام
- `pickup_time` - وقت الاستلام
- `return_date` - تاريخ الإرجاع
- `return_time` - وقت الإرجاع
- `pickup_location` - مكان الاستلام
- `return_location` - مكان الإرجاع
- `total_amount` - المبلغ الإجمالي
- `deposit_amount` - مبلغ التأمين
- `status` - حالة الحجز
- `notes` - ملاحظات

## المسارات الرئيسية 🛣️

```
GET  /                    # الصفحة الرئيسية
GET  /cars               # قائمة السيارات
GET  /cars/featured      # السيارات المميزة
GET  /cars/{car}         # تفاصيل السيارة
GET  /bookings           # حجوزاتي (تتطلب تسجيل دخول)
GET  /cars/{car}/book    # إنشاء حجز (تتطلب تسجيل دخول)
POST /cars/{car}/book    # حفظ الحجز
GET  /bookings/{booking} # تفاصيل الحجز
PATCH /bookings/{booking}/cancel # إلغاء الحجز
```

## التخصيص 🎨

### إضافة سيارة جديدة
1. اذهب إلى قاعدة البيانات
2. أضف فئة جديدة في جدول `categories`
3. أضف السيارة في جدول `cars`
4. أضف الصور في مجلد `public/images/cars`

### تغيير التصميم
- عدل ملف `resources/css/app.css` لتغيير الألوان والخطوط
- عدل ملفات Vue.js في `resources/js/pages/` لتغيير التخطيط

### إضافة ميزات جديدة
- أضف Controller جديد في `app/Http/Controllers/`
- أضف Model جديد في `app/Models/`
- أضف صفحة Vue.js جديدة في `resources/js/pages/`
- أضف المسارات في `routes/web.php`

## المساهمة 🤝

نرحب بالمساهمات! يرجى اتباع الخطوات التالية:

1. Fork المشروع
2. إنشاء branch جديد للميزة
3. Commit التغييرات
4. Push إلى Branch
5. إنشاء Pull Request

## الترخيص 📄

هذا المشروع مرخص تحت رخصة MIT.

## الدعم 💬

إذا واجهت أي مشاكل أو لديك أسئلة، يرجى إنشاء issue في GitHub.

---

**تم تطوير هذا المشروع بـ ❤️ للعالم العربي**
