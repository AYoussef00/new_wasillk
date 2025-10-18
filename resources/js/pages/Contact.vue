<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <Header />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 text-white py-20 overflow-hidden">
      <!-- Enhanced Animated Background -->
      <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-indigo-600/20"></div>
        <div class="absolute top-0 left-0 w-full h-full">
          <!-- Floating Elements -->
          <div class="absolute top-20 left-10 w-72 h-72 bg-white/5 rounded-full blur-3xl animate-pulse"></div>
          <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
          <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-indigo-400/5 rounded-full blur-3xl animate-pulse delay-500"></div>

          <!-- Additional floating elements -->
          <div class="absolute top-1/4 right-1/4 w-32 h-32 bg-white/3 rounded-full blur-2xl animate-bounce delay-700"></div>
          <div class="absolute bottom-1/3 left-1/3 w-48 h-48 bg-blue-300/5 rounded-full blur-3xl animate-pulse delay-300"></div>

          <!-- Geometric shapes -->
          <div class="absolute top-16 right-16 w-4 h-4 bg-white/20 rotate-45 animate-spin"></div>
          <div class="absolute bottom-16 left-16 w-6 h-6 bg-blue-300/30 rounded-full animate-ping"></div>
        </div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
          <!-- Enhanced Icon -->
          <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-3xl mb-8 border border-white/20 hover:bg-white/20 transition-all duration-500 group">
            <svg class="w-10 h-10 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
          </div>

          <!-- Enhanced Title -->
          <h1 class="text-5xl md:text-7xl font-black mb-8 bg-gradient-to-r from-white via-blue-100 to-indigo-200 bg-clip-text text-transparent leading-tight">
            اتصل بنا
          </h1>

          <!-- Enhanced Description -->
          <p class="text-xl md:text-2xl text-blue-100 max-w-4xl mx-auto leading-relaxed font-light mb-12">
            نحن هنا لمساعدتك في كل ما تحتاجه. تواصل معنا وسنرد عليك في أقرب وقت ممكن
          </p>

          <!-- Enhanced Status Badge -->
          <div class="flex justify-center">
            <div class="inline-flex items-center space-x-4 space-x-reverse bg-white/10 backdrop-blur-sm rounded-3xl px-10 py-5 border border-white/20 hover:bg-white/20 transition-all duration-500 group">
              <div class="w-4 h-4 bg-green-400 rounded-full animate-pulse group-hover:animate-ping"></div>
              <span class="text-blue-100 font-semibold text-lg">متاحون الآن للرد على استفساراتك</span>
            </div>
          </div>

          <!-- Quick Contact Buttons -->
          <div class="mt-12 flex flex-col sm:flex-row gap-6 justify-center items-center">
            <a
              :href="`tel:${contactInfo.phone.replace(/\s/g, '')}`"
              class="inline-flex items-center bg-white/10 backdrop-blur-sm text-white px-8 py-4 rounded-2xl font-semibold hover:bg-white/20 transition-all duration-300 transform hover:scale-105 border border-white/20"
            >
              <Phone class="w-5 h-5 ml-3" />
              اتصل الآن
            </a>
            <a
              :href="`https://wa.me/${contactInfo.whatsapp.replace(/\s/g, '')}?text=مرحبا، أريد الاستفسار عن خدمات تأجير السيارات`"
              target="_blank"
              class="inline-flex items-center bg-green-600/20 backdrop-blur-sm text-white px-8 py-4 rounded-2xl font-semibold hover:bg-green-600/30 transition-all duration-300 transform hover:scale-105 border border-green-400/30"
            >
              <svg class="w-5 h-5 ml-3" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
              </svg>
              واتساب
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Content -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
          <!-- Contact Form -->
          <div class="bg-white rounded-lg p-8 border border-gray-200">
            <div class="mb-8">
              <h2 class="text-2xl font-bold text-gray-900 mb-2">أرسل لنا رسالة</h2>
              <p class="text-gray-600">سنرد عليك في أقرب وقت ممكن</p>
            </div>

            <form @submit.prevent="submitForm" class="space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    الاسم الكامل
                  </label>
                  <input
                    v-model="form.name"
                    type="text"
                    id="name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                  />
                </div>

                <div>
                  <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    البريد الإلكتروني
                  </label>
                  <input
                    v-model="form.email"
                    type="email"
                    id="email"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                  />
                </div>
              </div>

              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                  رقم الهاتف
                </label>
                <input
                  v-model="form.phone"
                  type="tel"
                  id="phone"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  required
                />
              </div>

              <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                  الموضوع
                </label>
                <select
                  v-model="form.subject"
                  id="subject"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  required
                >
                  <option value="">اختر الموضوع</option>
                  <option value="استفسار عام">استفسار عام</option>
                  <option value="حجز سيارة">حجز سيارة</option>
                  <option value="شكوى">شكوى</option>
                  <option value="اقتراح">اقتراح</option>
                  <option value="شراكة">شراكة</option>
                </select>
              </div>

              <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                  الرسالة
                </label>
                <textarea
                  v-model="form.message"
                  id="message"
                  rows="5"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                  required
                ></textarea>
              </div>

              <button
                type="submit"
                class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                :disabled="form.processing"
              >
                {{ form.processing ? 'جاري الإرسال...' : 'إرسال الرسالة' }}
              </button>
            </form>
          </div>

          <!-- Contact Information -->
          <div class="space-y-12">
            <!-- Header Section -->
            <div class="text-center lg:text-right mb-16">
              <h2 class="text-4xl font-bold text-gray-900 mb-4">معلومات التواصل</h2>
              <p class="text-lg text-gray-600">تواصل معنا بأي طريقة تفضلها</p>
            </div>

            <!-- Contact Cards -->
            <div class="space-y-6">
              <!-- Phone -->
              <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-gray-300 transition-colors duration-200">
                <div class="flex items-center space-x-4 space-x-reverse">
                  <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                      <Phone class="w-6 h-6 text-gray-600" />
                    </div>
                  </div>
                  <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">الهاتف</h3>
                    <p class="text-gray-600 mb-3">{{ contactInfo.phone }}</p>
                    <a
                      :href="`tel:${contactInfo.phone.replace(/\s/g, '')}`"
                      class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium"
                    >
                      <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                      </svg>
                      اتصل الآن
                    </a>
                  </div>
                </div>
              </div>

              <!-- WhatsApp -->
              <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-gray-300 transition-colors duration-200">
                <div class="flex items-center space-x-4 space-x-reverse">
                  <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                      <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                      </svg>
                    </div>
                  </div>
                  <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">واتساب</h3>
                    <p class="text-gray-600 mb-3">{{ contactInfo.whatsapp }}</p>
                    <a
                      :href="`https://wa.me/${contactInfo.whatsapp.replace(/\s/g, '')}?text=مرحبا، أريد الاستفسار عن خدمات تأجير السيارات`"
                      target="_blank"
                      class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium"
                    >
                      <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                      </svg>
                      تواصل عبر واتساب
                    </a>
                  </div>
                </div>
              </div>

              <!-- Email -->
              <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-gray-300 transition-colors duration-200">
                <div class="flex items-center space-x-4 space-x-reverse">
                  <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                      <Mail class="w-6 h-6 text-gray-600" />
                    </div>
                  </div>
                  <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">البريد الإلكتروني</h3>
                    <p class="text-gray-600 mb-3">{{ contactInfo.email }}</p>
                    <a
                      :href="`mailto:${contactInfo.email}`"
                      class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium"
                    >
                      <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                      </svg>
                      أرسل بريد إلكتروني
                    </a>
                  </div>
                </div>
              </div>

              <!-- Address -->
              <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-gray-300 transition-colors duration-200">
                <div class="flex items-center space-x-4 space-x-reverse">
                  <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                      <MapPin class="w-6 h-6 text-gray-600" />
                    </div>
                  </div>
                  <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">العنوان</h3>
                    <p class="text-gray-600 mb-3">{{ contactInfo.address }}</p>
                    <a
                      :href="contactInfo.google_maps_link"
                      target="_blank"
                      class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium"
                    >
                      <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                      </svg>
                      عرض على الخريطة
                    </a>
                  </div>
                </div>
              </div>

              <!-- Working Hours -->
              <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-gray-300 transition-colors duration-200">
                <div class="flex items-center space-x-4 space-x-reverse">
                  <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                      <Clock class="w-6 h-6 text-gray-600" />
                    </div>
                  </div>
                  <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">ساعات العمل</h3>
                    <div class="space-y-2">
                      <div class="flex justify-between items-center">
                        <span class="text-gray-600">الأحد - الخميس</span>
                        <span class="font-medium text-gray-900">8:00 ص - 8:00 م</span>
                      </div>
                      <div class="flex justify-between items-center">
                        <span class="text-gray-600">الجمعة - السبت</span>
                        <span class="font-medium text-gray-900">9:00 ص - 6:00 م</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Additional Info Section -->
    <section class="py-16 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">لماذا تختار واصل لك؟</h2>
          <p class="text-lg text-gray-600 max-w-2xl mx-auto">نحن نقدم أفضل خدمات تأجير السيارات مع ضمان الجودة والموثوقية</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="text-center bg-white rounded-lg p-8 border border-gray-200">
            <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-6">
              <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">خدمة 24/7</h3>
            <p class="text-gray-600">نحن متاحون على مدار الساعة لمساعدتك في أي وقت تحتاج فيه</p>
          </div>

          <div class="text-center bg-white rounded-lg p-8 border border-gray-200">
            <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-6">
              <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">أسعار تنافسية</h3>
            <p class="text-gray-600">نقدم أفضل الأسعار مع ضمان الجودة والخدمة الممتازة</p>
          </div>

          <div class="text-center bg-white rounded-lg p-8 border border-gray-200">
            <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-6">
              <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">سرعة في الاستجابة</h3>
            <p class="text-gray-600">نرد على استفساراتك في أسرع وقت ممكن</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue'
