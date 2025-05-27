<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import { Pagination, Navigation, Autoplay, EffectFade } from 'swiper/modules';
import { Link } from '@inertiajs/vue3'

const slides = [
  '/images/telecom1.jpg',
  '/images/telecom2.jpg',
  '/images/telecom3.jpg',
  '/images/telecom4.jpg'
];
</script>

<template>
  <section class="relative w-full h-[500px] overflow-hidden">
    <!-- Swiper Background Slider -->
    <Swiper
      :modules="[Pagination, Navigation, Autoplay, EffectFade]"
      effect="fade"
      :pagination="{ clickable: true }"
      :navigation="true"
      :autoplay="{ delay: 3000, disableOnInteraction: false }"
      :loop="true"
      :speed="3000"  
      class="absolute top-0 left-0 w-full h-full z-0"
    >
      <SwiperSlide v-for="(img, index) in slides" :key="index">
        <div
          class="w-full h-full bg-cover bg-center"
          :style="{ backgroundImage: `url(${img})` }"
        ></div>
      </SwiperSlide>
    </Swiper>

    <!-- Overlay Static Text (on top of slider) -->
    <div class="absolute py-5 top-0 left-0 z-10 w-full h-full flex items-center justify-center">
      <div class="w-full bg-black bg-opacity-50 p-6 text-center text-white rounded">
        <!-- caption & sub caption -->
        <h1 class="text-4xl font-extrabold mb-4">We all love Telecommunications</h1>
        <p class="text-lg mb-6">...together we can achieve.</p>
        <!-- End caption & sub caption  -->

        <!-- button links to contact and services -->
        <div class="flex justify-center space-x-4">
          <Link type="button" :href="route('contact')" class="py-3 px-5 bg-blue-700 hover:bg-blue-800 text-white rounded-lg">Contact Us</Link>
          <Link :href="route('services')" class="py-3 px-5 border border-white hover:bg-white hover:text-black text-white rounded-lg">Learn more</Link>
        </div>
        <!-- End button links to contact and services -->
      </div>
    </div>
  </section>
</template>
