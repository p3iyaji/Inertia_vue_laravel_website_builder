<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { usePage, useForm, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const errors = usePage().props.errors;
const aboutId = usePage().props.about.id;
const existingMivision = usePage().props.mivi || [];

// Initialize form with useForm
const form = useForm({
    mission_title: '',
    mission_title_color: '#000000',
    mission_description: '',
    mission_description_color: '#000000',
    vision_title: '',
    vision_title_color: '#000000',
    vision_description: '',
    vision_description_color: '#000000',
});

// Check if we have existing data
const existingMivi = existingMivision.length > 0 ? existingMivision[0] : null;

// Populate form with existing data if available
onMounted(() => {
    if (existingMivi) {
        form.mission_title = existingMivi.mission_title || '';
        form.mission_title_color = existingMivi.mission_title_color || '#000000';
        form.mission_description = existingMivi.mission_description || '';
        form.mission_description_color = existingMivi.mission_description_color || '#000000';
        form.vision_title = existingMivi.vision_title || '';
        form.vision_title_color = existingMivi.vision_title_color || '#000000';
        form.vision_description = existingMivi.vision_description || '';
        form.vision_description_color = existingMivi.vision_description_color || '#000000';
    }
});

const goBack = () => {
    router.get(route('aboutpage.show', aboutId));
};

const saveMissionVision = () => {
    const isUpdate = !!existingMivi;
    const routeName = isUpdate ? 'aboutpage.missionvision.update' : 'aboutpage.missionvision.store';
    const routeParams = isUpdate ? [aboutId, existingMivi.id] : [aboutId];

    form[isUpdate ? 'put' : 'post'](
        route(routeName, ...routeParams),
        {
            preserveScroll: true,
            onSuccess: () => {
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    position: 'top-end',
                    showConfirmation: false,
                    timer: 3000,
                    title: `Mission & Vision ${isUpdate ? 'updated' : 'saved'} successfully`
                });
            },
            onError: (errors) => {
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    position: 'top-end',
                    showConfirmation: false,
                    timer: 3000,
                    title: `Error ${isUpdate ? 'updating' : 'saving'} mission & vision`
                });
            }
        }
    );
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="p-4 sm:ml-64">
            <div class="p-4 rounded-lg dark:border-gray-700">
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-4xl lg:py-16">
                        <div class="mb-2 flex justify-between items-center">
                            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                                {{ existingMivi ? 'Edit' : 'Add' }} Mission & Vision
                            </h2>
                            <button @click="goBack" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Back</button>
                        </div>
                        
                        <div class="mb-8 p-4 border rounded-lg dark:border-gray-600">
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <!-- Mission Section -->
                                <div class="sm:col-span-2">
                                    <label for="mission_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mission Title</label>
                                    <input v-model="form.mission_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mission title">
                                </div>
                                
                                <!-- Mission Title Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mission Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.mission_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="form.mission_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                
                                <!-- Mission Description -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mission Description</label>
                                    <textarea v-model="form.mission_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mission description"></textarea>
                                </div>
                                
                                <!-- Mission Description Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mission Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.mission_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="form.mission_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                
                                <hr class="sm:col-span-2 my-4 dark:border-gray-600" />
                                
                                <!-- Vision Section -->
                                <div class="sm:col-span-2">
                                    <label for="vision_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vision Title</label>
                                    <input v-model="form.vision_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Vision title">
                                </div>
                                
                                <!-- Vision Title Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vision Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.vision_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="form.vision_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                
                                <!-- Vision Description -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vision Description</label>
                                    <textarea v-model="form.vision_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Vision description"></textarea>
                                </div>
                                
                                <!-- Vision Description Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vision Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.vision_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="form.vision_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end mt-4">
                            <button @click="saveMissionVision" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                {{ existingMivi ? 'Update' : 'Save' }} Mission & Vision
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>