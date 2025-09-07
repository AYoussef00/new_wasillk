<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
    <!-- Header -->
    <Header />



    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
        <!-- Car Details -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-3xl shadow-2xl p-10 sticky top-8 border border-gray-100">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">تفاصيل السيارة</h2>
            <div class="space-y-8">
              <div class="relative overflow-hidden rounded-2xl">
                <img
                  :src="car.images[0] || '/images/car-placeholder.jpg'"
                  :alt="(car.brand_ar || 'تويوتا') + ' ' + (car.model_ar || 'كورولا')"
                  class="w-full h-64 object-cover rounded-2xl shadow-lg"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
              </div>
              <div class="text-center">
                <h3 class="text-2xl font-bold text-black mb-3">{{ car.brand_ar || 'تويوتا' }} {{ car.model_ar || 'كورولا' }}</h3>
                <p class="text-gray-600 text-lg">{{ car.category.name }}</p>
              </div>
              <div class="grid grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-4 text-center">
                  <Users class="w-8 h-8 text-blue-600 mx-auto mb-2" />
                  <div class="text-sm text-gray-600">المقاعد</div>
                  <div class="text-xl font-bold text-blue-600">{{ car.seats }}</div>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-4 text-center">
                  <Settings class="w-8 h-8 text-green-600 mx-auto mb-2" />
                  <div class="text-sm text-gray-600">الناقل</div>
                  <div class="text-lg font-bold text-green-600">{{ car.transmission }}</div>
                </div>
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-4 text-center">
                  <Droplets class="w-8 h-8 text-orange-600 mx-auto mb-2" />
                  <div class="text-sm text-gray-600">الوقود</div>
                  <div class="text-lg font-bold text-orange-600">{{ car.fuel_type }}</div>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-4 text-center">
                  <MapPin class="w-8 h-8 text-purple-600 mx-auto mb-2" />
                  <div class="text-sm text-gray-600">الرقم</div>
                  <div class="text-lg font-bold text-purple-600">{{ car.license_plate }}</div>
                </div>
              </div>
              <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white text-center">
                <div class="text-3xl font-bold mb-1">{{ car.daily_rate }}</div>
                <div class="text-blue-100">ريال / يوم</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Booking Form -->
        <div class="lg:col-span-2">
          <form @submit.prevent="submit" class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
            <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">تفاصيل الحجز</h2>

            <!-- Personal Information -->
            <div class="mb-10">
              <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <div class="bg-blue-100 rounded-full p-3 mr-4">
                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                </div>
                المعلومات الشخصية
              </h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                  <label class="block text-lg font-semibold text-gray-700 mb-3">اسم العميل *</label>
                  <input
                    v-model="form.customer_name"
                    type="text"
                    placeholder="أدخل الاسم الكامل"
                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 text-lg transition-all duration-300"
                    :class="{ 'border-red-500 focus:ring-red-500/20': errors.customer_name }"
                    required
                  />
                  <p v-if="errors.customer_name" class="text-red-500 text-sm mt-2">{{ errors.customer_name }}</p>
                </div>
                <div>
                  <label class="block text-lg font-semibold text-gray-700 mb-3">رقم الهاتف *</label>
                  <input
                    v-model="form.customer_phone"
                    type="tel"
                    placeholder="+966 50 123 4567"
                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 text-lg transition-all duration-300"
                    :class="{ 'border-red-500 focus:ring-red-500/20': errors.customer_phone }"
                    required
                  />
                  <p v-if="errors.customer_phone" class="text-red-500 text-sm mt-2">{{ errors.customer_phone }}</p>
                </div>
              </div>
              <div class="mt-8">
                <label class="block text-lg font-semibold text-gray-700 mb-3">العنوان *</label>
                <input
                  v-model="form.customer_address"
                  type="text"
                  placeholder="أدخل العنوان الكامل"
                  class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 text-lg transition-all duration-300"
                  :class="{ 'border-red-500 focus:ring-red-500/20': errors.customer_address }"
                  required
                />
                <p v-if="errors.customer_address" class="text-red-500 text-sm mt-2">{{ errors.customer_address }}</p>
              </div>
            </div>

            <!-- Rental Period -->
            <div class="mb-10">
              <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <div class="bg-green-100 rounded-full p-3 mr-4">
                  <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                </div>
                فترة التأجير
              </h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                  <label class="block text-lg font-semibold text-gray-700 mb-3">تاريخ الاستلام *</label>
                  <input
                    v-model="form.pickup_date"
                    type="date"
                    :min="minDate"
                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 text-lg transition-all duration-300"
                    :class="{ 'border-red-500 focus:ring-red-500/20': errors.pickup_date }"
                    required
                  />
                  <p v-if="errors.pickup_date" class="text-red-500 text-sm mt-2">{{ errors.pickup_date }}</p>
                </div>
                <div>
                  <label class="block text-lg font-semibold text-gray-700 mb-3">تاريخ التسليم *</label>
                  <input
                    v-model="form.return_date"
                    type="date"
                    :min="form.pickup_date || minDate"
                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 text-lg transition-all duration-300"
                    :class="{ 'border-red-500 focus:ring-red-500/20': errors.return_date }"
                    required
                  />
                  <p v-if="errors.return_date" class="text-red-500 text-sm mt-2">{{ errors.return_date }}</p>
                </div>
              </div>
            </div>

            <!-- Document Upload -->
            <div class="mb-10">
              <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <div class="bg-purple-100 rounded-full p-3 mr-4">
                  <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                  </svg>
                </div>
                المستندات المطلوبة
              </h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                  <label class="block text-lg font-semibold text-gray-700 mb-3">صورة الهوية *</label>
                  <div class="relative">
                    <input
                      @change="handleIdUpload"
                      type="file"
                      accept="image/*"
                      class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 text-lg transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                      :class="{ 'border-red-500 focus:ring-red-500/20': errors.id_image }"
                      required
                    />
                  </div>
                  <p v-if="errors.id_image" class="text-red-500 text-sm mt-2">{{ errors.id_image }}</p>
                  <p class="text-sm text-gray-500 mt-2">صورة واضحة للهوية الوطنية أو الإقامة</p>
                </div>
                <div>
                  <label class="block text-lg font-semibold text-gray-700 mb-3">صورة الرخصة *</label>
                  <div class="relative">
                    <input
                      @change="handleLicenseUpload"
                      type="file"
                      accept="image/*"
                      class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 text-lg transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                      :class="{ 'border-red-500 focus:ring-red-500/20': errors.license_image }"
                      required
                    />
                  </div>
                  <p v-if="errors.license_image" class="text-red-500 text-sm mt-2">{{ errors.license_image }}</p>
                  <p class="text-sm text-gray-500 mt-2">صورة واضحة لرخصة القيادة</p>
                </div>
              </div>
            </div>

            <!-- Notes -->
            <div class="mb-10">
              <label class="block text-lg font-semibold text-gray-700 mb-3">ملاحظات (اختياري)</label>
              <textarea
                v-model="form.notes"
                rows="5"
                placeholder="أضف أي ملاحظات أو متطلبات خاصة"
                class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 text-lg transition-all duration-300 resize-none"
                :class="{ 'border-red-500 focus:ring-red-500/20': errors.notes }"
              ></textarea>
              <p v-if="errors.notes" class="text-red-500 text-sm mt-2">{{ errors.notes }}</p>
            </div>

            <!-- Booking Summary -->
            <div class="bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 rounded-3xl p-8 mb-10 border-2 border-blue-100">
              <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">ملخص الحجز</h3>
              <div class="space-y-4 text-lg">
                <div class="flex justify-between items-center py-3 border-b border-blue-200">
                  <span class="text-gray-600">المدة:</span>
                  <span class="font-bold text-gray-900">{{ duration }} يوم</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-blue-200">
                  <span class="text-gray-600">السعر اليومي:</span>
                  <span class="font-bold text-gray-900">{{ car.daily_rate }} ريال</span>
                </div>
                <div class="pt-4">
                  <div class="flex justify-between items-center">
                    <span class="text-2xl font-bold text-gray-900">المبلغ الإجمالي:</span>
                    <span class="text-3xl font-bold text-blue-600">{{ totalAmount }} ريال</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <button
              type="submit"
              :disabled="processing"
              class="w-full bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 text-white py-6 px-8 rounded-2xl font-bold text-xl hover:from-blue-700 hover:via-blue-800 hover:to-indigo-800 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 shadow-2xl hover:shadow-3xl"
            >
              <span v-if="processing" class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                جاري الحجز...
              </span>
              <span v-else class="flex items-center justify-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                تأكيد الحجز
              </span>
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Booking Confirmation Modal -->
    <div v-if="showConfirmationModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <!-- Background overlay -->
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="closeConfirmationModal"></div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-3xl text-right overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
          <div class="bg-white px-8 pt-8 pb-6">
            <!-- Success Icon -->
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-8">
              <svg class="h-16 w-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>

            <!-- Title -->
            <div class="text-center mb-8">
              <h3 class="text-4xl font-bold text-gray-900 mb-4" id="modal-title">
                تم تأكيد الحجز بنجاح! 🎉
              </h3>
              <p class="text-xl text-gray-600">سيتم التواصل معك قريباً لتأكيد التفاصيل</p>
            </div>

            <!-- Booking Details -->
            <div class="bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 rounded-3xl p-8 mb-8 border-2 border-blue-100">
              <h4 class="text-2xl font-bold text-gray-900 mb-6 text-center">تفاصيل الحجز</h4>

              <!-- Car Info -->
              <div class="flex items-center mb-6 p-4 bg-white rounded-2xl shadow-sm">
                <img
                  :src="car.images[0] || '/images/car-placeholder.jpg'"
                  :alt="(car.brand_ar || 'تويوتا') + ' ' + (car.model_ar || 'كورولا')"
                  class="w-20 h-20 object-cover rounded-xl mr-4"
                />
                <div>
                  <h5 class="text-xl font-bold text-gray-900">{{ car.brand_ar || 'تويوتا' }} {{ car.model_ar || 'كورولا' }}</h5>
                  <p class="text-gray-600">{{ car.category.name }}</p>
                  <p class="text-blue-600 font-semibold">{{ car.license_plate }}</p>
                </div>
              </div>

              <!-- Customer Info -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-2xl p-4 shadow-sm">
                  <h6 class="font-semibold text-gray-900 mb-2">معلومات العميل</h6>
                  <p class="text-gray-600"><span class="font-medium">الاسم:</span> {{ form.customer_name }}</p>
                  <p class="text-gray-600"><span class="font-medium">الهاتف:</span> {{ form.customer_phone }}</p>
                  <p class="text-gray-600"><span class="font-medium">العنوان:</span> {{ form.customer_address }}</p>
                </div>
                <div class="bg-white rounded-2xl p-4 shadow-sm">
                  <h6 class="font-semibold text-gray-900 mb-2">تفاصيل التأجير</h6>
                  <p class="text-gray-600"><span class="font-medium">تاريخ الاستلام:</span> {{ formatDate(form.pickup_date) }}</p>
                  <p class="text-gray-600"><span class="font-medium">تاريخ التسليم:</span> {{ formatDate(form.return_date) }}</p>
                  <p class="text-gray-600"><span class="font-medium">المدة:</span> {{ duration }} يوم</p>
                </div>
              </div>

              <!-- Total Amount -->
              <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white text-center">
                <div class="text-2xl font-bold mb-2">المبلغ الإجمالي</div>
                <div class="text-4xl font-bold">{{ totalAmount }} ريال</div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
              <button
                @click="closeConfirmationModal"
                class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg"
              >
                <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                العودة للصفحة الرئيسية
              </button>
              <a
                href="/cars"
                class="w-full sm:w-auto bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 shadow-lg text-center"
              >
                <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                تصفح المزيد من السيارات
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'
import Header from '../../components/Header.vue'
import {
  Users,
  Settings,
  Droplets,
  MapPin
} from 'lucide-vue-next'

