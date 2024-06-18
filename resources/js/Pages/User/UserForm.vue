<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import NavLink from '@/Components/NavLink.vue';

const props = defineProps({
    roles: {
        type: Object,
    }
})

const form = useForm({
    id: null,
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role_id: null,
});

const submit = () => {
    
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation')
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuário</h2>
        </template>

        <template v-slot:navlinks>

            <NavLink :href="route('user.index')" :active="route().current('user.index')">
                Usuários
            </NavLink>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="text-center">
                    
                    <h1 class="titulo">Inserir</h1>
                </div>
                <div>
                    <form @submit.prevent="submit" >
                        <div class="inputs-container">
                            <div >
                                <InputLabel for="name" value="Nome" />
                                <TextInput id="name" type="text" class="inputs-campos" v-model="form.name" required
                                    autofocus autocomplete="name" />
                                <InputError class="mt-2" :message="form.errors.name" />        
                            </div>                        
                            <div >
                                <InputLabel for="email" value="Email" />
                                <TextInput id="email" type="text" class="inputs-campos" v-model="form.email" required
                                    autofocus autocomplete="email" />    
                                <InputError class="mt-2" :message="form.errors.email" />                               
                            </div>
                            <div >
                                <InputLabel for="password" value="Senha" />
                                <TextInput id="password" type="password" class="inputs-campos"
                                    v-model="form.password" required autofocus autocomplete="password" />
                                <InputError class="mt-2" :message="form.errors.password" />     
                            </div>
                            <div>
                                <InputLabel for="password_confirmation" value="Confirme a Senha" />

                                <TextInput id="password_confirmation" type="password"
                                    class="inputs-campos" v-model="form.password_confirmation" required autocomplete="new-password" />
                                <InputError class="mt-2" :message="form.errors.password_confirmation" />
                            </div>
                            <div>                               
                                <InputLabel for="role_id" value="Role" />
                                <select v-model="form.role_id" class="inputs-campos" name="role_id" id="role_id">
                                    <option v-for="role in roles" :value="role.id">{{ role.role_name }}</option>
                                </select>                               
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <Button type="submit" class="px-2 p-2">Register</Button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>