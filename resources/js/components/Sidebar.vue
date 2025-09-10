<template>
  <div class="sidebar-container">
    <!-- Sidebar Toggle Button (Mobile) -->
    <button
      @click="toggleSidebar"
      class="sidebar-toggle md:hidden fixed top-4 right-4 z-50 bg-blue-600 text-white p-2 rounded-lg shadow-lg"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>

    <!-- Sidebar Overlay (Mobile) -->
    <div
      v-if="isOpen && isMobile"
      @click="closeSidebar"
      class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
    ></div>

    <!-- Sidebar -->
    <div
      :class="[
        'sidebar',
        isOpen ? 'sidebar-open' : 'sidebar-closed',
        isMobile ? 'sidebar-mobile' : 'sidebar-desktop'
      ]"
    >
      <!-- Sidebar Header -->
      <div class="sidebar-header">
        <div class="flex items-center justify-between">
          <h2 class="text-xl font-bold text-white">واصل لك</h2>
          <button
            @click="closeSidebar"
            class="sidebar-close md:hidden text-white hover:text-gray-300"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Sidebar Navigation -->
      <nav class="sidebar-nav">
        <ul class="space-y-2">
          <li>
            <Link
              href="/dashboard"
              :class="[
                'sidebar-link',
                $page.url === '/dashboard' ? 'sidebar-link-active' : ''
              ]"
              @click="closeSidebar"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
              </svg>
              <span>لوحة التحكم</span>
            </Link>
          </li>

          <li>
            <Link
              href="/dashboard/cars"
              :class="[
                'sidebar-link',
                $page.url === '/dashboard/cars' ? 'sidebar-link-active' : ''
              ]"
              @click="closeSidebar"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2"></path>
              </svg>
              <span>السيارات</span>
            </Link>
          </li>

          <li>
            <Link
              href="/dashboard/bookings"
              :class="[
                'sidebar-link',
                $page.url === '/dashboard/bookings' ? 'sidebar-link-active' : ''
              ]"
              @click="closeSidebar"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
              <span>الطلبات</span>
            </Link>
          </li>

          <li>
            <Link
              href="/dashboard/settings"
              :class="[
                'sidebar-link',
                $page.url === '/dashboard/settings' ? 'sidebar-link-active' : ''
              ]"
              @click="closeSidebar"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <span>الإعدادات</span>
            </Link>
          </li>
        </ul>
      </nav>

      <!-- Sidebar Footer -->
      <div class="sidebar-footer">
        <div class="text-center">
          <p class="text-sm text-gray-300">واصل لك لتأجير السيارات</p>
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

<style scoped>
.sidebar-container {
  position: relative;
}

.sidebar {
  @apply fixed top-0 right-0 h-full bg-gradient-to-b from-blue-600 to-blue-800 shadow-2xl transform transition-transform duration-300 ease-in-out z-50;
  width: 280px;
}

.sidebar-desktop {
  @apply translate-x-0;
}

.sidebar-mobile {
  @apply translate-x-full;
}

.sidebar-open.sidebar-mobile {
  @apply translate-x-0;
}

.sidebar-closed.sidebar-mobile {
  @apply translate-x-full;
}

.sidebar-header {
  @apply p-6 border-b border-blue-500;
}

.sidebar-nav {
  @apply flex-1 p-4;
}

.sidebar-link {
  @apply flex items-center space-x-3 px-4 py-3 text-white rounded-lg transition-all duration-200 hover:bg-blue-500 hover:shadow-md;
}

.sidebar-link-active {
  @apply bg-blue-500 shadow-md;
}

.sidebar-footer {
  @apply p-4 border-t border-blue-500;
}

.sidebar-overlay {
  @apply fixed inset-0 bg-black bg-opacity-50 z-40;
}

.sidebar-toggle {
  @apply fixed top-4 right-4 z-50 bg-blue-600 text-white p-2 rounded-lg shadow-lg hover:bg-blue-700 transition-colors;
}

.sidebar-close {
  @apply text-white hover:text-gray-300 transition-colors;
}

/* Responsive adjustments */
@media (min-width: 768px) {
  .sidebar {
    @apply translate-x-0;
  }
}
</style>
