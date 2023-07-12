<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import {
    TruckIcon,
    AdjustmentsVerticalIcon
} from '@heroicons/vue/24/outline'

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const secondaryNavigation = [
    { name: 'General', href: '#', icon: AdjustmentsVerticalIcon, current: true },
    { name: 'Mes commandes', href: '#', icon: TruckIcon, current: false },
]
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-start gap-6">
                <aside class="flex border-b border-gray-900/5 py-4 w-full lg:block lg:w-64 lg:flex-none lg:border-0">
                    <nav class="flex flex-1 flex-col" aria-label="Sidebar">
                        <ul role="list" class="flex flex-row space-x-2 lg:flex-col lg:-mx-2 lg:space-y-2 lg:space-x-0">
                            <li v-for="item in secondaryNavigation" :key="item.name">
                                <a :href="item.href" :class="[item.current ? 'bg-gray-50 ring-1' : 'hover:bg-gray-50 hover:ring-1', 'group flex gap-x-3 rounded-xl px-4 py-2 text-gray-900 leading-6 font-semibold ring-gray-300 transition duration-500']">
                                    <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true" />
                                    {{ item.name }}
                                </a>
                            </li>
                        </ul>
                    </nav>
                </aside>
                <div class="flex flex-col w-full space-y-12 sm:space-y-6 lg:pl-6 lg:pt-4">
                    <div class="lg:px-8 lg:pb-12">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-2xl"
                        />
                    </div>

                    <div class="lg:px-8 lg:pb-12">
                        <UpdatePasswordForm class="max-w-2xl" />
                    </div>

                    <div class="lg:px-8">
                        <DeleteUserForm class="max-w-2xl" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
