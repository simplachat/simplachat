<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header class="border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-900">Modifier mon mot de passe</h2>
            <p class="mt-2 text-gray-900">
                Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester en sécurité et éviter les fuites de données.
            </p>
        </header>
        <form @submit.prevent="updatePassword" class="mt-4 space-y-4">
            <div>
                <InputLabel for="current_password" value="Mot de passe actuel" />
                <TextInput id="current_password" ref="currentPasswordInput" v-model="form.current_password" type="password" class="mt-1 block w-full" autocomplete="current-password"/>
                <InputError :message="form.errors.current_password" class="mt-2" />
            </div>
            <div>
                <InputLabel for="password" value="Nouveau mot de passe" />
                <TextInput id="password" ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-full" autocomplete="new-password"/>
                <InputError :message="form.errors.password" class="mt-2" />
            </div>
            <div>
                <InputLabel for="password_confirmation" value="Confirmer le mot de passe" />
                <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password"/>
                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing" type="button" action="submit" class="!px-6 leading-[1.25rem]">Sauvegarder le mot de passe</PrimaryButton>
                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
