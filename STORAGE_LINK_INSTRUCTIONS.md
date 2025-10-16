# حل مشكلة عدم ظهور صور السيارات على السيرفر المباشر

## المشكلة
الصور لا تظهر على السيرفر المباشر (Live Server) بينما تظهر بشكل طبيعي على localhost.

## السبب
الصور مخزنة في مجلد `storage/app/public/` ولكن Laravel يحتاج إلى رابط رمزي (symbolic link) بين `public/storage` و `storage/app/public/` لكي تكون الصور متاحة للعرض في المتصفح.

## الحل

### الطريقة الأولى: استخدام SSH (الأفضل)

1. اتصل بالسيرفر عبر SSH
2. انتقل إلى مجلد المشروع:
   ```bash
   cd /path/to/your/project
   ```
3. شغّل الأمر:
   ```bash
   php artisan storage:link
   ```
4. يجب أن تظهر رسالة: "The [public/storage] link has been created."

### الطريقة الثانية: استخدام ملف PHP مؤقت (إذا لم يكن لديك SSH)

1. ارفع ملف `storage-link.php` الموجود في مجلد `public/` إلى السيرفر المباشر
2. افتح المتصفح واذهب إلى: `http://your-domain.com/storage-link.php`
3. إذا ظهرت رسالة نجاح، **احذف الملف فوراً** من السيرفر لأسباب أمنية

### التحقق من نجاح العملية

1. افتح متصفحك واذهب إلى: `http://your-domain.com/storage/cars/main/`
2. يجب أن ترى قائمة بالصور أو رسالة 404 (وليس 403 Forbidden)
3. جرب فتح إحدى صور السيارات مباشرة

## مشاكل محتملة وحلولها

### المشكلة: "The [public/storage] link already exists"
```bash
# احذف الرابط القديم أولاً
rm public/storage
# ثم أنشئ رابط جديد
php artisan storage:link
```

### المشكلة: لا توجد صلاحيات لإنشاء symbolic links
اتصل بشركة الاستضافة واطلب منهم:
1. إنشاء symbolic link من `public/storage` إلى `storage/app/public`
2. أو إعطائك صلاحيات لإنشاء symbolic links

### المشكلة: الصور لا تزال لا تظهر بعد إنشاء الرابط
تحقق من:
1. صلاحيات مجلد `storage/app/public/` (يجب أن تكون 755)
   ```bash
   chmod -R 755 storage/app/public/
   ```
2. تأكد أن الصور موجودة فعلاً في `storage/app/public/cars/`
3. تأكد أن ملف `.gitignore` لا يمنع رفع الصور

## معلومات تقنية

- **مسار تخزين الصور:** `storage/app/public/cars/main/` و `storage/app/public/cars/secondary/`
- **مسار الوصول للصور:** `public/storage/cars/main/` و `public/storage/cars/secondary/`
- **URL في المتصفح:** `http://your-domain.com/storage/cars/main/filename.jpg`

## ملاحظات مهمة

1. يجب تشغيل الأمر `php artisan storage:link` على كل سيرفر جديد تنقل إليه المشروع
2. لا تضع الأمر في الـ deployment script لأنه يحتاج أن يُشغل مرة واحدة فقط
3. إذا كنت تستخدم Git، لا تضف مجلد `public/storage` لأنه رابط رمزي فقط

