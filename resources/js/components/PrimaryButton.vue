<template>
    <a :href="href" v-if="type === 'link'"
        class="flex items-center justify-center px-4 py-2 bg-gray-900 border border-transparent rounded-full font-semibold text-base text-white tracking-wide hover:bg-gray-700 focus:outline-none transition ease-in-out duration-200"
    >
        <slot />
    </a>
    <button v-else-if="type === 'button'"
        :type="action"
        class="flex items-center justify-center px-4 py-2 bg-gray-900 border border-transparent rounded-full font-semibold text-base text-white tracking-wide hover:bg-gray-700 focus:outline-none transition ease-in-out duration-200">
        <slot />
    </button>
</template>

<script setup>
defineProps({
    href: {
        type: String,
    },
    type: {
        type: String,
        default: 'button',
        required: true,
    },
    action: {
        type: String,
        default: 'submit',
    },
})
</script>
