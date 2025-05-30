<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { usePage, useForm, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const hero = usePage().props.hero;
const errors = usePage().props.errors;


const form = useForm({
    caption:  hero.caption,
    sub_caption: hero.sub_caption,
    contact_title: hero.contact_title,
    contact_link: hero.contact_link,
    learn_title: hero.learn_title,
    learn_link: hero.learn_link,
    images: []

})

// Image handling
const fileInput = ref(null);
const previewImages = ref([]);
const hero_images = ref(hero?.images || []); // For existing images when editing

const handleFileChange = (e) => {
    const files = e.target.files;
    if (!files.length) return;

    // Add new files to form and create previews
    for (let i = 0; i < files.length; i++) {
        const file = files[i];

        // Check if file already exists
        const fileExists = form.images.some(
            existingFile => existingFile.name === file.name && existingFile.size === file.size
        );

        if (!fileExists) {
            // Add to form data
            form.images.push(file);

            // Create preview
            previewImages.value.push({
                name: file.name,
                url: URL.createObjectURL(file)
            });
        }
    }

    // Reset the input to allow selecting the same files again
    e.target.value = '';
};

const removePreviewImage = (index) => {
    // Remove from preview
    previewImages.value.splice(index, 1);
    // Remove from form data
    form.images.splice(index, 1);
};

const deleteImage = async (image, index) => {
    if (confirm('Are you sure you want to delete this image?')) {
        try {
            await axios.delete(route('pagehero.images.destroy', image.id));
            hero_images.value.splice(index, 1);
            Swal.fire('Deleted!', 'Image has been deleted.', 'success');
        } catch (error) {
            Swal.fire('Error!', 'Failed to delete image.', 'error');
        }
    }
};


//This update method is important to enable Inertia deal with images while posting the formData too
const updateHero = async () => {
    const formData = new FormData();

    Object.keys(form.data()).forEach(key => {
        if (key === 'images') {
            form.images.forEach((image, index) => {
                formData.append(`images[${index}]`, image);
            });
        } else {
            formData.append(key, form[key]);
        }
    });

    // Spoof the method since PUT doesn't work well with FormData
   // formData.append('_method', 'PUT');

    try {
        router.post(route('pagehero.update', hero.id), formData, {
            _method: 'put',
            onSuccess: (page) => {
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    position: 'top-end',
                    showConfirmation: false,
                    timer: 3000,
                    title: 'Product updated successfully!',
                });
            },
        });
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            form.setErrors(error.response.data.errors);
        } else {
            console.error(error);
        }
    }
};


</script>

<template>
    <AuthenticatedLayout>
        <div class="p-4 sm:ml-64">
            <div class="p-4 rounded-lg dark:border-gray-700">
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Hero</h2>
                        <form @submit.prevent="updateHero()">
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label for="caption"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Caption</label>
                                    <input v-model="form.caption" type="text" name="caption" id="caption"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type caption name">
                                        <span class="text-red-500" v-if="form.errors.caption">{{ form.errors.caption }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="sub_caption"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub Caption</label>
                                    <input v-model="form.sub_caption" type="text" name="sub_caption" id="sub_caption"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type Sub caption">
                                        <span class="text-red-500" v-if="form.errors.sub_caption">{{ form.errors.sub_caption }}</span>

                                </div>
                                <div class="w-full">
                                    <label for="contact_title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Title</label>
                                    <input v-model="form.contact_title" type="text" name="contact_title" id="contact_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type contact title">
                                        <span class="text-red-500" v-if="form.errors.contact_title">{{ form.errors.contact_title }}</span>

                                </div>
                                <div class="w-full">
                                    <label for="contact_link"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Link</label>
                                    <input v-model="form.contact_link" type="text" name="contact_link" id="contact_link"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="url">
                                        <span class="text-red-500" v-if="form.errors.contact_link">{{ form.errors.contact_link }}</span>

                                </div>
                                <div class="w-full">
                                    <label for="learn_title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Learn Title</label>
                                    <input v-model="form.learn_title" type="text" name="learn_title" id="learn_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type learn title">
                                        <span class="text-red-500" v-if="form.errors.learn_title">{{ form.errors.learn_title }}</span>

                                </div>
                                <div class="w-full">
                                    <label for="learn_link"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">learn Link</label>
                                    <input v-model="form.learn_link" type="text" name="learn_link" id="learn_link"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="url">
                                        <span class="text-red-500" v-if="form.errors.learn_link">{{ form.errors.learn_link }}</span>

                                </div>
                                <div class="mb-5">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Hero Images
                                    </label>

                                    <!-- Current Images (if editing) -->
                                    <div v-if="hero_images && hero_images.length"
                                        class="flex flex-nowrap mb-4 space-x-1 overflow-x-auto">
                                        <div v-for="(pimage, index) in hero_images" :key="pimage.id"
                                            class="relative mb-3">
                                            <img class="w-24 h-24 rounded-sm object-cover" :src="`/storage/${pimage.image}`"
                                                alt="">
                                            <span
                                                class="absolute top-0 right-0 transform -translate-y-1/2 w-5 h-5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full cursor-pointer">
                                                <span @click="deleteImage(pimage, index)"
                                                    class="text-white text-xs font-bold absolute flex items-center justify-center w-full h-full">×</span>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Image Upload Component -->
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                                        <input type="file" id="hero_images" @change="handleFileChange" multiple
                                            accept="image/*" class="hidden" ref="fileInput">
                                        <label for="hero_images"
                                            class="flex flex-col items-center justify-center cursor-pointer">
                                            <svg class="w-8 h-8 mb-2 text-gray-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <p class="text-sm text-gray-500">
                                                <span class="font-semibold">Click to upload</span> or drag and drop
                                            </p>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                        </label>

                                        <!-- Preview of selected files before upload -->
                                        <div v-if="previewImages.length" class="mt-4 grid grid-cols-3 gap-2">
                                            <div v-for="(image, index) in previewImages" :key="index" class="relative">
                                                <img :src="image.url" class="w-full h-24 object-cover rounded">
                                                <button @click="removePreviewImage(index)"
                                                    class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center">
                                                    ×
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Add Hero
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>