<template>
  <Head title="تعديل السيارة - لوحة التحكم" />

  <AppLayout>
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-6">
      <!-- Welcome Section -->
      <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-6 text-white">
        <h1 class="text-2xl font-bold mb-2">تعديل السيارة</h1>
        <p class="text-blue-100">تعديل بيانات السيارة: {{ car.brand_ar }} {{ car.model_ar }}</p>
      </div>

      <!-- Flash Messages -->
      <div v-if="success" class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
          </div>
          <div class="mr-3">
            <p class="text-sm font-medium text-green-800">{{ success }}</p>
          </div>
        </div>
      </div>
      <div v-if="error" class="bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
          </div>
          <div class="mr-3">
            <p class="text-sm font-medium text-red-800">{{ error }}</p>
          </div>
        </div>
      </div>

      <!-- Edit Form -->
      <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
        <!-- Info Message -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div class="mr-3">
              <p class="text-sm font-medium text-blue-800 dark:text-blue-200">
                يمكنك تعديل أي حقل تريده فقط - لا حاجة لملء جميع الحقول
              </p>
            </div>
          </div>
        </div>

        <form @submit.prevent="submitCarForm" class="space-y-6" enctype="multipart/form-data">
          <!-- Basic Info -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الماركة</label>
              <input
                v-model="carForm.brand_ar"
                type="text"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                placeholder="مثال: تويوتا"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الموديل</label>
              <input
                v-model="carForm.model_ar"
                type="text"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                placeholder="مثال: كورولا"
              />
            </div>
          </div>

          <!-- Car Details -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">السنة</label>
              <input
                v-model="carForm.year"
                type="number"
                min="2000"
                max="2030"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">اللون</label>
              <input
                v-model="carForm.color_ar"
                type="text"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                placeholder="مثال: أبيض"
              />
            </div>
          </div>

          <!-- Specifications -->
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الناقل</label>
              <select
                v-model="carForm.transmission"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              >
                <option value="">اختر الناقل</option>
                <option value="أوتوماتيك">أوتوماتيك</option>
                <option value="يدوي">يدوي</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">نوع الوقود</label>
              <select
                v-model="carForm.fuel_type"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              >
                <option value="">اختر نوع الوقود</option>
                <option value="بنزين">بنزين</option>
                <option value="ديزل">ديزل</option>
                <option value="كهربائي">كهربائي</option>
                <option value="هجين">هجين</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">عدد المقاعد</label>
              <input
                v-model="carForm.seats"
                type="number"
                min="2"
                max="15"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">عدد الأبواب</label>
              <input
                v-model="carForm.doors"
                type="number"
                min="2"
                max="5"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              />
            </div>
          </div>

          <!-- Pricing -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">السعر اليومي (ريال)</label>
              <input
                v-model="carForm.daily_rate"
                type="number"
                min="0"
                step="0.01"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">السعر الأسبوعي (ريال)</label>
              <input
                v-model="carForm.weekly_rate"
                type="number"
                min="0"
                step="0.01"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">السعر الشهري (ريال)</label>
              <input
                v-model="carForm.monthly_rate"
                type="number"
                min="0"
                step="0.01"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              />
            </div>
          </div>

          <!-- Images -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الصورة الرئيسية</label>
              <input
                @change="handleMainImageUpload"
                type="file"
                accept="image/*"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              />
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">اختر صورة جديدة للصورة الرئيسية (اختياري)</p>
              <div v-if="car.images && car.images[0]" class="mt-2">
                <p class="text-sm text-gray-600 dark:text-gray-400">الصورة الحالية:</p>
                <img :src="car.images[0]" :alt="car.brand_ar" class="w-20 h-20 object-cover rounded-md mt-1" />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الصورة الثانوية</label>
              <input
                @change="handleSecondaryImageUpload"
                type="file"
                accept="image/*"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              />
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">اختر صورة جديدة للصورة الثانوية (اختياري)</p>
              <div v-if="car.images && car.images[1]" class="mt-2">
                <p class="text-sm text-gray-600 dark:text-gray-400">الصورة الحالية:</p>
                <img :src="car.images[1]" :alt="car.brand_ar" class="w-20 h-20 object-cover rounded-md mt-1" />
              </div>
            </div>
          </div>

          <!-- License Plate -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">رقم اللوحة</label>
            <input
              v-model="carForm.license_plate"
              type="text"
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              placeholder="مثال: ABC-123"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الوصف</label>
            <textarea
              v-model="carForm.description_ar"
              rows="3"
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              placeholder="وصف السيارة"
            ></textarea>
          </div>

          <!-- Features -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">المميزات</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="مكيف هواء"
                  class="ml-2"
                />
                <span class="text-sm text-gray-700 dark:text-gray-300">مكيف هواء</span>
              </label>
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="نظام صوت"
                  class="ml-2"
                />
                <span class="text-sm text-gray-700 dark:text-gray-300">نظام صوت</span>
              </label>
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="وسائد هوائية"
                  class="ml-2"
                />
                <span class="text-sm text-gray-700 dark:text-gray-300">وسائد هوائية</span>
              </label>
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="كاميرا خلفية"
                  class="ml-2"
                />
                <span class="text-sm text-gray-700 dark:text-gray-300">كاميرا خلفية</span>
              </label>
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="GPS"
                  class="ml-2"
                />
                <span class="text-sm text-gray-700 dark:text-gray-300">GPS</span>
              </label>
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="Bluetooth"
                  class="ml-2"
                />
                <span class="text-sm text-gray-700 dark:text-gray-300">Bluetooth</span>
              </label>
            </div>
          </div>

          <!-- Status -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الحالة</label>
              <select
                v-model="carForm.status"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
              >
                <option value="available">متاحة</option>
                <option value="rented">مستأجرة</option>
                <option value="maintenance">في الصيانة</option>
                <option value="unavailable">غير متاحة</option>
              </select>
            </div>
            <div class="flex items-center">
              <label class="flex items-center">
                <input
                  v-model="carForm.is_featured"
                  type="checkbox"
                  class="ml-2"
                />
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">سيارة مميزة</span>
              </label>
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="flex justify-end space-x-3 space-x-reverse">
            <button
              type="button"
              @click="goBack"
              class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors"
            >
              إلغاء
            </button>
            <button
              type="submit"
              :disabled="isSubmitting"
              class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors disabled:opacity-50"
            >
              {{ isSubmitting ? 'جاري التحديث...' : 'تحديث السيارة' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, onMounted } from 'vue'

const props = defineProps({
  car: Object,
  categories: Array,
  success: String,
  error: String,
})

const isSubmitting = ref(false)

// Car form
const carForm = ref({
  brand_ar: '',
  model_ar: '',
  year: new Date().getFullYear(),
  color_ar: '',
  transmission: '',
  fuel_type: '',
  seats: 5,
  doors: 4,
  daily_rate: '',
  weekly_rate: '',
  monthly_rate: '',
  license_plate: '',
  description_ar: '',
  features: [],
  status: 'available',
  is_featured: false,
  is_active: true,
  main_image: null,
  secondary_image: null
})

// Initialize form with car data
onMounted(() => {
  if (props.car) {
    carForm.value = {
      brand_ar: props.car.brand_ar || '',
      model_ar: props.car.model_ar || '',
      year: props.car.year || new Date().getFullYear(),
      color_ar: props.car.color_ar || '',
      transmission: props.car.transmission || '',
      fuel_type: props.car.fuel_type || '',
      seats: props.car.seats || 5,
      doors: props.car.doors || 4,
      daily_rate: props.car.daily_rate || '',
      weekly_rate: props.car.weekly_rate || '',
      monthly_rate: props.car.monthly_rate || '',
      license_plate: props.car.license_plate || '',
      description_ar: props.car.description_ar || '',
      features: props.car.features || [],
      status: props.car.status || 'available',
      is_featured: props.car.is_featured || false,
      is_active: props.car.is_active !== false,
      main_image: null,
      secondary_image: null
    }
  }
})

const handleMainImageUpload = (event) => {
  carForm.value.main_image = event.target.files[0]
}

const handleSecondaryImageUpload = (event) => {
  carForm.value.secondary_image = event.target.files[0]
}

const goBack = () => {
  router.get('/dashboard/cars')
}

const submitCarForm = () => {
  isSubmitting.value = true

  // Calculate weekly and monthly rates if not provided
  if (!carForm.value.weekly_rate && carForm.value.daily_rate) {
    carForm.value.weekly_rate = (parseFloat(carForm.value.daily_rate) * 6).toFixed(2)
  }

  if (!carForm.value.monthly_rate && carForm.value.daily_rate) {
    carForm.value.monthly_rate = (parseFloat(carForm.value.daily_rate) * 20).toFixed(2)
  }

  // Check if at least one field is being updated
  const hasUpdates = Object.keys(carForm.value).some(key => {
    if (key === 'main_image' || key === 'secondary_image') {
      return carForm.value[key] !== null
    }
    // Check if the value is different from the original car data
    const originalValue = props.car[key]
    const currentValue = carForm.value[key]

    // For arrays (like features), compare differently
    if (Array.isArray(currentValue) && Array.isArray(originalValue)) {
      return JSON.stringify(currentValue) !== JSON.stringify(originalValue)
    }

    return currentValue !== originalValue
  })

  if (!hasUpdates) {
    alert('يرجى تعديل حقل واحد على الأقل')
    isSubmitting.value = false
    return
  }

  // Prepare data for Inertia (it handles FormData automatically for files)
  const submitData = {
    _method: 'PUT',
    brand_ar: carForm.value.brand_ar,
    model_ar: carForm.value.model_ar,
    year: carForm.value.year,
    color_ar: carForm.value.color_ar,
    transmission: carForm.value.transmission,
    fuel_type: carForm.value.fuel_type,
    seats: carForm.value.seats,
    doors: carForm.value.doors,
    daily_rate: carForm.value.daily_rate,
    weekly_rate: carForm.value.weekly_rate,
    monthly_rate: carForm.value.monthly_rate,
    license_plate: carForm.value.license_plate,
    description_ar: carForm.value.description_ar,
    features: JSON.stringify(carForm.value.features),
    status: carForm.value.status,
    is_featured: carForm.value.is_featured ? '1' : '0',
    is_active: carForm.value.is_active ? '1' : '0',
  }

  // Add images only if they are File objects
  if (carForm.value.main_image instanceof File) {
    submitData.main_image = carForm.value.main_image
  }
  if (carForm.value.secondary_image instanceof File) {
    submitData.secondary_image = carForm.value.secondary_image
  }

  router.post(`/dashboard/cars/${props.car.id}`, submitData, {
    forceFormData: true,
    onSuccess: () => {
      isSubmitting.value = false
      // Redirect to cars list
      router.get('/dashboard/cars')
    },
    onError: (errors) => {
      let errorMessage = 'حدث خطأ أثناء تحديث السيارة: '
      if (typeof errors === 'object') {
        Object.keys(errors).forEach(key => {
          errorMessage += '\n' + key + ': ' + errors[key]
        })
      } else {
        errorMessage += errors
      }
      alert(errorMessage)
      isSubmitting.value = false
    }
  })
}
</script>
