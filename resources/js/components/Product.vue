<script setup>
import SecondaryButton from "@/components/SecondaryButton.vue";
import {ArrowSmallRightIcon} from "@heroicons/vue/20/solid/index.js";

defineProps(['product']);
</script>

<template>
    <!--<article class="relative isolate flex flex-col ring-1 ring-gray-300 rounded-xl">
        <div class="relative aspect-square max-h-80">
            <img :src="product.images" alt="" class="absolute inset-0 h-full w-full rounded-t-xl bg-gray-50 object-cover" />
        </div>
        <div class="flex flex-col items-start p-4">
            <div class="relative">
                <h1 class="text-2xl font-bold leading-6 text-gray-900 hover:text-test-400">
                    {{ product.name }}
                </h1>
                <p class="mt-2 text-gray-900 line-clamp-2">{{ product.description }}</p>
                <div class="flex items-baseline gap-4 mt-2" v-if="product.discount !== null">
                    <p class="text-lg text-red-600 font-bold">
                        {{ new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(product.unit_price * (1-product.discount)) }}
                    </p>
                    <p class="text-gray-500 line-through">
                        {{ new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(product.unit_price) }}
                    </p>
                </div>
                <p class="font-bold text-lg text-gray-900 mt-2" v-else>
                    {{ new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(product.unit_price) }}
                </p>
            </div>
            <SecondaryButton type="link" href="" class="mt-4 w-full rounded-xl">
                Voir le produit
            </SecondaryButton>
        </div>
    </article>-->
    <article class="relative isolate flex flex-col gap-8 lg:gap-x-6 lg:flex-row h-full">
        <div class="relative aspect-[16/9] sm:aspect-[2/1] lg:aspect-square lg:w-48 lg:shrink-0 h-full">
            <img :src="product.images" alt="" class="absolute inset-0 h-full w-full rounded-2xl bg-gray-50 object-cover" />
            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10" />
        </div>
        <div class="h-full">
            <div class="relative max-w-xl">
                <h3 class="mt-2 text-xl font-bold leading-6 text-gray-900">
                    {{ product.name }}
                </h3>
                <p class="mt-5 text-sm leading-6 font-medium text-gray-700 line-clamp-2">{{ product.description }}</p>
                <div class="flex items-baseline gap-4 mt-2" v-if="product.discount !== null">
                    <p class="text-lg text-red-600 font-bold">
                        {{ new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(product.unit_price * (1-product.discount)) }}
                    </p>
                    <p class="text-gray-500 line-through">
                        {{ new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(product.unit_price) }}
                    </p>
                </div>
                <p class="font-bold text-lg text-gray-900 mt-2" v-else>
                    {{ new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(product.unit_price) }}
                </p>
            </div>
            <SecondaryButton type="link" href="" class="mt-3 w-fit !rounded-full group">
                Voir le produit
                <!-- Heroicon name: chevron-left -->
                <ArrowSmallRightIcon class="h-5 w-5 ml-2 stroke-2" aria-hidden="true"/>
            </SecondaryButton>
        </div>
    </article>
</template>
