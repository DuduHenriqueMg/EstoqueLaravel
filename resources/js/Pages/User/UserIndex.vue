<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
import NavLink from '@/Components/NavLink.vue';

const props = defineProps({
    canCreateUsers : {
        type: Boolean,
    },
    canDeleteUsers : {
        type: Boolean,
    },
    users: {
        type: Object,
    },
    roles: {
        type: Object,
    },
    acao: {
        type: Object,
    },
    msg : ""
});

const exibirModalInserir = ref(false);

const form = useForm({
    id: null,
    name: '',
    email: '',
    role_id: null,
});

const submit = () => {
    
    form.post(route('register', form.id));
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuários</h2>
            <div class="text-center">
                <Link :href="route('user.create')"><Button v-if="canCreateUsers" class="p-1.5">Inserir Usuário</Button></Link>
            </div>
        <h2 v-if="msg">{{ msg }}</h2>
        </template>

        <template v-slot:navlinks>

            <NavLink :href="route('user.index')" :active="route().current('user.index')">
                Usuários
            </NavLink>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ul>
                            <li v-for="(user) in users" :key="key">
                                {{ user.name }} 
                                <button v-if="canDeleteUsers"   @click="exibirModalInserir = true,
                                                                form.id = user.id,
                                                                form.name = user.name,
                                                                form.email = user.email,
                                                                form.role_id = user.role_id"> 
                                    ---------- {{ acao[0] }} 
                                </button> 
                                <Link v-if="canDeleteUsers" method="delete" as="button" :href="route('user.destroy', user.id)"> 
                                    |{{ acao[1] }}  
                                </Link>
                                   
                            </li>
                        </ul>   
                    </div>
                </div>
            </div>
        </div>
        <Modal :show="exibirModalInserir" @close="exibirModalInserir = false, form.reset()">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="text-center">
                    
                    <h1 class="titulo">Editar</h1>
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
        </Modal>
    </AuthenticatedLayout>
</template>
