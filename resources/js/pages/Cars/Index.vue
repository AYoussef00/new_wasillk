<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <!-- Header -->
    <Header />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 text-white py-20 overflow-hidden">
      <!-- Background Pattern -->
      <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent opacity-30"></div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-2xl mb-8">
            <Car class="w-10 h-10 text-white" />
          </div>
          <h1 class="text-5xl md:text-7xl font-black mb-6 bg-gradient-to-r from-white via-blue-100 to-indigo-200 bg-clip-text text-transparent">
            استعرض السيارات
          </h1>
          <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-2xl mx-auto">
            اكتشف مجموعة واسعة من السيارات الفاخرة والاقتصادية لتناسب جميع احتياجاتك
          </p>
          <div class="inline-flex items-center gap-2 bg-white/20 rounded-full px-6 py-3">
            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
            <span class="text-sm font-medium">متاح الآن {{ cars.total }} سيارة</span>
          </div>
        </div>
      </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
              <!-- Cars Grid -->
        <div class="w-full">
          <!-- Page Title -->
          <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">جميع السيارات المتاحة</h2>
            <p class="text-lg text-gray-600">اختر من مجموعة واسعة من السيارات الفاخرة والاقتصادية</p>
          </div>

          <!-- Cars Grid -->
          <div v-if="cars.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <div
              v-for="car in cars.data"
              :key="car.id"
              class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2"
            >
                              <div class="relative overflow-hidden">
                  <img
                    :src="car.images && car.images[0] ? car.images[0] : '/images/cars/car-placeholder.jpg'"
                    :alt="car.full_name"
                    class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700"
                    @error="$event.target.src = '/images/cars/car-placeholder.jpg'"
                  />
                  <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                  <div v-if="car.is_featured" class="absolute top-4 right-4">
                    <span class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                      ⭐ مميزة
                    </span>
                  </div>
                  <div class="absolute top-4 left-4">
                    <span class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                      {{ car.category.name }}
                    </span>
                  </div>
                  <div class="absolute bottom-4 left-4 right-4">
                    <div class="bg-white/95 rounded-2xl p-3 shadow-lg">
                      <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">السعر اليومي</span>
                        <span class="text-lg font-bold text-blue-600">{{ car.daily_rate }} ريال</span>
                      </div>
                    </div>
                  </div>
                </div>
                              <div class="p-8">
                  <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold text-gray-900 leading-tight">{{ car.brand_ar || 'تويوتا' }} {{ car.model_ar || 'كورولا' }}</h3>
                  </div>

                  <!-- Car Specs -->
                  <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="text-center p-3 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-100">
                      <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                        </svg>
                      </div>
                      <div class="text-xs text-gray-600">الناقل</div>
                      <div class="text-sm font-semibold text-gray-900">{{ car.transmission || 'غير محدد' }}</div>
                    </div>

                    <div class="text-center p-3 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-100">
                      <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                      </div>
                      <div class="text-xs text-gray-600">الوقود</div>
                      <div class="text-sm font-semibold text-gray-900">{{ car.fuel_type || 'غير محدد' }}</div>
                    </div>

                    <div class="text-center p-3 bg-gradient-to-br from-purple-50 to-violet-50 rounded-2xl border border-purple-100">
                      <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                      </div>
                      <div class="text-xs text-gray-600">المقاعد</div>
                      <div class="text-sm font-semibold text-gray-900">{{ car.seats || 0 }}</div>
                    </div>
                  </div>

                  <!-- Features -->
                  <div class="flex items-center gap-2 mb-8">
                    <div v-for="feature in (car.features || []).slice(0, 3)" :key="feature" class="text-xs bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 px-4 py-2 rounded-full border border-blue-200 font-medium">
                      {{ feature }}
                    </div>
                  </div>

                  <!-- Action Button -->
                  <div class="flex items-center justify-center">
                    <Link
                      :href="`/cars/${car.id}`"
                      class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-2xl font-bold hover:from-blue-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl text-center group"
                    >
                      <span class="flex items-center justify-center gap-2">
                        عرض التفاصيل
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                      </span>
                    </Link>
                  </div>
                </div>
            </div>
          </div>

          <!-- No Results -->
          <div v-else class="text-center py-20">
            <div class="bg-white rounded-2xl p-12 shadow-lg max-w-md mx-auto">
              <div class="text-gray-400 mb-6">
                <Car class="w-20 h-20 mx-auto" />
              </div>
              <h3 class="text-2xl font-bold text-gray-900 mb-4">لا توجد سيارات</h3>
              <p class="text-gray-600">عذراً، لا توجد سيارات متاحة حالياً</p>
            </div>
          </div>

          <!-- Pagination -->
          <div v-if="cars.data.length > 0" class="mt-16">
            <nav class="flex items-center justify-center">
              <div class="flex items-center gap-3">
                <Link
                  v-for="link in cars.links"
                  :key="link.label"
                  :href="link.url || '#'"
                  :class="[
                    'px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-300',
                    link.active
                      ? 'bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-lg'
                      : link.url
                      ? 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-300'
                      : 'bg-gray-100 text-gray-400 cursor-not-allowed'
                  ]"
                  v-html="link.label"
                />
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { Car } from 'lucide-vue-next'
import Header from '../../components/Header.vue'

const props = defineProps({
  cars: Object,
})
</script>
