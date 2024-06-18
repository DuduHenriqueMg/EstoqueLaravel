<script setup>
import Button from './Button.vue';

const props = defineProps({
    itens: Object,
    titulos: Object,
    acao: Object,
    atributes: Object,

});

</script>

<template>
    <div class="p-8">
        <table class="tabela">
            <thead class="tabela-titulos">
                <tr>
                    <template v-for="titulo in this.titulos " :key="titulo">
                        <th v-if="titulo.slice(-2)!=='id'">{{ titulo }}</th>
                    </template> 
                    <th v-if="acao">Ação</th>
                </tr>
            </thead>

            <tbody class="tabela-body">
                <tr class="border" v-for="(item, index) in itens" :key="item.id">
                <template v-for="(i, key) in item" >
                    <td v-if="key.slice(-2)!=='id'"  class="border p-2" >{{ String(i).slice(0, 40) }}</td>
                </template>
                    <td v-if="this.acao">
                        <Button v-if="acao[0]" id="detalhe" @click="$emit('detalhe'), $emit('rota', index)" class="m-1">{{ acao[0] }}</Button>
                        <Button v-if="acao[1]" id="inserir" @click=" $emit('inserir'), $emit('rota', index)" class="m-1">{{ acao[1] }}</Button> 
                        <Button v-if="acao[2]" id="delete" @click=" $emit('delete'), $emit('rota', index)" class="m-1">{{ acao[2] }}</Button> 
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
