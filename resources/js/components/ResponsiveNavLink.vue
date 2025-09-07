<template>
  <Link
    v-if="!as || as === 'a'"
    :href="href"
    :class="[
      'block w-full pl-3 pr-4 py-2 border-l-4 text-right text-base font-medium leading-6 transition duration-150 ease-in-out focus:outline-none',
      active
        ? 'bg-indigo-50 border-indigo-400 text-indigo-700 focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700'
        : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300'
    ]"
  >
    <slot />
  </Link>

  <button
    v-else
    :class="[
      'block w-full pl-3 pr-4 py-2 border-l-4 text-right text-base font-medium leading-6 transition duration-150 ease-in-out focus:outline-none',
      active
        ? 'bg-indigo-50 border-indigo-400 text-indigo-700 focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700'
        : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300'
    ]"
  >
    <slot />
  </button>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  href: String,
  active: Boolean,
  as: String,
})
</script>
