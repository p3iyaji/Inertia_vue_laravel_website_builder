<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';



const errors = usePage().props.errors;

const form = useForm({
    sectn_header: '',
    sectn_header_title: '',
    sectn_header_description: '',

    sectn_header_title_color: '#000000',
    sectn_header_description_color: '#000000',
    sectn_header_bg_color: '#ffffff',

    sectn_mivi: '',

    sectn_slogan: '',
    sectn_slogan_bg_color: '#ffffff',

    sectn_slogan_caption: '',
    sectn_slogan_subcaption: '',
    slogan_image: '',
    sectn_slogan_caption_color: '#000000',
    sectn_slogan_subcaption_color: '#000000',

    sectn_team: '',
    team_title: '',
    team_caption: '',
    team_title_color: '#000000',
    team_caption_color: '#000000',
    team_bg_color: '#ffffff',
    sectn_team_mem: '',

})

// Image handling
const fileInput = ref(null);
const previewImage = ref(null);
const services_image = ref(null); // For existing image when editing

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
    services_image.value = null;
    // You would typically also make an API call to delete from server
};
const saveWelcome = () => {
    // Convert form to FormData to handle file uploads
    const formData = new FormData();

    // Append all form fields
    formData.append('about',form);

    // Submit the form
    form.post(route('aboutpage.store'), {
        data: formData,
        onSuccess: (page) => {
            const message = page.props.flash?.success || 'About Page added successfully';
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
                            <!-- header section -->
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_header" id="sectn_header" type="checkbox" value=""
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section About Header</span>
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
                                    <label for="sectn_header_title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section Title</label>
                                    <input v-model="form.sectn_header_title" type="text" name="sectn_header_title" id="sectn_header_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type section title">
                                    <span class="text-red-500" v-if="form.errors.sectn_header_title">{{ form.errors.sectn_header_title
                                        }}</span>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="sectn_header_title_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_header_title_color" type="color" name="color"
                                            id="sectn_header_title_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_header_title_color" type="text" name="sectn_header_title_color"
                                            id="sectn_header_title_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_header_title_color">{{
                                        form.errors.sectn_header_title_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_header_description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Header Description
                                    </label>
                                    <textarea id="sectn_header_description" rows="4" name="sectn_header_description"
                                        v-model="form.sectn_header_description"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your thoughts here..."></textarea>

                                    <span class="text-red-500" v-if="form.errors.sectn_header_description">{{
                                        form.errors.sectn_header_description
                                    }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_header_description_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_header_description_color" type="color" name="color"
                                            id="sectn_header_description_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_header_description_color" type="text" name="sectn_header_description_color"
                                            id="sectn_header_description_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_header_description_color">{{
                                        form.errors.sectn_header_description_color }}</span>
                                </div>

                                <!-- mivi section -->
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_mivi" id="sectn_mivi" type="checkbox" value=""
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section Mission & Vision</span>
                                    </label>
                                </div>

                                <!-- slogan section -->
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_slogan" id="sectn_slogan" type="checkbox"
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
                                    <label for="sectn_slogan_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section Slogan Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_slogan_bg_color" type="color" name="sectn_slogan_bg_color"
                                            id="sectn_slogan_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_slogan_bg_color" type="text" name="sectn_slogan_bg_color"
                                            id="sectn_slogan_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_slogan_bg_color">{{
                                        form.errors.sectn_slogan_bg_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_slogan_caption"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section Slogan Caption</label>
                                    <input v-model="form.sectn_slogan_caption" type="text" name="sectn_slogan_caption" id="sectn_slogan_caption"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type section slogan caption">
                                    <span class="text-red-500" v-if="form.errors.sectn_slogan_caption">{{ form.errors.sectn_slogan_caption
                                        }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_slogan_caption_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section Slogan Caption Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_slogan_caption_color" type="color" name="sectn_slogan_caption_color"
                                            id="sectn_slogan_caption_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_slogan_caption_color" type="text" name="sectn_slogan_caption_color"
                                            id="sectn_slogan_caption_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_slogan_caption_color">{{
                                        form.errors.sectn_slogan_caption_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_slogan_subcaption"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section Slogan Subcaption</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_slogan_subcaption" type="color" name="sectn_slogan_subcaption"
                                            id="sectn_slogan_subcaption"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_slogan_subcaption" type="text"
                                            name="sectn_slogan_subcaption" id="sectn_slogan_subcaption"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_slogan_subcaption">{{
                                        form.errors.sectn_slogan_subcaption }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sectn_slogan_subcaption_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section Slogan Subcaption Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.sectn_slogan_subcaption_color" type="color" name="sectn_slogan_subcaption_color"
                                            id="sectn_slogan_subcaption_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.sectn_slogan_subcaption_color" type="text" name="sectn_slogan_subcaption_color"
                                            id="sectn_slogan_subcaption_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.sectn_slogan_subcaption_color">{{
                                        form.errors.sectn_slogan_subcaption_color }}</span>
                                </div>
                                <!-- team color -->
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_team" id="sectn_team" type="checkbox"
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section Team
                                        </span>
                                    </label>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="team_bg_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.team_bg_color" type="color" name="team_bg_color"
                                            id="team_bg_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.team_bg_color" type="text" name="team_bg_color"
                                            id="team_bg_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.team_bg_color">{{ form.errors.team_bg_color
                                        }}</span>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="team_title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team Title</label>
                                    <input v-model="form.team_title" type="text" name="team_title" id="team_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type team title">
                                    <span class="text-red-500" v-if="form.errors.team_title">{{ form.errors.team_title
                                        }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="team_title_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.team_title_color" type="color" name="team_title_color"
                                            id="team_title_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.team_title_color" type="text" name="team_title_color"
                                            id="team_title_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.team_title_color">{{
                                        form.errors.team_title_color }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="team_caption"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team Caption</label>
                                    <input v-model="form.team_caption" type="text" name="team_caption" id="team_caption"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type team caption">
                                    <span class="text-red-500" v-if="form.errors.team_caption">{{ form.errors.team_caption
                                        }}</span>
                                </div>

                                <div class="sm:col-span-2"> 
                                    <label for="team_caption_color"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team Caption Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.team_caption_color" type="color" name="team_caption_color"
                                            id="team_caption_color"
                                            class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700"
                                            title="Choose your color">
                                        <input v-model="form.team_caption_color" type="text" name="team_caption_color"
                                            id="team_caption_color"
                                            class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Enter hex color code">
                                    </div>
                                    <span class="text-red-500" v-if="form.errors.team_caption_color">{{
                                        form.errors.team_caption_color }}</span>
                                </div>
                                    <!-- End -->

                                <!-- team member -->
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.sectn_team_mem" id="sectn_team_mem" type="checkbox"
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Section Team Member
                                        </span>
                                    </label>
                                </div>
                                <!-- End -->

                             
                             
                            </div>
                       
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Add About Page
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>