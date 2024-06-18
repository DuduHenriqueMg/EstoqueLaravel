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
    itens: Object, titulos: Object, acao: Object, atributes: Object, msg: String, fornecedores:Object, categorias:Array
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
        form.post(route('produtos.store', form.item));
    } else {
        form.post(route('produtos.store',form.item, form.item.id));
    }
};

function mascaraReal(value) {
    
    const options = { style: "currency", currency : "BRL"}
    return value.toLocaleString("pt-br", options)
}

const lista = computed(() => {

    const dados = JSON.parse(JSON.stringify(props.itens.data))

    return dados.filter( res => {
        
        res.valor = mascaraReal(res.valor);
    
        return true;
    })
    
})

</script>

<template>
    
    <Head title="Produtos"/>
    <AuthenticatedLayout>
        <template #header class="flex">
            <h2 class="font-semibold text-xl">Produtos</h2>
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
                <form :action="route('produtos.index')">        
                    <div align="right" >
                        <select class="rounded-lg w-32" name="categoria" id="categoria">
                            <option selected disabled value="">Selecionar</option>
                            <option v-for="categoria in categorias" :value="categoria" >{{ categoria }}</option>
                        </select>
                        <input type="search" id="busca" name="busca" placeholder="Buscar" class="rounded-lg ml-2">
                        <Button class="m-2">Buscar</Button>
                    </div>
                </form>
            </div>
            <Tabela v-bind:itens="lista" 
                    v-bind:titulos="titulos" 
                    v-bind:acao="acao" 
                    v-bind:atributes="atributes" 
                    @delete="exibirModalDelete = true" 
                    @rota="enviandoIndex" 
                    @inserir="exibirModalInserir = true, showEditarH1 = true" 
                    @detalhe="exibirModalDetalhe = true">                    
            </Tabela>

            <div class="text-center">
                <Button class="mr-2 p-1.5" @click="exibirModalInserir = true">CADASTRAR PRODUTO</Button>
                
            </div>
            
            <div class="flex justify-center">
                <pagination :links=" itens.links" />
            </div>

            <!-- Modal de Detalhe -->

            <Modal v-if="form.item != {}" :show="exibirModalDetalhe" @close="exibirModalDetalhe = false, form.item={}" >
                <div class="text-center">
                    <h1 class="titulo">
                        Detalhes
                    </h1>
                    <ul class="p-4">
                        <template v-for=" (dados, key, i) in form.item ">
                            <li v-if="key.slice(-2)!=='id'">{{titulos[i]}}: {{dados}}</li> 
                        </template>
                        
                    </ul>
                </div>
            </Modal>

            <!-- Modal de Inserir -->

            <Modal :show="exibirModalInserir" @close="exibirModalInserir = false, showEditarH1 = false, form.item = {}">
                <div class="text-center">
                    <h1 v-if="showEditarH1" class="titulo">Editar</h1>
                    <h1 v-else class="titulo">Inserir</h1>
                </div>
                <div>
                    <form @submit.prevent="submit" >
                        <div class="inputs-container">
                            <input type="hidden" id="id" v-model="form.item.id"/>
                            <div>
                                <InputLabel for="lote" value="Lote" />
                                <TextInput id="lote" type="text" class="inputs-campos" v-model="form.item.lote" required
                                    autofocus autocomplete="lote" />    
                            </div>                        
                           
                            <div>
                                <InputLabel for="descricao" value="Descrição" />
                                <TextInput id="descricao" type="text" class="inputs-campos"
                                    v-model="form.item.descricao" required autofocus autocomplete="descricao" /> 
                            </div>
                            <div>
                                <InputLabel for="categoria" value="Categoria" />
                                <TextInput id="categoria" type="text" class="inputs-campos" v-model="form.item.categoria"
                                    required autofocus autocomplete="categoria" /> 
                            </div>
                            <div>
                                <InputLabel for="valor" value="Valor" />
                                <TextInput id="valor" type="text" class="inputs-campos" v-model="form.item.valor"
                                    required autofocus autocomplete="valor" /> 
                            </div>
                            <div>
                                <InputLabel for="quantidade" value="Quantidade" />
                                <TextInput id="quantidade" type="text" class="inputs-campos" v-model="form.item.quantidade"
                                    required autofocus autocomplete="quantidade" /> 
                            </div>
                            <div>                               
                                <InputLabel for="fornecedor" value="Fornecedor" />
                                <select v-model="form.item.fornecedor_id" class="inputs-campos" name="fornecedor" id="fornecedor">
                                    <option v-for="fornecedor in fornecedores" :value="fornecedor.id" >{{ fornecedor.nome_fantasia }}</option>
                                </select>                               
                            </div>                 
                            
                                                     
                        </div>
                        <div class="text-center p-4">
                            <Button type="submit" class="px-2 p-2">Regsitrar</Button>
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
                    <div >
                        <Link method="delete" as="button" :href="route('produtos.destroy', form.item.id)">
                            <DangerButton cor="gray" class="my-8 ml-2">{{ acao[2] }}</DangerButton>
                        </Link>
                    </div>                  
                </div>
             </Modal>
        </Pagina>
    </AuthenticatedLayout>
</template>


