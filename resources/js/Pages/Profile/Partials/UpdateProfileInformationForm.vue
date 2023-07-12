<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    surname: user.surname,
    phone: user.phone,
});
</script>

<template>
    <section>
        <header class="border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-900">Mes informations personnelles</h2>
            <p class="mt-2 text-gray-900">
                Mettez à jour vos informations personnelles.
                <br>
                Ces informations seront utilisées pour remplir automatiquement les formulaires de commande.
            </p>
        </header>
        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-4 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <InputLabel for="name" value="Nom" />
                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autocomplete="name"/>
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel for="surname" value="Prénom" />
                    <TextInput id="surname" type="text" class="mt-1 block w-full" v-model="form.surname" required autocomplete="surname"/>
                    <InputError class="mt-2" :message="form.errors.surname" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <InputLabel for="email" value="Adresse mail" />
                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username"/>
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div>
                    <div class="flex justify-between">
                        <InputLabel for="phone" value="Téléphone" />
                        <span class="text-sm leading-6 text-gray-500" id="email-optional">Optionnel</span>
                    </div>
                    <TextInput id="phone" type="tel" class="mt-1 block w-full" v-model="form.phone" autocomplete="phone"/>
                    <InputError class="mt-2" :message="form.errors.phone" />
                </div>
            </div>
            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link :href="route('verification.send')" method="post" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div v-show="status === 'verification-link-sent'" class="mt-2 font-medium text-sm text-green-600">
                    A new verification link has been sent to your email address.
                </div>
            </div>
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing" type="button" class="!px-6 leading-tight" action="submit">Sauvegarder les changements</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
