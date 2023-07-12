<script setup>
import DangerButton from '@/components/DangerButton.vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import Modal from '@/components/Modal.vue';
import SecondaryButton from '@/components/SecondaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-2xl font-bold text-gray-900">Supprimer mon compte</h2>
            <p class="mt-2 text-gray-900">
                Supprimer votre compte est une action permanente et ne peut pas être annulée. Veuillez noter que
                toutes vos données seront supprimées. Si vous êtes sûr de vouloir supprimer votre compte, veuillez
                cliquer sur le bouton ci-dessous et saisir votre mot de passe pour confirmer la suppression de votre compte.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion" class="!px-6">Supprimer mon compte</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-900">
                    Êtes-vous sûr(e) de vouloir supprimer votre compte ?
                </h2>

                <p class="mt-2 text-gray-900">
                    Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.
                    Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer votre compte de façon permanente.
                </p>

                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        placeholder="Mot de passe"
                        required
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex flex-col sm:flex-row justify-end gap-2">
                    <SecondaryButton @click="closeModal" type="button" action="button">Annuler</SecondaryButton>

                    <DangerButton
                        class="!px-6"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Supprimer mon compte
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
