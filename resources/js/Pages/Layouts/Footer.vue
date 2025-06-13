<script setup>
import { usePage } from '@inertiajs/vue3';


const footer = usePage().props.footer;


console.log(footer);

</script>

<template>
   <footer 
    :class="[
        `bg-${footer.bg_color_tw}`,
        `text-${footer.text_color_tw}`,
        `dark:bg-${footer.dark_bg_color_tw}`,
        `dark:text-${footer.dark_text_color_tw}`
    ]"
    :style="{
        '--bg-color': footer.bg_color,
        '--text-color': footer.text_color,
        '--dark-bg-color': footer.dark_bg_color,
        '--dark-text-color': footer.dark_text_color
    }"
    class="w-full mb-0 mx-auto shadow-lg [&:not(:has(*))]:bg-[var(--bg-color)] [&:not(:has(*))]:text-[var(--text-color)] dark:[&:not(:has(*))]:bg-[var(--dark-bg-color)] dark:[&:not(:has(*))]:text-[var(--dark-text-color)]"
>
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm">
                © {{ footer.year }}
                <a href="#" class="hover:underline">{{ footer.company_name || 'Company' }}™</a>.
                All Rights Reserved.
            </span>

            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium sm:mt-0">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="https://realpayglobal.com" class="hover:underline">Designed by Realpay Global Services</a>
                </li>
            </ul>
        </div>
    </footer>
</template>
