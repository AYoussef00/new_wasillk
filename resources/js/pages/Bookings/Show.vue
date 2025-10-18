<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center">
          <h1 class="text-3xl font-bold text-gray-900 mb-4">تفاصيل الحجز</h1>
          <p class="text-lg text-gray-600">رقم الحجز: #{{ booking.id }}</p>
        </div>
      </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Car Details -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">تفاصيل السيارة</h2>
            <div class="space-y-4">
              <img
                :src="booking.car.images[0] || '/images/car-placeholder.jpg'"
                :alt="booking.car.full_name"
                class="w-full h-48 object-cover rounded-lg"
              />
              <div>
                <h3 class="text-lg font-semibold text-gray-900">{{ booking.car.full_name }}</h3>
                <p class="text-gray-600">{{ booking.car.category.name }}</p>
              </div>
              <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="flex items-center gap-2">
                  <Icon name="users" class="w-4 h-4 text-gray-400" />
                  <span>{{ booking.car.seats }} مقاعد</span>
                </div>
                <div class="flex items-center gap-2">
                  <Icon name="settings" class="w-4 h-4 text-gray-400" />
                  <span>{{ booking.car.transmission }}</span>
                </div>
                <div class="flex items-center gap-2">
                  <Icon name="droplets" class="w-4 h-4 text-gray-400" />
                  <span>{{ booking.car.fuel_type }}</span>
                </div>
                <div class="flex items-center gap-2">
                  <Icon name="map-pin" class="w-4 h-4 text-gray-400" />
                  <span>{{ booking.car.license_plate }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Booking Details -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">تفاصيل الحجز</h2>

            <!-- Status -->
            <div class="mb-6">
              <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">حالة الحجز</span>
                <span
                  :class="[
                    'px-3 py-1 rounded-full text-sm font-medium',
                    getStatusClass(booking.status)
                  ]"
                >
                  {{ booking.status_text }}
                </span>
              </div>
            </div>

            <!-- Dates -->
            <div class="space-y-4 mb-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <div class="text-sm text-gray-600 mb-1">تاريخ الاستلام</div>
                  <div class="font-medium">{{ formatDate(booking.pickup_date) }}</div>
                  <div class="text-gray-500">{{ booking.pickup_time }}</div>
                </div>
                <div>
                  <div class="text-sm text-gray-600 mb-1">تاريخ الإرجاع</div>
                  <div class="font-medium">{{ formatDate(booking.return_date) }}</div>
                  <div class="text-gray-500">{{ booking.return_time }}</div>
                </div>
              </div>
            </div>

            <!-- Locations -->
            <div class="space-y-4 mb-6">
              <div>
                <div class="text-sm text-gray-600 mb-1">مكان الاستلام</div>
                <div class="font-medium">{{ booking.pickup_location }}</div>
              </div>
              <div>
                <div class="text-sm text-gray-600 mb-1">مكان الإرجاع</div>
                <div class="font-medium">{{ booking.return_location }}</div>
              </div>
            </div>

            <!-- Notes -->
            <div v-if="booking.notes" class="mb-6">
              <div class="text-sm text-gray-600 mb-1">ملاحظات</div>
              <div class="bg-gray-50 p-3 rounded-lg">{{ booking.notes }}</div>
            </div>

            <!-- Pricing -->
            <div class="bg-gray-50 rounded-lg p-4">
              <h3 class="font-semibold text-gray-900 mb-3">التكلفة</h3>
              <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                  <span class="text-gray-600">المدة:</span>
                  <span class="font-medium">{{ booking.duration }} يوم</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-600">السعر اليومي:</span>
                  <span class="font-medium">{{ booking.car.daily_rate }} ريال</span>
                </div>
                <div class="border-t pt-2">
                  <div class="flex justify-between font-semibold">
                    <span>المبلغ الإجمالي:</span>
                    <span class="text-blue-600">{{ booking.total_amount }} ريال</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex gap-3">
              <button
                v-if="['pending', 'confirmed'].includes(booking.status)"
                @click="cancelBooking"
                class="flex-1 bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300"
              >
                إلغاء الحجز
              </button>
              <Link
                :href="route('dashboard.bookings')"
                class="flex-1 bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition duration-300 text-center"
              >
                العودة للحجوزات
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import {
  Users,
  Settings,
  Droplets,
  MapPin
} from 'lucide-vue-next'

const props = defineProps({
  booking: Object,
})

// Local route function
const route = (name, params = {}) => {
  const baseUrl = window.location.origin

  const routes = {
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

const cancelBooking = () => {
  if (confirm('هل أنت متأكد من إلغاء هذا الحجز؟')) {
    router.patch(route('bookings.cancel', { booking: props.booking.id }))
  }
}
</script>
