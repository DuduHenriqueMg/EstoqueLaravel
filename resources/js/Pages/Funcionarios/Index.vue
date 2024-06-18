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
    itens: Object, titulos: Object, acao: Object, atributes: Object, msg: String, enderecos:Object
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
        form.post(route('funcionarios.store', form.item));
    } else {
        form.post(route('funcionarios.store',form.item, form.item.id));
    }
};

</script>

<template>
    
    <Head title="Funcionários"/>
    <AuthenticatedLayout>
        <template #header class="flex">
            <h2 class="font-semibold text-xl">Funcionários</h2>
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
                <form :action="route('funcionarios.index')">        
                    <div align="right" >
                        
                        <input type="search" id="busca" name="busca" placeholder="Buscar" class="rounded-lg ml-2">
                        <Button class="m-2">Buscar</Button>
                    </div>
                </form>
            </div>
            <Tabela v-bind:itens="itens.data" 
                    v-bind:titulos="titulos" 
                    v-bind:acao="acao" 
                    v-bind:atributes="atributes" 
                    @delete="exibirModalDelete = true" 
                    @rota="enviandoIndex" 
                    @inserir="exibirModalInserir = true, showEditarH1 = true" 
                    @detalhe="exibirModalDetalhe = true">                    
            </Tabela>

            <div class="text-center">
                <Button class="mr-2 p-1.5" @click="exibirModalInserir = true">CADASTRAR FUNCIONÁRIO</Button>
                
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
                                <InputLabel for="nome" value="Nome" />
                                <TextInput id="nome" type="text" class="inputs-campos" v-model="form.item.nome" required
                                    autofocus autocomplete="nome" />    
                            </div>                        
                           
                            <div>
                                <InputLabel for="funcao" value="Função" />
                                <TextInput id="funcao" type="text" class="inputs-campos"
                                    v-model="form.item.funcao" required autofocus autocomplete="funcao" /> 
                            </div>
                            <div>
                                <InputLabel for="cpf" value="CPF" />
                                <TextInput id="cpf" type="text" class="inputs-campos" v-model="form.item.cpf"
                                    required autofocus autocomplete="cpf" /> 
                            </div>
                            <div>
                                <InputLabel for="telefone" value="Telefone" />
                                <TextInput id="telefone" type="text" class="inputs-campos"
                                    v-model="form.item.telefone" required autofocus autocomplete="telefone" />     
                            </div>
                                             
                            <div>
                                <InputLabel for="email" value="Email" />
                                <TextInput id="email" type="text" class="inputs-campos"
                                    v-model="form.item.email" required autofocus autocomplete="email" />     
                            </div>
                                                     
                        </div>
                        <div class="text-center p-4">
                            <Button type="submit" class="px-2 p-2">Registrar</Button>
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
                        {{ form.item.id }}
                        <Link method="delete" as="button" :href="route('funcionarios.destroy', form.item.id)">
                            <DangerButton cor="gray" class="my-8 ml-2">{{ acao[2] }}</DangerButton>
                        </Link>
                    </div>                  
                </div>
             </Modal>
        </Pagina>
    </AuthenticatedLayout>
</template>


