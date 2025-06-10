<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { usePage, useForm, router } from '@inertiajs/vue3';


const errors = usePage().props.errors;
const welcomeId = usePage().props.welcome.id;
const existingServices = usePage().props.oservices || []; // Get existing services from props

// Initialize services with existing data or empty array
const oservices = ref([]);

// Initialize form with empty services or existing data
onMounted(() => {
    if (existingServices.length > 0) {
        oservices.value = existingServices.map(service => ({
            id: service.id || null, // Include id for existing services
            sectn_oserv_title: service.sectn_oserv_title || '',
            sectn_oservh_bg_color: service.sectn_oservh_bg_color || '#ffffff',
            sectn_oservhd_bg_color: service.sectn_oservhd_bg_color || '#000000',
            sectn_oserv_title_color: service.sectn_oserv_title_color || '#000000',
            sectn_oservdark_title_color: service.sectn_oservdark_title_color || '#000000',
            sectn_oservhover_title_color: service.sectn_oservhover_title_color || '#000000',
            sectn_oservdarkhover_title_color: service.sectn_oservdarkhover_title_color || '#000000',
            sectn_oserv_description: service.sectn_oserv_description || '',
            sectn_oserv_description_color: service.sectn_oserv_description_color || '#000000',
            sectn_oservh_description_color: service.sectn_oservh_description_color || '#000000',
            sectn_oservd_description_color: service.sectn_oservd_description_color || '#000000',
            sectn_oservdh_description_color: service.sectn_oservdh_description_color || '#000000',
        }));
    } else {
        // Start with 4 empty services if none exist
        for (let i = 0; i < 4; i++) {
            oservices.value.push({
                id: null,
                sectn_oserv_title: '',
                sectn_oservh_bg_color: '#ffffff',
                sectn_oservhd_bg_color: '#000000',
                sectn_oserv_title_color: '#000000',
                sectn_oservdark_title_color: '#000000',
                sectn_oservhover_title_color: '#000000',
                sectn_oservdarkhover_title_color: '#000000',
                sectn_oserv_description: '',
                sectn_oserv_description_color: '#000000',
                sectn_oservh_description_color: '#000000',
                sectn_oservd_description_color: '#000000',
                sectn_oservdh_description_color: '#000000',
            });
        }
    }
});

const goBack = () => {
    router.get(route('welcomepage.show', welcomeId));
};

const addNewService = () => {
    oservices.value.push({
        id: null,
        sectn_oserv_title: '',
        sectn_oserv_bg_color: '#ffffff',
        sectn_oservdark_bg_color: '#000000',
        sectn_oservh_bg_color: '#ffffff',
        sectn_oservhd_bg_color: '#000000',
        sectn_oserv_title_color: '#000000',
        sectn_oservdark_title_color: '#000000',
        sectn_oservhover_title_color: '#000000',
        sectn_oservdarkhover_title_color: '#000000',
        sectn_oserv_description: '',
        sectn_oserv_description_color: '#000000',
        sectn_oservh_description_color: '#000000',
        sectn_oservd_description_color: '#000000',
        sectn_oservdh_description_color: '#000000',
    });
};

const removeService = (index) => {
    if (oservices.value.length > 1) {
        oservices.value.splice(index, 1);
    }
};

const form = useForm({
    oservices: []
});

const saveWelcome = () => {
    form.oservices = oservices.value;
    
    form.post(route('welcomepage.oservices.store', welcomeId), {
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
            if (page.props.oservices) {
                oservices.value = page.props.oservices.map(service => ({
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
                                {{ existingServices.length ? 'Edit' : 'Add' }} Services
                            </h2>
                            <button @click="goBack" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Back</button>
                        </div>
                        
                        <div v-for="(service, index) in oservices" :key="index" class="mb-8 p-4 border rounded-lg dark:border-gray-600">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Service #{{ index + 1 }}</h3>
                                <button v-if="oservices.length > 1" @click="removeService(index)" type="button" class="text-red-600 hover:text-red-800">
                                    Remove
                                </button>
                            </div>
                            
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <!-- Title -->
                                <div class="sm:col-span-2">
                                    <label for="sectn_oserv_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                    <input v-model="service.sectn_oserv_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Service title">
                                </div>
                                
                                <!-- Title Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_oserv_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_oserv_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                
                                <!-- Dark Title Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dark Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_oservdark_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_oservdark_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                
                                <!-- Hover Title Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hover Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_oservhover_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_oservhover_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                
                                <!-- Dark Hover Title Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dark Hover Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_oservdarkhover_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_oservdarkhover_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea v-model="service.sectn_oserv_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Service description"></textarea>
                                </div>
                                
                                <!-- Description Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_oserv_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_oserv_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                
                                <!-- Hover Description Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hover Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_oservh_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_oservh_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                
                                <!-- Dark Description Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dark Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_oservd_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_oservd_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                
                                <!-- Dark Hover Description Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dark Hover Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_oservdh_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_oservdh_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                
                             
                                
                                <!-- Hover Background Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hover Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_oservh_bg_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_oservh_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#ffffff">
                                    </div>
                                </div>
                                
                                <!-- Dark Hover Background Color -->
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dark Hover Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="service.sectn_oservhd_bg_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="service.sectn_oservhd_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
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