<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { usePage, useForm, router } from '@inertiajs/vue3';

const errors = usePage().props.errors;
const aboutId = usePage().props.about.id;
const existingTeamMembers = usePage().props.teamMembers || [];

// Initialize team members with existing data or empty array
const teamMembers = ref([]);

// Initialize form with existing team members or empty array
onMounted(() => {
    if (existingTeamMembers.length > 0) {
        teamMembers.value = existingTeamMembers.map(teamMember => ({
            id: teamMember.id || null,
            team_mem_name: teamMember.team_mem_name || '',
            team_mem_position: teamMember.team_mem_position || '',
            team_mem_description: teamMember.team_mem_description || '',
            team_mem_image: teamMember.team_mem_image || null,
            team_mem_name_color: teamMember.team_mem_name_color || '#000000',
            team_mem_position_color: teamMember.team_mem_position_color || '#000000',
            team_mem_description_color: teamMember.team_mem_description_color || '#000000',
            team_mem_bg_color: teamMember.team_mem_bg_color || '#000000',
            newImage: null,
            preview: teamMember.team_mem_image ? { url: '/storage/' + teamMember.team_mem_image } : null
        }));
    } else {
        addNewTeamMember();
    }
});

const goBack = () => {
    router.get(route('aboutpage.show', aboutId));
};

const addNewTeamMember = () => {
    teamMembers.value.push({
        id: null,
        team_mem_name: '',
        team_mem_position: '',
        team_mem_description: '',
        team_mem_image: null,
        team_mem_name_color: '#000000',
        team_mem_position_color: '#000000',
        team_mem_description_color: '#000000',
        team_mem_bg_color: '#000000',
        newImage: null,
        preview: null
    });
};

const removeTeamMember = (index) => {
    if (teamMembers.value.length > 1) {
        teamMembers.value.splice(index, 1);
    }
};

const form = useForm({
    teamMembers: []
});

// Image handling for each team member
const handleFileChange = (e, index) => {
    const file = e.target.files[0];
    if (!file) return;

    teamMembers.value[index].newImage = file;
    teamMembers.value[index].preview = {
        name: file.name,
        url: URL.createObjectURL(file)
    };

    e.target.value = '';
};

const removePreviewImage = (index) => {
    teamMembers.value[index].preview = null;
    teamMembers.value[index].newImage = null;
};

const deleteImage = (index) => {
    teamMembers.value[index].team_mem_image = null;
    teamMembers.value[index].newImage = null;
    teamMembers.value[index].preview = null;
};

