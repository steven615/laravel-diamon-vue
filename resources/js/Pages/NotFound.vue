<template>
    <div class="exception-body notfound" v-bind:style="{ 'background-image': 'url(images/layout/bg-404.jpg)' }" >

        <img src="images/layout/logo-m2-dark.svg" alt="diamond-layout" class="logo" />

        <div class="exception-content">
            <div class="exception-title">Não Encontrado (404)</div>
            <div class="exception-detail">O endereço requisitado não foi encontrado.</div>
            <router-link to="/">Ir para o Dashboard</router-link>
        </div>
    </div>
</template>

<script>
export default {};
</script>
