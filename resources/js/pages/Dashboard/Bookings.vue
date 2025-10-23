<template>
  <Head title="الطلبات - لوحة التحكم" />

  <AppLayout>
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-6">
      <!-- Welcome Section -->
      <div class="bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl p-6 text-white">
        <h1 class="text-2xl font-bold mb-2">إدارة الطلبات</h1>
        <p class="text-purple-100">إدارة وتتبع جميع طلبات الحجز</p>
      </div>
      <!-- Success Message -->
      <div v-if="props.success" class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
          </div>
          <div class="mr-3">
            <p class="text-sm font-medium text-green-800">{{ props.success }}</p>
          </div>
        </div>
      </div>

      <!-- Error Message -->
      <div v-if="props.error" class="bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
          </div>
          <div class="mr-3">
            <p class="text-sm font-medium text-red-800">{{ props.error }}</p>
          </div>
        </div>
      </div>

      <!-- Statistics -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-800 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
            </div>
            <div class="mr-3">
              <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200">الحجوزات المعلقة</p>
              <p class="text-2xl font-bold text-yellow-900 dark:text-yellow-100">{{ pendingCount }}</p>
            </div>
          </div>
        </div>

        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
              </div>
            </div>
            <div class="mr-3">
              <p class="text-sm font-medium text-green-800 dark:text-green-200">الحجوزات المؤكدة</p>
              <p class="text-2xl font-bold text-green-900 dark:text-green-100">{{ confirmedCount }}</p>
            </div>
          </div>
        </div>

        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-red-100 dark:bg-red-800 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </div>
            </div>
            <div class="mr-3">
              <p class="text-sm font-medium text-red-800 dark:text-red-200">الحجوزات المرفوضة</p>
              <p class="text-2xl font-bold text-red-900 dark:text-red-100">{{ rejectedCount }}</p>
            </div>
          </div>
        </div>

        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-blue-100 dark:bg-blue-800 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
              </div>
            </div>
            <div class="mr-3">
              <p class="text-sm font-medium text-blue-800 dark:text-blue-200">إجمالي الحجوزات</p>
              <p class="text-2xl font-bold text-blue-900 dark:text-blue-100">{{ totalCount }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Filters -->
      <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">البحث</label>
            <input
              v-model="search"
              type="text"
              placeholder="البحث في الطلبات..."
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الحالة</label>
            <select
              v-model="selectedStatus"
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            >
              <option value="">جميع الحالات</option>
              <option value="في الانتظار">في الانتظار</option>
              <option value="مؤكد">مؤكد</option>
              <option value="ملغي">ملغي</option>
              <option value="مكتمل">مكتمل</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">نوع العميل</label>
            <select
              v-model="selectedCustomerType"
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            >
              <option value="">جميع العملاء</option>
              <option value="guest">ضيوف</option>
              <option value="registered">مسجلين</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">التاريخ</label>
            <select
              v-model="selectedDate"
              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            >
              <option value="">جميع التواريخ</option>
              <option value="today">اليوم</option>
              <option value="week">هذا الأسبوع</option>
              <option value="month">هذا الشهر</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Bookings Table -->
      <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
        <div class="p-6">
          <!-- Legend -->
          <div class="mb-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
            <div class="flex items-center space-x-4 space-x-reverse text-sm text-gray-600 dark:text-gray-400">
                <span class="flex items-center">
                  <span class="inline-flex items-center justify-center w-4 h-4 bg-purple-100 rounded-full mr-2">
                    <svg class="w-2.5 h-2.5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                    </svg>
                  </span>
                  صورة الهوية متاحة
                </span>
                <span class="flex items-center">
                  <span class="inline-flex items-center justify-center w-4 h-4 bg-orange-100 rounded-full mr-2">
                    <svg class="w-2.5 h-2.5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                    </svg>
                  </span>
                  صورة الرخصة متاحة
                </span>
              </div>
            </div>
            <div v-if="filteredBookings.length === 0" class="text-center py-12">
              <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
              <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد طلبات</h3>
              <p class="text-gray-500">لم يتم العثور على طلبات تطابق معايير البحث</p>
            </div>

            <div v-else class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                      العميل
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                      السيارة
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                      التواريخ
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                      المبلغ
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                      الحالة
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                      التاريخ
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                      الإجراءات
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="booking in filteredBookings" :key="booking.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                          </div>
                        </div>
                        <div class="mr-4">
                          <div class="text-sm font-medium text-gray-900 flex items-center cursor-pointer hover:text-blue-600" @click="showCustomerDetails(booking)">
                            {{ booking.customer_name }}
                            <div class="mr-2 flex space-x-1 space-x-reverse">
                              <span v-if="booking.id_image" class="inline-flex items-center justify-center w-5 h-5 bg-purple-100 rounded-full" title="صورة الهوية متاحة">
                                <svg class="w-3 h-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                              <span v-if="booking.license_image" class="inline-flex items-center justify-center w-5 h-5 bg-orange-100 rounded-full" title="صورة الرخصة متاحة">
                                <svg class="w-3 h-3 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                            </div>
                          </div>
                          <div class="text-sm text-gray-500 flex items-center cursor-pointer hover:text-green-600" @click="callCustomer(booking.customer_phone)" v-if="booking.customer_phone !== 'غير محدد'">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            {{ booking.customer_phone }}
                          </div>
                          <div v-if="booking.customer_email !== 'غير محدد'" class="text-sm text-gray-500 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            {{ booking.customer_email }}
                          </div>
                          <div v-if="booking.customer_address !== 'غير محدد'" class="text-sm text-gray-500 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ booking.customer_address }}
                          </div>
                          <span v-if="booking.is_guest" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mt-1">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                            </svg>
                            ضيف
                          </span>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900">{{ booking.car_name }}</div>
                      <div class="text-sm text-gray-500">{{ booking.car_license_plate }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{ formatDate(booking.pickup_date) }}</div>
                      <div class="text-sm text-gray-500">إلى {{ formatDate(booking.return_date) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-bold text-green-600">{{ booking.total_amount }} ريال</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" :class="getStatusClass(booking.status)">
                        {{ booking.status }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ formatDate(booking.created_at) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <div class="flex space-x-2 space-x-reverse">
                        <button
                          @click="viewBooking(booking.id)"
                          class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-md hover:bg-blue-200 transition-colors duration-200"
                        >
                          <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                          </svg>
                          عرض
                        </button>
                        <button
                          v-if="booking.status === 'في الانتظار'"
                          @click="confirmBooking(booking.id)"
                          class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-md hover:bg-green-200 transition-colors duration-200"
                        >
                          <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                          </svg>
                          تأكيد
                        </button>
                        <button
                          v-if="booking.status === 'في الانتظار'"
                          @click="rejectBooking(booking.id)"
                          class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-md hover:bg-red-200 transition-colors duration-200"
                        >
                          <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                          </svg>
                          رفض
                        </button>
                        <button
                          v-if="booking.id_image"
                          @click="showImageModal(booking.id_image, 'صورة الهوية')"
                          class="inline-flex items-center px-2 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-md hover:bg-purple-200 transition-colors duration-200"
                        >
                          <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                          </svg>
                          الهوية
                        </button>
                        <button
                          v-if="booking.license_image"
                          @click="showImageModal(booking.license_image, 'صورة الرخصة')"
                          class="inline-flex items-center px-2 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded-md hover:bg-orange-200 transition-colors duration-200"
                        >
                          <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                          </svg>
                          الرخصة
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    <!-- Image Modal -->
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 max-w-4xl max-h-[90vh] overflow-auto">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold text-gray-900">{{ modalTitle }}</h3>
          <button
            @click="closeImageModal"
            class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-full"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <div class="flex justify-center">
          <img
            :src="modalImageUrl"
            :alt="modalTitle"
            class="max-w-full max-h-[70vh] object-contain rounded-lg shadow-lg"
            @error="handleImageError"
          />
        </div>

        <div class="mt-4 flex justify-end">
          <button
            @click="closeImageModal"
            class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors"
          >
            إغلاق
          </button>
        </div>
      </div>
    </div>

    <!-- Customer Details Modal -->
    <div v-if="selectedCustomer" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all">
        <!-- Header -->
        <div class="bg-blue-500 rounded-t-lg px-6 py-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
              <h3 class="text-lg font-semibold text-white">تفاصيل العميل</h3>
            </div>
            <button @click="selectedCustomer = null" class="text-white hover:text-gray-200">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
        </div>

        <!-- Content -->
        <div class="px-6 py-6">
          <div class="space-y-4">
            <div class="flex items-center">
              <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
              <div>
                <h4 class="text-lg font-semibold text-gray-900">{{ selectedCustomer.customer_name }}</h4>
                <p class="text-sm text-gray-500">{{ selectedCustomer.is_guest ? 'عميل ضيف' : 'عميل مسجل' }}</p>
              </div>
            </div>

            <div class="space-y-3">
              <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <span class="text-gray-700">{{ selectedCustomer.customer_phone }}</span>
              </div>

              <div v-if="selectedCustomer.customer_email !== 'غير محدد'" class="flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span class="text-gray-700">{{ selectedCustomer.customer_email }}</span>
              </div>

              <div v-if="selectedCustomer.customer_address !== 'غير محدد'" class="flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="text-gray-700">{{ selectedCustomer.customer_address }}</span>
              </div>
            </div>

            <div class="border-t pt-4">
              <h5 class="font-medium text-gray-900 mb-2">السيارة المطلوبة:</h5>
              <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-sm font-medium text-gray-900">{{ selectedCustomer.car_name }}</p>
                <p class="text-xs text-gray-500">{{ selectedCustomer.car_license_plate }}</p>
              </div>
            </div>

            <div class="border-t pt-4">
              <h5 class="font-medium text-gray-900 mb-2">تفاصيل الحجز:</h5>
              <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <span class="text-gray-500">من:</span>
                  <p class="font-medium">{{ formatDateForModal(selectedCustomer.pickup_date) }}</p>
                </div>
                <div>
                  <span class="text-gray-500">إلى:</span>
                  <p class="font-medium">{{ formatDateForModal(selectedCustomer.return_date) }}</p>
                </div>
                <div>
                  <span class="text-gray-500">المبلغ:</span>
                  <p class="font-medium text-green-600">{{ selectedCustomer.total_amount }} ريال</p>
                </div>
                <div>
                  <span class="text-gray-500">الحالة:</span>
                  <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium" :class="getStatusClass(selectedCustomer.status)">
                    {{ selectedCustomer.status }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 px-6 py-4 rounded-b-lg">
          <div class="flex gap-3">
            <button
              @click="selectedCustomer = null"
              class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-400 transition duration-200"
            >
              إغلاق
            </button>
            <button
              v-if="selectedCustomer.customer_phone !== 'غير محدد'"
              @click="callCustomer(selectedCustomer.customer_phone)"
              class="flex-1 bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 transition duration-200 flex items-center justify-center"
            >
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
              اتصل بالعميل
            </button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, computed } from 'vue'

const props = defineProps({
  bookings: Array,
  success: String,
  error: String,
})

const search = ref('')
const selectedStatus = ref('')
const selectedCustomerType = ref('')
const selectedDate = ref('')
const selectedCustomer = ref(null)

// Modal state
const showModal = ref(false)
const modalImageUrl = ref('')
const modalTitle = ref('')

const filteredBookings = computed(() => {
  return props.bookings.filter(booking => {
    const matchesSearch = !search.value ||
      booking.customer_name.toLowerCase().includes(search.value.toLowerCase()) ||
      booking.customer_phone.includes(search.value) ||
      booking.car_name.toLowerCase().includes(search.value.toLowerCase()) ||
      booking.car_license_plate.toLowerCase().includes(search.value.toLowerCase())

    const matchesStatus = !selectedStatus.value ||
      booking.status === selectedStatus.value

    const matchesCustomerType = !selectedCustomerType.value ||
      (selectedCustomerType.value === 'guest' && booking.is_guest) ||
      (selectedCustomerType.value === 'registered' && !booking.is_guest)

    const matchesDate = !selectedDate.value ||
      (selectedDate.value === 'today' && isToday(booking.created_at)) ||
      (selectedDate.value === 'week' && isThisWeek(booking.created_at)) ||
      (selectedDate.value === 'month' && isThisMonth(booking.created_at))

    return matchesSearch && matchesStatus && matchesCustomerType && matchesDate
  })
})

const getStatusClass = (status) => {
  switch (status) {
    case 'مؤكد':
      return 'bg-green-100 text-green-800'
    case 'في الانتظار':
      return 'bg-yellow-100 text-yellow-800'
    case 'ملغي':
      return 'bg-red-100 text-red-800'
    case 'مكتمل':
      return 'bg-blue-100 text-blue-800'
    default:
      return 'bg-gray-100 text-gray-800'
  }
}

const isToday = (dateString) => {
  const today = new Date().toDateString()
  const date = new Date(dateString).toDateString()
  return today === date
}

const isThisWeek = (dateString) => {
  const now = new Date()
  const date = new Date(dateString)
  const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000)
  return date >= weekAgo && date <= now
}

const isThisMonth = (dateString) => {
  const now = new Date()
  const date = new Date(dateString)
  return date.getMonth() === now.getMonth() && date.getFullYear() === now.getFullYear()
}

const formatDate = (dateString) => {
  if (!dateString) return ''
  const date = new Date(dateString)
  return date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit'
  })
}

// دالة لتنسيق التواريخ في modal العميل
const formatDateForModal = (dateString) => {
  if (!dateString) return ''
  const date = new Date(dateString)
  return date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit'
  })
}