const props = defineProps({
  car: Object,
  errors: Object,
})

const minDate = new Date().toISOString().split('T')[0]
const showConfirmationModal = ref(false)

const form = useForm({
  customer_name: '',
  customer_phone: '',
  customer_address: '',
  pickup_date: '',
  return_date: '',
  id_image: null,
  license_image: null,
  notes: '',
})

const processing = computed(() => form.processing)

const duration = computed(() => {
  if (!form.pickup_date || !form.return_date) return 0
  const start = new Date(form.pickup_date)
  const end = new Date(form.return_date)
  const diffTime = Math.abs(end - start)
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24))
  return diffDays + 1
})

const totalAmount = computed(() => {
  return (duration.value * props.car.daily_rate).toFixed(2)
})

const formatDate = (dateString) => {
  if (!dateString) return ''
  const date = new Date(dateString)
  return date.toLocaleDateString('ar-SA', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}

const handleIdUpload = (event) => {
  form.id_image = event.target.files[0]
}

const handleLicenseUpload = (event) => {
  form.license_image = event.target.files[0]
}

const closeConfirmationModal = () => {
  showConfirmationModal.value = false
  // Redirect to home page
  window.location.href = '/'
}

const submit = () => {
  form.post(`/cars/${props.car.id}/book`, {
    onSuccess: () => {
      // Show confirmation modal
      showConfirmationModal.value = true
    },
    onError: () => {
      // Handle errors
    }
  })
}
</script>
