<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center">
          <h1 class="text-3xl font-bold text-gray-900 mb-4">حجوزاتي</h1>
          <p class="text-lg text-gray-600">استعرض جميع حجوزاتك</p>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div v-if="bookings.data.length > 0" class="space-y-6">
        <div
          v-for="booking in bookings.data"
          :key="booking.id"
          class="bg-white rounded-lg shadow-sm overflow-hidden"
        >
          <div class="p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
              <!-- Car Info -->
              <div class="flex items-start space-x-4 mb-4 lg:mb-0">
                <img
                  :src="booking.car.images[0] || '/images/car-placeholder.jpg'"
                  :alt="booking.car.full_name"
                  class="w-20 h-16 object-cover rounded-lg"
                />
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">{{ booking.car.full_name }}</h3>
                  <p class="text-gray-600">{{ booking.car.category.name }}</p>
                  <p class="text-sm text-gray-500">{{ booking.car.license_plate }}</p>
                </div>
              </div>

              <!-- Booking Details -->
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                  <div class="text-gray-600 mb-1">تاريخ الاستلام</div>
                  <div class="font-medium">{{ formatDate(booking.pickup_date) }}</div>
                  <div class="text-gray-500">{{ booking.pickup_time }}</div>
                </div>
                <div>
                  <div class="text-gray-600 mb-1">تاريخ الإرجاع</div>
                  <div class="font-medium">{{ formatDate(booking.return_date) }}</div>
                  <div class="text-gray-500">{{ booking.return_time }}</div>
                </div>
                <div>
                  <div class="text-gray-600 mb-1">المبلغ الإجمالي</div>
                  <div class="text-lg font-bold text-blue-600">{{ booking.total_amount }} ريال</div>
                  <div class="text-gray-500">{{ booking.duration }} يوم</div>
                </div>
              </div>
            </div>

            <!-- Status & Actions -->
            <div class="mt-6 pt-6 border-t border-gray-200">
              <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4 mb-4 sm:mb-0">
                  <span
                    :class="[
                      'px-3 py-1 rounded-full text-sm font-medium',
                      getStatusClass(booking.status)
                    ]"
                  >
                    {{ booking.status_text }}
                  </span>
                  <div class="text-sm text-gray-600">
                    <div>مكان الاستلام: {{ booking.pickup_location }}</div>
                    <div>مكان الإرجاع: {{ booking.return_location }}</div>
                  </div>
                </div>
                <div class="flex items-center gap-2">
                  <Link
                    :href="route('bookings.show', booking.id)"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300"
                  >
                    التفاصيل
                  </Link>
                  <button
                    v-if="['pending', 'confirmed'].includes(booking.status)"
                    @click="cancelBooking(booking.id)"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300"
                  >
                    إلغاء الحجز
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
          <nav class="flex items-center justify-center">
            <div class="flex items-center gap-2">
              <Link
                v-for="link in bookings.links"
                :key="link.label"
                :href="link.url"
                :class="[
                  'px-3 py-2 rounded-lg text-sm font-medium',
                  link.active
                    ? 'bg-blue-600 text-white'
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

      <!-- No Bookings -->
      <div v-else class="text-center py-12">
        <div class="text-gray-400 mb-4">
          <Icon name="calendar" class="w-16 h-16 mx-auto" />
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">لا توجد حجوزات</h3>
        <p class="text-gray-600 mb-6">ابدأ بحجز سيارة من مجموعتنا الواسعة</p>
        <Link
          :href="route('cars.index')"
          class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300"
        >
          استعرض السيارات
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import { Calendar } from 'lucide-vue-next'

const props = defineProps({
  bookings: Object,
})

// Local route function
const route = (name, params = {}) => {
  const baseUrl = window.location.origin

  const routes = {
    'bookings.show': (params) => `/bookings/${params.booking}`,
    'bookings.cancel': (params) => `/bookings/${params.booking}/cancel`,
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

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('ar-SA')
}

const getStatusClass = (status) => {
  const classes = {
    pending: 'bg-yellow-100 text-yellow-800',
    confirmed: 'bg-blue-100 text-blue-800',
    active: 'bg-green-100 text-green-800',
    completed: 'bg-gray-100 text-gray-800',
    cancelled: 'bg-red-100 text-red-800',
  }
  return classes[status] || 'bg-gray-100 text-gray-800'
}

const cancelBooking = (bookingId) => {
  if (confirm('هل أنت متأكد من إلغاء هذا الحجز؟')) {
    router.patch(route('bookings.cancel', { booking: bookingId }))
  }
}
</script>
