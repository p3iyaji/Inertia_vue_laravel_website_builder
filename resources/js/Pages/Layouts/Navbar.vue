<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import ContactDrawer from './ContactDrawer.vue';


const navbar = usePage().props.navbar;
// Get current route name
const currentRoute = computed(() => usePage().url);
const isActive = (routeName) => {
  return currentRoute.value === routeName;
};
</script>

<template>
  <nav :class="[
    `bg-${navbar.bg_color_tw}`,
    `text-${navbar.text_color_tw}`,
    `dark:bg-${navbar.dark_bg_color_tw}`,
    `dark:text-${navbar.dark_text_color_tw}`
  ]" :style="{
      '--bg-color': navbar.bg_color,
      '--text-color': navbar.text_color,
      '--dark-bg-color': navbar.dark_bg_color,
      '--dark-text-color': navbar.dark_text_color
    }"
    class="fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600 [&:not(:has(*))]:bg-[var(--bg-color)] [&:not(:has(*))]:text-[var(--text-color)] dark:[&:not(:has(*))]:bg-[var(--dark-bg-color)] dark:[&:not(:has(*))]:text-[var(--dark-text-color)]">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
      <Link :href="route('home')" class="flex items-center space-x-2 rtl:space-x-reverse">
      <img :src="`/storage/${navbar.company_logo}`" class="h-14" alt="company Logo">
      <span class="self-center text-2xl font-semibold whitespace-nowrap">{{ navbar.company_name
        }}</span>
      </Link>
      <div class="flex md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
        <!-- make this button I/O -->
        <button v-if="navbar.get_in_touch === 1" type="button"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          data-drawer-target="drawer-contact" data-drawer-show="drawer-contact" aria-controls="drawer-contact">
          Get In Touch</button>
        <!-- End -->
        <button data-collapse-toggle="navbar-sticky" type="button"
          class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="navbar-sticky" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M1 1h15M1 7h15M1 13h15" />
          </svg>
        </button>
      </div>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
        <ul
          class="flex flex-col justify-center gap-2 md:p-0 mt-4 font-medium md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0  ">
          <li>
            <Link :href="route('home')" :class="{
              'block py-2 px-3 rounded-sm md:p-0': true,
              'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500': isActive('/'),
              'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent md:dark:hover:text-blue-500': !isActive('/')
            }">
            Home
            </Link>
          </li>
          <li>
            <Link :href="route('about')" :class="{
              'block py-2 px-3 rounded-sm md:p-0': true,
              'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500': isActive('/about'),
              'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent md:dark:hover:text-blue-500': !isActive('/about')
            }">
            About
            </Link>
          </li>
          <li>
            <Link :href="route('services')" :class="{
              'block py-2 px-3 rounded-sm md:p-0': true,
              'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500': isActive('/services'),
              'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent md:dark:hover:text-blue-500': !isActive('/services')
            }">
            Services
            </Link>
          </li>
          <li>
            <Link :href="route('contact')" :class="{
              'block py-2 px-3 rounded-sm md:p-0': true,
              'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500': isActive('/contact'),
              'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent md:dark:hover:text-blue-500': !isActive('/contact')
            }">
            Contact
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <ContactDrawer />
</template>