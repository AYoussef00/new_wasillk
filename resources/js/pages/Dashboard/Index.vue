<template>
  <Head title="لوحة التحكم" />

  <AppLayout>
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-6">
      <!-- Welcome Section -->
      <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl p-6 text-white">
        <h1 class="text-2xl font-bold mb-2">مرحباً بك في لوحة التحكم</h1>
        <p class="text-blue-100">إدارة شاملة لنظام حجز السيارات</p>
      </div>
      <!-- Stats Cards -->
      <div class="grid auto-rows-min gap-6 md:grid-cols-3">
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md transition-shadow">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400">إجمالي السيارات</p>
              <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ stats.total_cars }}</p>
            </div>
            <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-3">
              <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md transition-shadow">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400">الحجوزات النشطة</p>
              <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ stats.confirmed_bookings }}</p>
            </div>
            <div class="bg-green-100 dark:bg-green-900 rounded-full p-3">
              <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md transition-shadow">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400">في الانتظار</p>
              <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ stats.pending_bookings }}</p>
            </div>
            <div class="bg-purple-100 dark:bg-purple-900 rounded-full p-3">
              <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content Area -->
      <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">نظرة عامة</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">أحدث الحجوزات</h3>
            <div class="space-y-3">
              <div v-if="recent_bookings.length === 0" class="text-center py-8">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <p class="text-gray-500">لا توجد حجوزات حديثة</p>
              </div>
              <div v-else>
                <div v-for="booking in recent_bookings" :key="booking.id" class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                  <div class="flex items-center gap-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <span class="text-sm text-gray-900 dark:text-white">{{ booking.customer_name }} - {{ booking.car_name }}</span>
                  </div>
                  <span class="text-xs text-gray-500 dark:text-gray-400">{{ booking.created_at }}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">السيارات المتاحة</h3>
            <div class="space-y-3">
              <div v-if="available_cars.length === 0" class="text-center py-8">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <p class="text-gray-500">لا توجد سيارات متاحة</p>
              </div>
              <div v-else>
                <div v-for="car in available_cars" :key="car.id" class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                  <span class="text-sm text-gray-900 dark:text-white">{{ car.name }}</span>
                  <span class="text-xs text-green-600 dark:text-green-400">متاحة</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
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
