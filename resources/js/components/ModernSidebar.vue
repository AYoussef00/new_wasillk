<template>
  <div>
    <!-- Mobile Menu Button -->
    <button
      @click="toggleSidebar"
      class="md:hidden fixed top-4 right-4 z-50 bg-gradient-to-r from-blue-600 to-purple-600 text-white p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>

    <!-- Overlay for Mobile -->
    <div
      v-if="isOpen && isMobile"
      @click="closeSidebar"
      class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
    ></div>

    <!-- Sidebar -->
    <div
      :class="[
        'fixed top-0 right-0 h-full w-80 bg-white shadow-2xl transform transition-all duration-300 ease-in-out z-50',
        isOpen ? 'translate-x-0' : 'translate-x-full md:translate-x-0'
      ]"
    >
      <!-- Sidebar Header -->
      <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 text-white">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2"></path>
              </svg>
            </div>
            <div>
              <h2 class="text-xl font-bold">واصل لك</h2>
              <p class="text-sm opacity-90">لوحة التحكم</p>
            </div>
          </div>
          <button
            @click="closeSidebar"
            class="md:hidden text-white hover:text-gray-300 transition-colors"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Navigation Menu -->
      <nav class="p-4 space-y-2">
        <!-- Dashboard -->
        <Link
          href="/dashboard"
          :class="[
            'flex items-center space-x-4 p-4 rounded-xl transition-all duration-200 group',
            $page.url === '/dashboard'
              ? 'bg-gradient-to-r from-blue-50 to-purple-50 border-r-4 border-blue-500 text-blue-600'
              : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600'
          ]"
          @click="closeSidebar"
        >
          <div :class="[
            'w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200',
            $page.url === '/dashboard'
              ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white'
              : 'bg-gray-100 text-gray-600 group-hover:bg-gradient-to-r group-hover:from-blue-500 group-hover:to-purple-500 group-hover:text-white'
          ]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
            </svg>
          </div>
          <div>
            <p class="font-semibold">لوحة التحكم</p>
            <p class="text-sm opacity-70">نظرة عامة</p>
          </div>
        </Link>

        <!-- Cars -->
        <Link
          href="/dashboard/cars"
          :class="[
            'flex items-center space-x-4 p-4 rounded-xl transition-all duration-200 group',
            $page.url === '/dashboard/cars'
              ? 'bg-gradient-to-r from-blue-50 to-purple-50 border-r-4 border-blue-500 text-blue-600'
              : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600'
          ]"
          @click="closeSidebar"
        >
          <div :class="[
            'w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200',
            $page.url === '/dashboard/cars'
              ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white'
              : 'bg-gray-100 text-gray-600 group-hover:bg-gradient-to-r group-hover:from-blue-500 group-hover:to-purple-500 group-hover:text-white'
          ]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2"></path>
            </svg>
          </div>
          <div>
            <p class="font-semibold">السيارات</p>
            <p class="text-sm opacity-70">إدارة الأسطول</p>
          </div>
        </Link>

        <!-- Bookings -->
        <Link
          href="/dashboard/bookings"
          :class="[
            'flex items-center space-x-4 p-4 rounded-xl transition-all duration-200 group',
            $page.url === '/dashboard/bookings'
              ? 'bg-gradient-to-r from-blue-50 to-purple-50 border-r-4 border-blue-500 text-blue-600'
              : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600'
          ]"
          @click="closeSidebar"
        >
          <div :class="[
            'w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200',
            $page.url === '/dashboard/bookings'
              ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white'
              : 'bg-gray-100 text-gray-600 group-hover:bg-gradient-to-r group-hover:from-blue-500 group-hover:to-purple-500 group-hover:text-white'
          ]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
          </div>
          <div>
            <p class="font-semibold">الطلبات</p>
            <p class="text-sm opacity-70">إدارة الحجوزات</p>
          </div>
        </Link>

        <!-- Settings -->
        <Link
          href="/dashboard/settings"
          :class="[
            'flex items-center space-x-4 p-4 rounded-xl transition-all duration-200 group',
            $page.url === '/dashboard/settings'
              ? 'bg-gradient-to-r from-blue-50 to-purple-50 border-r-4 border-blue-500 text-blue-600'
              : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600'
          ]"
          @click="closeSidebar"
        >
          <div :class="[
            'w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200',
            $page.url === '/dashboard/settings'
              ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white'
              : 'bg-gray-100 text-gray-600 group-hover:bg-gradient-to-r group-hover:from-blue-500 group-hover:to-purple-500 group-hover:text-white'
          ]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
          </div>
          <div>
            <p class="font-semibold">الإعدادات</p>
            <p class="text-sm opacity-70">إعدادات النظام</p>
          </div>
        </Link>
      </nav>

      <!-- Sidebar Footer -->
      <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200">
        <div class="text-center">
          <p class="text-sm font-medium text-gray-600">واصل لك لتأجير السيارات</p>
          <p class="text-xs text-gray-400 mt-1">© 2025 جميع الحقوق محفوظة</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const isOpen = ref(false)
const isMobile = ref(false)
const $page = usePage()

const toggleSidebar = () => {
  isOpen.value = !isOpen.value
}

const closeSidebar = () => {
  isOpen.value = false
}

const checkScreenSize = () => {
  isMobile.value = window.innerWidth < 768
  if (!isMobile.value) {
    isOpen.value = true
  }
}

onMounted(() => {
  checkScreenSize()
  window.addEventListener('resize', checkScreenSize)
})

onUnmounted(() => {
  window.removeEventListener('resize', checkScreenSize)
})
</script>
