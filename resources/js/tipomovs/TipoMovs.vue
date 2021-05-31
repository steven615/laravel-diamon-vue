<template>
    <div class="p-grid crud-demo">
        <div class="p-col-12">
            <div class="card">
                <Toast />
                <Toolbar class="p-mb-4">
                    <template v-slot:left>
                        <Button label="Novo" icon="pi pi-plus" class="p-button-success p-mr-2" @click="openNew" />
                        <Button label="Deletar" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected" :disabled="!selectedRegs || !selectedRegs.length" />
                    </template>

                    <template v-slot:right>
                        <Button label="Exportar" icon="pi pi-upload" class="p-button-info" @click="exportCSV($event)" />
                    </template>
                </Toolbar>

                <DataTable
                    ref="dt"
                    :value="tipomovs"
                    v-model:selection="selectedRegs"
                    dataKey="id"
                    :paginator="true"
                    :rows="10"
                    :loading="loadingTable"
                    paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                    :rowsPerPageOptions="[5, 10, 25]"
                    currentPageReportTemplate="Exibindo {first} até {last} de {totalRecords} tipos de movimento"
                    responsiveLayout="scroll"
                >
                    <template #header>
                        <div class="table-header p-d-flex p-flex-column p-flex-md-row p-jc-md-between">
                            <h5 class="p-m-0">Tipos de Movimento</h5>
                            <span class="p-input-icon-left">
                                <i class="pi pi-search" />
                                <InputText v-model="filter" placeholder="Pesquisar..." />
                            </span>
                        </div>
                    </template>

                    <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                    <Column field="code" header="Código" :sortable="true">
                        <template #body="slotProps">
                            <span class="p-column-title">Código</span>
                            {{ slotProps.data.codigo }}
                        </template>
                    </Column>
                    <Column field="descricao" header="Descrição" :sortable="true">
                        <template #body="slotProps">
                            <span class="p-column-title">Descrição</span>
                            {{ slotProps.data.descricao }}
                        </template>
                    </Column>


                    <Column field="inventoryStatus" header="Status" :sortable="true">
                        <template #body="slotProps">
                            <span class="p-column-title">Status</span>
                            <span :class="'tipomov-badge status-' + (slotProps.data.status ? slotProps.data.status.toLowerCase() : '')">{{ slotProps.data.status }}</span>
                        </template>
                    </Column>

                    <Column field="activity" header="Participação" :showFilterMatchModes="false" style="min-width:12rem">
                        <template #body="{data}">
                            <span class="p-column-title">Participação</span>
                            <ProgressBar :value="data.id" :showValue="false"></ProgressBar>
                        </template>
                        <template #filter={filterModel}>
                            <Slider v-model="filterModel.value" range class="p-m-3"></Slider>
                            <div class="p-d-flex p-ai-center p-jc-between p-px-2">
                                <span>{{filterModel.value ? filterModel.value[0] : 0}}</span>
                                <span>{{filterModel.value ? filterModel.value[1] : 100}}</span>
                            </div>
                        </template>
                    </Column>

                    <Column>
                        <template #body="slotProps">
                            <Button icon="pi pi-pencil" class="p-button-rounded p-button-success p-mr-2" @click="edit(slotProps.data)" />
                            <Button icon="pi pi-trash" class="p-button-rounded p-button-danger" @click="confirmarDelete(slotProps.data)" />
                        </template>
                    </Column>
                </DataTable>

                <Dialog v-model:visible="editDialog" :style="{ width: '450px' }" header="Editar" :modal="true" class="p-fluid">
                    <div class="p-field">
                        <label for="descricao">Descrição</label>
                        <InputText id="descricao" v-model.trim="tipomov.descricao" required="true" autofocus :class="{ 'p-invalid': submitted && !tipomov.nome }" />
                        <small class="p-invalid" v-if="submitted && !tipomov.descricao">Descrição é obrigatório.</small>
                    </div>

                    <div class="p-field">
                        <label for="status" class="p-mb-3">Status</label>
                        <Dropdown
                            id="status"
                            v-model="tipomov.status"
                            :options="statuses"
                            optionLabel="label"
                            required="true"
                            :class="{ 'p-invalid': submitted && !tipomov.status }"
                            placeholder="Selecionar Status">
                            <template #value="slotProps">
                                <div v-if="slotProps.value && slotProps.value.value">
                                    <span :class="'tipomov-badge status-' + slotProps.value.value">{{ slotProps.value.label }}</span>
                                </div>
                                <div v-else-if="slotProps.value && !slotProps.value.value">
                                    <span :class="'tipomov-badge status-' + slotProps.value.toLowerCase()">{{ slotProps.value }}</span>
                                </div>
                                <span v-else>
                                    {{ slotProps.placeholder }}
                                </span>
                            </template>
                        </Dropdown>
                        <small class="p-invalid" v-if="submitted && !tipomov.status">Status é obrigatório.</small>
                    </div>



                    <template #footer>
                        <Button label="Cancelar" icon="pi pi-times" class="p-button-text" @click="hideDialog" />
                        <Button label="Salvar" icon="pi pi-check" class="p-button-text" @click="save" />
                    </template>
                </Dialog>

                <Dialog v-model:visible="showDeleteDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
                    <div class="confirmation-content">
                        <i class="pi pi-exclamation-triangle p-mr-3" style="font-size: 2rem" />
                        <span v-if="tipomov"
                        >Tem certeza de que deseja excluir <b>{{ tipomov.name }}</b
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
                        <span v-if="tipomov">Confirma deletar todos os registros selecionados?</span>
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

