<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';


const props = defineProps({
    item: Object,
});

const form = useForm({
    nome: '',
    id: 0
});

const submit = () => {

    form.post(route('teste.store'));
};



</script>

<template>
    
    <div class="py-8 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <h1 class="mt-6 font-semibold text-xl text-gray-800 leading-tight">Inserir </h1>
        
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            
            <form @submit.prevent="submit">
                <div>

                    <InputLabel for="nome" value="Nome" />
                    <TextInput id="nome" type="text" class="mt-1 block w-full" v-model="form.nome" required autofocus autocomplete="nome" />
                    <InputError class="mt-2" :message="form.errors.nome" />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
