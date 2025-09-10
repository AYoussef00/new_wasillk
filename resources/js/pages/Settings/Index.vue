<template>
  <AppLayout>
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-6">
      <!-- Welcome Section -->
      <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl p-6 text-white">
        <h1 class="text-2xl font-bold mb-2">إعدادات الشركة</h1>
        <p class="text-indigo-100">إدارة إعدادات الشركة والمعلومات العامة</p>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
        <div class="p-6 text-gray-900 dark:text-white">
            <form @submit.prevent="submit" class="space-y-8" enctype="multipart/form-data">
              <input type="hidden" name="_method" value="PUT">
            <!-- الإعدادات العامة -->
            <div class="bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 p-6 rounded-2xl border border-orange-100 dark:border-orange-800">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                <div class="bg-orange-100 dark:bg-orange-800 rounded-full p-3 mr-4">
                  <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                </div>
                الإعدادات العامة
              </h3>

              <div class="space-y-6">
                <!-- الشعار -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">شعار الشركة</label>
                  <div class="flex items-center space-x-4 space-x-reverse">
                    <div v-if="form.logo || props.settings?.logo" class="flex-shrink-0">
                      <img
                        :src="getLogoPreview()"
                        alt="شعار الشركة"
                        class="w-20 h-20 object-cover rounded-lg border border-gray-300"
                      />
                    </div>
                    <div class="flex-1">
                      <input
                        @change="handleLogoUpload"
                        type="file"
                        accept="image/*"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                      />
                      <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        💡 يمكنك رفع صورة الشعار (JPG, PNG, GIF, SVG) - الحد الأقصى 2 ميجابايت
                      </p>
                    </div>
                  </div>
                  <div v-if="form.errors.logo" class="text-red-500 text-sm mt-1">
                    {{ form.errors.logo }}
                  </div>
                </div>

                <!-- العنوان الرئيسي -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">العنوان الرئيسي</label>
                  <input
                    v-model="form.main_title"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="أدخل العنوان الرئيسي للموقع"
                  />
                  <div v-if="form.errors.main_title" class="text-red-500 text-sm mt-1">
                    {{ form.errors.main_title }}
                  </div>
                </div>

                <!-- العنوان الثانوي -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">العنوان الثانوي</label>
                  <input
                    v-model="form.sub_title"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="أدخل العنوان الثانوي للموقع"
                  />
                  <div v-if="form.errors.sub_title" class="text-red-500 text-sm mt-1">
                    {{ form.errors.sub_title }}
                  </div>
                </div>
              </div>
            </div>

            <!-- معلومات الشركة -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 p-6 rounded-2xl border border-blue-100 dark:border-blue-800">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                <div class="bg-blue-100 dark:bg-blue-800 rounded-full p-3 mr-4">
                  <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                  </svg>
                </div>
                معلومات الشركة
              </h3>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">اسم الشركة</label>
                  <input
                    v-model="form.company_name"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="أدخل اسم الشركة"
                  />
                  <div v-if="form.errors.company_name" class="text-red-500 text-sm mt-1">
                    {{ form.errors.company_name }}
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">رقم هاتف الشركة</label>
                  <input
                    v-model="form.company_phone"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="أدخل رقم الهاتف"
                  />
                  <div v-if="form.errors.company_phone" class="text-red-500 text-sm mt-1">
                    {{ form.errors.company_phone }}
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">رقم الواتساب</label>
                  <input
                    v-model="form.whatsapp_phone"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="أدخل رقم الواتساب"
                  />
                  <div v-if="form.errors.whatsapp_phone" class="text-red-500 text-sm mt-1">
                    {{ form.errors.whatsapp_phone }}
                  </div>
                </div>
              </div>

              <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">عنوان الشركة</label>
                <textarea
                  v-model="form.company_address"
                  rows="3"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                  placeholder="أدخل عنوان الشركة"
                ></textarea>
                <div v-if="form.errors.company_address" class="text-red-500 text-sm mt-1">
                  {{ form.errors.company_address }}
                </div>
              </div>
            </div>

            <!-- السياسات والشروط -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 p-6 rounded-2xl border border-green-100 dark:border-green-800">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                <div class="bg-green-100 dark:bg-green-800 rounded-full p-3 mr-4">
                  <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                السياسات والشروط
              </h3>

              <div class="space-y-6">
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">سياسة الإلغاء</label>
                  <textarea
                    v-model="form.cancellation_policy"
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="أدخل سياسة الإلغاء"
                  ></textarea>
                  <div v-if="form.errors.cancellation_policy" class="text-red-500 text-sm mt-1">
                    {{ form.errors.cancellation_policy }}
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">معلومات التأمين</label>
                  <textarea
                    v-model="form.insurance_info"
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="أدخل معلومات التأمين"
                  ></textarea>
                  <div v-if="form.errors.insurance_info" class="text-red-500 text-sm mt-1">
                    {{ form.errors.insurance_info }}
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">شروط الإيجار</label>
                  <textarea
                    v-model="form.rental_terms"
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="أدخل شروط الإيجار"
                  ></textarea>
                  <div v-if="form.errors.rental_terms" class="text-red-500 text-sm mt-1">
                    {{ form.errors.rental_terms }}
                  </div>
                </div>
              </div>
            </div>

            <!-- الموقع الجغرافي -->
            <div class="bg-gradient-to-r from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 p-6 rounded-2xl border border-purple-100 dark:border-purple-800">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                <div class="bg-purple-100 dark:bg-purple-800 rounded-full p-3 mr-4">
                  <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                </div>
                الموقع الجغرافي
              </h3>


              <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">عنوان الموقع</label>
                <input
                  v-model="form.location_address"
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                  placeholder="أدخل عنوان الموقع"
                />
                <div v-if="form.errors.location_address" class="text-red-500 text-sm mt-1">
                  {{ form.errors.location_address }}
                </div>
              </div>

              <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">رابط جوجل ماب</label>
                <div class="relative">
                  <input
                    v-model="form.google_maps_link"
                    type="url"
                    class="w-full px-4 py-3 pr-12 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="https://maps.google.com/?q=24.7136,46.6753"
                  />
                  <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                  </div>
                </div>
                <div v-if="form.errors.google_maps_link" class="text-red-500 text-sm mt-1">
                  {{ form.errors.google_maps_link }}
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                  💡 يمكنك الحصول على الرابط من جوجل ماب: ابحث عن موقعك → انسخ الرابط
                </p>
              </div>
            </div>

            <!-- أزرار الحفظ -->
            <div class="flex justify-end space-x-4">
              <button
                type="button"
                @click="reset"
                class="px-8 py-3 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition-colors duration-300 font-medium"
              >
                إعادة تعيين
              </button>
              <button
                type="submit"
                :disabled="form.processing"
                class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-xl hover:from-blue-700 hover:to-indigo-800 transition-all duration-300 font-medium disabled:opacity-50"
              >
                <span v-if="form.processing">جاري الحفظ...</span>
                <span v-else>حفظ الإعدادات</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

