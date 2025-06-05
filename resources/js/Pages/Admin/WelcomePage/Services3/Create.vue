<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { usePage, useForm, router } from '@inertiajs/vue3';

const errors = usePage().props.errors;
const welcomeId = usePage().props.welcome.id;
const existingServices = usePage().props.services || []; // Get existing services from props

// Initialize services with existing data or empty array
const services = ref([]);

// Initialize form with empty services or existing data
onMounted(() => {
    if (existingServices.length > 0) {
        services.value = existingServices.map(service => ({
            id: service.id || null, // Include id for existing services
            sectn_3_title: service.sectn_3_title || '',
            sectn_3_title_color: service.sectn_3_title_color || '#000000',
            sectn_3ghover_title_color: service.sectn_3ghover_title_color || '#000000',
            sectn_3darkghover_title_color: service.sectn_3darkghover_title_color || '#000000',
            sectn_3_bg_color: service.sectn_3_bg_color || '#ffffff',
            sectn_3_dark_bg_color: service.sectn_3_dark_bg_color || '#000000',
            sectn_3_description: service.sectn_3_description || '',
            sectn_3_description_color: service.sectn_3_description_color || '#000000',
            sectn_3ghover_description_color: service.sectn_3ghover_description_color || '#000000',
            sectn_3dark_description_color: service.sectn_3dark_description_color || '#000000',
            sectn_3darkhover_description_color: service.sectn_3darkhover_description_color || '#000000',
        }));
    } else {
        // Start with 3 empty services if none exist
        for (let i = 0; i < 3; i++) {
            services.value.push({
                id: null,
                sectn_3_title: '',
                sectn_3_title_color: '#000000',
                sectn_3ghover_title_color: '#000000',
                sectn_3darkghover_title_color: '#000000',
                sectn_3_bg_color: '#ffffff',
                sectn_3_dark_bg_color: '#000000',
                sectn_3_description: '',
                sectn_3_description_color: '#000000',
                sectn_3ghover_description_color: '#000000',
                sectn_3dark_description_color: '#000000',
                sectn_3darkhover_description_color: '#000000',
            });
        }
    }
});

const goBack = () => {
    router.get(route('welcomepage.show', welcomeId));
};

const addNewService = () => {
    services.value.push({
        id: null,
        sectn_3_title: '',
        sectn_3_title_color: '#000000',
        sectn_3ghover_title_color: '#000000',
        sectn_3darkghover_title_color: '#000000',
        sectn_3_bg_color: '#ffffff',
        sectn_3_dark_bg_color: '#000000',
        sectn_3_description: '',
        sectn_3_description_color: '#000000',
        sectn_3ghover_description_color: '#000000',
        sectn_3dark_description_color: '#000000',
        sectn_3darkhover_description_color: '#000000',
    });
};

const removeService = (index) => {
    if (services.value.length > 1) {
        services.value.splice(index, 1);
    }
};

const form = useForm({
    services: []
});

const saveWelcome = () => {
    form.services = services.value;
    
    form.post(route('welcomepage.services3.store', welcomeId), {
        onSuccess: (page) => {
            const message = page.props.flash?.success || 'Services saved successfully';
            Swal.fire({
                toast: true,
                icon: 'success',
                position: 'top-end',
                showConfirmation: false,
                timer: 3000,
                title: message
            });
            
            // If new services were created, update the IDs
            if (page.props.services) {
                services.value = page.props.services.map(service => ({
                    ...service,
                    id: service.id
                }));
            }
        },
        onError: (errors) => {
            Swal.fire({
                toast: true,
                icon: 'error',
                position: 'top-end',
                showConfirmation: false,
                timer: 3000,
                title: 'Error saving services'
            });
        }
    });
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
                                {{ existingServices.length ? 'Edit' : 'Add' }} 3 Services
                            </h2>
                            <button @click="goBack" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Back</button>
                        </div>
                        
                        <div v-for="(service, index) in services" :key="index" class="mb-8 p-4 border rounded-lg dark:border-gray-600">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Service #{{ index + 1 }}</h3>
                                <button v-if="services.length > 1" @click="removeService(index)" type="button" class="text-red-600 hover:text-red-800">
                                    Remove
                                </button>
                            </div>
                            
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <!-- Title -->
                                <div class="sm:col-span-2">
                                    <label for="sectn_3_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                    <input v-model="service.sectn_3_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type title">
                                </div>
                                
                                <!-- Title Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_3_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_3_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Hex code">
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea v-model="service.sectn_3_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Description"></textarea>
                                </div>
                                
                                <!-- Description Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_3_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_3_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Hex code">
                                    </div>
                                </div>
                                
                                <!-- Group Hover Title Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group Hover Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_3ghover_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_3ghover_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Hex code">
                                    </div>
                                </div>
                                
                                <!-- Dark Group Hover Title Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dark Group Hover Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_3darkghover_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_3darkghover_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Hex code">
                                    </div>
                                </div>

                                <!-- Background Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_3_bg_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_3_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Hex code">
                                    </div>
                                </div>

                                <!-- Dark Background Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dark Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_3_dark_bg_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_3_dark_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Hex code">
                                    </div>
                                </div>

                                <!-- Group Hover Description Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group Hover Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_3ghover_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_3ghover_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Hex code">
                                    </div>
                                </div>

                                <!-- Dark Description Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dark Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_3dark_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_3dark_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Hex code">
                                    </div>
                                </div>

                                <!-- Dark Hover Description Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dark Hover Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_3darkhover_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_3darkhover_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Hex code">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between mt-4">
                            <button @click="addNewService" type="button" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                                Add Another Service
                            </button>
                            
                            <button @click="saveWelcome" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Save All Services
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>