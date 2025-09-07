<template>
  <Head title="السيارات - لوحة التحكم" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        إدارة السيارات
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Flash Messages -->
        <div v-if="success" class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
          {{ success }}
        </div>
        <div v-if="error" class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
          {{ error }}
        </div>

        <!-- Header with Add Button -->
        <div class="mb-6 flex justify-between items-center">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">جميع السيارات</h3>
            <p class="text-sm text-gray-600">إدارة وتعديل السيارات في النظام</p>
          </div>
          <button
            @click="showAddCarModal = true"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
          >
            <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            إضافة سيارة جديدة
          </button>
        </div>

        <!-- Filters -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
          <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">البحث</label>
                <input
                  v-model="search"
                  type="text"
                  placeholder="البحث في السيارات..."
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">الفئة</label>
                <select
                  v-model="selectedCategory"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="">جميع الفئات</option>
                  <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                  </option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                <select
                  v-model="selectedStatus"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="">جميع الحالات</option>
                  <option value="متاحة">متاحة</option>
                  <option value="مستأجرة">مستأجرة</option>
                  <option value="في الصيانة">في الصيانة</option>
                  <option value="غير متاحة">غير متاحة</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">النوع</label>
                <select
                  v-model="selectedType"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="">جميع الأنواع</option>
                  <option value="featured">مميزة</option>
                  <option value="regular">عادية</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <!-- Cars Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="car in filteredCars"
            :key="car.id"
            class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow"
          >
            <!-- Car Image Placeholder -->
            <div class="h-48 bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center">
              <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
              </svg>
            </div>

            <!-- Car Info -->
            <div class="p-6">
              <div class="flex justify-between items-start mb-3">
                <h3 class="text-lg font-semibold text-gray-900">{{ car.name }}</h3>
                <div class="flex space-x-1 space-x-reverse">
                  <span v-if="car.is_featured" class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">مميزة</span>
                  <span :class="getStatusClass(car.status)" class="text-xs px-2 py-1 rounded-full">
                    {{ car.status }}
                  </span>
                </div>
              </div>

              <div class="space-y-2 mb-4">
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">الفئة:</span>
                  <span class="text-gray-900">{{ car.category }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">رقم اللوحة:</span>
                  <span class="text-gray-900 font-mono">{{ car.license_plate }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">السعر اليومي:</span>
                  <span class="text-green-600 font-bold">{{ car.daily_rate }} ريال</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">السنة:</span>
                  <span class="text-gray-900">{{ car.year }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">اللون:</span>
                  <span class="text-gray-900">{{ car.color }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">الناقل:</span>
                  <span class="text-gray-900">{{ car.transmission }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">الوقود:</span>
                  <span class="text-gray-900">{{ car.fuel_type }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">المقاعد:</span>
                  <span class="text-gray-900">{{ car.seats }}</span>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="flex space-x-2 space-x-reverse">
                <button class="flex-1 bg-blue-600 text-white px-3 py-2 rounded-md text-sm hover:bg-blue-700 transition-colors">
                  تعديل
                </button>
                <button class="flex-1 bg-green-600 text-white px-3 py-2 rounded-md text-sm hover:bg-green-700 transition-colors">
                  عرض
                </button>
                <button class="bg-red-600 text-white px-3 py-2 rounded-md text-sm hover:bg-red-700 transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-if="filteredCars.length === 0" class="text-center py-12">
          <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
          </svg>
          <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد سيارات</h3>
          <p class="text-gray-500">لم يتم العثور على سيارات تطابق معايير البحث</p>
        </div>
      </div>
    </div>

    <!-- Add Car Modal -->
    <div v-if="showAddCarModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
          <h3 class="text-lg font-semibold text-gray-900">إضافة سيارة جديدة</h3>
          <button
            @click="closeAddCarModal"
            class="text-gray-400 hover:text-gray-600"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <form @submit.prevent="submitCarForm" class="space-y-6" enctype="multipart/form-data">
          <!-- Basic Info -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">الماركة</label>
              <input
                v-model="carForm.brand_ar"
                type="text"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="مثال: تويوتا"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">الموديل</label>
              <input
                v-model="carForm.model_ar"
                type="text"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="مثال: كورولا"
              />
            </div>
          </div>

          <!-- Car Details -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">السنة</label>
              <input
                v-model="carForm.year"
                type="number"
                min="2000"
                max="2030"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">اللون</label>
              <input
                v-model="carForm.color_ar"
                type="text"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="مثال: أبيض"
              />
            </div>
          </div>

          <!-- Specifications -->
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">الناقل</label>
              <select
                v-model="carForm.transmission"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
                <option value="">اختر الناقل</option>
                <option value="أوتوماتيك">أوتوماتيك</option>
                <option value="يدوي">يدوي</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">نوع الوقود</label>
              <select
                v-model="carForm.fuel_type"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
                <option value="">اختر نوع الوقود</option>
                <option value="بنزين">بنزين</option>
                <option value="ديزل">ديزل</option>
                <option value="كهربائي">كهربائي</option>
                <option value="هجين">هجين</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">عدد المقاعد</label>
              <input
                v-model="carForm.seats"
                type="number"
                min="2"
                max="15"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">عدد الأبواب</label>
              <input
                v-model="carForm.doors"
                type="number"
                min="2"
                max="5"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>

          <!-- Pricing -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">السعر اليومي (ريال)</label>
              <input
                v-model="carForm.daily_rate"
                type="number"
                min="0"
                step="0.01"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">السعر الأسبوعي (ريال)</label>
              <input
                v-model="carForm.weekly_rate"
                type="number"
                min="0"
                step="0.01"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">السعر الشهري (ريال)</label>
              <input
                v-model="carForm.monthly_rate"
                type="number"
                min="0"
                step="0.01"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>

          <!-- Images -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">الصورة الرئيسية</label>
              <input
                @change="handleMainImageUpload"
                type="file"
                accept="image/*"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
              <p class="text-xs text-gray-500 mt-1">اختر صورة رئيسية للسيارة</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">الصورة الثانوية</label>
              <input
                @change="handleSecondaryImageUpload"
                type="file"
                accept="image/*"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
              <p class="text-xs text-gray-500 mt-1">اختر صورة ثانوية (اختياري)</p>
            </div>
          </div>

          <!-- License Plate -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">رقم اللوحة</label>
            <input
              v-model="carForm.license_plate"
              type="text"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="مثال: ABC-123"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">الوصف</label>
            <textarea
              v-model="carForm.description_ar"
              rows="3"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="وصف السيارة"
            ></textarea>
          </div>

          <!-- Features -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">المميزات</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="مكيف هواء"
                  class="ml-2"
                />
                <span class="text-sm">مكيف هواء</span>
              </label>
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="نظام صوت"
                  class="ml-2"
                />
                <span class="text-sm">نظام صوت</span>
              </label>
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="وسائد هوائية"
                  class="ml-2"
                />
                <span class="text-sm">وسائد هوائية</span>
              </label>
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="كاميرا خلفية"
                  class="ml-2"
                />
                <span class="text-sm">كاميرا خلفية</span>
              </label>
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="GPS"
                  class="ml-2"
                />
                <span class="text-sm">GPS</span>
              </label>
              <label class="flex items-center">
                <input
                  v-model="carForm.features"
                  type="checkbox"
                  value="Bluetooth"
                  class="ml-2"
                />
                <span class="text-sm">Bluetooth</span>
              </label>
            </div>
          </div>

          <!-- Status -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
              <select
                v-model="carForm.status"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
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
                <span class="text-sm font-medium text-gray-700">سيارة مميزة</span>
              </label>
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="flex justify-end space-x-3 space-x-reverse">
            <button
              type="button"
              @click="closeAddCarModal"
              class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors"
            >
              إلغاء
            </button>
            <button
              type="submit"
              :disabled="isSubmitting"
              class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors disabled:opacity-50"
            >
              {{ isSubmitting ? 'جاري الإضافة...' : 'إضافة السيارة' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed } from 'vue'

const props = defineProps({
  cars: Array,
  categories: Array,
  success: String,
  error: String,
})

const search = ref('')
const selectedCategory = ref('')
const selectedStatus = ref('')
const selectedType = ref('')

// Modal state
const showAddCarModal = ref(false)
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

// Debug: Log initial form state
console.log('Initial car form:', carForm.value)

const filteredCars = computed(() => {
  return props.cars.filter(car => {
    const matchesSearch = !search.value ||
      car.name.toLowerCase().includes(search.value.toLowerCase()) ||
      car.license_plate.toLowerCase().includes(search.value.toLowerCase())

    const matchesCategory = !selectedCategory.value ||
      car.category === selectedCategory.value

    const matchesStatus = !selectedStatus.value ||
      car.status === selectedStatus.value

    const matchesType = !selectedType.value ||
      (selectedType.value === 'featured' && car.is_featured) ||
      (selectedType.value === 'regular' && !car.is_featured)

    return matchesSearch && matchesCategory && matchesStatus && matchesType
  })
})

const getStatusClass = (status) => {
  switch (status) {
    case 'متاحة':
      return 'bg-green-100 text-green-800'
    case 'مستأجرة':
      return 'bg-blue-100 text-blue-800'
    case 'في الصيانة':
      return 'bg-yellow-100 text-yellow-800'
    case 'غير متاحة':
      return 'bg-red-100 text-red-800'
    default:
      return 'bg-gray-100 text-gray-800'
  }
}

// Modal methods
const closeAddCarModal = () => {
  showAddCarModal.value = false
  resetCarForm()
}

const resetCarForm = () => {
  carForm.value = {
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
  }
}

const handleMainImageUpload = (event) => {
  carForm.value.main_image = event.target.files[0]
}

const handleSecondaryImageUpload = (event) => {
  carForm.value.secondary_image = event.target.files[0]
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

  // Create FormData for file upload
  const formData = new FormData()

  // Add all form fields
  Object.keys(carForm.value).forEach(key => {
    if (key === 'features') {
      formData.append(key, JSON.stringify(carForm.value[key]))
    } else if (key === 'main_image' || key === 'secondary_image') {
      if (carForm.value[key]) {
        formData.append(key, carForm.value[key])
      }
    } else if (key === 'is_featured' || key === 'is_active') {
      // Convert boolean to string for FormData
      formData.append(key, carForm.value[key] ? '1' : '0')
    } else {
      formData.append(key, carForm.value[key])
    }
  })

  // Ensure all required fields are present
  if (!carForm.value.brand_ar) {
    alert('يرجى إدخال الماركة')
    isSubmitting.value = false
    return
  }
  if (!carForm.value.model_ar) {
    alert('يرجى إدخال الموديل')
    isSubmitting.value = false
    return
  }
  if (!carForm.value.color_ar) {
    alert('يرجى إدخال اللون')
    isSubmitting.value = false
    return
  }
  if (!carForm.value.transmission) {
    alert('يرجى اختيار الناقل')
    isSubmitting.value = false
    return
  }
  if (!carForm.value.fuel_type) {
    alert('يرجى اختيار نوع الوقود')
    isSubmitting.value = false
    return
  }
  if (!carForm.value.daily_rate) {
    alert('يرجى إدخال السعر اليومي')
    isSubmitting.value = false
    return
  }
  if (!carForm.value.license_plate) {
    alert('يرجى إدخال رقم اللوحة')
    isSubmitting.value = false
    return
  }
  if (!carForm.value.main_image) {
    alert('يرجى اختيار صورة رئيسية')
    isSubmitting.value = false
    return
  }

  // Debug: Log form data
  console.log('Form data being sent:', carForm.value)
  console.log('FormData entries:')
  for (let [key, value] of formData.entries()) {
    console.log(key, value)
  }

  // Log specific required fields
  console.log('Required fields check:')
  console.log('brand_ar:', carForm.value.brand_ar)
  console.log('model_ar:', carForm.value.model_ar)
  console.log('year:', carForm.value.year)
  console.log('color_ar:', carForm.value.color_ar)
  console.log('transmission:', carForm.value.transmission)
  console.log('fuel_type:', carForm.value.fuel_type)
  console.log('seats:', carForm.value.seats)
  console.log('doors:', carForm.value.doors)
  console.log('daily_rate:', carForm.value.daily_rate)
  console.log('license_plate:', carForm.value.license_plate)
  console.log('main_image:', carForm.value.main_image)
  console.log('is_featured:', carForm.value.is_featured)
  console.log('is_active:', carForm.value.is_active)

  router.post('/dashboard/cars', formData, {
    onSuccess: () => {
      console.log('Car added successfully')
      closeAddCarModal()
      isSubmitting.value = false
      // Refresh the page to show the new car
      window.location.reload()
    },
    onError: (errors) => {
      console.error('Error adding car:', errors)
      let errorMessage = 'حدث خطأ أثناء إضافة السيارة: '
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
