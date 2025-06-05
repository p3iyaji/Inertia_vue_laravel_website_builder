<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';



const errors = usePage().props.errors;

const form = useForm({
    sectn_wwd: '',
    sectn_wwd_bg_color: '#ffffff',
    sectn_ccn: '',
    sectn_ccn_bg_color: '#ffffff',
    ccn_title: '',
    ccn_title_color: '#000000',
    ccn_description: '',
    ccn_description_color: '#000000',
    ccn_btn_title: '',
    btn_ccn_bg_color: '#ffffff',
    btn_ccn_text_color: '#000000',

    sectn_3_services: '',

    sectn_oservices: '',
    sectn_oserv_bg_color: '#ffffff',
    sectn_oservdark_bg_color: '#000000',
    
    sectn_services: '',
    sectn_serv_title: '',
    sectn_serv_description: '',
    services_image: '',
    sectn_serv_bg_color: '#ffffff',
    sectn_serv_title_color: '#000000',
    sectn_serv_description_color: '#000000',
    
    sectn_client_logo: '',
    sectn_client_title: '',
    sectn_client_text_color: '#000000',
    sectn_client_bg_color: '#ffffff',
    sectn_dclient_text_color: '#000000',
    sectn_dclient_bg_color: '#ffffff',

})

// Image handling
const fileInput = ref(null);
const previewImage = ref(null);
const services_image = ref(null); // For existing image when editing

const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (!file) return;

    // Set form data (assuming your form has an 'image' field)
    form.services_image = file;

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
    form.image = null;
};

