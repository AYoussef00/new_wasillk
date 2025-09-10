<template>
  <header class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo - على اليسار -->
        <div class="flex items-center">
          <img
            src="/images/logo/company-logo.png"
            alt="واصل لك لتأجير السيارات"
            class="h-24 w-auto object-contain"
          />
        </div>

        <!-- Navigation Menu - على اليمين -->
        <nav class="hidden md:flex space-x-8 space-x-reverse">
          <Link
            href="/"
            class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-bold transition duration-300"
            :class="{ 'text-blue-600': $page.url === '/' }"
          >
            الصفحة الرئيسية
          </Link>



          <Link
            href="/about"
            class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-bold transition duration-300"
            :class="{ 'text-blue-600': $page.url === '/about' }"
          >
            نبذة عنا
          </Link>

          <Link
            href="/contact"
            class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-bold transition duration-300"
            :class="{ 'text-blue-600': $page.url === '/contact' }"
          >
            اتصل بنا
          </Link>

          <Link
            href="/location"
            class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-bold transition duration-300"
            :class="{ 'text-blue-600': $page.url === '/location' }"
          >
            موقعنا
          </Link>


        </nav>

        <!-- Mobile menu button -->
        <div class="md:hidden">
          <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="text-gray-700 hover:text-blue-600 focus:outline-none focus:text-blue-600"
          >
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path
                v-if="!mobileMenuOpen"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
              <path
                v-else
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile menu -->
      <div v-if="mobileMenuOpen" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
          <Link
            href="/"
            class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-bold transition duration-300"
            :class="{ 'text-blue-600': $page.url === '/' }"
            @click="mobileMenuOpen = false"
          >
            الصفحة الرئيسية
          </Link>



          <Link
            href="/about"
            class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-bold transition duration-300"
            :class="{ 'text-blue-600': $page.url === '/about' }"
            @click="mobileMenuOpen = false"
          >
            نبذة عنا
          </Link>

          <Link
            href="/contact"
            class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-bold transition duration-300"
            :class="{ 'text-blue-600': $page.url === '/contact' }"
            @click="mobileMenuOpen = false"
          >
            اتصل بنا
          </Link>

          <Link
            href="/location"
            class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-bold transition duration-300"
            :class="{ 'text-blue-600': $page.url === '/location' }"
            @click="mobileMenuOpen = false"
          >
            موقعنا
          </Link>


        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const mobileMenuOpen = ref(false)
const $page = usePage()
</script>
