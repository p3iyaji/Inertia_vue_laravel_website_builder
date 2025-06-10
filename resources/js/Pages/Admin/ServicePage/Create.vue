<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';



const errors = usePage().props.errors;

const form = useForm({
    sectn_services: '',
    sectn_services_title: '',
    sectn_services_title_color: '#000000', 
    sectn_header_bg_color: '#ffffff',

    sectn_someserv: '',
    sectn_someserve_bg_color: '#ffffff',
    sectn_someserve_dark_bg_color: '#000000',
            
    sectn_servslogan: '',
    sloganImage: '',

    caption_title: '',
    caption_color: '#000000', 

    slogan: '',
    slogan_color: '#000000',

    slogan_bg_color: '#ffffff', 

    sectn_allserve: '',
    allserve_bg_color: '#ffffff',
})

// Image handling
const fileInput = ref(null);
const previewImage = ref(null);
const sloganImage = ref(null); // For existing image when editing

const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (!file) return;

    // Set form data (assuming your form has an 'image' field)
    form.sloganImage = file;

    // Create preview
    previewImage.value = {
        name: file.name,
        url: URL.createObjectURL(file)
    };

    // Reset the input to allow selecting the same file again
    e.target.value = '';
};

const removePreviewImage = () => {
    // Remove preview
    previewImage.value = null;
    // Remove from form data
    form.sloganImage = null;
};

