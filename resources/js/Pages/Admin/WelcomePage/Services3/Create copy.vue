<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';



const errors = usePage().props.errors;

const form = useForm({
    'sectn_3_title': '',
    'sectn_3_title_color': '#000000',
    'sectn_3ghover_title_color': '#000000',
    'sectn_3darkghover_title_color': '#000000',
    'sectn_3_bg_color': '#ffffff',
    'sectn_3_dark_bg_color': '#000000',

    'sectn_3_description': '',
    'sectn_3_description_color': '#000000', 
    'sectn_3ghover_description_color': '#000000', 
    'sectn_3dark_description_color': '#000000', 
    'sectn_3darkhover_description_color': '#000000', 
})

const saveWelcome = () => {
    // Convert form to FormData to handle file uploads
    const formData = new FormData();

    // Append all form fields
    formData.append('form',form);

    // Submit the form
    form.post(route('welcomepage.store'), {
        data: formData,
        onSuccess: (page) => {
            const message = page.props.flash?.success || 'Welcome Page added successfully';
            Swal.fire({
                toast: true,
                icon: 'success',
                position: 'top-end',
                showConfirmation: false,
                timer: 3000,
                title: message
            });
            form.reset();
           
        },
    });
};


</script>

<template>
    <AuthenticatedLayout>
        <div class="p-4 sm:ml-64">
            <div class="p-4 rounded-lg dark:border-gray-700">
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add 3 Services</h2>
                        <form @submit.prevent="saveWelcome()">
                            <!-- main section -->
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label for="sectn_3_title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                    <input v-model="form.sectn_3_title" type="text" name="sectn_3_title" id="sectn_3_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type title">
                                    <span class="text-red-500" v-if="form.errors.sectn_3_title">{{ form.errors.sectn_3_title
                                        }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_3_title_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service Title Text
                                        Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_3_title_color" type="color" name="color"
                                            id="sectn_3_title_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_3_title_color" type="text" name="sectn_3_title_color"
                                            id="sectn_3_title_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_3_title_color">{{
                                        form.errors.sectn_3_title_color }}</span>
                                </div>  
                        
                                <div class="sm:col-span-2">
                                    <label for="sectn_3_description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Description
                                    </label>
                                    <textarea id="sectn_3_description" rows="4" name="sectn_3_description"
                                        v-model="form.sectn_3_description"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your thoughts here..."></textarea>

                                    <span class="text-red-500" v-if="form.errors.sectn_3_description">{{
                                        form.errors.sectn_3_description
                                    }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_3_description_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description text
                                        Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_3_description_color" type="color" name="sectn_3_description_color"
                                            id="sectn_3_description_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_3_description_color" type="text"
                                            name="sectn_3_description_color" id="sectn_3_description_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_3_description_color">{{
                                        form.errors.sectn_3_description_color }}</span>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="sectn_3ghover_title_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group Hover Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_3ghover_title_color" type="color" name="sectn_3ghover_title_color"
                                            id="sectn_3ghover_title_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_3ghover_title_color" type="text" name="sectn_3ghover_title_color"
                                            id="sectn_3ghover_title_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_3ghover_title_color">{{
                                        form.errors.sectn_3ghover_title_color }}</span>
                                </div>
                               
                                <div class="sm:col-span-2">
                                    <label for="sectn_3darkghover_title_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group Dark Hover Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_3darkghover_title_color" type="color"
                                            name="sectn_3darkghover_title_color" id="sectn_3darkghover_title_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_3darkghover_title_color" type="text"
                                            name="sectn_3darkghover_title_color" id="sectn_3darkghover_title_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_3darkghover_title_color">{{
                                        form.errors.sectn_3darkghover_title_color }}</span>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="sectn_3_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Services
                                        Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_3_bg_color" type="color"
                                            name="sectn_3_bg_color" id="sectn_3_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_3_bg_color" type="text"
                                            name="sectn_3_bg_color" id="sectn_3_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_3_bg_color">{{
                                        form.errors.sectn_3_bg_color }}</span>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="sectn_3_dark_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Services Dark
                                        Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_3_dark_bg_color" type="color"
                                            name="sectn_3_dark_bg_color" id="sectn_3_dark_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_3_dark_bg_color" type="text"
                                            name="sectn_3_dark_bg_color" id="sectn_3_dark_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_3_dark_bg_color">{{
                                        form.errors.sectn_3_dark_bg_color }}</span>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="sectn_3ghover_description_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        
                                        Group Hover Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_3ghover_description_color" type="color"
                                            name="sectn_3ghover_description_color" id="sectn_3ghover_description_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_3ghover_description_color" type="text"
                                            name="sectn_3ghover_description_color" id="sectn_3ghover_description_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_3ghover_description_color">{{
                                        form.errors.sectn_3ghover_description_color }}</span>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="sectn_3dark_description_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        
                                        Dark Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_3dark_description_color" type="color"
                                            name="sectn_3dark_description_color" id="sectn_3dark_description_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_3dark_description_color" type="text"
                                            name="sectn_3dark_description_color" id="sectn_3dark_description_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_3dark_description_color">{{
                                        form.errors.sectn_3dark_description_color }}</span>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="sectn_3darkhover_description_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        
                                        Dark Hover Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_3darkhover_description_color" type="color"
                                            name="sectn_3darkhover_description_color" id="sectn_3darkhover_description_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_3darkhover_description_color" type="text"
                                            name="sectn_3darkhover_description_color" id="sectn_3darkhover_description_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_3darkhover_description_color">{{
                                        form.errors.sectn_3darkhover_description_color }}</span>
                                </div>
                             
                            </div>
                       
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Add Welcome Page
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>