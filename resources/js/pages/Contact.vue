<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <!-- Header -->
    <Header />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 text-white py-16 overflow-hidden">
      <!-- Animated Background -->
      <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-indigo-600/20"></div>
        <div class="absolute top-0 left-0 w-full h-full">
          <div class="absolute top-20 left-10 w-72 h-72 bg-white/5 rounded-full blur-3xl animate-pulse"></div>
          <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
          <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-indigo-400/5 rounded-full blur-3xl animate-pulse delay-500"></div>
        </div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
          <div class="inline-flex items-center justify-center w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl mb-6 border border-white/20">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
          </div>
          <h1 class="text-4xl md:text-6xl font-black mb-6 bg-gradient-to-r from-white via-blue-100 to-indigo-200 bg-clip-text text-transparent leading-tight">
            اتصل بنا
          </h1>
          <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-light">
            نحن هنا لمساعدتك في كل ما تحتاجه. تواصل معنا وسنرد عليك في أقرب وقت ممكن
          </p>
          <div class="mt-8 flex justify-center">
            <div class="inline-flex items-center space-x-4 space-x-reverse bg-white/10 backdrop-blur-sm rounded-2xl px-8 py-4 border border-white/20">
              <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
              <span class="text-blue-100 font-medium">متاحون الآن للرد على استفساراتك</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Content -->
    <section class="py-24 bg-white relative">
      <!-- Decorative Elements -->
      <div class="absolute top-0 left-0 w-64 h-64 bg-gradient-to-br from-blue-100/50 to-transparent rounded-full -translate-x-32 -translate-y-32"></div>
      <div class="absolute bottom-0 right-0 w-80 h-80 bg-gradient-to-tl from-indigo-100/50 to-transparent rounded-full translate-x-40 translate-y-40"></div>
      <div class="absolute top-1/2 left-1/4 w-32 h-32 bg-blue-200/30 rounded-full blur-2xl"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
          <!-- Contact Form -->
          <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100 relative overflow-hidden">
            <!-- Form Background Pattern -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-blue-50 to-transparent rounded-full -translate-y-16 translate-x-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-indigo-50 to-transparent rounded-full translate-y-12 -translate-x-12"></div>

            <div class="relative z-10">
              <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl mb-6 shadow-lg">
                  <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                  </svg>
                </div>
                <h2 class="text-4xl font-bold text-gray-900 mb-3">أرسل لنا رسالة</h2>
                <p class="text-gray-600 text-lg">سنرد عليك في أقرب وقت ممكن</p>
              </div>

              <form @submit.prevent="submitForm" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                  <div class="group">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-3 group-focus-within:text-blue-600 transition-colors">
                      الاسم الكامل
                    </label>
                    <div class="relative">
                      <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                      </div>
                      <input
                        v-model="form.name"
                        type="text"
                        id="name"
                        class="w-full pr-12 pl-5 py-5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 bg-gray-50/50 focus:bg-white text-lg"
                        required
                      />
                    </div>
                  </div>

                  <div class="group">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-3 group-focus-within:text-blue-600 transition-colors">
                      البريد الإلكتروني
                    </label>
                    <div class="relative">
                      <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                      </div>
                      <input
                        v-model="form.email"
                        type="email"
                        id="email"
                        class="w-full pr-12 pl-5 py-5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 bg-gray-50/50 focus:bg-white text-lg"
                        required
                      />
                    </div>
                  </div>
                </div>

                <div class="group">
                  <label for="phone" class="block text-sm font-semibold text-gray-700 mb-3 group-focus-within:text-blue-600 transition-colors">
                    رقم الهاتف
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                      </svg>
                    </div>
                    <input
                      v-model="form.phone"
                      type="tel"
                      id="phone"
                      class="w-full pr-12 pl-5 py-5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 bg-gray-50/50 focus:bg-white text-lg"
                      required
                    />
                  </div>
                </div>

                <div class="group">
                  <label for="subject" class="block text-sm font-semibold text-gray-700 mb-3 group-focus-within:text-blue-600 transition-colors">
                    الموضوع
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                      </svg>
                    </div>
                    <select
                      v-model="form.subject"
                      id="subject"
                      class="w-full pr-12 pl-5 py-5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 bg-gray-50/50 focus:bg-white text-lg appearance-none"
                      required
                    >
                      <option value="">اختر الموضوع</option>
                      <option value="استفسار عام">استفسار عام</option>
                      <option value="حجز سيارة">حجز سيارة</option>
                      <option value="شكوى">شكوى</option>
                      <option value="اقتراح">اقتراح</option>
                      <option value="شراكة">شراكة</option>
                    </select>
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                    </div>
                  </div>
                </div>

                <div class="group">
                  <label for="message" class="block text-sm font-semibold text-gray-700 mb-3 group-focus-within:text-blue-600 transition-colors">
                    الرسالة
                  </label>
                  <div class="relative">
                    <div class="absolute top-5 right-4 flex items-start pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400 mt-1 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                      </svg>
                    </div>
                    <textarea
                      v-model="form.message"
                      id="message"
                      rows="6"
                      class="w-full pr-12 pl-5 py-5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 bg-gray-50/50 focus:bg-white text-lg resize-none"
                      required
                    ></textarea>
                  </div>
                </div>

                <button
                  type="submit"
                  class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-6 px-8 rounded-2xl font-bold text-xl hover:from-blue-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none relative overflow-hidden group"
                  :disabled="form.processing"
                >
                  <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-500 opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                  <div class="relative flex items-center justify-center space-x-3 space-x-reverse">
                    <svg v-if="!form.processing" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <svg v-else class="animate-spin w-6 h-6" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>{{ form.processing ? 'جاري الإرسال...' : 'إرسال الرسالة' }}</span>
                  </div>
                </button>
              </form>
            </div>
          </div>

          <!-- Contact Information -->
          <div class="space-y-8">
            <div class="text-center lg:text-right mb-16">
              <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl mb-6 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
              </div>
              <h2 class="text-4xl font-bold text-gray-900 mb-3">معلومات التواصل</h2>
              <p class="text-gray-600 text-lg">تواصل معنا بأي طريقة تفضلها</p>
            </div>

            <div class="space-y-8">
              <!-- Phone -->
              <div class="group bg-gradient-to-br from-gray-50 to-blue-50/30 rounded-3xl p-8 border border-gray-200 hover:border-blue-300 transition-all duration-500 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start space-x-6 space-x-reverse">
                  <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-5 group-hover:scale-110 transition-transform duration-500 shadow-lg">
                    <Phone class="w-7 h-7 text-white" />
                  </div>
                  <div class="flex-1">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">الهاتف</h3>
                    <p class="text-xl text-gray-700 mb-4 font-medium">+966 55 8588 097</p>
                    <a
                      href="tel:+966558588097"
                      class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-2xl font-semibold hover:from-blue-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
                    >
                      <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                      </svg>
                      اتصل الآن
                    </a>
                  </div>
                </div>
              </div>

              <!-- WhatsApp -->
              <div class="group bg-gradient-to-br from-gray-50 to-blue-50/30 rounded-3xl p-8 border border-gray-200 hover:border-blue-300 transition-all duration-500 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start space-x-6 space-x-reverse">
                  <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-5 group-hover:scale-110 transition-transform duration-500 shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                    </svg>
                  </div>
                  <div class="flex-1">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">واتساب</h3>
                    <p class="text-xl text-gray-700 mb-4 font-medium">+966 55 8588 097</p>
                    <a
                      href="https://wa.me/966558588097?text=مرحبا، أريد الاستفسار عن خدمات تأجير السيارات"
                      target="_blank"
                      class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-2xl font-semibold hover:from-blue-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
                    >
                      <svg class="w-5 h-5 ml-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                      </svg>
                      تواصل عبر واتساب
                    </a>
                  </div>
                </div>
              </div>

              <!-- Email -->
              <div class="group bg-gradient-to-br from-gray-50 to-blue-50/30 rounded-3xl p-8 border border-gray-200 hover:border-blue-300 transition-all duration-500 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start space-x-6 space-x-reverse">
                  <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-5 group-hover:scale-110 transition-transform duration-500 shadow-lg">
                    <Mail class="w-7 h-7 text-white" />
                  </div>
                  <div class="flex-1">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">البريد الإلكتروني</h3>
                    <p class="text-xl text-gray-700 mb-4 font-medium">info@wasillk.com</p>
                    <a
                      href="mailto:info@wasillk.com"
                      class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-2xl font-semibold hover:from-blue-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
                    >
                      <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                      </svg>
                      أرسل بريد إلكتروني
                    </a>
                  </div>
                </div>
              </div>

              <!-- Address -->
              <div class="group bg-gradient-to-br from-gray-50 to-blue-50/30 rounded-3xl p-8 border border-gray-200 hover:border-blue-300 transition-all duration-500 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start space-x-6 space-x-reverse">
                  <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-5 group-hover:scale-110 transition-transform duration-500 shadow-lg">
                    <MapPin class="w-7 h-7 text-white" />
                  </div>
                  <div class="flex-1">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">العنوان</h3>
                    <p class="text-xl text-gray-700 mb-2 font-medium">الدرعية - طريق الأمير عبدالله بن عبدالرحمن</p>
                    <p class="text-gray-600 mb-4">الرياض، المملكة العربية السعودية</p>
                    <a
                      href="https://maps.app.goo.gl/J1FPhWPzNBLq8qXC9?g_st=iw"
                      target="_blank"
                      class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-2xl font-semibold hover:from-blue-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
                    >
                      <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                      </svg>
                      عرض على الخريطة
                    </a>
                  </div>
                </div>
              </div>

              <!-- Working Hours -->
              <div class="group bg-gradient-to-br from-gray-50 to-blue-50/30 rounded-3xl p-8 border border-gray-200 hover:border-blue-300 transition-all duration-500 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start space-x-6 space-x-reverse">
                  <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-5 group-hover:scale-110 transition-transform duration-500 shadow-lg">
                    <Clock class="w-7 h-7 text-white" />
                  </div>
                  <div class="flex-1">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">ساعات العمل</h3>
                    <div class="space-y-3 text-gray-700">
                      <p class="text-lg font-medium">الأحد - الخميس: <span class="text-blue-600 font-bold">8:00 ص - 8:00 م</span></p>
                      <p class="text-lg font-medium">الجمعة - السبت: <span class="text-blue-600 font-bold">9:00 ص - 6:00 م</span></p>
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
    <section class="py-24 bg-gradient-to-br from-gray-50 via-blue-50/50 to-indigo-50/50 relative overflow-hidden">
      <!-- Background Elements -->
      <div class="absolute inset-0">
        <div class="absolute top-20 left-20 w-64 h-64 bg-blue-200/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-20 w-80 h-80 bg-indigo-200/20 rounded-full blur-3xl"></div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
          <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl mb-6 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
                      <h2 class="text-4xl font-bold text-gray-900 mb-4">لماذا تختار واصل لك؟</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">نحن نقدم أفضل خدمات تأجير السيارات مع ضمان الجودة والموثوقية</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
          <div class="text-center bg-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative">
              <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl mb-8 shadow-lg group-hover:scale-110 transition-transform duration-500">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900 mb-4">خدمة 24/7</h3>
              <p class="text-gray-600 text-lg leading-relaxed">نحن متاحون على مدار الساعة لمساعدتك في أي وقت تحتاج فيه</p>
            </div>
          </div>

          <div class="text-center bg-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative">
              <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl mb-8 shadow-lg group-hover:scale-110 transition-transform duration-500">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900 mb-4">أسعار تنافسية</h3>
              <p class="text-gray-600 text-lg leading-relaxed">نقدم أفضل الأسعار مع ضمان الجودة والخدمة الممتازة</p>
            </div>
          </div>

          <div class="text-center bg-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative">
              <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl mb-8 shadow-lg group-hover:scale-110 transition-transform duration-500">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900 mb-4">سرعة في الاستجابة</h3>
              <p class="text-gray-600 text-lg leading-relaxed">نرد على استفساراتك في أسرع وقت ممكن</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
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

const submitForm = () => {
  form.post('/contact', {
    onSuccess: () => {
      form.reset()
      alert('تم إرسال رسالتك بنجاح! سنرد عليك في أقرب وقت ممكن.')
    }
  })
}
</script>
