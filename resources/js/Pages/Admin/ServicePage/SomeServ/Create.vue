<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { usePage, useForm, router } from '@inertiajs/vue3';

const errors = usePage().props.errors;
const someservId = usePage().props.service.id;
const existingSomeServs = usePage().props.someServs || [];

// Initialize team members with existing data or empty array
const someServs = ref([]);

// Initialize form with existing team members or empty array
onMounted(() => {
    if (existingSomeServs.length > 0) {
        someServs.value = existingSomeServs.map(someServ => ({
            id: someServ.id || null,
            sectn_someserv_title: someServ.sectn_someserv_title || '',
            sectn_someserv_title_color: someServ.sectn_someserv_title_color || '#000000',

            sectn_someserv_description: someServ.sectn_someserv_description || '',
            sectn_someserv_des_color: someServ.sectn_someserv_des_color || '#000000',

            sectn_someserv_bg_color: someServ.sectn_someserv_bg_color || '#000000', 
            sectn_someserv_dark_bg_color: someServ.sectn_someserv_dark_bg_color || '#000000', 

            someservimage: someServ.someservimage || null,
            newImage: null,
            preview: someServ.someservimage ? { url: '/storage/' + someServ.someservimage } : null
        }));
    } else {
        addNewSomeServ();
    }
});

const goBack = () => {
    router.get(route('servicepage.show', someservId));
};

const addNewSomeServ = () => {
    someServs.value.push({
        id: null,
        sectn_someserv_title: '',
        sectn_someserv_title_color: '#000000',

        sectn_someserv_description: '',
        sectn_someserv_des_color: '#000000',

        sectn_someserv_bg_color: '#000000', 
        sectn_someserv_dark_bg_color: '#000000', 

        someservimage: null,
        newImage: null,
        preview: null
    });
};

const removeSomeServ = (index) => {
    if (someServs.value.length > 1) {
        someServs.value.splice(index, 1);
    }
};

const form = useForm({
    teamMembers: []
});

// Image handling for each team member
const handleFileChange = (e, index) => {
    const file = e.target.files[0];
    if (!file) return;

    someServs.value[index].newImage = file;
    someServs.value[index].preview = {
        name: file.name,
        url: URL.createObjectURL(file)
    };

    e.target.value = '';
};

const removePreviewImage = (index) => {
    someServs.value[index].preview = null;
    someServs.value[index].newImage = null;
};

const deleteImage = (index) => {
    someServs.value[index].someservimage = null;
    someServs.value[index].newImage = null;
    someServs.value[index].preview = null;
};

const saveSomeServs = () => {
    const formData = new FormData();
    
    // Add each team member's data
    someServs.value.forEach((someServ, index) => {
        formData.append(`someServs[${index}][id]`, someServ.id || '');
        formData.append(`someServs[${index}][sectn_someserv_title]`, someServ.sectn_someserv_title);
        formData.append(`someServs[${index}][sectn_someserv_title_color]`, someServ.sectn_someserv_title_color);
        formData.append(`someServs[${index}][sectn_someserv_description]`, someServ.sectn_someserv_description);
        formData.append(`someServs[${index}][sectn_someserv_des_color]`, someServ.sectn_someserv_des_color);
        formData.append(`someServs[${index}][sectn_someserv_bg_color]`, someServ.sectn_someserv_bg_color);
        formData.append(`someServs[${index}][sectn_someserv_dark_bg_color]`, someServ.sectn_someserv_dark_bg_color);
        
        // For new images
        if (someServ.newImage) {
            formData.append(`someServs[${index}][someservimage]`, someServ.newImage);
        }
        // For existing images (mark as unchanged)
        else if (someServ.someservimage) {
            formData.append(`someServs[${index}][existing_image]`, someServ.someservimage);
        }
    });

    // Determine if we're updating or creating
    const hasExistingMembers = someServs.value.some(member => member.id !== null);
    const routeName = hasExistingMembers ? 'servicepage.someserv.update' : 'servicepage.someserv.store';

    form.transform(() => formData)
        .post(route(routeName, someservId), {
            preserveScroll: true,
            onSuccess: (page) => {
                const message = page.props.flash?.success || 'SomeServs saved successfully';
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    position: 'top-end',
                    showConfirmation: false,
                    timer: 3000,
                    title: message
                });
                
                // Update teamMembers with new data from server
                if (page.props.someServs) {
                    someServs.value = page.props.someServs.map(someServ => ({
                        id: someServ.id,
                        sectn_someserv_title: someServ.sectn_someserv_title,
                        sectn_someserv_title_color: someServ.sectn_someserv_title_color,
                        sectn_someserv_description: someServ.sectn_someserv_description,
                        sectn_someserv_des_color: someServ.sectn_someserv_des_color,
                        sectn_someserv_bg_color: someServ.sectn_someserv_bg_color,
                        sectn_someserv_dark_bg_color: someServ.sectn_someserv_dark_bg_color,
                        someservimage: someServ.someservimage,
                        newImage: null,
                        preview: someServ.someservimage ? { url: '/storage/' + someServ.someservimage } : null
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
                    title: 'Error saving SomeServs'
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
                                {{ existingSomeServs.length ? 'Edit' : 'Add' }} Some Services
                            </h2>
                            <button @click="goBack" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Back</button>
                        </div>
                        
                        <div v-for="(someServ, index) in someServs" :key="index" class="mb-8 p-4 border rounded-lg dark:border-gray-600">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">SomeServ #{{ index + 1 }}</h3>
                                <button v-if="someServs.length > 1" @click="removeSomeServ(index)" type="button" class="text-red-600 hover:text-red-800">
                                    Remove
                                </button>
                            </div>
                            
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <!-- SomeServ Title -->
                                <div class="sm:col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                    <input v-model="someServ.sectn_someserv_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Client name">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="someServ.sectn_someserv_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="someServ.sectn_someserv_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>

                                <!-- SomeServ Description -->
                                <div class="sm:col-span-2">

                                    <label for="sectn_someserv_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea rows="4" cols="50" v-model="someServ.sectn_someserv_description" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Client name">
                             
                                </textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="someServ.sectn_someserv_des_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="someServ.sectn_someserv_des_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SomeServ Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="someServ.sectn_someserv_bg_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="someServ.sectn_someserv_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SomeServ Dark Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="someServ.sectn_someserv_dark_bg_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="someServ.sectn_someserv_dark_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                <!-- Current Image (if editing) -->
                                <div v-if="someServ.someservimage && !someServ.preview" class="mb-4">
                                    <div class="relative inline-block">
                                        <img class="w-24 h-24 rounded-sm object-cover" :src="`/${someServ.someservimage}`" alt="Client logo">
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
                                            :id="`someservimage_${index}`" 
                                            @change="(e) => handleFileChange(e, index)" 
                                            accept="image/*" 
                                            class="hidden" 
                                            :ref="`fileInput_${index}`"
                                        >
                                        <label :for="`someservimage_${index}`" class="flex flex-col items-center justify-center cursor-pointer">
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
                                        <div v-if="someServ.preview" class="mt-4">
                                            <div class="relative inline-block">
                                                <img :src="someServ.preview.url" class="w-24 h-24 object-cover rounded">
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
                            <button @click="addNewSomeServ" type="button" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                                Add Another Service
                            </button>
                            
                            <button @click="saveSomeServs" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Save All Services
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>