<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { usePage, useForm, router } from '@inertiajs/vue3';

const errors = usePage().props.errors;
const contactId = usePage().props.contact.id;
const existingContact = usePage().props.contact || [];

// Initialize form with existing data or defaults
const form = useForm({
    src: existingContact.src || '',
    main_section: !!existingContact.main_section || '',
    office_block_bg_color: existingContact.office_block_bg_color || '#ffffff',
    office_title: existingContact.office_title || '',
    office_title_color: existingContact.office_title_color || '#000000',
    address: existingContact.address || '',
    address_color: existingContact.address_color || '#000000',
    email: existingContact.email || '',
    email_color: existingContact.email_color || '#000000',
    phone: existingContact.phone || '',
    phone_color: existingContact.phone_color || '#000000',
});

const goBack = () => {
    router.get(route('contactpage'));
}

const updateContact = (contactId) => {
    // Use PUT for update if we have an existing record, POST for create
    const method = 'post';
    const routeName = 'contactpage.update';

    form[method](route(routeName, contactId), {
        preserveScroll: true,
        onSuccess: () => {
            Swal.fire({
                toast: true,
                icon: 'success',
                position: 'top-end',
                showConfirmation: false,
                timer: 3000,
                title: 'Contact saved successfully'
            });
        },
        onError: (errors) => {
            Swal.fire({
                toast: true,
                icon: 'error',
                position: 'top-end',
                showConfirmation: false,
                timer: 3000,
                title: 'Error saving contact'
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
                                Edit Contact 
                            </h2>
                            <button @click="goBack" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Back</button>
                        </div>
                        
                        <div class="mb-8 p-4 border rounded-lg dark:border-gray-600">
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <!-- google map Section -->
                                <div class="sm:col-span-2">
                                    <label for="src" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Google Map</label>
                                    <input v-model="form.src" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter only the google map src">
                                </div>
                                
                                <!-- Mission Title Color -->
                                <div class="sm:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input v-model="form.main_section" id="main_section" type="checkbox" value=""
                                            class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle
                                            Main Section</span>
                                    </label>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Office Block Background Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.office_block_bg_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="form.office_block_bg_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="office_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Office Title</label>
                                    <input v-model="form.office_title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Office title">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Office Title Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.office_title_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="form.office_title_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                                    <textarea v-model="form.address" rows="4" cols="50" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Address"></textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.address_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="form.address_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input v-model="form.email" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Email">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.email_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="form.email_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                                    <input v-model="form.phone" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Phone">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Color</label>
                                    <div class="flex items-center">
                                        <input v-model="form.phone_color" type="color" class="h-10 w-10 rounded-lg border border-gray-300 cursor-pointer dark:border-gray-600 dark:bg-gray-700">
                                        <input v-model="form.phone_color" type="text" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="#000000">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end mt-4">
                            <button @click="updateContact" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                               Update Contact
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>