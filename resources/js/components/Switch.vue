<template>
    <Switch v-model="enabled" aria-checked="true" :class="[enabled ? 'bg-green-500' : 'bg-gray-300', 'relative inline-flex h-5 w-9 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none']">
        <span class="sr-only">Use setting</span>
        <span aria-hidden="true" :class="[enabled ? 'translate-x-4' : 'translate-x-0', 'pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
    </Switch>
</template>

<script setup>
import { ref } from 'vue'
import { Switch } from '@headlessui/vue'

const enabled = ref(false)
</script>
