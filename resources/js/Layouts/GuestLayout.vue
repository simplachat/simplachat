<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex min-h-screen flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-100">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <Link href="/">
                <ApplicationLogo class="w-auto h-8 sm:h-10 mx-auto" />
            </Link>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[520px]">
            <div class="bg-white px-6 py-12 shadow-lg sm:rounded-2xl sm:px-12 ring-1 ring-gray-300">
                <slot />
            </div>
        </div>
        <slot name="footer" />
    </div>
</template>