const deleteImage = () => {
    // For existing image (when editing)
    services_image.value = null;
    // You would typically also make an API call to delete from server
};
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
            previewImages.value = [];
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
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new Welcome Page</h2>
                        <form @submit.prevent="saveWelcome()">
                            <!-- main section -->
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_wwd" id="sectn_wwd" type="checkbox" value=""
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section What we do</span>
                                    </label>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_wwd_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Background
                                        Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_wwd_bg_color" type="color" name="color"
                                            id="sectn_wwd_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_wwd_bg_color" type="text" name="sectn_wwd_bg_color"
                                            id="sectn_wwd_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_wwd_bg_color">{{
                                        form.errors.sectn_wwd_bg_color }}</span>
                                </div>
                                <!-- main section end -->
                                <hr class="w-full">
                                <!-- company info section -->
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_ccn" id="sectn_ccn" type="checkbox"
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section Company Info
                                        </span>
                                    </label>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_ccn_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company
                                        Info Background
                                        Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_ccn_bg_color" type="color" name="sectn_ccn_bg_color"
                                            id="sectn_ccn_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_ccn_bg_color" type="text" name="sectn_ccn_bg_color"
                                            id="sectn_ccn_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_ccn_bg_color">{{
                                        form.errors.sectn_ccn_bg_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="ccn_title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company
                                        Name</label>
                                    <input v-model="form.ccn_title" type="text" name="ccn_title" id="ccn_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type company name">
                                    <span class="text-red-500" v-if="form.errors.ccn_title">{{ form.errors.ccn_title
                                        }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="ccn_title_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company
                                        Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.ccn_title_color" type="color" name="ccn_title_color"
                                            id="ccn_title_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.ccn_title_color" type="text" name="ccn_title_color"
                                            id="ccn_title_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.ccn_title_color">{{
                                        form.errors.ccn_title_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="ccn_description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brief
                                        Introduction
                                    </label>
                                    <textarea id="ccn_description" rows="4" name="ccn_description"
                                        v-model="ccn_description"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your thoughts here..."></textarea>

                                    <span class="text-red-500" v-if="form.errors.ccn_description">{{
                                        form.errors.ccn_description
                                    }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="ccn_description_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brief Intro
                                        Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.ccn_description_color" type="color" name="ccn_title_color"
                                            id="ccn_description_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.ccn_description_color" type="text"
                                            name="ccn_description_color" id="ccn_description_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.ccn_description_color">{{
                                        form.errors.ccn_description_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="ccn_btn_title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Read more
                                        Button Title</label>
                                    <input v-model="form.ccn_btn_title" type="text" name="ccn_btn_title"
                                        id="ccn_btn_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type Sub caption">
                                    <span class="text-red-500" v-if="form.errors.ccn_btn_title">{{
                                        form.errors.ccn_btn_title
                                    }}</span>
                                </div>
                                <!-- Read more button -->
                                <div class="sm:col-span-2">
                                    <label for="btn_ccn_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Read more
                                        Button Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.btn_ccn_bg_color" type="color" name="btn_ccn_bg_color"
                                            id="btn_ccn_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.btn_ccn_bg_color" type="text" name="btn_ccn_bg_color"
                                            id="btn_ccn_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.btn_ccn_bg_color">{{
                                        form.errors.btn_ccn_bg_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="btn_ccn_text_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Read more
                                        Button Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.btn_ccn_text_color" type="color" name="btn_ccn_text_color"
                                            id="btn_ccn_text_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.btn_ccn_text_color" type="text" name="btn_ccn_text_color"
                                            id="btn_ccn_text_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.btn_ccn_text_color">{{
                                        form.errors.btn_ccn_text_color }}</span>
                                </div>
                                <!-- read more button ends -->
                                <!-- company info section ends -->

                                <!-- 3 services section -->
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_3_services" id="sectn_3_services" type="checkbox"
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section 3 Services
                                        </span>
                                    </label>
                                </div>
                        
                                <!-- 3 services ends -->

                                <!-- Other services -->

                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_oservices" id="sectn_oservices" type="checkbox"
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section for Other Services
                                        </span>
                                    </label>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_oservg_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Other
                                        Services
                                        Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_oserv_bg_color" type="color"
                                            name="sectn_oserv_bg_color" id="sectn_oserv_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_oserv_bg_color" type="text"
                                            name="sectn_oserv_bg_color" id="sectn_oserv_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_oserv_bg_color">{{
                                        form.errors.sectn_oserv_bg_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_oservdark_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Other
                                        Services
                                        Dark Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_oservdark_bg_color" type="color"
                                            name="sectn_oservdark_bg_color" id="sectn_oservdark_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_oservdark_bg_color" type="text"
                                            name="sectn_oservdark_bg_color" id="sectn_oservdark_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_oservdark_bg_color">{{
                                        form.errors.sectn_oservdark_bg_color }}</span>
                                </div>

                                <!-- Other services end -->

                                <!-- section services with a brief intro -->
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_services" id="sectn_services" type="checkbox"
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section for Other Services
                                        </span>
                                    </label>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_serv_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Services
                                        Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_serv_bg_color" type="color"
                                            name="sectn_serv_bg_color" id="sectn_serv_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_serv_bg_color" type="text"
                                            name="sectn_serv_bg_color" id="sectn_serv_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_serv_bg_color">{{
                                        form.errors.sectn_serv_bg_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_serv_title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Services
                                        Title</label>
                                    <input v-model="form.sectn_serv_title" type="text" name="sectn_serv_title"
                                        id="sectn_serv_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type services title">
                                    <span class="text-red-500" v-if="form.errors.sectn_serv_title">{{
                                        form.errors.sectn_serv_title }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_serv_title_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Services
                                        Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_serv_title_color" type="color"
                                            name="sectn_serv_title_color" id="sectn_serv_title_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_serv_title_color" type="text"
                                            name="sectn_serv_title_color" id="sectn_serv_title_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_serv_title_color">{{
                                        form.errors.sectn_serv_title_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_serv_description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description
                                    </label>
                                    <textarea id="sectn_serv_description" rows="4" name="sectn_serv_description"
                                        v-model="sectn_serv_description"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your thoughts here..."></textarea>

                                    <span class="text-red-500" v-if="form.errors.sectn_serv_description">{{
                                        form.errors.sectn_serv_description
                                    }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_serv_description_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Services
                                        Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_serv_description_color" type="color"
                                            name="sectn_serv_description_color" id="sectn_serv_description_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_serv_description_color" type="text"
                                            name="sectn_serv_description_color" id="sectn_serv_description_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_serv_description_color">{{
                                        form.errors.sectn_serv_description_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Services Image
                                    </label>

                                    <!-- Current Image (if editing) -->
                                    <div v-if="services_image" class="mb-4">
                                        <div class="relative inline-block">
                                            <img class="w-24 h-24 rounded-sm object-cover" :src="`/${services_image.image}`" alt="">
                                            <span class="absolute top-0 right-0 transform -translate-y-1/2 w-5 h-5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full cursor-pointer">
                                                <span @click="deleteImage" class="text-white text-xs font-bold absolute flex items-center justify-center w-full h-full">×</span>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Image Upload Component -->
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                                        <input type="file" id="services_image" @change="handleFileChange" accept="image/*" class="hidden" ref="fileInput">
                                        <label for="services_image" class="flex flex-col items-center justify-center cursor-pointer">
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
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_client_logo" id="sectn_client_logo" type="checkbox"
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section for Clients Logos
                                        </span>
                                    </label>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_client_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_client_bg_color" type="color"
                                            name="sectn_client_bg_color" id="sectn_client_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_client_bg_color" type="text"
                                            name="sectn_client_bg_color" id="sectn_client_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_client_bg_color">{{
                                        form.errors.sectn_client_bg_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_client_title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section Title</label>
                                    <input v-model="form.sectn_client_title" type="text" name="sectn_client_title" id="sectn_client_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type a Section Title">
                                    <span class="text-red-500" v-if="form.errors.sectn_client_title">{{
                                        form.errors.sectn_client_title }}</span>

                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_client_text_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client Text Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_client_text_color" type="color"
                                            name="sectn_client_text_color" id="sectn_client_text_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_client_text_color" type="text"
                                            name="sectn_client_text_color" id="sectn_client_text_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_client_text_color">{{
                                        form.errors.sectn_client_text_color }}</span>
                                </div>

                           
                                <div class="sm:col-span-2">
                                    <label for="sectn_dclient_text_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dark Client Text Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_dclient_text_color" type="color"
                                            name="sectn_dclient_text_color" id="sectn_dclient_text_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_dclient_text_color" type="text"
                                            name="sectn_dclient_text_color" id="sectn_dclient_text_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_dclient_text_color">{{
                                        form.errors.sectn_dclient_text_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_dclient_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dark Client Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_dclient_bg_color" type="color"
                                            name="sectn_dclient_bg_color" id="sectn_dclient_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_dclient_bg_color" type="text"
                                            name="sectn_dclient_bg_color" id="sectn_dclient_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_dclient_bg_color">{{
                                        form.errors.sectn_dclient_bg_color }}</span>
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