<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="block font-semibold text-gray-950">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
