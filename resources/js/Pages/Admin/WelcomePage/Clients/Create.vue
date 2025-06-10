<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { usePage, useForm, router } from '@inertiajs/vue3';

const errors = usePage().props.errors;
const welcomeId = usePage().props.welcome.id;
const existingClients = usePage().props.clients || [];

// Initialize clients with existing data or empty array
const clients = ref([]);

// Initialize form with empty clients or existing data
onMounted(() => {
    if (existingClients.length > 0) {
        clients.value = existingClients.map(client => ({
            id: client.id || null,
            name: client.name || '',
            logo: client.logo || null,
            newLogo: null, // For handling new logo uploads
            preview: client.logo ? { url: '/storage/' + client.logo } : null
        }));
    } else {
        // Start with 1 empty client if none exist
        addNewClient();
    }
});

const goBack = () => {
    router.get(route('welcomepage.show', welcomeId));
};

const addNewClient = () => {
    clients.value.push({
        id: null,
        name: '',
        logo: null,
        newLogo: null,
        preview: null
    });
};

const removeClient = (index) => {
    if (clients.value.length > 1) {
        clients.value.splice(index, 1);
    }
};

const form = useForm({
    clients: []
});

// Image handling for each client
const handleFileChange = (e, index) => {
    const file = e.target.files[0];
    if (!file) return;

    // Set the new logo for this client
    clients.value[index].newLogo = file;
    
    // Create preview
    clients.value[index].preview = {
        name: file.name,
        url: URL.createObjectURL(file)
    };

    // Reset the input to allow selecting the same file again
    e.target.value = '';
};

const removePreviewImage = (index) => {
    // Remove preview and new logo
    clients.value[index].preview = null;
    clients.value[index].newLogo = null;
};

const deleteImage = (index) => {
    // Remove both existing logo and any new upload
    clients.value[index].logo = null;
    clients.value[index].newLogo = null;
    clients.value[index].preview = null;
};

const saveClients = () => {
    // Prepare FormData for file uploads
    const formData = new FormData();
    
    // Add each client's data
    clients.value.forEach((client, index) => {
        formData.append(`clients[${index}][id]`, client.id || '');
        formData.append(`clients[${index}][name]`, client.name);
        
        // Append new logo if present
        if (client.newLogo) {
            formData.append(`clients[${index}][logo]`, client.newLogo);
        }
        
        // For existing logos (when editing)
        if (client.logo && !client.newLogo) {
            formData.append(`clients[${index}][existing_logo]`, client.logo);
        }
    });

    // Submit the form
    form.transform(() => formData)
        .post(route('welcomepage.clients.store', welcomeId), {
        onSuccess: (page) => {
            const message = page.props.flash?.success || 'Clients saved successfully';
            Swal.fire({
                toast: true,
                icon: 'success',
                position: 'top-end',
                showConfirmation: false,
                timer: 3000,
                title: message
            });
            
            // Update clients with new data from server
            if (page.props.clients) {
                clients.value = page.props.clients.map(client => ({
                    id: client.id,
                    name: client.name,
                    logo: client.logo,
                    newLogo: null,
                    preview: client.logo ? { url: `/${client.logo}` } : null
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
                title: 'Error saving clients'
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
                                {{ existingClients.length ? 'Edit' : 'Add' }} Clients Logo
                            </h2>
                            <button @click="goBack" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Back</button>
                        </div>
                        
                        <div v-for="(client, index) in clients" :key="index" class="mb-8 p-4 border rounded-lg dark:border-gray-600">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Client #{{ index + 1 }}</h3>
                                <button v-if="clients.length > 1" @click="removeClient(index)" type="button" class="text-red-600 hover:text-red-800">
                                    Remove
                                </button>
                            </div>
                            
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <!-- Client Name -->
                                <div class="sm:col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input v-model="client.name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Client name">
                                </div>
                                
                                <!-- Current Image (if editing) -->
                                <div v-if="client.logo && !client.preview" class="mb-4">
                                    <div class="relative inline-block">
                                        <img class="w-24 h-24 rounded-sm object-cover" :src="`/${client.logo}`" alt="Client logo">
                                        <span class="absolute top-0 right-0 transform -translate-y-1/2 w-5 h-5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full cursor-pointer">
                                            <span @click="deleteImage(index)" class="text-white text-xs font-bold absolute flex items-center justify-center w-full h-full">×</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Image Upload Component -->
                                <div class="sm:col-span-2">
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                                        <input 
                                            type="file" 
                                            :id="`client_logo_${index}`" 
                                            @change="(e) => handleFileChange(e, index)" 
                                            accept="image/*" 
                                            class="hidden" 
                                            :ref="`fileInput_${index}`"
                                        >
                                        <label :for="`client_logo_${index}`" class="flex flex-col items-center justify-center cursor-pointer">
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
                                        <div v-if="client.preview" class="mt-4">
                                            <div class="relative inline-block">
                                                <img :src="client.preview.url" class="w-24 h-24 object-cover rounded">
                                                <button @click="removePreviewImage(index)"
                                                    class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center">
                                                    ×
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between mt-4">
                            <button @click="addNewClient" type="button" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                                Add Another Client
                            </button>
                            
                            <button @click="saveClients" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Save All Clients
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>