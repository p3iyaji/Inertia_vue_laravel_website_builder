<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted, ref } from 'vue'
import { initFlowbite } from 'flowbite'
import { useForm, usePage, router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'


// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

const props = defineProps({
    errors: Object,
    flash: Object

})

const navbars = usePage().props.navbars;
const showModal = ref(false);
const isEditing = ref(false);
const currentNavbarId = ref(null);

const form = useForm({
    get_in_touch: false,
    company_logo: null,
    company_name: '',
    bg_color: '#ffffff',
    text_color: '#000000',
    dark_bg_color: '#000000',
    dark_text_color: '#ffffff'
})

const fields = [
    { name: 'company_logo', label: 'Company Logo', type: 'file' },
    { name: 'company_name', label: 'Company Name', type: 'text'},
    { name: 'get_in_touch', label: 'Get in touch', type: 'boolean' },
    { name: 'bg_color', label: 'Background Color', type: 'color' },
    { name: 'text_color', label: 'Text Color', type: 'color' },
    { name: 'dark_bg_color', label: 'Dark Background Color', type: 'color' },
    { name: 'dark_text_color', label: 'Dark Text Color', type: 'color' }
]

const imagePreview = ref(null);

function handleFileUpload(event) {
    const file = event.target.files[0]
    form.company_logo = file
    if (file) {
        const reader = new FileReader()
        reader.onload = () => {
            imagePreview.value = reader.result
        }
        reader.readAsDataURL(file)
    }
}

const submit = () => {
    if (isEditing.value) {
        form.post(route('pagenavbar.update', currentNavbarId.value), {
            _method: 'put',
            onSuccess: () => {
                resetForm();
                closeModal();
                router.visit(route('pagenavbar'));
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    title: 'Navbar updated successfully'
                });
            }
        });
    } else {
        form.post(route('pagenavbar.store'), {
            onSuccess: () => {
                form.reset();
                closeModal();

                router.visit(route('pagenavbar'));

                Swal.fire({
                    toast: true,
                    icon: 'success',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    title: "Navbar added successfully"
                });
            }
        });
    }

}
const addNavbar = (navbar) => {
    isEditing.value = false;
    currentNavbarId.value = '';
    form.company_logo = '';
    form.company_name = '';
    form.get_in_touch = '';
    form.bg_color = '';
    form.text_color = '';
    form.dark_bg_color = '';
    form.dark_text_color = '';

    //open modal
    openModal();
}

const editNavbar = (navbar) => {
    isEditing.value = true;
    currentNavbarId.value = navbar.id;
    form.company_logo = navbar.company_logo;
    form.company_name = navbar.company_name;
    form.get_in_touch = Boolean(navbar.get_in_touch);
    form.bg_color = navbar.bg_color;
    form.text_color = navbar.text_color;
    form.dark_bg_color = navbar.dark_bg_color;
    form.dark_text_color = navbar.dark_text_color;

    //open modal
    openModal();
}

const resetForm = () => {
    form.reset();
    isEditing.value = false;
    currentNavbarId.value = null;
}
const openModal = () => {
    showModal.value = true;
    // Disable body scroll when modal is open
    document.body.style.overflow = 'hidden';
}

const closeModal = () => {
    showModal.value = false;
    imagePreview.value = null

    // Re-enable body scroll
    document.body.style.overflow = 'auto';
}

const deleteNavbar = async (navbar) => {
    const result = await Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    })

    if (result.isConfirmed) {
        try {
            await router.delete(route('pagenavbar.destroy', navbar.id));
            router.visit(route('pagenavbar'));
            Swal.fire({
                toast: true,
                icon: 'success',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                title: 'navbar deleted successfully'
            })
        } catch (error) {
            Swal.fire({
                toast: true,
                icon: 'error',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                title: 'Failed to delete navbar'
            })
        }
    }
}



</script>

