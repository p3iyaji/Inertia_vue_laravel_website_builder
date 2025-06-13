<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import SiteLayout from '../Pages/Layouts/SiteLayout.vue'
import Hero from './Layouts/Hero.vue'
import { Head, Link, usePage } from '@inertiajs/vue3';
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

const welcome = usePage().props.welcome;




</script>

<template>

    <SiteLayout>

        <Head title="Welcome to" />
        <Hero />
        <!-- content -->
        <!-- what we do section -->
        <section class="bg-white dark:bg-gray-900 mb-0">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <div class="max-w-full mb-8 lg:mb-16">
                    <!-- company name & brief intro -->
                    <div>
                        <h2 :class="[`${welcome.ccn_title_color_tw}`]" class="mb-4 text-4xl tracking-tight font-extrabold dark:text-white">
                            {{ welcome.ccn_title }}
                        </h2>
                        <p :class="[`${welcome.ccn_description_color_tw}`]" class="sm:text-xl text-justify dark:text-gray-400 mb-5">
                            {{welcome.ccn_description }}</p><span class="mt-5">
                            <Link :href="route('about')"
                                class="inline-flex items-center bg-blue-700 justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                            ...Read more
                            </Link>
                        </span>
                    </div>

                    <!-- End -->
                </div>
                <!-- 3 of our services -->
                <div
                    class="space-y-8 md:grid md:grid-cols-2 bg-white lg:grid-cols-3 md:gap-12 md:space-y-0 dark:bg-gray-800 px-4 py-4 rounded-md">
                    <div
                        class="text-center rounded-full group bg-blue-200 dark:bg-gray-800 p-6 transition-all duration-300 hover:bg-white hover:shadow-lg hover:-translate-y-1 cursor-pointer">
                        <!-- Icon Container -->
                        <div :class="[`${welcome.welcomeserves[0].sectn_3ghover_title_color_tw} dark:${welcome.welcomeserves[0].sectn_3darkghover_title_color_tw}`]"
                            class="flex justify-center items-center mb-4 w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900 mx-auto transition-all duration-300 group-hover:bg-white group-hover:text-blue-700">
                            <!-- Icon -->
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-300 transition-all duration-300 group-hover:text-blue-700"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>


                        <!-- Content -->

                        <!-- 3 options of what we do with title and description -->
                        <h3 :class="[`${welcome.welcomeserves[0].sectn_3_title_color}`]"
                            class="mb-2 text-xl font-bold text-yellow-800 dark:text-white transition-all duration-300 group-hover:text-gray-800">
                            {{ welcome.welcomeserves[0].sectn_3_title }}
                        </h3>
                        <p :class="[`${welcome.welcomeserves[0].sectn_3_description_color}`]"
                            class="dark:text-gray-400 font-semibold transition-all duration-300 group-hover:text-gray-800">
                            {{welcome.welcomeserves[0].sectn_3_description }}</p>
                    </div>
                    <!-- 4services -->
                    <div class="text-center rounded-full group bg-blue-500 dark:bg-gray-800 p-6 transition-all duration-300 hover:bg-white hover:shadow-lg hover:-translate-y-1 cursor-pointer">
                        <!-- Icon Container -->
                        <div class="flex justify-center items-center mb-4 w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900 mx-auto transition-all duration-300 group-hover:bg-white group-hover:text-blue-700">
                            <!-- Icon -->
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-300 transition-all duration-300 group-hover:text-blue-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <!-- Content -->
                        <h3 :class="[`${welcome.welcomeserves[1].sectn_3_title_color}`]" class="mb-2 text-xl font-bold text-white dark:text-white transition-all duration-300 group-hover:text-gray-800 break-words">
                            {{welcome.welcomeserves[1].sectn_3_title}}
                        </h3>
                        <p :class="[`${welcome.welcomeserves[1].sectn_3_description_color} ${welcome.welcomeserves[1].sectn_3_description_color_tw}` ]" class="pl-10 pr-10 dark:text-gray-400 transition-all duration-300 group-hover:text-gray-800 px-5 break-words whitespace-normal">
                            {{welcome.welcomeserves[1].sectn_3_description}}
                        </p>
                    </div>

                    <div
                        class="text-center rounded-full group bg-blue-300 dark:bg-gray-800 p-6 transition-all duration-300 hover:bg-white hover:shadow-lg hover:-translate-y-1 cursor-pointer">
                        <!-- Icon Container -->
                        <div
                            class="flex justify-center items-center mb-4 w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900 mx-auto transition-all duration-300 group-hover:bg-white group-hover:text-blue-700">
                            <!-- Icon -->
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-300 transition-all duration-300 group-hover:text-blue-700"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <!-- Content -->
                        <h3 :class="[`${welcome.welcomeserves[2].sectn_3_title_color}`]"
                            class="mb-2 text-xl font-bold text-yellow-800 dark:text-white transition-all duration-300 group-hover:text-gray-00">
                            {{welcome.welcomeserves[2].sectn_3_title}}</h3>
                        <p :class="[`${welcome.welcomeserves[2].sectn_3_description_color}`]"
                            class="text-gray-800 font-semibold dark:text-gray-400 transition-all duration-300 group-hover:text-gray-800">
                            {{welcome.welcomeserves[2].sectn_3_description}}</p>
                    </div>
                    <!-- End title and description -->


                </div>
                <!-- End 3 services section -->

                <!-- Other services we render 4 options with title and description -->
                <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-12 md:space-y-0 bg-gray-100 dark:bg-gray-800 px-4 py-4 rounded-md">
                    <!-- Loop through each service -->
                    <div v-for="(service, index) in welcome.welcomeourserves" :key="index"
                    :class="[`bg-${welcome.welcomeourserves.sectn_oservg_bg_color_tw} hover:bg-${welcome.welcomeourserves.sectn_oservhd_bg_color_tw}`]"
                        class="text-center group dark:bg-gray-800 rounded-lg p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 cursor-pointer">
                        <!-- Icon Container -->
                        <div class="flex justify-center items-center mb-4 w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900 mx-auto transition-all duration-300 group-hover:bg-white group-hover:text-blue-700">
                            <!-- Icon - you can customize this per service if needed -->
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-300 transition-all duration-300 group-hover:text-blue-700"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <!-- Content -->
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white transition-all duration-300 group-hover:text-white break-words">
                            {{ service.sectn_oserv_title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 transition-all duration-300 group-hover:text-white break-words">
                            {{ service.sectn_oserv_description }}
                        </p>
                    </div>
                </div>
                <!-- End other services -->
            </div>
        </section>
        <!-- what we do section ends -->

        <!-- Our services brief description -->
        <section class="bg-blue-100 dark:bg-gray-900 flex items-center mt-0">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="mr-auto place-self-center lg:col-span-7">
                    <h1 :class="[`${welcome.sectn_serv_title_color_tw}`]"
                        class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                        Our Services</h1>
                    <p :class="[`${welcome.sectn_serv_description_color_tw}`]"
                        class="max-w-2xl text-left mb-6 font-light lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                        {{welcome.sectn_serv_description }}

                    </p>

                    <Link :href="route('services')"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium bg-blue-700 text-center text-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-900 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Speak to Us
                    </Link>
                </div>
                <div class="hidden lg:mt-0 lg:col-span-5 lg:flex ml-5">
                    <img :src="welcome.services_image ? `/storage/${welcome.services_image}` : '/images/default-service.jpg'" :alt="welcome.sectn_serv_title || 'service image'" height="400" width="400" class="rounded-lg shadow">
                </div>
            </div>
        </section>
        <!-- End  -->

        <!-- Logo of companies we have worked section can be on or off -->
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 lg:py-16 mx-auto max-w-screen-xl px-4">
                <h2
                    class="mb-8 lg:mb-16 text-3xl font-extrabold tracking-tight leading-tight text-center text-gray-900 dark:text-white md:text-4xl">
                    {{ welcome.sectn_client_title }}</h2>
                <div
                    class="grid grid-cols-2 gap-8 text-gray-500 sm:gap-12 md:grid-cols-3 lg:grid-cols-6 dark:text-gray-400">
                    <a v-for="(companylogo, index) in welcome.companylogos" :key="index" href="#" class="flex justify-center items-center">
                        <img class="h-24 w-24 md:h-24 md:w-24 object-contain"
                        :src="companylogo.logo  ? `/storage/${companylogo.logo}` : '/images/default-service.jpg'" 
                        :alt="companylogo.name || 'client image'"
                        >
                    </a>
                   
                </div>
            </div>
        </section>
        <!-- End -->
        <!-- End content -->

    </SiteLayout>

</template>
