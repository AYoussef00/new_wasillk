<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <Header />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <h1 class="text-4xl md:text-6xl font-bold mb-6">موقعنا</h1>
          <p class="text-xl text-blue-100">تعرف على مواقع فروعنا</p>
        </div>
      </div>
    </section>

    <!-- Location Content -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
          <!-- Map Placeholder -->
          <div class="bg-gray-200 rounded-lg h-96 flex items-center justify-center">
            <div class="text-center">
              <MapPin class="w-16 h-16 text-gray-400 mx-auto mb-4" />
              <div class="text-gray-500 text-lg">موقعنا على الخريطة</div>
              <a
                href="https://maps.app.goo.gl/J1FPhWPzNBLq8qXC9?g_st=iw"
                target="_blank"
                class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 mt-4"
              >
                عرض على Google Maps
              </a>
            </div>
          </div>

          <!-- Location Information -->
          <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">العنوان الرئيسي</h2>
            <div class="space-y-6">
              <div class="flex items-start space-x-4 space-x-reverse">
                <div class="bg-blue-100 rounded-full p-3">
                  <MapPin class="w-6 h-6 text-blue-600" />
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900 mb-1">العنوان</h3>
                  <p class="text-gray-600">الدرعية - طريق الأمير عبدالله بن عبدالرحمن</p>
                  <p class="text-gray-600">الرياض، المملكة العربية السعودية</p>
                  <a
                    href="https://maps.app.goo.gl/J1FPhWPzNBLq8qXC9?g_st=iw"
                    target="_blank"
                    class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition duration-300 mt-2"
                  >
                    عرض على الخريطة
                  </a>
                </div>
              </div>

              <div class="flex items-start space-x-4 space-x-reverse">
                <div class="bg-blue-100 rounded-full p-3">
                  <Phone class="w-6 h-6 text-blue-600" />
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900 mb-1">الهاتف</h3>
                  <p class="text-gray-600">+966558587908</p>
                  <a href="tel:+966558587908" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition duration-300 mt-2">
                    اتصل الآن
                  </a>
                </div>
              </div>

              <div class="flex items-start space-x-4 space-x-reverse">
                <div class="bg-blue-100 rounded-full p-3">
                  <Clock class="w-6 h-6 text-blue-600" />
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900 mb-1">ساعات العمل</h3>
                  <p class="text-gray-600">الأحد - الخميس: 8:00 ص - 8:00 م</p>
                  <p class="text-gray-600">الجمعة - السبت: 9:00 ص - 6:00 م</p>
                </div>
              </div>

              <div class="flex items-start space-x-4 space-x-reverse">
                <div class="bg-blue-100 rounded-full p-3">
                  <Car class="w-6 h-6 text-blue-600" />
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900 mb-1">موقف السيارات</h3>
                  <p class="text-gray-600">موقف مجاني للعملاء</p>
                  <p class="text-gray-600">سعة 20 سيارة</p>
                </div>
              </div>
            </div>

            <!-- Directions -->
            <div class="mt-8 p-6 bg-gray-50 rounded-lg">
              <h3 class="text-xl font-semibold text-gray-900 mb-4">كيفية الوصول</h3>
              <div class="space-y-3 text-gray-600">
                <p><strong>من مطار الملك خالد:</strong> 30 دقيقة بالسيارة</p>
                <p><strong>من وسط المدينة:</strong> 15 دقيقة بالسيارة</p>
                <p><strong>بالحافلة:</strong> خط 123، محطة النزهة</p>
                <p><strong>بالقطار:</strong> محطة الملك عبدالله</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
          <!-- Company Info -->
          <div class="col-span-1 md:col-span-2">
                            <div class="text-2xl font-bold text-blue-400 mb-4">واصل لك</div>
            <p class="text-gray-300 mb-6 leading-relaxed">
              شركة متخصصة في تأجير السيارات، نوفر لعملائنا مجموعة واسعة من أحدث السيارات الفاخرة والاقتصادية لتناسب جميع الاحتياجات والمناسبات.
            </p>
            <div class="flex space-x-4 space-x-reverse">
              <a href="tel:+966558587908" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
              </a>
              <a href="mailto:info@wasillk.com" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
              </a>
              <a href="https://wa.me/966558587908" target="_blank" class="bg-green-600 hover:bg-green-700 text-white p-3 rounded-full transition duration-300">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h3 class="text-lg font-semibold mb-4">روابط سريعة</h3>
            <ul class="space-y-2">
              <li><a href="/" class="text-gray-300 hover:text-white transition duration-300">الصفحة الرئيسية</a></li>
              <li><a href="/cars" class="text-gray-300 hover:text-white transition duration-300">المعرض</a></li>
              <li><a href="/about" class="text-gray-300 hover:text-white transition duration-300">نبذة عنا</a></li>
              <li><a href="/contact" class="text-gray-300 hover:text-white transition duration-300">اتصل بنا</a></li>
              <li><a href="/location" class="text-gray-300 hover:text-white transition duration-300">موقعنا</a></li>
            </ul>
          </div>

          <!-- Contact Info -->
          <div>
            <h3 class="text-lg font-semibold mb-4">معلومات التواصل</h3>
            <div class="space-y-3 text-gray-300">
              <div class="flex items-center space-x-3 space-x-reverse">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <span>+966558587908</span>
              </div>
              <div class="flex items-center space-x-3 space-x-reverse">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span>info@wasillk.com</span>
              </div>
              <div class="flex items-center space-x-3 space-x-reverse">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>الدرعية - الرياض</span>
              </div>
            </div>
          </div>

          <!-- Download App -->
          <div>
            <h3 class="text-lg font-semibold mb-4">حمل التطبيق الآن</h3>
            <div class="space-y-3">
              <!-- Android -->
              <a href="https://play.google.com/store/apps/details?id=edx.wasillk.com&hl=en" target="_blank" rel="noopener noreferrer" class="flex items-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 rounded-xl p-3 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                <svg class="w-12 h-12 ml-3 flex-shrink-0" viewBox="0 0 24 24" fill="white">
                  <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.5,12.92 20.16,13.19L16.19,16.19L14.54,14.54L17.78,11.31L14.54,8.08L16.19,6.43L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
                </svg>
                <div class="flex-1 text-right">
                  <div class="text-xs text-green-100 opacity-90">احصل عليه من</div>
                  <div class="text-base font-bold text-white">Google Play</div>
                </div>
              </a>
              <!-- iOS -->
              <a href="https://apps.apple.com/gb/app/wasillk-car/id6748010446" target="_blank" rel="noopener noreferrer" class="flex items-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl p-3 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                <svg class="w-12 h-12 ml-3 flex-shrink-0" viewBox="0 0 24 24" fill="white">
                  <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                </svg>
                <div class="flex-1 text-right">
                  <div class="text-xs text-blue-100 opacity-90">احصل عليه من</div>
                  <div class="text-base font-bold text-white">App Store</div>
                </div>
              </a>
            </div>
          </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-800 mt-12 pt-8">
          <div class="flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm">
              © 2024 واصل لك لتأجير السيارات. جميع الحقوق محفوظة.
            </p>
            <div class="flex space-x-6 space-x-reverse mt-4 md:mt-0">
              <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">سياسة الخصوصية</a>
              <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">الشروط والأحكام</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import Header from '../components/Header.vue'
import {
  MapPin,
  Phone,
  Clock,
  Car
} from 'lucide-vue-next'
</script>
