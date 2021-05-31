<template>
    <div class="p-grid crud-demo">
        <div class="p-col-12">
            <div class="card">
                <Toast />
                <Toolbar class="p-mb-4">


                    <template v-slot:right>
                        <Button label="Exportar" icon="pi pi-upload" class="p-button-info" @click="exportCSV($event)" />
                    </template>
                </Toolbar>

                <DataTable
                    ref="dt"
                    :value="activitylogs"
                    v-model:selection="selectedRegs"
                    dataKey="id"
                    :paginator="true"
                    :rows="10"
                    :loading="loadingTable"
                    paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                    :rowsPerPageOptions="[5, 10, 25]"
                    currentPageReportTemplate="Exibindo {first} até {last} de {totalRecords} Log's de atividade"
                    responsiveLayout="scroll"
                >
                    <template #header>
                        <div class="table-header p-d-flex p-flex-column p-flex-md-row p-jc-md-between">
                            <h5 class="p-m-0">Log's de Atividade</h5>
                            <span class="p-input-icon-left">
                                <i class="pi pi-search" />
                                <InputText v-model="filter" placeholder="Pesquisar..." />
                            </span>
                        </div>
                    </template>

                    <Column field="code" header="Código" :sortable="true">
                        <template #body="slotProps">
                            <span class="p-column-title">Código</span>
                            {{ slotProps.data.id }}
                        </template>
                    </Column>
                    <Column field="usuario" header="Usuário" :sortable="true">
                        <template #body="slotProps">
                            <span class="p-column-title">Usuário</span>
                            {{ slotProps.data.usuario }}
                        </template>
                    </Column>
                    <Column field="created_at" header="Criado" :sortable="true">
                        <template #body="slotProps">
                            <span class="p-column-title">Criado</span>
                            {{ formatDate(slotProps.data.created_at) }}
                        </template>
                    </Column>
                    <Column field="funcao" header="Função" :sortable="true">
                        <template #body="slotProps">
                            <span class="p-column-title">Função</span>
                            {{ slotProps.data.funcao }}
                        </template>
                    </Column>
                    <Column field="tabela" header="Tabela" :sortable="true">
                        <template #body="slotProps">
                            <span class="p-column-title">Tabela</span>
                            {{ formatDecimal(slotProps.data.tabela) }}
                        </template>
                    </Column>


                    <Column>
                        <template #body="slotProps">
                            <Button icon="pi pi-eye" class="p-button-rounded p-button-success p-mr-2" @click="edit(slotProps.data)" />
                        </template>
                    </Column>
                </DataTable>

                <Dialog v-model:visible="editDialog" :style="{ width: '450px' }" header="Visualizar" :modal="true" class="p-fluid">
                    <div class="p-field">
                        <label for="descricao">Cliente</label>
                        <InputText id="nomecli" v-model.trim="activitylog.nomecli" required="true" autofocus :class="{ 'p-invalid': submitted && !activitylog.nomecli }" :disabled="true"/>
                        <small class="p-invalid" v-if="submitted && !activitylog.descricao">Descrição é obrigatório.</small>
                    </div>

                    <div class="p-field">
                        <label for="status" class="p-mb-3">Status</label>
                        <Dropdown id="status" v-model="activitylog.status" :options="statuses" optionLabel="label" placeholder="Selecionar Status" :disabled="true">
                            <template #value="slotProps">
                                <div v-if="slotProps.value && slotProps.value.value">
                                    <span :class="'activitylog-badge status-' + slotProps.value.value">{{ slotProps.value.label }}</span>
                                </div>
                                <div v-else-if="slotProps.value && !slotProps.value.value">
                                    <span :class="'activitylog-badge status-' + slotProps.value.toLowerCase()">{{ slotProps.value }}</span>
                                </div>
                                <span v-else>
                                    {{ slotProps.placeholder }}
                                </span>
                            </template>
                        </Dropdown>
                    </div>


                    <div class="p-formgrid p-grid">
                        <div class="p-field p-col">
                            <label for="emissao">Emissão</label>
                            <InputText id="emissao" :modelValue="formatDate(activitylog.emissao)" :disabled="true"/>
                        </div>

                        <div class="p-field p-col">
                            <label for="vencimento">Vencimento</label>
                            <InputText id="vencimento" :modelValue="formatDate(activitylog.vencimento)"  :disabled="true"/>
                        </div>

                    </div>

                    <div class="p-formgrid p-grid">

                        <div class="p-field p-col">
                            <label for="valor">Valor</label>
                            <InputNumber id="valor" v-model="activitylog.valor" mode="currency" currency="BRL" locale="pt-BR"  :disabled="true"/>
                        </div>

                    </div>
                    <template #footer>
                        <Button label="Fechar" icon="pi pi-times" class="p-button-text" @click="hideDialog" />

                    </template>
                </Dialog>

                <Dialog v-model:visible="showDeleteDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
                    <div class="confirmation-content">
                        <i class="pi pi-exclamation-triangle p-mr-3" style="font-size: 2rem" />
                        <span v-if="activitylog"
                        >Tem certeza de que deseja excluir <b>{{ activitylog.name }}</b
                        >?</span
                        >
                    </div>
                    <template #footer>
                        <Button label="Não" icon="pi pi-times" class="p-button-text" @click="showDeleteDialog = false" />
                        <Button label="Sim" icon="pi pi-check" class="p-button-text" @click="delete" />
                    </template>
                </Dialog>

                <Dialog v-model:visible="deleteDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
                    <div class="confirmation-content">
                        <i class="pi pi-exclamation-triangle p-mr-3" style="font-size: 2rem" />
                        <span v-if="activitylog">Confirma deletar todos os registros selecionados?</span>
                    </div>
                    <template #footer>
                        <Button label="Não" icon="pi pi-times" class="p-button-text" @click="deleteDialog = false" />
                        <Button label="Sim" icon="pi pi-check" class="p-button-text" @click="deleteSelectedRegs" />
                    </template>
                </Dialog>
            </div>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';

