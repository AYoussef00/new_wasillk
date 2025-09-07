<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
          <h1 class="text-4xl font-bold mb-4">السيارات المميزة</h1>
          <p class="text-xl text-blue-100">أفضل السيارات المختارة خصيصاً لك</p>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div v-if="featuredCars.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="car in featuredCars"
          :key="car.id"
          class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300"
        >
          <div class="relative">
            <img
              :src="car.images[0] || '/images/car-placeholder.jpg'"
              :alt="car.full_name"
              class="w-full h-56 object-cover"
            />
            <div class="absolute top-4 right-4">
              <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                مميزة
              </span>
            </div>
            <div class="absolute top-4 left-4">
              <span class="bg-blue-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
                {{ car.category.name }}
              </span>
            </div>
          </div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-3">
              <h3 class="text-xl font-bold text-black leading-tight">{{ car.brand_ar || 'تويوتا' }} {{ car.model_ar || 'كورولا' }}</h3>
            </div>
            <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
              <span>{{ car.transmission }}</span>
              <span>{{ car.fuel_type }}</span>
              <span>{{ car.seats }} مقاعد</span>
            </div>
            <div class="flex items-center gap-2 mb-4">
              <div v-for="feature in car.features.slice(0, 3)" :key="feature" class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">
                {{ feature }}
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="text-2xl font-bold text-blue-600">
                {{ car.daily_rate }} ريال
                <span class="text-sm text-gray-500">/ يوم</span>
              </div>
              <Link
                :href="route('cars.show', car.id)"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300"
              >
                التفاصيل
              </Link>
            </div>
          </div>
        </div>
      </div>

      <!-- No Featured Cars -->
      <div v-else class="text-center py-12">
        <div class="text-gray-400 mb-4">
          <Icon name="star" class="w-16 h-16 mx-auto" />
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">لا توجد سيارات مميزة حالياً</h3>
        <p class="text-gray-600 mb-6">يمكنك استعراض جميع السيارات المتاحة</p>
        <Link
          :href="route('cars.index')"
          class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300"
        >
          استعرض جميع السيارات
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { Star } from 'lucide-vue-next'

defineProps({
  featuredCars: Array,
})

// Local route function
const route = (name, params = {}) => {
  const baseUrl = window.location.origin

  const routes = {
    'cars.index': '/cars',
    'cars.show': (params) => `/cars/${params.id || params.car}`,
  }

  const route = routes[name]

  if (typeof route === 'function') {
    return baseUrl + route(params)
  }

  if (typeof route === 'string') {
    return baseUrl + route
  }

  return baseUrl + '/' + name.replace('.', '/')
}
</script>
