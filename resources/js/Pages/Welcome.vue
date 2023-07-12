<script setup>
import {Head} from '@inertiajs/vue3';
import Navbar from "@/components/Navigation/Navbar.vue";
import { MagnifyingGlassIcon } from "@heroicons/vue/24/outline";
import SecondaryButton from "@/components/SecondaryButton.vue";
import {ArrowSmallRightIcon} from "@heroicons/vue/20/solid";
import {onMounted, ref} from "vue";
import Product from "@/components/Product.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import Loader from "@/components/Loader.vue";
import Footer from "@/components/Footer.vue";

const products = ref([]);
let loading = ref(false);

const getProduct = async () => {
    loading.value = true;
    await axios.get('/api/products', {params: {random: 4}})
        .then(response => {
            products.value = response.data;
        })
        .catch(error => {
            console.log(error);
        });
    loading.value = false;
    console.log(products.value);
}

onMounted(() => {
    getProduct();
});

</script>

<template>
    <Head title="Simpl'Achat | Notre solution pour consommer local et adordable"/>
    <header>
        <Navbar/>
    </header>
    <main>
        <section class="sm:max-w-[1360px] p-0 m-0 relative mb-10 sm:mb-20 sm:px-6 xl:mx-auto">
            <picture>
                <source media="(max-width: 768px)" srcset="
                https://f.hellowork.com/hellowork/tags/2.30.1/img/jpg/subheader/subheader_hp_marcia_mobile.jpg,
                https://f.hellowork.com/hellowork/tags/2.30.1/img/jpg/subheader/subheader_hp_marcia_mobile_x2.jpg 2x,
                https://f.hellowork.com/hellowork/tags/2.30.1/img/jpg/subheader/subheader_hp_marcia_mobile_x3.jpg 3x
                ">
                <img class="object-cover h-[450px] xl:h-[590px] sm:h-[400px] w-full sm:rounded-3xl" src="https://f.hellowork.com/hellowork/tags/2.30.1/img/jpg/subheader/subheader_hp_marcia.jpg" alt="">
            </picture>
            <div class="p-4 w-full flex flex-col absolute top-[5.4rem] mx-auto sm:w-fit sm:p-8 sm:justify-start sm:top-[50px] sm:right-[1.5rem] lg:right-[3.5rem] xl:right-[6.5rem] xl:top-[70px] xl:w-[420px] 2xl:top-[100px] 2xl:w-[502px]">
                <h1 class="mb-6 2xl:mb-8 text-4xl sm:text-[3rem] leading-[3.5rem] text-white font-normal mx-auto ml-0 sm:text-start">Notre solution pour<br> vous donner envie de consommer<br>
                    <span class="text-4xl sm:text-[3rem] leading-[3.5rem] font-bold">local et abordable</span>
                </h1>
                <SecondaryButton type="link" :href="route('api.products.index')" class="!py-3 !px-6 mx-auto ml-0 bg-white !border-transparent hover:!bg-gray-200 !text-gray-900 !rounded-full text-[1rem] leading-[1.25rem]">
                    Trouver maintenant
                    <!-- Heroicon name: chevron-left -->
                    <ArrowSmallRightIcon class="h-5 w-5 ml-2 text-gray-900 stroke-2" aria-hidden="true"/>
                </SecondaryButton>
            </div>
            <form action="" method="get" class="absolute sm:-bottom-10 z-10 md:rounded-2xl sm:mx-auto border-b sm:border border-gray-300 inset-x-0 max-w-3xl flex h-fit bg-white">
                <div class="relative w-full sm:px-6 sm:py-5 border-r border-gray-300 flex items-center">
                    <div class="inset-0 sm:-bottom-20 bg-white px-4 pb-3 flex flex-col w-full sm:static sm:p-0" data-toggle-target="toToggle">
                        <div class="typo-xs-cap mt-4 sm:mt-0 mb-1">
                            Que recherchez-vous ?
                        </div>
                        <div class="flex flex-col overflow-auto sm:overflow-visible">
                            <div class="flex border border-gray-300 rounded-lg p-3 focus-within:border-black sm:static sm:border-none sm:p-0">
                                <input name="search" placeholder="Produit, marque, boutique..." class="flex-grow w-full text-ellipsis typo-m placeholder:text-gray peer outline-none pr-2" required>
                                <button type="reset" class="hover:scale-125 peer-placeholder-shown:invisible transition-transform duration-200">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m11.25 10 7.92-7.92a.89.89 0 0 0 0-1.25.89.89 0 0 0-1.25 0L10 8.75 2.08.83a.89.89 0 0 0-1.25 0 .89.89 0 0 0 0 1.25L8.75 10 .83 17.92a.89.89 0 0 0 0 1.25c.178.176.401.259.625.259a.874.874 0 0 0 .625-.26L10 11.25l7.92 7.92c.177.177.4.26.625.26a.874.874 0 0 0 .624-.26.89.89 0 0 0 0-1.249L11.25 10Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="min-h-fit flex items-center sm:transition sm:duration-200 p-5 flex-shrink-0">
                    <button type="submit" class="bg-gray-900 hover:bg-gray-700 h-12 w-12 hover:scale-110 transition duration-200 rounded-full flex-shrink-0 flex items-center">
                        <div class="text-white flex items-center justify-center min-h-fit sm:h-full w-full">
                            <MagnifyingGlassIcon class="w-5 h-5 stroke-2" />
                        </div>
                    </button>
                </div>
            </form>
        </section>

        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative mb-10 sm:mb-20 sm:pt-10" v-if="products.data !== 0">
            <h2 class="text-2xl sm:text-4xl leading-9 font-medium tracking-tight text-gray-900 mb-4">Des produits <br> <b>qui viennent d'arriver.</b></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6" v-if="!loading">
                <Product v-for="product in products.data" :key="product.id" :product="product" />
            </div>
            <Loader class="mt-6 sm:mt-10" v-else />
            <!-- See all products -->
            <div class="flex mt-6 sm:mt-10" v-if="!loading">
                <PrimaryButton type="link" :href="route('api.products.index')" class="!py-3 !px-6 text-[1rem] leading-[1.25rem] text-lg">
                    Voir tous les produits
                    <!-- Heroicon name: chevron-left -->
                    <ArrowSmallRightIcon class="h-6 w-6 ml-2 stroke-2" aria-hidden="true"/>
                </PrimaryButton>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative mb-10 sm:mb-20 sm:pt-10">
            <h2 class="text-2xl sm:text-4xl leading-9 font-medium tracking-tight text-gray-900 mb-4">Naviguer sur Simpl'Achat.<br> <b>Mode d'emploi</b></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="flex h-[204px] flex-col justify-between rounded-xl relative bg-gray-100 p-6 transition-all sm:h-[256px]">
                    
                </div>
                <div class="flex h-[204px] flex-col justify-between rounded-xl relative bg-gray-100 p-6 transition-all sm:h-[256px]">

                </div>
                <div class="flex h-[204px] flex-col justify-between rounded-xl relative bg-gray-100 p-6 transition-all sm:h-[256px]">

                </div>
            </div>
        </section>

        <Footer />
    </main>

</template>
