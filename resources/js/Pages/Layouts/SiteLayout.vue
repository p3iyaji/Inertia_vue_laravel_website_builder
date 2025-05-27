<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Footer from './Footer.vue'
import Navbar from './Navbar.vue'
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

</script>

<template>
    
<!-- Navbar -->
<Navbar />


 <!-- content -->
    <slot />




<!-- End content -->

<!-- footer -->
<Footer />
<!-- End footer -->

</template>