const showCustomerDetails = (customer) => {
  selectedCustomer.value = customer
}

const callCustomer = (phone) => {
  window.open(`tel:${phone}`, '_blank')
}

const viewBooking = (bookingId) => {
  router.visit(`/bookings/${bookingId}`)
}

const confirmBooking = (bookingId) => {
  if (!confirm('هل أنت متأكد من تأكيد هذا الحجز؟')) {
    return
  }

  router.post(`/dashboard/bookings/${bookingId}/confirm`, {}, {
    onSuccess: () => {
      // Success message will be shown via flash message
    },
    onError: (errors) => {
      alert('حدث خطأ أثناء تأكيد الحجز')
    }
  })
}

const rejectBooking = (bookingId) => {
  if (!confirm('هل أنت متأكد من رفض هذا الحجز؟')) {
    return
  }

  router.post(`/dashboard/bookings/${bookingId}/reject`, {}, {
    onSuccess: () => {
      // Success message will be shown via flash message
    },
    onError: (errors) => {
      alert('حدث خطأ أثناء رفض الحجز')
    }
  })
}

// Statistics computed properties
const pendingCount = computed(() => {
  return props.bookings.filter(booking => booking.status === 'في الانتظار').length
})

const confirmedCount = computed(() => {
  return props.bookings.filter(booking => booking.status === 'مؤكد').length
})

const rejectedCount = computed(() => {
  return props.bookings.filter(booking => booking.status === 'ملغي').length
})

const totalCount = computed(() => {
  return props.bookings.length
})

// Modal methods
const showImageModal = (imageUrl, title) => {
  if (!imageUrl) {
    alert('لا توجد صورة متاحة')
    return
  }

  // Handle storage URLs
  let fullUrl = imageUrl
  if (!imageUrl.startsWith('http')) {
    // Remove leading slash if exists and ensure proper path
    const cleanPath = imageUrl.startsWith('/') ? imageUrl.substring(1) : imageUrl
    fullUrl = window.location.origin + '/storage/' + cleanPath
  }

  console.log('Loading image:', fullUrl)

  // Show modal immediately
  modalImageUrl.value = fullUrl
  modalTitle.value = title
  showModal.value = true
}

const closeImageModal = () => {
  showModal.value = false
  modalImageUrl.value = ''
  modalTitle.value = ''
}

const handleImageError = (event) => {
  console.error('Image load error:', event.target.src)
  alert('عذراً، لا يمكن تحميل الصورة. تأكد من وجود الملف.')
  closeImageModal()
}
</script>
