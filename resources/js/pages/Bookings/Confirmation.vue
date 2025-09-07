<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <Header />

    <!-- Success Section -->
    <section class="py-16 bg-gradient-to-r from-green-600 to-green-700 text-white">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
          <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
          <h1 class="text-4xl font-bold mb-4">تم الحجز بنجاح!</h1>
          <p class="text-xl text-green-100">رقم الحجز: #{{ booking.id }}</p>
        </div>
      </div>
    </section>

    <!-- Booking Details -->
    <section class="py-16">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
          <!-- Car Details -->
          <div class="bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">تفاصيل السيارة</h2>
            <div class="space-y-6">
              <img
                :src="booking.car.images[0] || '/images/car-placeholder.jpg'"
                :alt="(booking.car.brand_ar || 'تويوتا') + ' ' + (booking.car.model_ar || 'كورولا')"
                class="w-full h-48 object-cover rounded-xl"
              />
              <div>
                <h3 class="text-xl font-bold text-black mb-2">{{ booking.car.brand_ar || 'تويوتا' }} {{ booking.car.model_ar || 'كورولا' }}</h3>
                <p class="text-gray-600">{{ booking.car.category.name }}</p>
              </div>
              <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="flex items-center space-x-2 space-x-reverse">
                  <Users class="w-4 h-4 text-blue-600" />
                  <span>{{ booking.car.seats }} مقاعد</span>
                </div>
                <div class="flex items-center space-x-2 space-x-reverse">
                  <Settings class="w-4 h-4 text-green-600" />
                  <span>{{ booking.car.transmission }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Booking Information -->
          <div class="bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">تفاصيل الحجز</h2>
            <div class="space-y-6">
              <!-- Customer Info -->
              <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">معلومات العميل</h3>
                <div class="space-y-3">
                  <div class="flex justify-between">
                    <span class="text-gray-600">الاسم:</span>
                    <span class="font-semibold">{{ booking.customer_name }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600">الهاتف:</span>
                    <span class="font-semibold">{{ booking.customer_phone }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600">العنوان:</span>
                    <span class="font-semibold">{{ booking.customer_address }}</span>
                  </div>
                </div>
              </div>

              <!-- Rental Period -->
              <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">فترة التأجير</h3>
                <div class="space-y-3">
                  <div class="flex justify-between">
                    <span class="text-gray-600">تاريخ الاستلام:</span>
                    <span class="font-semibold">{{ formatDate(booking.pickup_date) }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600">تاريخ التسليم:</span>
                    <span class="font-semibold">{{ formatDate(booking.return_date) }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600">المدة:</span>
                    <span class="font-semibold">{{ booking.duration }} يوم</span>
                  </div>
                </div>
              </div>

              <!-- Payment Summary -->
              <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">ملخص الدفع</h3>
                <div class="space-y-3">
                  <div class="flex justify-between">
                    <span class="text-gray-600">السعر اليومي:</span>
                    <span class="font-semibold">{{ booking.car.daily_rate }} ريال</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600">المدة:</span>
                    <span class="font-semibold">{{ booking.duration }} يوم</span>
                  </div>
                  <div class="border-t border-blue-200 pt-3">
                    <div class="flex justify-between">
                      <span class="text-lg font-bold text-gray-900">المبلغ الإجمالي:</span>
                      <span class="text-2xl font-bold text-blue-600">{{ booking.total_amount }} ريال</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Status -->
              <div class="bg-yellow-50 rounded-xl p-4 border border-yellow-200">
                <div class="flex items-center space-x-2 space-x-reverse">
                  <div class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></div>
                  <span class="font-semibold text-yellow-800">في انتظار التأكيد</span>
                </div>
                <p class="text-sm text-yellow-700 mt-2">سيتم التواصل معك قريباً لتأكيد الحجز</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-12 text-center">
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <Link
              href="/"
              class="bg-blue-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-blue-700 transition duration-300"
            >
              العودة للرئيسية
            </Link>
            <Link
              href="/cars"
              class="border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-xl font-semibold hover:bg-blue-600 hover:text-white transition duration-300"
            >
              استعرض المزيد من السيارات
            </Link>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Header from '../../components/Header.vue'
import { Users, Settings } from 'lucide-vue-next'

const props = defineProps({
  booking: Object,
})

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('ar-SA', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}
</script>
