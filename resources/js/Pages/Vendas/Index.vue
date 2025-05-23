<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue'
import Pagina from '@/Components/Pagina.vue';
import Button from '@/Components/Button.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Tabela from '@/Components/Tabela.vue';
import Pagination from '@/Components/Pagination.vue'
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm, Link, router } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import { ref, computed } from 'vue';


const props = defineProps({
    itens: Object, titulos: Object, acao: Object, atributes: Object, msg: String, clientes: Object, funcionarios: Object
});

const exibirModalDelete = ref(false);
const exibirModalInserir = ref(false);
const exibirModalDetalhe = ref(false);
const showEditarH1 = ref(false);

function enviandoIndex(index) {
    const dados = JSON.parse(JSON.stringify(props.itens.data))
    form.item = dados[index];
}

const form = useForm({
    item: {},
});

const submit = () => {
    if (form.item.id == null) {
        form.post(route('vendas.store', form.item));
    } else {
        form.post(route('vendas.store', form.item, form.item.id));
    }
};

function mascaraReal(value) {

    const options = { style: "currency", currency: "BRL" }
    return value.toLocaleString("pt-br", options)
}

function formatarVendas(vendas) {
    return vendas.map(venda => ({
        ...venda,
        nome_cliente: venda.cliente?.nome || 'Sem cliente',
        nome_funcionario: venda.funcionario?.nome || 'Sem funcionário',
        // Pode adicionar mais campos achatados se quiser
    }));
}

const lista = computed(() => {

    const dados = JSON.parse(JSON.stringify(props.itens.data))

    return dados.map(res => {
        // Formata o valor
        res.valor = mascaraReal(res.valor)

        // Achata os dados do relacionamento
        res.nome_cliente = res.cliente?.nome || 'Sem cliente'
        res.nome_funcionario = res.funcionario?.nome || 'Sem funcionário'

        delete res.cliente
        delete res.funcionario
        delete res.produtos
        delete res.created_at
        delete res.created_at
        delete res.updated_at

        return res
    })

})



</script>

<template>

    <Head title="Vendas" />
    <AuthenticatedLayout>
        <template #header class="flex">
            <h2 class="font-semibold text-xl">Vendas</h2>
            <h2 v-if="msg">{{ msg }}</h2>

        </template>

        <template v-slot:navlinks>

            <NavLink :href="route('produtos.index')" :active="route().current('produtos.index')">
                Produtos
            </NavLink>
            <NavLink :href="route('funcionarios.index')" :active="route().current('funcionarios.index')">
                Funcionários
            </NavLink>
            <NavLink :href="route('fornecedores.index')" :active="route().current('fornecedores.index')">
                Fornecedores
            </NavLink>

            <NavLink :href="route('vendas.index')" :active="route().current('vendas.index')">
                Vendas
            </NavLink>
        </template>

        <Pagina tamanho="12">
            <div class="mt-10 grid content-center">
                <form :action="route('vendas.index')">
                    <div align="right">

                        <input type="search" id="busca" name="busca" placeholder="Buscar" class="rounded-lg ml-2">
                        <Button class="m-2">Buscar</Button>
                    </div>
                </form>
            </div>
            <Tabela v-bind:itens="lista" v-bind:titulos="titulos" v-bind:acao="acao" v-bind:atributes="atributes"
                @delete="exibirModalDelete = true" @rota="enviandoIndex"
                @inserir="exibirModalInserir = true, showEditarH1 = true" @detalhe="exibirModalDetalhe = true">
            </Tabela>

            <div class="flex justify-center">
                <pagination :links="itens.links" />
            </div>

            <!-- Modal de Detalhe -->

            <Modal v-if="form.item != {}" :show="exibirModalDetalhe" @close="exibirModalDetalhe = false, form.item = {}">
                <div class="text-center">
                    <h1 class="titulo">
                        Detalhes
                    </h1>
                    <ul class="p-4 text-left space-y-1">

                        <!-- Nome do Cliente -->
                        <li v-if="form.item.funcionario.nome">
                            <strong>Cliente:</strong> {{ form.item.funcionario.nome }}
                        </li>

                        <!-- Nome do Funcionário -->
                        <li v-if="form.item.funcionario.nome">
                            <strong>Funcionário:</strong> {{ form.item.cliente.nome }}
                        </li>
                        <template v-for="(valor, chave) in form.item">
                            <li
                                v-if="!['cliente', 'funcionario', 'produtos'].includes(chave) && !chave.endsWith('id') && !chave.endsWith('_at') && chave !== 'nome_cliente' && chave !== 'nome_funcionario'">
                                <strong>{{ chave }}:</strong> {{ valor }}
                            </li>
                        </template>

                    </ul>
                    <div v-if="form.item.produtos?.length" class="m-6">
                        <h2 class="mt-4 font-bold text-lg">Produtos</h2>
                        <ul class="pl-4 space-y-1">
                            <li v-for="produto in form.item.produtos" :key="produto.id">
                                {{ produto.nome }} | Quantidade: {{ produto.pivot.quantidade }} |
                                Valor: R$
                                {{ produto.valor * produto.pivot.quantidade }}
                            </li>
                        </ul>
                    </div>
                </div>
            </Modal>

            <!-- Modal de Inserir -->

            <Modal :show="exibirModalInserir" @close="exibirModalInserir = false, showEditarH1 = false, form.item = {}">
                <div class="text-center">
                    <h1 v-if="showEditarH1" class="titulo">Editar</h1>
                    <h1 v-else class="titulo">Inserir</h1>
                </div>
                <div>
                    <form @submit.prevent="submit">
                        <div class="inputs-container">
                            <input type="hidden" id="id" v-model="form.item.id" />
                            <div>
                                <InputLabel for="data" value="Data" />
                                <TextInput id="data" type="text" class="inputs-campos" v-model="form.item.data" required
                                    autofocus autocomplete="data" />
                            </div>
                            <div>
                                <InputLabel for="cliente" value="Cliente" />
                                <select v-model="form.item.cliente_id" class="inputs-campos" name="cliente"
                                    id="cliente">
                                    <option v-for="cliente in clientes" :value="cliente.id">{{ cliente.nome }}</option>
                                </select>
                            </div>

                            <div>
                                <InputLabel for="funcionario" value="Funcionário" />
                                <select v-model="form.item.funcionario_id" class="inputs-campos" name="funcionario"
                                    id="funcionario">
                                    <option v-for="funcionario in funcionarios" :value="funcionario.id">{{
                                        funcionario.nome }}
                                    </option>
                                </select>
                            </div>

                            <div>
                                <InputLabel for="valor" value="valor" />
                                <TextInput id="valor" type="number" step="0.01" class="inputs-campos"
                                    v-model="form.item.valor" required autofocus autocomplete="valor" />
                            </div>


                        </div>
                        <div class="text-center p-4">
                            <Button type="submit" class="px-2 p-2">Register</Button>
                        </div>
                    </form>
                </div>
            </Modal>

            <!-- Modal de Delete -->

            <Modal :show="exibirModalDelete" @close="exibirModalDelete = false, form.item = {}">
                <div class="p-2 text-center">
                    <h1 class="titulo">
                        Tem certeza?
                    </h1>
                    <div>
                        <Link method="delete" as="button" :href="route('vendas.destroy', form.item.id)">
                        <DangerButton cor="gray" class="my-8 ml-2 ">{{ acao[2] }}</DangerButton>
                        </Link>
                    </div>
                </div>
            </Modal>
        </Pagina>
    </AuthenticatedLayout>
</template>
