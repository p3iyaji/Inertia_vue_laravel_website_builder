<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted, ref } from 'vue'
import { initFlowbite } from 'flowbite'
import { usePage, useForm, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

const welcome = usePage().props.welcome;


const errors = usePage().props.errors;

const goBack = () => {
    window.history.back();
}

const form = useForm({
    sectn_wwd: !!welcome.sectn_wwd,
    sectn_wwd_bg_color: welcome.sectn_wwd_bg_color,
    sectn_ccn: !!welcome.sectn_ccn,
    sectn_ccn_bg_color: welcome.sectn_ccn_bg_color,
    ccn_title: welcome.ccn_title,
    ccn_title_color: welcome.ccn_title_color,
    ccn_description: welcome.ccn_description,
    ccn_description_color: welcome.ccn_description_color,
    ccn_btn_title: welcome.ccn_btn_title,
    btn_ccn_bg_color: welcome.btn_ccn_bg_color,
    btn_ccn_text_color: welcome.btn_ccn_text_color,

    sectn_3_services: !!welcome.sectn_3_services,

    sectn_oservices: !!welcome.sectn_oservices,
    sectn_oserv_bg_color: welcome.sectn_oserv_bg_color,
    sectn_oservdark_bg_color: welcome.sectn_oservdark_bg_color,
    
    sectn_services: !!welcome.sectn_services,
    sectn_serv_title: welcome.sectn_serv_title,
    sectn_serv_description: welcome.sectn_serv_description,
    services_image: welcome.services_image,
    sectn_serv_bg_color: welcome.sectn_serv_bg_color,
    sectn_serv_title_color: welcome.sectn_serv_title_color,
    sectn_serv_description_color: welcome.sectn_serv_description_color,
    
    sectn_client_logo: !!welcome.sectn_client_logo,
    sectn_client_title: welcome.sectn_client_title,
    sectn_client_text_color: welcome.sectn_client_text_color,
    sectn_client_bg_color: welcome.sectn_client_bg_color,
    sectn_dclient_text_color: welcome.sectn_dclient_text_color,
    sectn_dclient_bg_color: welcome.sectn_dclient_bg_color,

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
const saveUpdate = () => {
    // Convert form to FormData to handle file uploads
    const formData = new FormData();

    // Append all form fields
    formData.append('form',form);

    // Submit the form
    form.post(route('welcomepage.update',welcome.id), {
        data: formData,
        onSuccess: (page) => {
            const message = page.props.flash?.success || 'Welcome Page updated successfully';
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

const add3Services = (welcome) => {
    router.get(route('welcomepage.services3.create',welcome.id));
}



</script>

<template>
    <AuthenticatedLayout>
        <div class="p-4 sm:ml-64">
            <div class="p-4 rounded-lg dark:border-gray-700">
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-6xl lg:py-16">
                        <div class="mb-2 flex justify-between items-center">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">View & Quick Edit for Welcome Page</h2>
                            <button @click="goBack" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Back</button>
                        </div>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Section</th>
                                        <th scope="col" class="px-6 py-3">Status</th>
                                        <th scope="col" class="px-6 py-3">Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- What We Do Section -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            What We Do
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_wwd" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <input v-model="form.sectn_wwd_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700" title="Choose color">
                                                <input v-model="form.sectn_wwd_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Hex code">
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Company Info Section -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Company Info
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_ccn" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="grid gap-2">
                                                <div class="flex items-center">
                                                    <input v-model="form.sectn_ccn_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700" title="BG Color">
                                                    <input v-model="form.sectn_ccn_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                                <input v-model="form.ccn_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Company Name">
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 3 Services Section -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            3 Services
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_3_services" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <!-- Add specific settings for 3 Services here -->
                                            <span class="text-gray-400 px-2">Click to add/edit 3 services of your company</span>
                                            <button type="button" @click="add3Services(welcome)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add/Edit 3 Services</button>
                                        </td>
                                        
                                    </tr>

                                    <!-- Other Services Section -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Other Services
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_oservices" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="grid gap-2">
                                                <div class="flex items-center">
                                                    <input v-model="form.sectn_oserv_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700" title="BG Color">
                                                    <input v-model="form.sectn_oserv_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                                <div class="flex items-center">
                                                    <input v-model="form.sectn_oservdark_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700" title="Dark BG Color">
                                                    <input v-model="form.sectn_oservdark_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Services with Brief Intro -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Services with Brief Intro
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_services" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="grid gap-2">
                                                <input v-model="form.sectn_serv_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Title">
                                                <textarea v-model="form.sectn_serv_description" rows="2" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Description"></textarea>
                                                
                                                <!-- Image Upload -->
                                                <div v-if="previewImage" class="relative inline-block mt-2">
                                                    <img :src="previewImage.url" class="w-16 h-16 object-cover rounded">
                                                    <button @click="removePreviewImage" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs">×</button>
                                                </div>
                                                <input type="file" @change="handleFileChange" accept="image/*" class="hidden" ref="fileInput" id="services_image">
                                                <label for="services_image" class="cursor-pointer text-xs text-blue-600 dark:text-blue-500 hover:underline mt-1">Upload Image</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Clients Logos Section -->
                                    <tr class="bg-white dark:bg-gray-800">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Clients Logos
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_client_logo" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="grid gap-2">
                                                <input v-model="form.sectn_client_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Section Title">
                                                <div class="flex items-center">
                                                    <input v-model="form.sectn_client_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700" title="BG Color">
                                                    <input v-model="form.sectn_client_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button" @click="saveUpdate" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>