import ActivityLogsService from './ActivityLogsService';

export default {
    data() {
        return {
            activitylogs: null,
            editDialog: false,
            showDeleteDialog: false,
            deleteDialog: false,
            activitylog: {},
            selectedRegs: null,
            filter: '',
            submitted: false,
            loadingTable: true,
            statuses: [
                { label: 'Em Aberto', value: 'A' },
                { label: 'Baixado', value: 'B' },
            ],
        };
    },
    service: null,
    created() {
        this.service = new ActivityLogsService();
        this.debouncedGet = _.debounce(this.getActivityLogs, 500);
    },
    mounted() {
        this.getActivityLogs();
    },
    watch: {
        filter: function (value) {
            this.debouncedGet();
        }
    },
    methods: {
        // Format currency to human
        formatCurrency(value) {
            if (value) return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            return 0;
        },

        formatDecimal(value) {
            if (value) return value.toLocaleString('pt-BR');
            return 0;
        },

        openNew() {
            this.activitylog = {};
            this.submitted = false;
            this.editDialog = true;
        },

        hideDialog() {
            this.editDialog = false;
            this.submitted = false;
        },

        getActivityLogs() {
            this.service.getAll(this.filter).then((data) => {
                (this.activitylogs = data);
                this.loadingTable = false;
            });
        },

        // Open edit activitylog modal
        edit(activitylog) {

            this.service.edit(activitylog.id).then((data) => {
                this.activitylog = { ...data };
                this.editDialog = true;
            });
        },


        findIndexById(id) {
            let index = -1;
            for (let i = 0; i < this.activitylogs.length; i++) {
                if (this.activitylogs[i].id === id) {
                    index = i;
                    break;
                }
            }
            return index;
        },


        exportCSV() {
            this.$refs.dt.exportCSV();
        },

        formatDate(value) {
            return new Date(value).toLocaleDateString('pt-BR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
            });
        },
    },
};
</script>

<style scoped lang="scss">