<template>
    <AuthenticatedLayout>
        <div class="p-4 sm:ml-64">
            <div class="p-4 rounded-lg dark:border-gray-700">

                <!-- table -->
                <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
                    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                        <!-- Start coding here -->
                        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                            <div
                                class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                                <div class="w-full md:w-1/2">
                                    <form class="flex items-center">
                                        <label for="simple-search" class="sr-only">Search</label>
                                        <div class="relative w-full">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                    fill="currentColor" viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input type="text" id="simple-search"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Search">
                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">

                                    <button @click="addNavbar"
                                        class="flex items-center justify-center px-4 py-2 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button">
                                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                        </svg>
                                        Add Navbar
                                    </button>


                                    <div class="flex items-center space-x-3 w-full md:w-auto">
                                        <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                            type="button">
                                            <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                            </svg>
                                            Actions
                                        </button>
                                        <div id="actionsDropdown"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="actionsDropdownButton">
                                                <li>
                                                    <a href="#"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mass
                                                        Edit</a>
                                                </li>
                                            </ul>
                                            <div class="py-1">
                                                <a href="#"
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                                    all</a>
                                            </div>
                                        </div>
                                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                            type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                                class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Filter
                                            <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                            </svg>
                                        </button>
                                        <div id="filterDropdown"
                                            class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose
                                                brand</h6>
                                            <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                                <li class="flex items-center">
                                                    <input id="apple" type="checkbox" value=""
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="apple"
                                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Apple
                                                        (56)</label>
                                                </li>
                                                <li class="flex items-center">
                                                    <input id="fitbit" type="checkbox" value=""
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="fitbit"
                                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Microsoft
                                                        (16)</label>
                                                </li>
                                                <li class="flex items-center">
                                                    <input id="razor" type="checkbox" value=""
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="razor"
                                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Razor
                                                        (49)</label>
                                                </li>
                                                <li class="flex items-center">
                                                    <input id="nikon" type="checkbox" value=""
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="nikon"
                                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Nikon
                                                        (12)</label>
                                                </li>
                                                <li class="flex items-center">
                                                    <input id="benq" type="checkbox" value=""
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="benq"
                                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">BenQ
                                                        (74)</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-4 py-3">Company Logo</th>
                                            <th scope="col" class="px-4 py-3">Company Name</th>                                            <th scope="col" class="px-4 py-3">Get in touch</th>
                                            <th scope="col" class="px-4 py-3">BG-Color</th>
                                            <th scope="col" class="px-4 py-3">Text-Color</th>
                                            <th scope="col" class="px-4 py-3">Dark: BG-Color</th>
                                            <th scope="col" class="px-4 py-3">Dark: Text-Color</th>
                                            <th scope="col" class="px-4 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="navbar in navbars" :key="navbar.id"
                                            class="border-b dark:border-gray-700">
                                            <th scope="row"
                                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <img :src="`/storage/${navbar.company_logo}`" alt="logo image" height="100" width="100"></th>
                                                <td class="px-4 py-3">{{ navbar.company_name }}</td>
                                                <td class="px-4 py-3">{{ navbar.get_in_touch }}</td>
                                            <td class="px-4 py-3">{{ navbar.bg_color_tw }}</td>
                                            <td class="px-4 py-3">{{ navbar.text_color_tw }}</td>
                                            <td class="px-4 py-3">{{ navbar.dark_bg_color_tw }}</td>
                                            <td class="px-4 py-3">{{ navbar.dark_text_color_tw }}</td>
                                            <td class="px-4 py-3">
                                                <button type="button" @click="editNavbar(navbar)"
                                                    class="block py-2 px-4 font-semibold hover:rounded-md text-yellow-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    Edit</button>
                                            </td>
                                            <td class="px-4 py-3">
                                                <button type="button" @click="deleteNavbar(navbar)"
                                                    class="block py-2 px-4 font-semibold hover:rounded-md text-red-600 hover:bg-red-100 dark:hover:bg-red-600 dark:hover:text-white">
                                                    Delete</button>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </section>
                <!-- end table -->


                <!-- Main modal -->
                <div id="default-modal" tabindex="-1" :class="{ 'hidden': !showModal, 'flex': showModal }"
                    class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <!-- Backdrop - separate div covering entire screen -->
                    <div class="fixed inset-0 bg-black bg-opacity-75 z-40"></div>

                    <!-- Modal container - centered content -->
                    <div class="relative p-4 w-full max-w-6xl max-h-full z-50">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700 mx-auto w-full md:w-1/2">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    {{ isEditing ? 'Edit Navbar' : 'Add Navbar' }}
                                </h3>
                                <button type="button" @click="closeModal"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <form @submit.prevent="submit">
                                    <div v-for="field in fields" :key="field.name" class="mb-4">
                                        <label :for="field.name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ field.label }}
                                        </label>
                                        <!-- Handle file input with preview -->
                                        <div v-if="field.type === 'file'">
                                            <input type="file" accept="image/*" :id="field.name"
                                                @change="handleFileUpload"
                                                class="w-full p-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                                            <div v-if="imagePreview" class="mt-2">
                                                <img :src="imagePreview" alt="Image Preview" class="h-20 rounded" />
                                            </div>
                                        </div>

                                        <!-- Handle boolean as checkbox -->
                                        <div v-else-if="field.type === 'boolean'" class="flex items-center">
                                            <input type="checkbox" :id="field.name" v-model="form[field.name]"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" />
                                            <label :for="field.name" class="ml-2 text-sm text-gray-900 dark:text-white">
                                                Enable {{ field.label }}
                                            </label>
                                        </div>

                                        <!-- Standard input types -->
                                        <div v-else>
                                            <input v-model="form[field.name]" :type="field.type" :id="field.name"
                                                :name="field.name"
                                                class="w-full p-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                                            <template
                                                v-if="['bg_color', 'text_color', 'dark_bg_color', 'dark_text_color'].includes(field.name)">
                                                <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                                    Selected: {{ form[field.name] }}
                                                </p>
                                            </template>
                                        </div>
                                        <div v-if="errors[field.name]" class="text-sm text-red-500 mt-1">
                                            {{ errors[field.name] }}
                                        </div>
                                       
                                    </div>

                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700">
                                            Save Navbar
                                        </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </AuthenticatedLayout>
</template>