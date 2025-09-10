<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Modern Sidebar -->
    <ModernSidebar />
    
    <!-- Main Content Area -->
    <div class="main-content">
      <!-- Top Navigation Bar -->
      <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <!-- Left side - Logo and Title -->
            <div class="flex items-center">
              <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2"></path>
                  </svg>
                </div>
                <h1 class="text-xl font-bold text-gray-900">واصل لك</h1>
              </div>
            </div>

            <!-- Right side - User Menu -->
            <div class="flex items-center space-x-4">
              <!-- User Info -->
              <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                  <span class="text-white text-sm font-medium">
                    {{ $page.props.auth.user.name.charAt(0) }}
                  </span>
                </div>
                <div class="hidden md:block">
                  <p class="text-sm font-medium text-gray-900">{{ $page.props.auth.user.name }}</p>
                  <p class="text-xs text-gray-500">{{ $page.props.auth.user.email }}</p>
                </div>
              </div>

              <!-- Logout Button -->
              <button
                @click="logout"
                class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>تسجيل الخروج</span>
              </button>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Header -->
      <header v-if="$slots.header" class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Main Content -->
      <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import ModernSidebar from '@/components/ModernSidebar.vue'

const $page = usePage()

const logout = () => {
  useForm().post('/logout')
}
</script>

<style scoped>
.main-content {
  margin-right: 320px;
  transition: margin-right 0.3s ease-in-out;
}

@media (max-width: 767px) {
  .main-content {
    margin-right: 0;
  }
}
</style>