import TipoMovsService from './TipoMovsService';

export default {
    data() {
        return {
            tipomovs: null,
            editDialog: false,
            showDeleteDialog: false,
            deleteDialog: false,
            tipomov: {},
            selectedRegs: null,
            filter: '',
            submitted: false,
            loadingTable: true,
            statuses: [
                { label: 'Ativo', value: 'A' },
                { label: 'Inativo', value: 'I' },
            ],
        };
    },
    service: null,
    created() {
        this.service = new TipoMovsService();
        this.debouncedGet = _.debounce(this.getTipoMovs, 500);
    },
    mounted() {
        this.getTipoMovs();
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
            this.tipomov = {};
            this.submitted = false;
            this.editDialog = true;
        },

        hideDialog() {
            this.editDialog = false;
            this.submitted = false;
        },

        getTipoMovs() {
            this.service.getAll(this.filter).then((data) => {
                (this.tipomovs = data);
                this.loadingTable = false;
            });
        },

        save() {
            this.submitted = true;
            if (
                this.tipomov.descricao
                && this.tipomov.status
            ) {
                this.loadingTable = true;
                if (this.tipomov.id) { // Save editted tipomov
                    this.tipomov.status = this.tipomov.status.value ? this.tipomov.status.value : this.tipomov.status;

                    this.service.update(this.tipomov).then((data) => {
                        this.tipomovs[this.findIndexById(data.id)] = data;
                        this.$toast.add({ severity: 'success', summary: 'Successo', detail: 'Tipo de Movimento Atualizado', life: 3000 });
                        this.loadingTable = false;
                        this.editDialog = false;
                        this.tipomov = {};
                    });
                } else {
                    this.tipomov.codigo = this.createCode();
                    this.tipomov.image = 'bamboo-watch.jpg'; // Use template image
                    this.tipomov.status = this.tipomov.status ? this.tipomov.status.value : 'A';
                    this.service.store(this.tipomov).then((data) => {
                        this.tipomovs.unshift(data);
                        this.$toast.add({ severity: 'success', summary: 'Successo', detail: 'Tipo de Movimento Criado', life: 3000 });
                        this.loadingTable = false;
                        this.editDialog = false;
                        this.tipomov = {};
                    });
                }

            }
        },
        // Open edit tipomov modal
        edit(tipomov) {
            this.service.edit(tipomov.id).then((data) => {
                this.tipomov = { ...data };
                this.editDialog = true;
            });
        },
        // Open confirm delete tipomov modal
        confirmarDelete(tipomov) {
            this.tipomov = tipomov;
            this.showDeleteDialog = true;
        },
        // Delete tipomov
        delete() {
            this.service.delete([this.tipomov.id]).then((id) => {
                this.tipomovs = this.tipomovs.filter((val) => val.id !== Number(id[0]));
                this.showDeleteDialog = false;
                this.tipomov = {};
                this.$toast.add({ severity: 'success', summary: 'Successo', detail: 'Tipo de Movimento Deletado', life: 3000 });
            });
        },
        // Find tipomov by id
        findIndexById(id) {
            let index = -1;
            for (let i = 0; i < this.tipomovs.length; i++) {
                if (this.tipomovs[i].id === id) {
                    index = i;
                    break;
                }
            }
            return index;
        },
        // Generate tipomov code
        createCode() {
            let code = '';
            var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            for (var i = 0; i < 5; i++) {
                code += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return code;
        },

        exportCSV() {
            this.$refs.dt.exportCSV();
        },
        // Open confirm delete selected tipomovs
        confirmDeleteSelected() {
            this.deleteDialog = true;
        },
        // Delete selected tipomovs
        deleteSelectedRegs() {
            let ids = this.selectedRegs.map((item) => {
                return item.id;
            });

            this.service.delete(ids).then((id) => {
                this.tipomovs = this.tipomovs.filter((val) => !id.includes(val.id.toString()));
                this.deleteDialog = false;
                this.selectedRegs = null;
                this.$toast.add({ severity: 'success', summary: 'Successo', detail: 'Tipo de Movimento Deletada', life: 3000 });
            });
        },
    },
};
</script>

<style scoped lang="scss">


.tipomov-image {
    width: 100px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.p-dialog .tipomov-image {
    width: 150px;
    margin: 0 auto 2rem auto;
    display: block;
}

.confirmation-content {
    display: flex;
    align-items: center;
    justify-content: center;
}

.tipomov-badge {
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

    &.status-i {
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



