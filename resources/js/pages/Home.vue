<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <Header />

    <!-- Success Modal -->
    <div v-if="flash && flash.success && showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" @click="closeModal">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all" @click.stop>
        <!-- Header -->
        <div class="bg-green-500 rounded-t-lg px-6 py-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <svg class="w-6 h-6 text-white mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
              <h3 class="text-lg font-semibold text-white">تم الحجز بنجاح!</h3>
            </div>
          </div>
        </div>

        <!-- Content -->
        <div class="px-6 py-6">
          <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
              <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
            <p class="text-gray-700 text-sm leading-relaxed mb-6">
              {{ flash.success }}
            </p>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
              <div class="flex items-center text-blue-800">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-sm font-medium">معلومات مهمة</span>
              </div>
              <p class="text-blue-700 text-xs mt-2">
                سيتم التواصل معك خلال 24 ساعة لتأكيد تفاصيل الحجز والدفع
              </p>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 px-6 py-4 rounded-b-lg">
          <div class="flex flex-col sm:flex-row gap-3">
            <Link
              href="/cars"
              class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg text-center font-medium hover:bg-blue-700 transition duration-200"
            >
              استعرض المزيد من السيارات
            </Link>
            <button
              @click="closeModal"
              class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-400 transition duration-200"
            >
              إغلاق
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white">
      <div class="absolute inset-0 bg-black opacity-20"></div>
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
          <h1 class="text-4xl md:text-6xl font-bold mb-6">
            استأجر سيارتك وانت بمكانك
          </h1>
          <p class="text-xl md:text-2xl mb-8 text-blue-100">
            السيارة توصلك… من واصل لك
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <Link
              href="/cars"
              class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300"
            >
              استعرض السيارات
            </Link>
            <Link
              href="/cars/featured"
              class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300"
            >
              السيارات المميزة
            </Link>
          </div>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div class="text-center">
            <div class="text-4xl font-bold text-blue-600 mb-2">+1000</div>
            <div class="text-gray-600">عميل راضي</div>
          </div>
          <div class="text-center">
            <div class="text-4xl font-bold text-blue-600 mb-2">+50</div>
            <div class="text-gray-600">سيارة متنوعة</div>
          </div>
          <div class="text-center">
            <div class="text-4xl font-bold text-blue-600 mb-2">24/7</div>
            <div class="text-gray-600">خدمة دعم</div>
          </div>
          <div class="text-center">
            <div class="text-4xl font-bold text-blue-600 mb-2">+5</div>
            <div class="text-gray-600">فروع</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">لماذا تختار واصل لك</h2>
          <p class="text-lg text-gray-600">نقدم لكم أفضل خدمة تأجير سيارات</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div class="group bg-yellow-50 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-yellow-100 p-6 text-center">
            <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
              <ThumbsUp class="w-8 h-8 text-red-600" />
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">سهولة الحجز</h3>
            <p class="text-sm text-gray-600">احجز سيارتك بسهولة وسرعة</p>
          </div>

          <div class="group bg-yellow-50 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-yellow-100 p-6 text-center">
            <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
              <FileText class="w-8 h-8 text-red-600" />
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">إجراءات سهلة</h3>
            <p class="text-sm text-gray-600">إجراءات بسيطة وسريعة</p>
          </div>

          <div class="group bg-yellow-50 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-yellow-100 p-6 text-center">
            <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
              <Truck class="w-8 h-8 text-red-600" />
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">سيارتك توصلك لعندك</h3>
            <p class="text-sm text-gray-600">خدمة التوصيل للمنزل</p>
          </div>

          <div class="group bg-yellow-50 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-yellow-100 p-6 text-center">
            <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
              <Car class="w-8 h-8 text-red-600" />
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">أسطول سيارات اقتصادية</h3>
            <p class="text-sm text-gray-600">متنوعة</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Latest Cars Section -->
    <section class="py-16 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">أحدث السيارات</h2>
          <p class="text-lg text-gray-600">اكتشف أحدث الإضافات إلى أسطولنا</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
          <div
            v-for="car in latestCars"
            :key="car.id"
            class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-200"
          >
            <!-- Image Section -->
            <div class="relative overflow-hidden">
              <img
                :src="car.images[0] || '/images/car-placeholder.jpg'"
                :alt="car.full_name"
                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
              />
              <!-- Gradient Overlay -->
              <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/10 to-transparent"></div>



              <!-- Category Badge -->
              <div class="absolute top-4 right-4">
                <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-full text-sm font-bold shadow-xl">
                  {{ car.category.name }}
                </span>
              </div>

              <!-- Price Badge -->
              <div class="absolute bottom-4 left-4">
                <div class="bg-white/95 backdrop-blur-md rounded-xl px-4 py-3 shadow-2xl border border-white/20">
                  <div class="text-2xl font-bold text-blue-600">{{ car.daily_rate }}</div>
                  <div class="text-sm text-gray-600 font-medium">ريال/يوم</div>
                </div>
              </div>

              <!-- Favorite Button -->
              <div class="absolute top-4 left-4">
                <button class="bg-white/90 backdrop-blur-sm rounded-full p-3 shadow-lg hover:bg-red-50 transition-all duration-300 group-hover:scale-110">
                  <Heart class="w-5 h-5 text-gray-600 group-hover:text-red-500 transition-colors duration-300" />
                </button>
              </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
              <!-- Car Name - At the top of the card content -->
              <h3 class="text-2xl font-bold text-black mb-6 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300 leading-tight">
                {{ car.brand_ar || 'تويوتا' }} {{ car.model_ar || 'كورولا' }}
              </h3>

              <!-- Car Specs Grid -->
              <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="flex items-center space-x-3 space-x-reverse bg-gray-50 rounded-xl p-3">
                  <div class="bg-blue-100 rounded-full p-2">
                    <Users class="w-5 h-5 text-blue-600" />
                  </div>
                  <div>
                    <div class="text-sm text-gray-500">المقاعد</div>
                    <div class="font-semibold text-gray-900">{{ car.seats }}</div>
                  </div>
                </div>

                <div class="flex items-center space-x-3 space-x-reverse bg-gray-50 rounded-xl p-3">
                  <div class="bg-green-100 rounded-full p-2">
                    <Settings class="w-5 h-5 text-green-600" />
                  </div>
                  <div>
                    <div class="text-sm text-gray-500">ناقل الحركة</div>
                    <div class="font-semibold text-gray-900">{{ car.transmission }}</div>
                  </div>
                </div>
              </div>

              <!-- Fuel Type -->
              <div class="flex items-center space-x-3 space-x-reverse bg-gray-50 rounded-xl p-3 mb-6">
                <div class="bg-orange-100 rounded-full p-2">
                  <Droplets class="w-5 h-5 text-orange-600" />
                </div>
                <div>
                  <div class="text-sm text-gray-500">نوع الوقود</div>
                  <div class="font-semibold text-gray-900">{{ car.fuel_type }}</div>
                </div>
              </div>

              <!-- Additional Info -->
              <div class="flex items-center justify-between mb-6 p-4 bg-blue-50 rounded-xl">
                <div class="text-center">
                  <div class="text-2xl font-bold text-blue-600">{{ car.daily_rate }}</div>
                  <div class="text-sm text-gray-600">ريال/يوم</div>
                </div>
                <div class="text-center">
                  <div class="text-lg font-bold text-gray-900">متاح</div>
                  <div class="text-sm text-green-600">●</div>
                </div>
              </div>

              <!-- Action Button -->
              <Link
                :href="`/cars/${car.id}`"
                class="block w-full bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white text-center py-4 px-6 rounded-xl font-bold text-lg hover:from-blue-700 hover:via-blue-800 hover:to-blue-900 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl"
              >
                عرض التفاصيل
              </Link>
            </div>
          </div>
        </div>
        <div class="text-center mt-12">
          <Link
            href="/cars"
            class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition duration-300"
          >
            عرض جميع السيارات
          </Link>
        </div>
      </div>
    </section>

    <!-- Special Offers Section -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">العروض الخاصة</h2>
          <p class="text-lg text-gray-600">احصل على أفضل العروض والخصومات</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="relative z-10">
              <h3 class="text-2xl font-bold mb-4">خصم 20%</h3>
              <p class="text-red-100 mb-6">للحجوزات الأسبوعية</p>
              <Link href="/cars" class="bg-white text-red-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 inline-block">
                احجز الآن
              </Link>
            </div>
          </div>

          <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="relative z-10">
              <h3 class="text-2xl font-bold mb-4">خصم 30%</h3>
              <p class="text-blue-100 mb-6">للحجوزات الشهرية</p>
              <Link href="/cars" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 inline-block">
                احجز الآن
              </Link>
            </div>
          </div>

          <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="relative z-10">
              <h3 class="text-2xl font-bold mb-4">عرض الطلاب</h3>
              <p class="text-green-100 mb-6">خصم 15% للطلاب</p>
              <Link href="/cars" class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 inline-block">
                احجز الآن
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">خدماتنا</h2>
          <p class="text-lg text-gray-600">نقدم مجموعة شاملة من الخدمات</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition duration-300">
            <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <Car class="w-8 h-8 text-blue-600" />
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">تأجير السيارات</h3>
            <p class="text-gray-600">سيارات متنوعة بأسعار تنافسية</p>
          </div>

          <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition duration-300">
            <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <Truck class="w-8 h-8 text-green-600" />
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">التوصيل</h3>
            <p class="text-gray-600">نوصل السيارة إلى باب منزلك</p>
          </div>

          <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition duration-300">
            <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <ShieldCheck class="w-8 h-8 text-purple-600" />
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">التأمين</h3>
            <p class="text-gray-600">تأمين شامل على جميع السيارات</p>
          </div>

          <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition duration-300">
            <div class="bg-orange-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <Clock class="w-8 h-8 text-orange-600" />
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">دعم 24/7</h3>
            <p class="text-gray-600">خدمة عملاء متاحة على مدار الساعة</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">آراء العملاء</h2>
          <p class="text-lg text-gray-600">ماذا يقول عملاؤنا عنا</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-gray-50 rounded-xl p-6">
            <div class="flex items-center mb-4">
              <div class="text-yellow-400 flex">
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
              </div>
            </div>
            <p class="text-gray-700 mb-4">"خدمة ممتازة وسيارات نظيفة. أنصح الجميع بالتعامل معهم"</p>
            <div class="flex items-center">
              <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                أ
              </div>
              <div>
                <div class="font-semibold text-gray-900">أحمد محمد</div>
                <div class="text-sm text-gray-600">عميل دائم</div>
              </div>
            </div>
          </div>

          <div class="bg-gray-50 rounded-xl p-6">
            <div class="flex items-center mb-4">
              <div class="text-yellow-400 flex">
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
              </div>
            </div>
            <p class="text-gray-700 mb-4">"أسعار معقولة وخدمة سريعة. سأتعامل معهم مرة أخرى"</p>
            <div class="flex items-center">
              <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                س
              </div>
              <div>
                <div class="font-semibold text-gray-900">سارة أحمد</div>
                <div class="text-sm text-gray-600">عميلة جديدة</div>
              </div>
            </div>
          </div>

          <div class="bg-gray-50 rounded-xl p-6">
            <div class="flex items-center mb-4">
              <div class="text-yellow-400 flex">
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
                <Star class="w-5 h-5 fill-current" />
              </div>
            </div>
            <p class="text-gray-700 mb-4">"سيارات حديثة ونظيفة. الخدمة كانت ممتازة"</p>
            <div class="flex items-center">
              <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                م
              </div>
              <div>
                <div class="font-semibold text-gray-900">محمد علي</div>
                <div class="text-sm text-gray-600">عميل منتظم</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-blue-600 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold mb-4">لماذا تختارنا؟</h2>
          <p class="text-xl text-blue-100">نقدم أفضل خدمة تأجير سيارات</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="text-center">
            <div class="bg-blue-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <ShieldCheck class="w-8 h-8" />
            </div>
            <h3 class="text-xl font-semibold mb-2">سيارات آمنة</h3>
            <p class="text-blue-100">جميع سياراتنا مؤمنة ومفحوصة دورياً</p>
          </div>
          <div class="text-center">
            <div class="bg-blue-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <Clock class="w-8 h-8" />
            </div>
            <h3 class="text-xl font-semibold mb-2">خدمة 24/7</h3>
            <p class="text-blue-100">دعم فني متاح على مدار الساعة</p>
          </div>
          <div class="text-center">
            <div class="bg-blue-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <CreditCard class="w-8 h-8" />
            </div>
            <h3 class="text-xl font-semibold mb-2">أسعار تنافسية</h3>
            <p class="text-blue-100">أفضل الأسعار مع خصومات خاصة</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="py-16 bg-gray-900 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">هل تحتاج مساعدة؟</h2>
        <p class="text-xl text-gray-300 mb-8">فريقنا متاح لمساعدتك في أي وقت</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <!-- WhatsApp Button -->
          <a
            href="https://wa.me/966558587908?text=مرحبا، أريد الاستفسار عن خدمات تأجير السيارات"
            target="_blank"
            class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300 flex items-center justify-center space-x-2 space-x-reverse"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
            </svg>
            <span>واتساب</span>
          </a>

          <Link
            href="/contact"
            class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300"
          >
            اتصل بنا
          </Link>
          <Link
            href="/location"
            class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition duration-300"
          >
            موقعنا
          </Link>
        </div>

        <div class="mt-6 text-gray-300">
          <p>أو راسلنا على: <span class="font-semibold">+966 50 123 4567</span></p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { ref, onMounted, onUnmounted } from 'vue'
import Header from '../components/Header.vue'
import {
  ShieldCheck,
  Clock,
  CreditCard,
  Users,
  Settings,
  Droplets,
  ThumbsUp,
  FileText,
  Truck,
  Car,
  Heart,
  Star
} from 'lucide-vue-next'

defineProps({
  latestCars: Array,
  flash: Object,
})

const $page = usePage()

// Modal state
const showModal = ref(true)

// Close modal function
const closeModal = () => {
  showModal.value = false
  // Clear flash message from session
  window.location.href = '/'
}

// Close modal on ESC key
const handleKeydown = (event) => {
  if (event.key === 'Escape' && flash && flash.success) {
    closeModal()
  }
}

// Add event listener
onMounted(() => {
  document.addEventListener('keydown', handleKeydown)
})

onUnmounted(() => {
  document.removeEventListener('keydown', handleKeydown)
})

// Local route function
const route = (name, params = {}) => {
  const baseUrl = window.location.origin

  const routes = {
    'home': '/',
    'cars.index': '/cars',
    'cars.featured': '/cars/featured',
    'cars.show': (params) => `/cars/${params.id || params.car}`,
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
</script>
