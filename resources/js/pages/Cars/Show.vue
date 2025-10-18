<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <Header />



    <!-- Breadcrumb -->
    <div class="bg-white border-b shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center space-x-2 text-sm text-gray-600">
          <Link href="/" class="hover:text-blue-600 transition-colors">الرئيسية</Link>
          <span>/</span>
          <Link href="/cars" class="hover:text-blue-600 transition-colors">السيارات</Link>
          <span>/</span>
          <span class="text-gray-900 font-medium">{{ car.brand_ar || 'تويوتا' }} {{ car.model_ar || 'كورولا' }}</span>
        </nav>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Car Images -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="relative">
              <img
                :src="selectedImage || car.images[0] || '/images/car-placeholder.jpg'"
                :alt="(car.brand_ar || 'تويوتا') + ' ' + (car.model_ar || 'كورولا')"
                class="w-full h-96 md:h-[500px] object-cover"
              />

              <!-- Featured Badge -->
              <div v-if="car.is_featured" class="absolute top-6 right-6">
                <span class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-xl">
                  ⭐ مميزة
                </span>
              </div>

              <!-- Favorite Button -->
              <div class="absolute top-6 left-6">
                <button class="bg-white/90 backdrop-blur-sm rounded-full p-3 shadow-lg hover:bg-red-50 transition-all duration-300 hover:scale-110">
                  <Heart class="w-6 h-6 text-gray-600 hover:text-red-500 transition-colors duration-300" />
                </button>
              </div>

              <!-- Image Navigation -->
              <div v-if="car.images && car.images.length > 1" class="absolute bottom-6 left-1/2 transform -translate-x-1/2">
                <div class="flex gap-2 bg-white/90 backdrop-blur-sm rounded-full px-4 py-2 shadow-lg">
                  <button
                    v-for="(image, index) in car.images"
                    :key="index"
                    @click="selectedImage = image"
                    class="w-3 h-3 rounded-full transition-all duration-300"
                    :class="selectedImage === image ? 'bg-blue-600' : 'bg-gray-300 hover:bg-gray-400'"
                  ></button>
                </div>
              </div>
            </div>

            <!-- Image Gallery -->
            <div v-if="car.images && car.images.length > 1" class="p-6 border-t border-gray-100">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">معرض الصور</h3>
              <div class="flex gap-3 overflow-x-auto">
                <img
                  v-for="(image, index) in car.images"
                  :key="index"
                  :src="image"
                  :alt="(car.brand_ar || 'تويوتا') + ' ' + (car.model_ar || 'كورولا')"
                  class="w-24 h-20 object-cover rounded-xl cursor-pointer border-2 transition-all duration-300 hover:scale-105"
                  :class="selectedImage === image ? 'border-blue-500 shadow-lg' : 'border-gray-200 hover:border-blue-300'"
                  @click="selectedImage = image"
                />
              </div>
            </div>
          </div>
        </div>

        <!-- Car Details Sidebar -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-2xl shadow-xl p-8 sticky top-8">
            <!-- Car Title -->
            <div class="mb-8">
              <h1 class="text-3xl font-bold text-black mb-3">{{ car.brand_ar || 'تويوتا' }} {{ car.model_ar || 'كورولا' }}</h1>
              <div class="flex items-center gap-3 mb-4">
                <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-full text-sm font-bold">
                  {{ car.category.name }}
                </span>
                <span class="text-gray-400">•</span>
                <span class="text-gray-600 font-medium">{{ car.license_plate }}</span>
              </div>
            </div>

            <!-- Pricing Section -->
            <div class="mb-8 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
              <div class="text-center mb-4">
                <div class="text-4xl font-bold text-blue-600 mb-1">
                  {{ formatPrice(car.daily_rate) }}
                </div>
                <div class="text-lg text-gray-600">ريال / يوم</div>
              </div>

              <div class="grid grid-cols-3 gap-4 text-center">
                <div class="bg-white rounded-lg p-3 shadow-sm">
                  <div class="font-bold text-gray-900">{{ formatPrice(car.weekly_rate) }}</div>
                  <div class="text-sm text-gray-600">أسبوعياً</div>
                </div>
                <div class="bg-white rounded-lg p-3 shadow-sm">
                  <div class="font-bold text-gray-900">{{ formatPrice(car.monthly_rate) }}</div>
                  <div class="text-sm text-gray-600">شهرياً</div>
                </div>
                <div class="bg-white rounded-lg p-3 shadow-sm">
                  <div class="font-bold text-gray-900">{{ formatPrice(car.mileage) }}</div>
                  <div class="text-sm text-gray-600">كم</div>
                </div>
              </div>
            </div>

            <!-- Quick Specs -->
            <div class="mb-8">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">المواصفات السريعة</h3>
              <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center space-x-3 space-x-reverse bg-gray-50 rounded-xl p-3">
                  <div class="bg-blue-100 rounded-full p-2">
                    <Users class="w-5 h-5 text-blue-600" />
                  </div>
                  <div>
                    <div class="text-sm text-gray-500">المقاعد</div>
                    <div class="font-bold text-gray-900">{{ car.seats }}</div>
                  </div>
                </div>

                <div class="flex items-center space-x-3 space-x-reverse bg-gray-50 rounded-xl p-3">
                  <div class="bg-green-100 rounded-full p-2">
                    <DoorOpen class="w-5 h-5 text-green-600" />
                  </div>
                  <div>
                    <div class="text-sm text-gray-500">الأبواب</div>
                    <div class="font-bold text-gray-900">{{ car.doors }}</div>
                  </div>
                </div>

                <div class="flex items-center space-x-3 space-x-reverse bg-gray-50 rounded-xl p-3">
                  <div class="bg-purple-100 rounded-full p-2">
                    <Settings class="w-5 h-5 text-purple-600" />
                  </div>
                  <div>
                    <div class="text-sm text-gray-500">الناقل</div>
                    <div class="font-bold text-gray-900">{{ car.transmission }}</div>
                  </div>
                </div>

                <div class="flex items-center space-x-3 space-x-reverse bg-gray-50 rounded-xl p-3">
                  <div class="bg-orange-100 rounded-full p-2">
                    <Droplets class="w-5 h-5 text-orange-600" />
                  </div>
                  <div>
                    <div class="text-sm text-gray-500">الوقود</div>
                    <div class="font-bold text-gray-900">{{ car.fuel_type }}</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Availability Status -->
            <div class="mb-8 p-4 bg-green-50 rounded-xl border border-green-200">
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2 space-x-reverse">
                  <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                  <span class="font-semibold text-green-800">متاح للحجز</span>
                </div>
                <span class="text-sm text-green-600">●</span>
              </div>
            </div>

            <!-- Book Button -->
            <Link
              :href="`/cars/${car.id}/book`"
              class="block w-full bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white text-center py-4 px-6 rounded-xl font-bold text-lg hover:from-blue-700 hover:via-blue-800 hover:to-blue-900 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl"
            >
              احجز الآن
            </Link>

            <!-- Contact Info -->
            <div class="mt-6 text-center">
              <p class="text-sm text-gray-600 mb-3">للاستفسارات</p>

              <!-- WhatsApp Button -->
              <a
                :href="`https://wa.me/${contactInfo.whatsapp.replace(/\s/g, '')}?text=مرحبا، أريد الاستفسار عن سيارة ${car.brand_ar || 'تويوتا'} ${car.model_ar || 'كورولا'}`"
                target="_blank"
                class="block w-full bg-gradient-to-r from-green-500 to-green-600 text-white text-center py-3 px-4 rounded-xl font-semibold hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl mb-3"
              >
                <div class="flex items-center justify-center space-x-2 space-x-reverse">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                  </svg>
                  <span>تواصل عبر واتساب</span>
                </div>
              </a>

              <!-- Phone Number -->
              <div class="flex items-center justify-center space-x-2 space-x-reverse text-sm">
                <Phone class="w-4 h-4 text-blue-600" />
                <span class="text-blue-600 font-semibold">{{ contactInfo.phone }}</span>
              </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-8 p-6 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border border-gray-200">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">معلومات مهمة</h3>
              <div class="space-y-3 text-sm text-gray-600">
                <div class="flex items-start space-x-2 space-x-reverse">
                  <ShieldCheck class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>تأمين شامل مجاني</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>إلغاء مجاني قبل 24 ساعة</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>دعم فني 24/7</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>توصيل مجاني</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Car Details Tabs -->
      <div class="mt-12">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
          <div class="border-b border-gray-100">
            <nav class="flex space-x-8 px-8">
              <button
                v-for="tab in tabs"
                :key="tab.id"
                @click="activeTab = tab.id"
                :class="[
                  'py-6 px-1 border-b-2 font-semibold text-sm transition-all duration-300',
                  activeTab === tab.id
                    ? 'border-blue-500 text-blue-600'
                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                ]"
              >
                {{ tab.name }}
              </button>
            </nav>
          </div>

          <div class="p-8">
            <!-- Description Tab -->
            <div v-if="activeTab === 'description'" class="space-y-6">
              <h3 class="text-2xl font-bold text-gray-900 mb-6">وصف السيارة</h3>
              <div class="prose prose-lg max-w-none">
                <p class="text-gray-700 leading-relaxed text-lg">{{ car.description }}</p>
              </div>
            </div>

            <!-- Features Tab -->
            <div v-if="activeTab === 'features'" class="space-y-6">
              <h3 class="text-2xl font-bold text-gray-900 mb-6">المميزات</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                  v-for="feature in car.features"
                  :key="feature"
                  class="flex items-center space-x-3 space-x-reverse bg-gray-50 rounded-xl p-4"
                >
                  <div class="bg-green-100 rounded-full p-2">
                    <Check class="w-5 h-5 text-green-600" />
                  </div>
                  <span class="text-gray-700 font-medium">{{ feature }}</span>
                </div>
              </div>
            </div>

            <!-- Specifications Tab -->
            <div v-if="activeTab === 'specifications'" class="space-y-6">
              <h3 class="text-2xl font-bold text-gray-900 mb-6">المواصفات التفصيلية</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                  <h4 class="text-lg font-semibold text-gray-900 mb-4">المواصفات الأساسية</h4>
                  <div class="space-y-3">
                    <div class="flex justify-between py-3 border-b border-gray-100">
                      <span class="text-gray-600">الماركة</span>
                      <span class="font-semibold text-gray-900">{{ car.brand }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b border-gray-100">
                      <span class="text-gray-600">الموديل</span>
                      <span class="font-semibold text-gray-900">{{ car.model }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b border-gray-100">
                      <span class="text-gray-600">سنة الصنع</span>
                      <span class="font-semibold text-gray-900">{{ car.year }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b border-gray-100">
                      <span class="text-gray-600">اللون</span>
                      <span class="font-semibold text-gray-900">{{ car.color }}</span>
                    </div>
                  </div>
                </div>
                <div class="space-y-4">
                  <h4 class="text-lg font-semibold text-gray-900 mb-4">المواصفات التقنية</h4>
                  <div class="space-y-3">
                    <div class="flex justify-between py-3 border-b border-gray-100">
                      <span class="text-gray-600">نوع الناقل</span>
                      <span class="font-semibold text-gray-900">{{ car.transmission }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b border-gray-100">
                      <span class="text-gray-600">نوع الوقود</span>
                      <span class="font-semibold text-gray-900">{{ car.fuel_type }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b border-gray-100">
                      <span class="text-gray-600">عدد المقاعد</span>
                      <span class="font-semibold text-gray-900">{{ car.seats }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b border-gray-100">
                      <span class="text-gray-600">عدد الأبواب</span>
                      <span class="font-semibold text-gray-900">{{ car.doors }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Additional Information Section -->
      <div class="mt-16">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">معلومات مهمة</h2>
          <p class="text-lg text-gray-600">تعرف على سياساتنا وشروط التأجير</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Insurance Information -->
          <div class="bg-white rounded-2xl shadow-xl p-8 border border-blue-100">
            <div class="text-center mb-6">
              <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <ShieldCheck class="w-8 h-8 text-blue-600" />
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">التأمين الشامل</h3>
            </div>
            <div class="text-sm text-gray-600 leading-relaxed">
              <p v-if="insuranceInfo" class="whitespace-pre-line">{{ insuranceInfo }}</p>
              <div v-else class="space-y-3">
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>تأمين شامل ضد الحوادث</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>تأمين ضد السرقة</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>تأمين ضد الأضرار الطبيعية</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>تأمين المسؤولية المدنية</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Cancellation Policy -->
          <div class="bg-white rounded-2xl shadow-xl p-8 border border-purple-100">
            <div class="text-center mb-6">
              <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">سياسة الإلغاء</h3>
            </div>
            <div class="text-sm text-gray-600 leading-relaxed">
              <p v-if="cancellationPolicy" class="whitespace-pre-line">{{ cancellationPolicy }}</p>
              <div v-else class="space-y-3">
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>إلغاء مجاني قبل 24 ساعة</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>استرداد 50% قبل 12 ساعة</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>لا يمكن الإلغاء قبل 6 ساعات</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>إلغاء فوري في حالة الطوارئ</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Rental Terms -->
          <div class="bg-white rounded-2xl shadow-xl p-8 border border-green-100">
            <div class="text-center mb-6">
              <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">شروط الإيجار</h3>
            </div>
            <div class="text-sm text-gray-600 leading-relaxed">
              <p v-if="rentalTerms" class="whitespace-pre-line">{{ rentalTerms }}</p>
              <div v-else class="space-y-3">
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>يجب أن يكون عمر المستأجر 21 سنة أو أكثر</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>تقديم رخصة قيادة سارية المفعول</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>تقديم هوية شخصية</span>
                </div>
                <div class="flex items-start space-x-2 space-x-reverse">
                  <Check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                  <span>ممنوع التدخين في السيارة</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Contact & Complaints -->
          <div class="bg-white rounded-2xl shadow-xl p-8 border border-red-100">
            <div class="text-center mb-6">
              <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">الشكاوى والاستفسارات</h3>
            </div>
            <div class="space-y-4 text-sm text-gray-600">
              <div class="text-center">
                <p class="font-semibold text-gray-900 mb-2">إيميل الشكاوى:</p>
                <a href="mailto:complaints@wasilk.com" class="text-blue-600 hover:text-blue-700 font-medium">
                  complaints@wasilk.com
                </a>
              </div>
              <div class="text-center">
                <p class="font-semibold text-gray-900 mb-2">إيميل الدعم:</p>
                <a href="mailto:support@wasilk.com" class="text-blue-600 hover:text-blue-700 font-medium">
                  support@wasilk.com
                </a>
              </div>
              <div class="text-center">
                <p class="font-semibold text-gray-900 mb-2">الهاتف:</p>
                <a :href="`tel:${contactInfo.phone.replace(/\s/g, '')}`" class="text-blue-600 hover:text-blue-700 font-medium">
                  {{ contactInfo.phone }}
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Similar Cars -->
      <div v-if="similarCars.length > 0" class="mt-16">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">سيارات مشابهة</h2>
          <p class="text-lg text-gray-600">اكتشف المزيد من السيارات المماثلة</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div
            v-for="similarCar in similarCars"
            :key="similarCar.id"
            class="group bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100"
          >
            <div class="relative overflow-hidden">
              <img
                :src="similarCar.images[0] || '/images/car-placeholder.jpg'"
                :alt="similarCar.full_name"
                class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>



              <div class="absolute top-3 right-3">
                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                  {{ similarCar.category.name }}
                </span>
              </div>

              <div class="absolute bottom-3 left-3">
                <div class="bg-white/90 backdrop-blur-sm rounded-lg px-3 py-2 shadow-lg">
                  <div class="text-lg font-bold text-blue-600">{{ similarCar.daily_rate }}</div>
                  <div class="text-xs text-gray-600">ريال/يوم</div>
                </div>
              </div>
            </div>

            <div class="p-6">
              <!-- Car Name - At the top of the card content -->
              <h3 class="text-xl font-bold text-black mb-4 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300 leading-tight">
                {{ similarCar.brand_ar || 'تويوتا' }} {{ similarCar.model_ar || 'كورولا' }}
              </h3>

              <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2 space-x-reverse">
                  <div class="bg-blue-50 rounded-full p-2">
                    <Users class="w-4 h-4 text-blue-600" />
                  </div>
                  <span class="text-sm text-gray-600">{{ similarCar.seats }} مقاعد</span>
                </div>

                <div class="flex items-center space-x-2 space-x-reverse">
                  <div class="bg-green-50 rounded-full p-2">
                    <Settings class="w-4 h-4 text-green-600" />
                  </div>
                  <span class="text-sm text-gray-600">{{ similarCar.transmission }}</span>
                </div>
              </div>

                             <Link
                 :href="`/cars/${similarCar.id}`"
                 class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white text-center py-3 px-4 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
               >
                 عرض التفاصيل
               </Link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Contact Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">هل تحتاج مساعدة؟</h2>
        <p class="text-xl text-blue-100 mb-8">فريقنا متاح لمساعدتك في أي وقت</p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
          <!-- WhatsApp Button -->
          <a
            :href="`https://wa.me/${contactInfo.whatsapp.replace(/\s/g, '')}?text=مرحبا، أريد الاستفسار عن سيارة ${car.brand_ar || 'تويوتا'} ${car.model_ar || 'كورولا'}`"
            target="_blank"
            class="bg-green-500 text-white px-8 py-4 rounded-xl font-semibold hover:bg-green-600 transition duration-300 flex items-center space-x-2 space-x-reverse"
          >
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
            </svg>
            <span>تواصل عبر واتساب</span>
          </a>

          <!-- Phone Button -->
          <a
            :href="`tel:${contactInfo.phone.replace(/\s/g, '')}`"
            class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-blue-600 transition duration-300 flex items-center space-x-2 space-x-reverse"
          >
            <Phone class="w-6 h-6" />
            <span>اتصل الآن</span>
          </a>
        </div>

        <div class="mt-6 text-blue-100">
          <p>أو راسلنا على: <span class="font-semibold">{{ contactInfo.phone }}</span></p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import Header from '../../components/Header.vue'
import {
  Users,
  DoorOpen,
  Settings,
  Droplets,
  MapPin,
  Check,
  Heart,
  Phone,
  ShieldCheck
} from 'lucide-vue-next'

const props = defineProps({
  car: Object,
  similarCars: Array,
})

const selectedImage = ref(props.car.images?.[0] || null)
const activeTab = ref('description')
const insuranceInfo = ref('')
const cancellationPolicy = ref('')
const rentalTerms = ref('')
const contactInfo = ref({
  phone: '+966558587908',
  whatsapp: '+966558587908'
})

const tabs = [
  { id: 'description', name: 'الوصف' },
  { id: 'features', name: 'المميزات' },
  { id: 'specifications', name: 'المواصفات' },
]

const fetchPoliciesInfo = async () => {
  try {
    const response = await fetch('/api/settings/policies')
    const data = await response.json()
    if (data.success) {
      insuranceInfo.value = data.data.insurance_info || 'جميع السيارات مؤمنة بالكامل'
      cancellationPolicy.value = data.data.cancellation_policy || 'يمكن إلغاء الحجز قبل 24 ساعة من تاريخ الاستلام'
      rentalTerms.value = data.data.rental_terms || 'يجب أن يكون عمر المستأجر 21 سنة أو أكثر'
    }
  } catch (error) {
    console.error('Error fetching policies info:', error)
    insuranceInfo.value = 'جميع السيارات مؤمنة بالكامل'
    cancellationPolicy.value = 'يمكن إلغاء الحجز قبل 24 ساعة من تاريخ الاستلام'
    rentalTerms.value = 'يجب أن يكون عمر المستأجر 21 سنة أو أكثر'
  }
}

const fetchContactInfo = async () => {
  try {
    const response = await fetch('/api/settings/contact')
    const data = await response.json()
    if (data.success) {
      contactInfo.value = {
        phone: data.data.phone || '+966558587908',
        whatsapp: data.data.whatsapp || '+966558587908'
      }
    }
  } catch (error) {
    console.error('Error fetching contact info:', error)
    contactInfo.value = {
      phone: '+966558587908',
      whatsapp: '+966558587908'
    }
  }
}

onMounted(() => {
  fetchPoliciesInfo()
  fetchContactInfo()
})

const formatPrice = (price) => {
  return new Intl.NumberFormat('ar-SA').format(price)
}
</script>