const saveTeamMembers = () => {
    const formData = new FormData();
    
    // Add each team member's data
    teamMembers.value.forEach((teamMember, index) => {
        formData.append(`teamMembers[${index}][id]`, teamMember.id || '');
        formData.append(`teamMembers[${index}][team_mem_name]`, teamMember.team_mem_name);
        formData.append(`teamMembers[${index}][team_mem_position]`, teamMember.team_mem_position);
        formData.append(`teamMembers[${index}][team_mem_description]`, teamMember.team_mem_description);
        formData.append(`teamMembers[${index}][team_mem_name_color]`, teamMember.team_mem_name_color);
        formData.append(`teamMembers[${index}][team_mem_position_color]`, teamMember.team_mem_position_color);
        formData.append(`teamMembers[${index}][team_mem_description_color]`, teamMember.team_mem_description_color);
        formData.append(`teamMembers[${index}][team_mem_bg_color]`, teamMember.team_mem_bg_color);
        
        // For new images
        if (teamMember.newImage) {
            formData.append(`teamMembers[${index}][team_mem_image]`, teamMember.newImage);
        }
        // For existing images (mark as unchanged)
        else if (teamMember.team_mem_image) {
            formData.append(`teamMembers[${index}][existing_image]`, teamMember.team_mem_image);
        }
    });

    // Determine if we're updating or creating
    const hasExistingMembers = teamMembers.value.some(member => member.id !== null);
    const routeName = hasExistingMembers ? 'aboutpage.teammembers.update' : 'aboutpage.teammembers.store';

    form.transform(() => formData)
        .post(route(routeName, aboutId), {
            preserveScroll: true,
            onSuccess: (page) => {
                const message = page.props.flash?.success || 'Team members saved successfully';
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    position: 'top-end',
                    showConfirmation: false,
                    timer: 3000,
                    title: message
                });
                
                // Update teamMembers with new data from server
                if (page.props.teamMembers) {
                    teamMembers.value = page.props.teamMembers.map(teamMember => ({
                        id: teamMember.id,
                        team_mem_name: teamMember.team_mem_name,
                        team_mem_position: teamMember.team_mem_position,
                        team_mem_description: teamMember.team_mem_description,
                        team_mem_image: teamMember.team_mem_image,
                        team_mem_name_color: teamMember.team_mem_name_color,
                        team_mem_position_color: teamMember.team_mem_position_color,
                        team_mem_description_color: teamMember.team_mem_description_color,
                        team_mem_bg_color: teamMember.team_mem_bg_color,
                        newImage: null,
                        preview: teamMember.team_mem_image ? { url: '/storage/' + teamMember.team_mem_image } : null
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
                    title: 'Error saving team members'
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
                                {{ existingTeamMembers.length ? 'Edit' : 'Add' }} Team Members
                            </h2>
                            <button @click="goBack" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Back</button>
                        </div>
                        
                        <div v-for="(teamMember, index) in teamMembers" :key="index" class="mb-8 p-4 border rounded-lg dark:border-gray-600">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Team Member #{{ index + 1 }}</h3>
                                <button v-if="teamMembers.length > 1" @click="removeTeamMember(index)" type="button" class="text-red-600 hover:text-red-800">
                                    Remove
                                </button>
                            </div>
                            
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <!-- Team Member Name -->
                                <div class="sm:col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input v-model="teamMember.team_mem_name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Client name">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team Member Name Color</label>
                                    <div class="flex items-center">
                                        <input v-model="teamMember.team_mem_name_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="teamMember.team_mem_name_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                 <!-- Team Member Position -->
                                 <div class="sm:col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position/Rank</label>
                                    <input v-model="teamMember.team_mem_position" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Client name">
                                </div> 
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team Member Position Color</label>
                                    <div class="flex items-center">
                                        <input v-model="teamMember.team_mem_position_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="teamMember.team_mem_position_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                <!-- Team Member Description -->
                                <div class="sm:col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea v-model="teamMember.team_mem_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Vision description"></textarea>
                                </div> 
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team Member Description Color</label>
                                    <div class="flex items-center">
                                        <input v-model="teamMember.team_mem_description_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="teamMember.team_mem_description_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team Member Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="teamMember.team_mem_bg_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="teamMember.team_mem_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                <!-- Current Image (if editing) -->
                                <div v-if="teamMember.team_mem_image && !teamMember.preview" class="mb-4">
                                    <div class="relative inline-block">
                                        <img class="w-24 h-24 rounded-sm object-cover" :src="`/${teamMember.team_mem_image}`" alt="Client logo">
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
                                            :id="`team_mem_image_${index}`" 
                                            @change="(e) => handleFileChange(e, index)" 
                                            accept="image/*" 
                                            class="hidden" 
                                            :ref="`fileInput_${index}`"
                                        >
                                        <label :for="`team_mem_image_${index}`" class="flex flex-col items-center justify-center cursor-pointer">
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
                                        <div v-if="teamMember.preview" class="mt-4">
                                            <div class="relative inline-block">
                                                <img :src="teamMember.preview.url" class="w-24 h-24 object-cover rounded">
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
                            <button @click="addNewTeamMember" type="button" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                                Add Another Team Member
                            </button>
                            
                            <button @click="saveTeamMembers" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Save All Team Members
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>