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

const service = usePage().props.service;


const errors = usePage().props.errors;

const goBack = () => {
    window.history.back();
}

const form = useForm({
        sectn_services: service.sectn_services,
        sectn_services_title: service.sectn_services_title,
        sectn_services_title_color: service.sectn_services_title_color, 
        sectn_header_bg_color: service.sectn_header_bg_color,

        sectn_someserv: service.sectn_someserv,
        sectn_someserve_bg_color: service.sectn_someserve_bg_color,
        sectn_someserve_dark_bg_color: service.sectn_someserve_dark_bg_color,
            
        sectn_servslogan: service.sectn_servslogan,
        sloganimage: service.sloganimage,

        caption_title: service.caption_title,
        caption_color: service.caption_color, 

        slogan: service.slogan,
        slogan_color: service.slogan_color,

        slogan_bg_color: service.slogan_bg_color, 

        sectn_allserve: service.sectn_allserve,
        allserve_bg_color: service.allserve_bg_color,

})

// Image handling
const fileInput = ref(null);
const previewImage = ref(null);
const sloganImage = ref(service?.sloganImage ? { url: '/storage/' + service.sloganImage } : null); // For existing image when editing

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
const saveUpdate = () => {
    // Convert form to FormData to handle file uploads
    const formData = new FormData();

    // Append all form fields
    formData.append('form',form);

    // Submit the form
    form.post(route('servicepage.update',service.id), {
        data: formData,
        onSuccess: (page) => {
            const message = page.props.flash?.success || 'Service Page updated successfully';
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


const addSomeServices = (service) => {
    router.visit(route('servicepage.someserv.create',service.id));
}

const addTeamMember = (service) => {
    router.visit(route('servicepage.teammembers.create',service.id));
}


</script>

<template>
    <AuthenticatedLayout>
        <div class="p-4 sm:ml-64">
            <div class="p-4 rounded-lg dark:border-gray-700">
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-6xl lg:py-16">
                        <div class="mb-2 flex justify-between items-center">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">View & Quick Edit for Service Page</h2>
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
                                    <!-- Services Section -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Services Section
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_services" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="grid gap-4">
                                                <input v-model="form.sectn_services_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Services Title">
                                                <div class="flex items-center gap-4">
                                                    <div>
                                                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Title Color</label>
                                                        <div class="flex items-center">
                                                            <input v-model="form.sectn_services_title_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                            <input v-model="form.sectn_services_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">BG Color</label>
                                                        <div class="flex items-center">
                                                            <input v-model="form.sectn_header_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                            <input v-model="form.sectn_header_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Some Services Section -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Some Services Section
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_someserv" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">BG Color</label>
                                                    <div class="flex items-center">
                                                        <input v-model="form.sectn_someserve_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                        <input v-model="form.sectn_someserve_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Dark BG Color</label>
                                                    <div class="flex items-center">
                                                        <input v-model="form.sectn_someserve_dark_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                        <input v-model="form.sectn_someserve_dark_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Add/Edit Some Services</label>
                                                    <button type="button" @click="addSomeServices(service)" class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-600">
                                                        Add/Edit Some Services
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Services Slogan Section -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Services Slogan
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_servslogan" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="grid gap-4">
                                                <!-- Current Image -->
                                                <div v-if="sloganImage" class="mb-4">
                                                    <div class="relative inline-block">
                                                        <img class="w-24 h-24 rounded-sm object-cover" :src="sloganImage.url" alt="Slogan image">
                                                        <span class="absolute top-0 right-0 transform -translate-y-1/2 w-5 h-5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full cursor-pointer">
                                                            <span @click="deleteImage" class="text-white text-xs font-bold absolute flex items-center justify-center w-full h-full">×</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Image Upload -->
                                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                                                    <input type="file" @change="handleFileChange" accept="image/*" class="hidden" ref="fileInput" id="slogan_image">
                                                    <label for="slogan_image" class="flex flex-col items-center justify-center cursor-pointer">
                                                        <svg class="w-8 h-8 mb-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                        </svg>
                                                        <p class="text-sm text-gray-500">
                                                            <span class="font-semibold">Click to upload</span> or drag and drop
                                                        </p>
                                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                                    </label>
                                                    <div v-if="previewImage" class="mt-4">
                                                        <div class="relative inline-block">
                                                            <img :src="previewImage.url" class="w-24 h-24 object-cover rounded">
                                                            <button @click="removePreviewImage" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center">×</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Caption -->
                                                <div>
                                                    <input v-model="form.caption_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Caption Title">
                                                    <div class="flex items-center mt-2">
                                                        <input v-model="form.caption_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                        <input v-model="form.caption_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>
                                                </div>

                                                <!-- Slogan -->
                                                <div>
                                                    <textarea v-model="form.slogan" type="textarea" rows="4" cols="50" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Slogan"></textarea>
                                                    <div class="flex items-center mt-2">
                                                        <input v-model="form.slogan_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                        <input v-model="form.slogan_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>
                                                </div>

                                                <!-- Slogan BG Color -->
                                                <div class="flex items-center">
                                                    <label class="block mr-2 text-sm font-medium text-gray-900 dark:text-white">BG Color:</label>
                                                    <input v-model="form.slogan_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                    <input v-model="form.slogan_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- All Services Section -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            All Services Section
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_allserve" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <label class="block mr-2 text-sm font-medium text-gray-900 dark:text-white">BG Color:</label>
                                                <input v-model="form.allserve_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                <input v-model="form.allserve_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <button type="button" @click="addAllServices(service)" class="ml-5 text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-600">
                                                Add/Edit All Services
                                            </button>
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