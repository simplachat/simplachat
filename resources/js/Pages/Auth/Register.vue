<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    surname: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Inscription - Simpl'Achat"/>
    <GuestLayout>
        <h2 class="mb-6 sm:mb-8 sm:text-center text-xl sm:text-2xl font-bold leading-9 tracking-tight text-gray-900">
            Créez votre compte gratuitement
        </h2>
        <form class="space-y-4" @submit.prevent="submit">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <InputLabel for="name" value="Nom" />
                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel for="surname" value="Prénom" />
                    <TextInput id="surname" type="text" class="mt-1 block w-full" v-model="form.surname" required autocomplete="surname" />
                    <InputError class="mt-2" :message="form.errors.surname" />
                </div>
            </div>
            <div>
                <InputLabel for="email" value="Adresse mail" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="email" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div>
                <InputLabel for="password" value="Mot de passe" />
                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div>
                <InputLabel for="password_confirmation" value="Confirmez votre mot de passe" />
                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            <div>
                <PrimaryButton type="button" class="mx-auto px-8">
                    Je m'inscris
                </PrimaryButton>
            </div>
            <div class="text-sm text-gray-600">
                En cliquant sur « Je m'inscris » , vous acceptez les <a href="" class="underline font-bold text-gray-900">CGU</a> ainsi que notre <a href="" class="underline font-bold text-gray-900">politique de confidentialité</a> décrivant la finalité des traitements de vos données personnelles.
            </div>
        </form>

        <template #footer>
            <p class="mt-10 text-center text-sm text-gray-700 font-medium">
                Déjà un compte ?
                {{ ' ' }}
                <a :href="route('login')" class="font-bold leading-6 text-gray-700 underline hover:text-gray-900">
                    Connectez-vous maintenant
                </a>
            </p>
        </template>
    </GuestLayout>
</template>
