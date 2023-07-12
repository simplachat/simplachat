<template>
    <a :href="href" v-if="type === 'link'"
       class="flex items-center justify-center px-4 py-2 border border-gray-900 rounded-full font-semibold text-base text-gray-900 tracking-wide hover:bg-gray-900 hover:text-white focus:outline-none transition ease-in-out duration-200"
    >
        <slot />
    </a>
    <button v-else-if="type === 'button'"
            :type="action"
            class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-full font-semibold text-base text-gray-900 tracking-wide hover:bg-gray-200 focus:outline-none transition ease-in-out duration-200">
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
