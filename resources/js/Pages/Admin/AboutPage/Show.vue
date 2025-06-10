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

const about = usePage().props.about;


const errors = usePage().props.errors;

const goBack = () => {
    window.history.back();
}

const form = useForm({
    sectn_header: !!about.sectn_header,
    sectn_header_title: about.sectn_header_title,
    sectn_header_description: about.sectn_header_description,

    sectn_header_title_color: about.sectn_header_title_color,
    sectn_header_description_color: about.sectn_header_description_color,
    sectn_header_bg_color: about.sectn_header_bg_color,

    sectn_mivi: !!about.sectn_mivi,

    sectn_slogan: !!about.sectn_slogan,
    sectn_slogan_bg_color: about.sectn_slogan_bg_color,

    sectn_slogan_caption: about.sectn_slogan_caption,
    sectn_slogan_subcaption: about.sectn_slogan_subcaption,
    slogan_image: about.slogan_image,
    sectn_slogan_caption_color: about.sectn_slogan_caption_color,
    sectn_slogan_subcaption_color: about.sectn_slogan_subcaption_color,

    sectn_team: !!about.sectn_team,
    team_title: about.team_title,
    team_caption: about.team_caption,
    team_title_color: about.team_title_color,
    team_caption_color: about.team_caption_color,
    team_bg_color: about.team_bg_color,
    sectn_team_mem: !!about.sectn_team_mem,

})

// Image handling
const fileInput = ref(null);
const previewImage = ref(null);
const slogan_image = ref(about?.slogan_image ? { url: '/storage/' + about.slogan_image } : null); // For existing image when editing

const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (!file) return;

    // Set form data (assuming your form has an 'image' field)
    form.slogan_image = file;

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
    form.slogan_image = null;
};

const deleteImage = () => {
    // For existing image (when editing)
    slogan_image.value = null;
    // You would typically also make an API call to delete from server
};
const saveUpdate = () => {
    // Convert form to FormData to handle file uploads
    const formData = new FormData();

    // Append all form fields
    formData.append('form',form);

    // Submit the form
    form.post(route('aboutpage.update',about.id), {
        data: formData,
        onSuccess: (page) => {
            const message = page.props.flash?.success || 'About Page updated successfully';
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


const AddMissionVision = (about) => {
    router.visit(route('aboutpage.missionvision.create',about.id));
}

const addTeamMember = (about) => {
    router.visit(route('aboutpage.teammembers.create',about.id));
}


</script>

<template>
    <AuthenticatedLayout>
        <div class="p-4 sm:ml-64">
            <div class="p-4 rounded-lg dark:border-gray-700">
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-6xl lg:py-16">
                        <div class="mb-2 flex justify-between items-center">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">View & Quick Edit for About Page</h2>
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
                                    <!-- Header Section -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Section Header
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_header" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="grid gap-4">
                                                <input v-model="form.sectn_header_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Header Title">
                                                <textarea v-model="form.sectn_header_description" rows="2" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Header Description"></textarea>
                                                <div class="flex items-center gap-4">
                                                    <div>
                                                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Title Color</label>
                                                        <div class="flex items-center">
                                                            <input v-model="form.sectn_header_title_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                            <input v-model="form.sectn_header_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Description Color</label>
                                                        <div class="flex items-center">
                                                            <input v-model="form.sectn_header_description_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                            <input v-model="form.sectn_header_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
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

                                    <!-- Mission & Vision Section -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Mission & Vision
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_mivi" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <button type="button" @click="AddMissionVision(about)" class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-600">
                                                    Add/Edit Mission & Vision
                                               </button>
                                        </td>
                                    </tr>

                                    <!-- Slogan Section -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Slogan Section
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_slogan" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="grid gap-4">
                                                <div class="flex items-center">
                                                    <input v-model="form.sectn_slogan_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                    <input v-model="form.sectn_slogan_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                                <input v-model="form.sectn_slogan_caption" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Caption">
                                                <div class="flex items-center">
                                                    <input v-model="form.sectn_slogan_caption_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                    <input v-model="form.sectn_slogan_caption_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                                <input v-model="form.sectn_slogan_subcaption" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Subcaption">
                                                <div class="flex items-center">
                                                    <input v-model="form.sectn_slogan_subcaption_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                    <input v-model="form.sectn_slogan_subcaption_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                                   <!-- Current Images (if editing) -->
                                                <div v-if="slogan_image"
                                                    class="flex flex-nowrap mb-4 space-x-1 overflow-x-auto">
                                                    <div class="relative mb-3">
                                                    <img class="w-24 h-24 rounded-sm object-cover" :src="`/storage/${about.slogan_image}`"
                                                            alt="">
                                                        <span
                                                            class="absolute top-0 right-0 transform -translate-y-1/2 w-5 h-5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full cursor-pointer">
                                                            <span @click="deleteImage(slogan_image)"
                                                                class="text-white text-xs font-bold absolute flex items-center justify-center w-full h-full">×</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <!-- Slogan Image Upload -->
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
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Team Section -->
                                    <tr class="bg-white dark:bg-gray-800">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Team Section
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_team" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="grid gap-4">
                                                <input v-model="form.team_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Team Title">
                                                <div class="flex items-center">
                                                    <input v-model="form.team_title_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                    <input v-model="form.team_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                                <input v-model="form.team_caption" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Team Caption">
                                                <div class="flex items-center">
                                                    <input v-model="form.team_caption_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                    <input v-model="form.team_caption_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                                <div class="flex items-center">
                                                    <input v-model="form.team_bg_color" type="color" class="h-8 w-8 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                                    <input v-model="form.team_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-24 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                               
                                            </div>
                                        </td>
                                        
                                    </tr>
                                      <!-- Team Members Section -->
                                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Team Members
                                        </th>
                                        <td class="px-6 py-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input v-model="form.sectn_team_mem" type="checkbox" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            <button type="button" @click="addTeamMember(about)" class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-600">
                                                    Add/Edit Team Members
                                               </button>
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