const deleteImage = () => {
    // For existing image (when editing)
    sloganImage.value = null;
    // You would typically also make an API call to delete from server
};
const saveService = () => {
    // Convert form to FormData to handle file uploads
    const formData = new FormData();

    // Append all form fields
    formData.append('form',form);

    // Submit the form
    form.post(route('servicepage.store'), {
        data: formData,
        onSuccess: (page) => {
            const message = page.props.flash?.success || 'Service Page added successfully';
            Swal.fire({
                toast: true,
                icon: 'success',
                position: 'top-end',
                showConfirmation: false,
                timer: 3000,
                title: message
            });
            form.reset();
            previewImage.value = null;
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
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new Service Page</h2>
                        <form @submit.prevent="saveService()">
                            <!-- main section -->
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_services" id="sectn_services" type="checkbox" value=""
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section Services</span>
                                    </label>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_header_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Background
                                        Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_header_bg_color" type="color" name="color"
                                            id="sectn_header_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_header_bg_color" type="text" name="sectn_header_bg_color"
                                            id="sectn_header_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_header_bg_color">{{
                                        form.errors.sectn_header_bg_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_services_title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Services
                                        Title</label>
                                    <input v-model="form.sectn_services_title" type="text" name="sectn_services_title" id="sectn_services_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type services title">
                                    <span class="text-red-500" v-if="form.errors.sectn_services_title">{{ form.errors.sectn_services_title
                                        }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_services_title_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Services
                                        Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_services_title_color" type="color" name="color"
                                            id="sectn_services_title_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_services_title_color" type="text" name="sectn_services_title_color"
                                            id="sectn_services_title_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_services_title_color">{{ form.errors.sectn_services_title_color
                                        }}</span>
                                </div>

                                <!-- somserv section end -->
                                <hr class="w-full">
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_someserv" id="sectn_someserv" type="checkbox"
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section Some Services
                                        </span>
                                    </label>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_someserv_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Some
                                        Services Background
                                        Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_someserv_bg_color" type="color" name="sectn_someserv_bg_color"
                                            id="sectn_someserv_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_someserv_bg_color" type="text" name="sectn_someserv_bg_color"
                                            id="sectn_someserv_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_someserv_bg_color">{{
                                        form.errors.sectn_someserv_bg_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_someserv_dark_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Some
                                        Services Dark Background
                                        Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_someserv_dark_bg_color" type="color" name="sectn_someserv_dark_bg_color"
                                            id="sectn_someserv_dark_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_someserv_dark_bg_color" type="text" name="sectn_someserv_dark_bg_color"
                                            id="sectn_someserv_dark_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_someserv_dark_bg_color">{{
                                        form.errors.sectn_someserv_dark_bg_color }}</span>
                                </div>


                                <!-- slogan section start -->
                                <hr class="w-full">
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_servslogan" id="sectn_servslogan" type="checkbox"
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section Slogan
                                        </span>
                                    </label>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Slogan Image
                                    </label>

                                    <!-- Current Image (if editing) -->
                                    <div v-if="sloganImage" class="mb-4">
                                        <div class="relative inline-block">
                                            <img class="w-24 h-24 rounded-sm object-cover" :src="`/${sloganImage}`" alt="">
                                            <span class="absolute top-0 right-0 transform -translate-y-1/2 w-5 h-5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full cursor-pointer">
                                                <span @click="deleteImage" class="text-white text-xs font-bold absolute flex items-center justify-center w-full h-full">×</span>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Image Upload Component -->
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                                        <input type="file" id="sloganImage" @change="handleFileChange" accept="image/*" class="hidden" ref="fileInput">
                                        <label for="sloganImage" class="flex flex-col items-center justify-center cursor-pointer">
                                            <svg class="w-8 h-8 mb-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <p class="text-sm text-gray-500">
                                                <span class="font-semibold">Click to upload</span> or drag and drop
                                            </p>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                        </label>

                                        <!-- Preview of selected file before upload -->
                                        <div v-if="previewImage" class="mt-4">
                                            <div class="relative inline-block">
                                                <img :src="previewImage.url" class="w-24 h-24 object-cover rounded">
                                                <button @click="removePreviewImage"
                                                    class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center">
                                                    ×
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- end -->

                                <div class="sm:col-span-2">
                                    <label for="caption_title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Caption
                                        Title</label>
                                    <input v-model="form.caption_title" type="text" name="caption_title" id="caption_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type caption title">
                                    <span class="text-red-500" v-if="form.errors.caption_title">{{ form.errors.caption_title
                                        }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="caption_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Caption
                                        Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.caption_color" type="color" name="caption_color"
                                            id="caption_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.caption_color" type="text" name="caption_color"
                                            id="caption_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.caption_color">{{
                                        form.errors.caption_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="slogan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brief
                                        Introduction
                                    </label>
                                    <textarea id="slogan" rows="4" name="slogan"
                                        v-model="form.slogan"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your thoughts here..."></textarea>

                                    <span class="text-red-500" v-if="form.errors.slogan">{{
                                        form.errors.slogan
                                    }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="slogan_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slogan
                                        Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.slogan_color" type="color" name="slogan_color"
                                            id="slogan_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.slogan_color" type="text"
                                            name="slogan_color" id="slogan_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.slogan_color">{{
                                        form.errors.slogan_color }}</span>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="slogan_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slogan
                                        Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.slogan_bg_color" type="color" name="slogan_bg_color"
                                            id="slogan_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.slogan_bg_color" type="text"
                                            name="slogan_bg_color" id="slogan_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.slogan_bg_color">{{
                                        form.errors.slogan_bg_color }}</span>
                                </div>

                                <!-- Slogan Ends -->
                                
                                <!-- Section All Services Starts -->
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_allserve" id="sectn_allserve" type="checkbox"
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            All Services Section
                                        </span>
                                    </label>
                                </div>
                          

                                <!-- Read more button -->
                                <div class="sm:col-span-2">
                                    <label for="allserve_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">All Services
                                        Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.allserve_bg_color" type="color" name="allserve_bg_color"
                                            id="allserve_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.allserve_bg_color" type="text" name="allserve_bg_color"
                                            id="allserve_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.allserve_bg_color">{{
                                        form.errors.allserve_bg_color }}</span>
                                </div>
                                                              
                             
                            </div>
                       
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Add Service Page
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>