.activitylog-image {
    width: 100px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.p-dialog .activitylog-image {
    width: 150px;
    margin: 0 auto 2rem auto;
    display: block;
}

.confirmation-content {
    display: flex;
    align-items: center;
    justify-content: center;
}

.activitylog-badge {
    border-radius: 2px;
    padding: 0.25em 0.5rem;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 0.3px;

    &.status-a {
        background: #c8e6c9;
        color: #256029;
    }

    &.status-b {
        background: #ffcdd2;
        color: #c63737;
    }

    &.status-x {
        background: #feedaf;
        color: #8a5340;
    }
}



::v-deep(.p-datatable-frozen-tbody) {
    font-weight: bold;
}

::v-deep(.p-datatable-scrollable .p-frozen-column) {
    font-weight: bold;
}

::v-deep(.p-progressbar) {
    height: .5rem;
    background-color: #D8DADC;

    .p-progressbar-value {
        background-color: #607D8B;
    }
}

.p-datatable .p-column-filter {
    display: none;
}

.table-header {
    display: flex;
    justify-content: space-between;
}

::v-deep(.p-datatable.p-datatable-customers) {
    .p-datatable-header {
        padding: 1rem;
        text-align: left;
        font-size: 1.5rem;
    }

    .p-paginator {
        padding: 1rem;
    }

    .p-datatable-thead > tr > th {
        text-align: left;
    }

    .p-datatable-tbody > tr > td {
        cursor: auto;
    }

    .p-dropdown-label:not(.p-placeholder) {
        text-transform: uppercase;
    }
}

/* Responsive */
.p-datatable-customers .p-datatable-tbody > tr > td .p-column-title {
    display: none;
}

.customer-badge {
    border-radius: 2px;
    padding: .25em .5rem;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: .3px;

    &.status-qualified {
        background: #C8E6C9;
        color: #256029;
    }

    &.status-unqualified {
        background: #FFCDD2;
        color: #C63737;
    }

    &.status-negotiation {
        background: #FEEDAF;
        color: #8A5340;
    }

    &.status-new {
        background: #B3E5FC;
        color: #23547B;
    }

    &.status-renewal {
        background: #ECCFFF;
        color: #694382;
    }

    &.status-proposal {
        background: #FFD8B2;
        color: #805B36;
    }
}

.p-progressbar-value.ui-widget-header {
    background: #607d8b;
}

@media (max-width: 640px) {
    .p-progressbar {
        margin-top: .5rem;
    }
}

.product-image {
    width: 100px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23)
}

.orders-subtable {
    padding: 1rem;
}

.product-badge {
    border-radius: 2px;
    padding: .25em .5rem;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: .3px;

    &.status-instock {
        background: #C8E6C9;
        color: #256029;
    }

    &.status-outofstock {
        background: #FFCDD2;
        color: #C63737;
    }

    &.status-lowstock {
        background: #FEEDAF;
        color: #8A5340;
    }
}

.order-badge {
    border-radius: 2px;
    padding: .25em .5rem;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: .3px;

    &.order-delivered {
        background: #C8E6C9;
        color: #256029;
    }

    &.order-cancelled {
        background: #FFCDD2;
        color: #C63737;
    }

    &.order-pending {
        background: #FEEDAF;
        color: #8A5340;
    }

    &.order-returned {
        background: #ECCFFF;
        color: #694382;
    }
}

@media screen and (max-width: 960px) {
    ::v-deep(.p-datatable) {
        &.p-datatable-customers {
            .p-datatable-thead > tr > th,
            .p-datatable-tfoot > tr > td {
                display: none !important;
            }

            .p-datatable-tbody > tr {
                border-bottom: 1px solid var(--surface-d);

                > td {
                    text-align: left !important;
                    display: block;
                    border: 0 none !important;
                    width: 100% !important;
                    float: left;
                    clear: left;
                    border: 0 none;

                    .p-column-title {
                        padding: .4rem;
                        min-width: 30%;
                        display: inline-block;
                        margin: -.4rem 1rem -.4rem -.4rem;
                        font-weight: bold;
                    }

                    .p-progressbar {
                        margin-top: .5rem;
                        display: inline-block;
                        width: 60%;
                    }

                    .p-rating {
                        display: inline-block;
                    }
                }
            }

            .p-datatable-tbody > tr.p-rowgroup-footer{
                display: flex;
            }
        }
    }
}

.true-icon {
    color: #256029;
}

.false-icon {
    color: #C63737;
}
</style>



