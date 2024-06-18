<template>
    <div v-bind:class="defineCor">
        <div v-if="titulo" class="body bg-white dark:bg-[#0F172A]">{{ titulo }}</div>

        <div class="flex-none flex justify-center">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['titulo', 'cor'],
        computed:{
            defineCor: function(){
                return "panel "+ ( this.cor || "panel-default" )
            }
        }
    }
</script>

<style>
    .blue {
        border-color: #28306f;
    }
    .blue > .panel-heading {
        color: #ccc132;
        background-color: #28306f;
        border-color: #28306f;
    }
</style>