const props = defineProps({
  settings: Object,
})

const form = useForm({
  company_name: props.settings?.company_name || '',
  company_address: props.settings?.company_address || '',
  company_phone: props.settings?.company_phone || '',
  whatsapp_phone: props.settings?.whatsapp_phone || '',
  cancellation_policy: props.settings?.cancellation_policy || '',
  insurance_info: props.settings?.insurance_info || '',
  rental_terms: props.settings?.rental_terms || '',
  location_address: props.settings?.location_address || '',
  google_maps_link: props.settings?.google_maps_link || '',
  logo: null,
  main_title: props.settings?.main_title || '',
  sub_title: props.settings?.sub_title || '',
})

const logoPreview = ref(null)

const handleLogoUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.logo = file

    // Create preview
    const reader = new FileReader()
    reader.onload = (e) => {
      logoPreview.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const getLogoPreview = () => {
  if (logoPreview.value) {
    return logoPreview.value
  }
  if (props.settings?.logo) {
    return `/storage/${props.settings.logo}`
  }
  return null
}

const submit = () => {
  // Check if there's a logo file to upload
  if (form.logo) {
    // Use POST with FormData for file uploads
    form.post('/dashboard/settings', {
      forceFormData: true,
      onSuccess: () => {
        // Show success message
        alert('تم حفظ الإعدادات بنجاح!')
        // Refresh the page to show updated data
        window.location.reload()
      },
      onError: (errors) => {
        console.error('Error updating settings:', errors)
        alert('حدث خطأ في حفظ الإعدادات: ' + JSON.stringify(errors))
      }
    })
  } else {
    // Use PUT for regular data without files
    form.put('/dashboard/settings', {
      onSuccess: () => {
        // Show success message
        alert('تم حفظ الإعدادات بنجاح!')
        // Refresh the page to show updated data
        window.location.reload()
      },
      onError: (errors) => {
        console.error('Error updating settings:', errors)
        alert('حدث خطأ في حفظ الإعدادات: ' + JSON.stringify(errors))
      }
    })
  }
}

const reset = () => {
  form.reset()
}
</script>
