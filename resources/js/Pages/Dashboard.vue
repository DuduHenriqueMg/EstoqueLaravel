<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <template v-slot:navlinks>
        </template>

        <div class="py-12">
            <div class="p-4 grid grid-cols-2 gap-4 text-center">
                <Link :href="route('funcionarios.index')">  
                    <div class="mx-auto w-50 p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <img class="h-12 mx-auto" src="../Images/logoReq.png" alt="">
                        <div class=" text-gray-900">Funcionários</div>
                    </div>
                </Link>

                <Link :href="route('user.index')">  
                    <div class="mx-auto w-45 p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <img class=" h-12 mx-auto" src="../Images/logoUser.png" alt="">
                        <div class=" text-gray-900">Usuários</div>
                    </div>
                </Link>

                <Link :href="route('produtos.index')">  
                    <div class="mx-auto w-45 p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <img class=" h-12 mx-auto" src="../Images/logoProdutos.png" alt="">
                        <div class=" text-gray-900">Produtos</div>
                    </div>
                </Link>

                <Link :href="route('fornecedores.index')">  
                    <div class="mx-auto w-45 p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <img class=" h-12 mx-auto" src="../Images/logoFornecedores.png" alt="">
                        <div class=" text-gray-900">Fornecedores</div>
                    </div>
                </Link>

                <Link :href="route('vendas.index')">  
                    <div class="mx-auto w-45 p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <img class=" h-12 mx-auto" src="../Images/logoVendas.png" alt="">
                        <div class=" text-gray-900">Vendas</div>
                    </div>
                </Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
