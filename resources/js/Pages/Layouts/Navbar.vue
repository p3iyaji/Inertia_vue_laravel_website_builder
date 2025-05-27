<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import ContactDrawer from './ContactDrawer.vue';

// Get current route name
const currentRoute = computed(() => usePage().url);
const isActive = (routeName) => {
  return currentRoute.value === routeName;
};
</script>

<template>
<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Infinite Digits</span>
    </a>
    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <!-- make this button I/O -->
      <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      data-drawer-target="drawer-contact" data-drawer-show="drawer-contact" aria-controls="drawer-contact">
      Get In Touch</button>
      <!-- End -->
      <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <Link 
            :href="route('home')" 
            :class="{
              'block py-2 px-3 rounded-sm md:p-0': true,
              'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500': isActive('/'),
              'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent md:dark:hover:text-blue-500': !isActive('/')
            }"
            aria-current="page"
          >
            Home
          </Link>
        </li>
        <li>
          <Link 
            :href="route('about')" 
            :class="{
              'block py-2 px-3 rounded-sm md:p-0': true,
              'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500': isActive('/about'),
              'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent md:dark:hover:text-blue-500': !isActive('/about')
            }"
          >
            About
          </Link>
        </li>
        <li>
          <Link 
            :href="route('services')" 
            :class="{
              'block py-2 px-3 rounded-sm md:p-0': true,
              'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500': isActive('/services'),
              'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent md:dark:hover:text-blue-500': !isActive('/services')
            }"
          >
            Services
          </Link>
        </li>
        <li>
          <Link 
            :href="route('contact')" 
            :class="{
              'block py-2 px-3 rounded-sm md:p-0': true,
              'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500': isActive('/contact'),
              'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent md:dark:hover:text-blue-500': !isActive('/contact')
            }"
          >
            Contact
          </Link>
        </li>
      </ul>
    </div>
  </div>
</nav>

<ContactDrawer />
</template>