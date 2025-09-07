<template>
  <Head title="لوحة التحكم" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        لوحة التحكم
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <div class="flex items-center">
                <div class="bg-blue-100 rounded-full p-3 mr-4">
                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                  </svg>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-600">إجمالي السيارات</p>
                  <p class="text-2xl font-bold text-gray-900">{{ stats.total_cars }}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <div class="flex items-center">
                <div class="bg-green-100 rounded-full p-3 mr-4">
                  <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-600">السيارات المتاحة</p>
                  <p class="text-2xl font-bold text-gray-900">{{ stats.available_cars }}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <div class="flex items-center">
                <div class="bg-purple-100 rounded-full p-3 mr-4">
                  <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                  </svg>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-600">إجمالي الحجوزات</p>
                  <p class="text-2xl font-bold text-gray-900">{{ stats.total_bookings }}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <div class="flex items-center">
                <div class="bg-orange-100 rounded-full p-3 mr-4">
                  <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-600">في الانتظار</p>
                  <p class="text-2xl font-bold text-gray-900">{{ stats.pending_bookings }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Recent Bookings -->
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
              <h3 class="text-lg font-semibold text-gray-900">أحدث الحجوزات</h3>
            </div>
            <div class="p-6">
              <div v-if="recent_bookings.length === 0" class="text-center py-8">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <p class="text-gray-500">لا توجد حجوزات حديثة</p>
              </div>
              <div v-else class="space-y-4">
                <div v-for="booking in recent_bookings" :key="booking.id" class="border border-gray-200 rounded-lg p-4">
                  <div class="flex justify-between items-start mb-2">
                    <h4 class="font-semibold text-gray-900">{{ booking.customer_name }}</h4>
                    <span class="text-sm text-gray-500">{{ booking.created_at }}</span>
                  </div>
                  <p class="text-gray-600 mb-2">{{ booking.car_name }}</p>
                  <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                      {{ booking.pickup_date }} - {{ booking.return_date }}
                    </div>
                    <div class="flex items-center space-x-2 space-x-reverse">
                      <span class="text-lg font-bold text-blue-600">{{ booking.total_amount }} ريال</span>
                      <span class="px-2 py-1 text-xs rounded-full" :class="getStatusClass(booking.status)">
                        {{ booking.status }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Available Cars -->
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
              <h3 class="text-lg font-semibold text-gray-900">السيارات المتاحة</h3>
            </div>
            <div class="p-6">
              <div v-if="available_cars.length === 0" class="text-center py-8">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <p class="text-gray-500">لا توجد سيارات متاحة</p>
              </div>
              <div v-else class="space-y-4">
                <div v-for="car in available_cars" :key="car.id" class="border border-gray-200 rounded-lg p-4">
                  <div class="flex justify-between items-start mb-2">
                    <h4 class="font-semibold text-gray-900">{{ car.name }}</h4>
                    <span v-if="car.is_featured" class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">مميزة</span>
                  </div>
                  <p class="text-gray-600 mb-2">{{ car.category }}</p>
                  <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                      {{ car.license_plate }}
                    </div>
                    <div class="text-lg font-bold text-green-600">
                      {{ car.daily_rate }} ريال/يوم
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Monthly Statistics -->
        <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">إحصائيات الحجوزات الشهرية</h3>
          </div>
          <div class="p-6">
            <div v-if="monthly_bookings.length === 0" class="text-center py-8">
              <p class="text-gray-500">لا توجد إحصائيات متاحة</p>
            </div>
            <div v-else class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
              <div v-for="(stat, index) in monthly_bookings" :key="index" class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600 mb-1">{{ stat.month }}</p>
                <p class="text-2xl font-bold text-blue-600">{{ stat.count }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue'

const props = defineProps({
  stats: Object,
  recent_bookings: Array,
  available_cars: Array,
  monthly_bookings: Array,
})

const getStatusClass = (status) => {
  switch (status) {
    case 'مؤكد':
      return 'bg-green-100 text-green-800'
    case 'في الانتظار':
      return 'bg-yellow-100 text-yellow-800'
    case 'ملغي':
      return 'bg-red-100 text-red-800'
    case 'مكتمل':
      return 'bg-blue-100 text-blue-800'
    default:
      return 'bg-gray-100 text-gray-800'
  }
}
</script>
