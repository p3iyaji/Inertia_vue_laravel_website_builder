<script setup>
import SiteLayout from './Layouts/SiteLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';


const about = usePage().props.about;
const mivis = usePage().props.about.mivis;

</script>

<template>

    <SiteLayout>
        <Head title="About" />
        <!-- company title description with mission and vision -->
        <section :class="[`bg-${about.sectn_header_bg_color_tw}`]" class="dark:bg-gray-900 mb-0 mt-5">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <div class="max-w-full mb-8 lg:mb-16">
                    <!-- company title & and description -->
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-white dark:text-white pt-5">
                        {{ about.sectn_header_title }} </h2>
                    <p :class="[`text-${about.sectn_header_description_color_tw}`]" class="sm:text-xl text-justify dark:text-gray-400">
                        {{ about.sectn_header_description }}
                        </p>
                </div>
            <!-- Mission & Vision -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 py-8 max-w-6xl mx-auto">
                    <!-- Mission Section -->
                    <div class="text-center w-full">
                        <h2
                        class="mb-4 text-2xl font-extrabold tracking-tight text-orange-500 dark:text-white">
                        {{ about.mivis[0].mission_title }}
                        </h2>
                        <p
                        :class="[`text-${about.mivis[0].mission_description_color_tw}`]"
                        class="text-base sm:text-lg break-words w-full dark:text-gray-400">
                        {{ about.mivis[0].mission_description }}
                        </p>
                    </div>

                    <!-- Vision Section -->
                    <div class="text-center w-full">
                        <h2
                        :class="[`text-${about.mivis[0].vision_title_color_tw}`]"
                        class="mb-4 text-2xl font-extrabold tracking-tight text-orange-500 dark:text-white">
                        {{ about.mivis[0].vision_title }}
                        </h2>
                        <p
                        :class="[`text-${about.mivis[0].vision_description_color_tw}`]"
                        class="text-base sm:text-lg break-words w-full dark:text-gray-400">
                        {{ about.mivis[0].vision_description }}
                        </p>
                    </div>
                </div>

                <!-- End -->

            </div>
        </section>

        <!-- company slogan and image sub-caption -->
        <section class="px-4 py-8 antialiased dark:bg-gray-900 md:py-16">
            <div :class="[`bg-${about.sectn_slogan_bg_color_tw}`]"
                class="mx-auto grid max-w-screen-xl rounded-lg p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 lg:p-16 xl:gap-16">
                <div class="lg:col-span-5 lg:mt-0">
                    <a href="#">
                        <img class="mb-4 h-56 w-56 dark:hidden sm:h-96 sm:w-96 md:h-full md:w-full"
                            :src="about.slogan_image ? `/storage/${about.slogan_image}` : '/images/default-service.jpg'"
                            :alt="about.caption_title" />
                        <img class="mb-4 hidden dark:block md:h-full"
                            :src="about.slogan_image ? `/storage/${about.slogan_image}` : '/images/default-service.jpg'"
                            :alt="about.caption_title" />
                    </a>
                </div>
                <div class="me-auto place-self-center lg:col-span-7">
                    <h1 :class="[`text-${about.sectn_slogan_caption_color_tw}`]"
                        class="mb-3 text-2xl font-bold leading-tight tracking-tight dark:text-white md:text-4xl">
                        {{ about.sectn_slogan_caption || 'caption title' }}
                    </h1>
                    <p :class="[`text-${about.sectn_slogan_subcaption_color_tw}`]" class="mb-6 dark:text-gray-400">
                        {{ about.sectn_slogan_subcaption || 'subcaption' }}
                    </p>
                    <!-- <a href="#"
                        class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                        Pre-order now </a> -->
                </div>
            </div>
            
        </section>
        <!-- Our team -->
         <section :class="[`bg-${about.team_bg_color_tw}`]" class="py-4">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-white dark:text-white">{{ about.team_title || 'Our Team' }}</h2>
                    <p :class="[`text-${about.team_caption_color_tw}`]" class="font-light text-white lg:mb-16 sm:text-xl dark:text-gray-400">{{ about.team_caption || 'Get to know Our Team members' }}</p>
                </div>
         </section> 
         <!-- team members display -->
        <section class="dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
                
                <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
    <div v-for="teammember in about.teammembers" :key="teammember.id" :class="[`bg-${teammember.team_mem_bg_color_tw}`]"
        class="items-center rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a href="#" class="sm:w-1/3 flex-shrink-0">
            <img class="w-full h-48 object-cover rounded-lg sm:rounded-none sm:rounded-l-lg"
            :src="teammember.team_mem_image ? `/storage/${teammember.team_mem_image}` : '/images/default-service.jpg'"
            alt="Bonnie Avatar">
        </a>
        <div class="p-5 sm:w-2/3">
            <!-- name -->
            <h3 :class="[`text-${teammember.team_mem_name_color_tw}`]" class="text-xl font-bold tracking-tight dark:text-white">
                <a href="#">{{ teammember.team_mem_name }}</a>
            </h3>
            <!-- end name -->
             <!-- title/position brief description -->
            <span :class="[`text-${teammember.team_mem_position_color_tw}`]" class="dark:text-gray-400">{{ teammember.team_mem_position }}</span>
            
            <p :class="[`text-${teammember.team_mem_description_color_tw}`]" class="mt-3 mb-4 font-light dark:text-gray-400">
                {{ teammember.team_mem_description }}</p>
                <!-- social media links -->
            <ul class="flex space-x-4 sm:mt-0">
                <li>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
            </ul>
            <!-- end -->
        </div>
    </div>
</div>
            </div>
        </section>
        <!-- End Our teams display -->

        <!-- End content -->
   
    </SiteLayout>

</template>