import { useForm } from '@inertiajs/vue3'
import Header from '../components/Header.vue'
import {
  Phone,
  Mail,
  MapPin,
  Clock
} from 'lucide-vue-next'

const form = useForm({
  name: '',
  email: '',
  phone: '',
  subject: '',
  message: ''
})

// Contact info from API
const contactInfo = ref({
  phone: '+966558587908',
  whatsapp: '+966558587908',
  email: 'info@wasillk.com',
  address: 'الدرعية - طريق الأمير عبدالله بن عبدالرحمن، الرياض، المملكة العربية السعودية',
  google_maps_link: 'https://maps.app.goo.gl/J1FPhWPzNBLq8qXC9?g_st=iw'
})

// Fetch contact info from API
const fetchContactInfo = async () => {
  try {
    const response = await fetch('/api/settings/contact')
    const data = await response.json()
    if (data.success) {
      contactInfo.value = data.data
    }
  } catch (error) {
    console.error('Error fetching contact info:', error)
  }
}

onMounted(() => {
  fetchContactInfo()
})

const submitForm = () => {
  form.post('/contact', {
    onSuccess: () => {
      form.reset()
      alert('تم إرسال رسالتك بنجاح! سنرد عليك في أقرب وقت ممكن.')
    }
  })
}
</script>

