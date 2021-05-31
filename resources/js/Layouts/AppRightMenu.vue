<template>
    <div class="layout-sidebar-right" :class="{ 'layout-sidebar-right-active': rightMenuActive }" @click="rightMenuClick">
        <h5>Atividade Recente</h5>
        <div class="widget-timeline">
            <div class="timeline-event">
                <span class="timeline-event-icon" style="background-color: #64b5f6">
                    <i class="pi pi-dollar"></i>
                </span>
                <div class="timeline-event-title">Novo Pedido</div>
                <div class="timeline-event-detail">
                    Cliente Teste 001
                    <strong>R$ 79.000,00</strong>.
                </div>
            </div>
            <div class="timeline-event">
                <span class="timeline-event-icon" style="background-color: #7986cb">
                    <i class="timeline-icon pi pi-download"></i>
                </span>
                <div class="timeline-event-title">Novo Chamado</div>
                <div class="timeline-event-detail">Abertura de chamado 11:23 <strong>Cliente Teste 066</strong> foi iniado.</div>
            </div>
            <div class="timeline-event">
                <span class="timeline-event-icon" style="background-color: #4db6ac">
                    <i class="timeline-icon pi pi-question"></i>
                </span>
                <div class="timeline-event-title">Requisição Suporte</div>
                <div class="timeline-event-detail">Usuário testes 001 <strong>abriu nova solicitação</strong> referente a seu projeto.</div>
            </div>
            <div class="timeline-event">
                <span class="timeline-event-icon" style="background-color: #4dd0e1">
                    <i class="timeline-icon pi pi-comment"></i>
                </span>
                <div class="timeline-event-title">Comentário Recebido</div>
                <div class="timeline-event-detail">
                    Usuário Testes 002 deixou um novo comentário referente ao projeto
                    <strong>Testes 0009</strong>.
                </div>
            </div>
        </div>

        <hr />



    </div>
</template>

<script>
export default {
    name: "AppRightMenu",
    emits: ["right-menu-click"],
    props: {
        rightMenuActive: Boolean,
    },
    data() {
        return {
            selectedAmount: "",
            amount: [
                {
                    label: "*****24",
                    value: { id: 1, name: "*****24", code: "A1" },
                },
                {
                    label: "*****75",
                    value: { id: 2, name: "*****75", code: "A2" },
                },
            ],
        };
    },
    mounted() {
        this.selectedAmount = this.amount[0];
    },
    methods: {
        rightMenuClick($event) {
            this.$emit("right-menu-click", $event)
        }
    }
};
</script>