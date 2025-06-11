<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { usePage, useForm, router } from '@inertiajs/vue3';

const errors = usePage().props.errors;
const allservId = usePage().props.service.id;
const existingAllServs = usePage().props.allServs || [];

// Initialize team members with existing data or empty array
const allServs = ref([]);

// Initialize form with existing team members or empty array
onMounted(() => {
    if (existingAllServs.length > 0) {
        allServs.value = existingAllServs.map(allServ => ({
            id: allServ.id || null,
            allserve_title: allServ.allserve_title || '',
            allserve_description: allServ.allserve_description || '',
            allserve_image: allServ.allserve_image || null,
            allserve_title_color: allServ.allserve_title_color || '#000000',
            allserve_description_color: allServ.allserve_description_color || '#000000',
            
            newImage: null,
            preview: allServ.allserve_image ? { url: '/storage/' + allServ.allserve_image } : null
        }));
    } else {
        addNewAllServ();
    }
});

const goBack = () => {
    router.get(route('servicepage.show', allservId));
};

const addNewAllServ = () => {
    allServs.value.push({
        id: null,
        allserve_title: '',
        allserve_description: '',
        allserve_image: null,
        allserve_title_color: '#000000',

        allserve_description_color: '#000000',


        newImage: null,
        preview: null
    });
};

const removeAllServ = (index) => {
    if (allServs.value.length > 1) {
        allServs.value.splice(index, 1);
    }
};

const form = useForm({
    teamMembers: []
});

// Image handling for each team member
const handleFileChange = (e, index) => {
    const file = e.target.files[0];
    if (!file) return;

    allServs.value[index].newImage = file;
    allServs.value[index].preview = {
        name: file.name,
        url: URL.createObjectURL(file)
    };

    e.target.value = '';
};

const removePreviewImage = (index) => {
    allServs.value[index].preview = null;
    allServs.value[index].newImage = null;
};

const deleteImage = (index) => {
    allServs.value[index].allserve_image = null;
    allServs.value[index].newImage = null;
    allServs.value[index].preview = null;
};

const saveAllServs = () => {
    const formData = new FormData();
    
    // Add each team member's data
    allServs.value.forEach((allServ, index) => {
        formData.append(`allServs[${index}][id]`, allServ.id || '');
        formData.append(`allServs[${index}][allserve_title]`, allServ.allserve_title);
        formData.append(`allServs[${index}][allserve_title_color]`, allServ.allserve_title_color);
        formData.append(`allServs[${index}][allserve_description]`, allServ.allserve_description);
        formData.append(`allServs[${index}][allserve_description_color]`, allServ.allserve_description_color);
        
        // For new images
        if (allServ.newImage) {
            formData.append(`allServs[${index}][allserve_image]`, allServ.newImage);
        }
        // For existing images (mark as unchanged)
        else if (allServ.allserve_image) {
            formData.append(`allServs[${index}][existing_image]`, allServ.allserve_image);
        }
    });

    // Determine if we're updating or creating
    const hasExistingAllServ = allServs.value.some(allServ => allServ.id !== null);
    const routeName = hasExistingAllServ ? 'servicepage.allserv.update' : 'servicepage.allserv.store';

    form.transform(() => formData)
        .post(route(routeName, allservId), {
            preserveScroll: true,
            onSuccess: (page) => {
                const message = page.props.flash?.success || 'All Service saved successfully';
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    position: 'top-end',
                    showConfirmation: false,
                    timer: 3000,
                    title: message
                });
                
                // Update teamMembers with new data from server
                if (page.props.allServs) {
                    allServs.value = page.props.allServs.map(allServ => ({
                        id: allServ.id,
                        allserve_title: allServ.allserve_title,
                        allserve_title_color: allServ.allserve_title_color,
                        allserve_description: allServ.allserve_description,
                        allserve_description_color: allServ.allserve_description_color,
                        allserve_image: allServ.allserve_image,
                        newImage: null,
                        preview: allServ.allserve_image ? { url: '/storage/' + allServ.allserve_image } : null
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
                    title: 'Error saving All Services'
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
                                {{ existingAllServs.length ? 'Edit' : 'Add' }} All Services
                            </h2>
                            <button @click="goBack" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Back</button>
                        </div>
                        
                        <div v-for="(allServ, index) in allServs" :key="index" class="mb-8 p-4 border rounded-lg dark:border-gray-600">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">AllServ #{{ index + 1 }}</h3>
                                <button v-if="allServs.length > 1" @click="removeAllServ(index)" type="button" class="text-red-600 hover:text-red-800">
                                    Remove
                                </button>
                            </div>
                            
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <!-- Allserve Title -->
                                <div class="sm:col-span-2">
                                    <label for="allserve_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                    <input v-model="allServ.allserve_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Client name">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="allServ.allserve_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="allServ.allserve_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>

                                <!-- AllServ Description -->
                                <div class="sm:col-span-2">

                                    <label for="allserve_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea rows="4" cols="50" v-model="allServ.allserve_description" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Client name">
                             
                                </textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="allServ.allserve_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="allServ.allserve_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>

                               
                                <!-- Current Image (if editing) -->
                                <div v-if="allServ.allserve_image && !allServ.preview" class="mb-4">
                                    <div class="relative inline-block">
                                        <img class="w-24 h-24 rounded-sm object-cover" :src="`/${allServ.allserve_image}`" alt="Client logo">
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
                                            :id="`allserve_image_${index}`" 
                                            @change="(e) => handleFileChange(e, index)" 
                                            accept="image/*" 
                                            class="hidden" 
                                            :ref="`fileInput_${index}`"
                                        >
                                        <label :for="`allserve_image_${index}`" class="flex flex-col items-center justify-center cursor-pointer">
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
                                        <div v-if="allServ.preview" class="mt-4">
                                            <div class="relative inline-block">
                                                <img :src="allServ.preview.url" class="w-24 h-24 object-cover rounded">
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
                            <button @click="addNewAllServ" type="button" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                                Add Another Service
                            </button>
                            
                            <button @click="saveAllServs" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Save All Services
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>