<script setup>
import SiteLayout from './Layouts/SiteLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    contact: Object,
})

</script>

<template>

    <SiteLayout>

        <Head title="Contact" />
        <!-- content -->
         <!-- google map src -->
        <section class="w-full bg-white dark:bg-gray-900">
            <div class="w-full h-[50vh] mt-6">
                <iframe class="w-full h-full border-0" loading="lazy" allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    :src="contact.src">
                </iframe>
            </div>
        </section>




        <!-- main section -->
        <section class="flex items-center mt-0">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <div class="flex flex-col lg:flex-row justify-between items-center max-w-full mb-8 lg:mb-16 gap-8">

                    <!-- Office Info Block -->
                    <div class="flex-1 rounded-md shadow">
                        <div :class="[`bg-${contact.office_block_bg_color_tw}`]" class="py-8  lg:py-16 px-4 mx-auto max-w-screen-md">

                            <h2 :class="[`text-${contact.office_title_color_tw}`]"
                                class="mb-4 text-3xl tracking-tight font-extrabold text-center dark:text-white">
                                {{ contact.office_title }}
                            </h2>
                            <div class="space-y-6 text-center text-gray-700 dark:text-gray-300">

                                <!-- Address -->
                                <div>
                                    <h3 :class="[`text-${contact.address_color_tw}`]" class="mb-2 font-semibold text-lg font-semibold dark:text-white">
                                        Address</h3>
                                    <p>{{ contact.address }}</p>
                                </div>

                                <!-- Email -->
                                <div>
                                    <h3 :class="[`text-${contact.address_color_tw}`]" class="mb-2 text-lg font-semibold dark:text-white">Email</h3>
                                    <p><a href="mailto:{{ contact.email }}"
                                            :class="[`text-${contact.email_color_tw}`]">{{ contact.email }}</a>
                                    </p>
                                </div>

                                <!-- Phone -->
                                <div>
                                    <h3 :class="[`text-${contact.address_color_tw}`]" class="mb-2 text-lg font-semibold dark:text-white">Phone</h3>
                                    <p><a href="tel:{{ contact.phone }}"
                                            :class="[`text-${contact.phone_color_tw}`]">{{ contact.phone }}</a></p>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- Contact Us Form -->
                    <div class="flex-1">
                        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                            <!-- title -->
                            <h2
                                class="mb-4 text-3xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">
                                Contact Us
                            </h2>
                            <!-- end -->
                             <!-- brief intro -->
                            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">
                                Got a technical issue? Want to send feedback about a beta feature? Need details about
                                our Business plan? Let us know.
                            </p>
                            <!-- end intro -->
                            <form action="#" class="space-y-8">
                                <!-- Email Field -->
                                <div>
                                    <label for="contact-email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Your email
                                    </label>
                                    <input type="email" id="contact-email" required placeholder="name@flowbite.com"
                                        class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500" />
                                </div>

                                <!-- Subject Field -->
                                <div>
                                    <label for="contact-subject"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Subject
                                    </label>
                                    <input type="text" id="contact-subject" required
                                        placeholder="Let us know how we can help you"
                                        class="block w-full p-3 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500" />
                                </div>

                                <!-- Message Field -->
                                <div>
                                    <label for="contact-message"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                                        Your message
                                    </label>
                                    <textarea id="contact-message" rows="6" placeholder="Leave a comment..."
                                        class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit"
                                    class="py-3 px-5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Send message
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- End content -->

    </SiteLayout>

</template>
