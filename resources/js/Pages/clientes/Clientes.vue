<template>
  <app>
    <div class="p-grid crud-demo">
      <div class="p-col-12">
        <div class="card">
          <Toast />
          <Toolbar class="p-mb-4">
            <template v-slot:left>
              <Button
                label="Novo"
                icon="pi pi-plus"
                class="p-button-success p-mr-2"
                @click="openNew"
              />
              <Button
                label="Deletar"
                icon="pi pi-trash"
                class="p-button-danger"
                @click="confirmDeleteSelected"
                :disabled="!selectedRegs || !selectedRegs.length"
              />
            </template>

            <template v-slot:right>
              <Button
                label="Questionário de Sucesso"
                icon="pi pi-plus"
                class="p-button-success p-mr-2"
                @click="novoQuest"
              />
              <Button
                label="Exportar"
                icon="pi pi-upload"
                class="p-button-info"
                @click="exportCSV($event)"
              />
            </template>
          </Toolbar>

          <DataTable
            ref="dt"
            :value="clientes"
            v-model:selection="selectedRegs"
            dataKey="id"
            :paginator="true"
            :rows="10"
            :loading="loadingTable"
            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            :rowsPerPageOptions="[5, 10, 25]"
            currentPageReportTemplate="Exibindo {first} até {last} de {totalRecords} clientes"
            responsiveLayout="scroll"
          >
            <template #header>
              <div
                class="table-header p-d-flex p-flex-column p-flex-md-row p-jc-md-between"
              >
                <h5 class="p-m-0">Clientes</h5>
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
            <Column field="nome" header="Nome" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Nome</span>
                {{ slotProps.data.nome }}
              </template>
            </Column>
            <Column field="cnpj" header="CNPJ" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">CNPJ</span>
                {{ slotProps.data.cnpj }}
              </template>
            </Column>
            <Column field="cidade" header="Cidade" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Cidade</span>
                {{ slotProps.data.cidade }}
              </template>
            </Column>
            <Column field="estado" header="Estado" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Estado</span>
                {{ slotProps.data.estado }}
              </template>
            </Column>
            <Column
              field="qtdpedidos"
              header="Qtd.Pedidos"
              :sortable="true"
              class="p-text-right"
            >
              <template #body="slotProps">
                <span class="p-column-title">Qtd.Pedidos</span>
                {{ formatDecimal(slotProps.data.qtdpedidos) }}
              </template>
            </Column>

            <Column
              field="valorpedidos"
              header="Valor Pedidos"
              :sortable="true"
              class="p-text-right"
            >
              <template #body="slotProps">
                <span class="p-column-title">Valor Pedidos</span>
                {{ formatDecimal(slotProps.data.valorpedidos) }}
              </template>
            </Column>

            <Column field="inventoryStatus" header="Status" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Status</span>
                <span
                  :class="
                    'cliente-badge status-' +
                    (slotProps.data.status
                      ? slotProps.data.status.toLowerCase()
                      : '')
                  "
                  >{{ slotProps.data.status }}</span
                >
              </template>
            </Column>

            <Column
              field="activity"
              header="Participação"
              :showFilterMatchModes="false"
              style="min-width: 12rem"
            >
              <template #body="{ data }">
                <span class="p-column-title">Participação</span>
                <ProgressBar :value="data.id" :showValue="false"></ProgressBar>
              </template>
              <template #filter="{ filterModel }">
                <Slider
                  v-model="filterModel.value"
                  range
                  class="p-m-3"
                ></Slider>
                <div class="p-d-flex p-ai-center p-jc-between p-px-2">
                  <span>{{
                    filterModel.value ? filterModel.value[0] : 0
                  }}</span>
                  <span>{{
                    filterModel.value ? filterModel.value[1] : 100
                  }}</span>
                </div>
              </template>
            </Column>

            <Column>
              <template #body="slotProps">
                <Button
                  icon="pi pi-pencil"
                  class="p-button-rounded p-button-success p-mr-2"
                  @click="edit(slotProps.data)"
                />
                <Button
                  icon="pi pi-trash"
                  class="p-button-rounded p-button-danger"
                  @click="confirmarDelete(slotProps.data)"
                />
              </template>
            </Column>
          </DataTable>

          <Dialog
            v-model:visible="editDialog"
            :style="{ width: '450px' }"
            header="Editar"
            :modal="true"
            class="p-fluid"
          >
            <div class="p-field">
              <label for="nome">Nome</label>
              <InputText
                id="nome"
                v-model.trim="cliente.nome"
                required="true"
                autofocus
                :class="{ 'p-invalid': submitted && !cliente.nome }"
              />
              <small class="p-invalid" v-if="submitted && !cliente.nome"
                >Nome é obrigatório.</small
              >
            </div>
            <div class="p-field">
              <label for="cnpj">CNPJ</label>
              <InputText
                id="cnpj"
                v-model.trim="cliente.cnpj"
                required="true"
                autofocus
                :class="{ 'p-invalid': submitted && !cliente.cnpj }"
              />
              <small class="p-invalid" v-if="submitted && !cliente.cnpj"
                >CNPJ é obrigatório.</small
              >
            </div>

            <div class="p-field">
              <label for="status" class="p-mb-3">Status</label>
              <Dropdown
                id="status"
                v-model="cliente.status"
                :options="statuses"
                optionLabel="label"
                required="true"
                :class="{ 'p-invalid': submitted && !cliente.status }"
                placeholder="Selecionar Status"
              >
                <template #value="slotProps">
                  <div v-if="slotProps.value && slotProps.value.value">
                    <span
                      :class="'cliente-badge status-' + slotProps.value.value"
                      >{{ slotProps.value.label }}</span
                    >
                  </div>
                  <div v-else-if="slotProps.value && !slotProps.value.value">
                    <span
                      :class="
                        'cliente-badge status-' + slotProps.value.toLowerCase()
                      "
                      >{{ slotProps.value }}</span
                    >
                  </div>
                  <span v-else>
                    {{ slotProps.placeholder }}
                  </span>
                </template>
              </Dropdown>
              <small class="p-invalid" v-if="submitted && !cliente.status"
                >Status é obrigatório.</small
              >
            </div>

            <div class="p-field">
              <label class="p-mb-3">Categoria</label>
              <div class="p-formgrid p-grid">
                <div class="p-field-radiobutton p-col-6">
                  <RadioButton
                    id="category1"
                    name="categoria"
                    value="categoria1"
                    v-model="cliente.categoria"
                  />
                  <label for="categoria1">Categoria 1</label>
                </div>
                <div class="p-field-radiobutton p-col-6">
                  <RadioButton
                    id="category2"
                    name="categoria"
                    value="categoria2"
                    v-model="cliente.categoria"
                  />
                  <label for="categoria2">Categoria 2</label>
                </div>
                <div class="p-field-radiobutton p-col-6">
                  <RadioButton
                    id="category3"
                    name="categoria"
                    value="categoria3"
                    v-model="cliente.categoria"
                  />
                  <label for="categoria3">Categoria 3</label>
                </div>
                <div class="p-field-radiobutton p-col-6">
                  <RadioButton
                    id="category4"
                    name="categoria"
                    value="categoria4"
                    v-model="cliente.categoria"
                  />
                  <label for="categoria4">Categoria 4</label>
                </div>
              </div>
            </div>

            <div class="p-formgrid p-grid">
              <div class="p-field p-col">
                <label for="cidade">Cidade</label>
                <InputText id="cidade" v-model="cliente.cidade" />
              </div>
              <div class="p-field p-col">
                <label for="estado">Estado</label>
                <InputText id="estado" v-model="cliente.estado" />
              </div>
            </div>

            <div class="p-formgrid p-grid">
              <div class="p-field p-col">
                <label for="limite">Limite</label>
                <InputNumber
                  id="limite"
                  v-model="cliente.limite"
                  mode="currency"
                  currency="BRL"
                  locale="pt-BR"
                />
              </div>
            </div>
            <template #footer>
              <Button
                label="Cancelar"
                icon="pi pi-times"
                class="p-button-text"
                @click="hideDialog"
              />
              <Button
                label="Salvar"
                icon="pi pi-check"
                class="p-button-text"
                @click="save"
              />
            </template>
          </Dialog>

          <Dialog
            v-model:visible="showDeleteDialog"
            :style="{ width: '450px' }"
            header="Confirmar"
            :modal="true"
          >
            <div class="confirmation-content">
              <i
                class="pi pi-exclamation-triangle p-mr-3"
                style="font-size: 2rem"
              />
              <span v-if="cliente"
                >Tem certeza de que deseja excluir <b>{{ cliente.name }}</b
                >?</span
              >
            </div>
            <template #footer>
              <Button
                label="Não"
                icon="pi pi-times"
                class="p-button-text"
                @click="showDeleteDialog = false"
              />
              <Button
                label="Sim"
                icon="pi pi-check"
                class="p-button-text"
                @click="delete"
              />
            </template>
          </Dialog>

          <Dialog
            v-model:visible="deleteDialog"
            :style="{ width: '450px' }"
            header="Confirmar"
            :modal="true"
          >
            <div class="confirmation-content">
              <i
                class="pi pi-exclamation-triangle p-mr-3"
                style="font-size: 2rem"
              />
              <span v-if="cliente"
                >Confirma deletar todos os registros selecionados?</span
              >
            </div>
            <template #footer>
              <Button
                label="Não"
                icon="pi pi-times"
                class="p-button-text"
                @click="deleteDialog = false"
              />
              <Button
                label="Sim"
                icon="pi pi-check"
                class="p-button-text"
                @click="deleteSelectedRegs"
              />
            </template>
          </Dialog>
        </div>
      </div>
    </div>
  </app>
</template>

<script>
import _ from "lodash";
import App from "@/Layouts/App";
import ClientesService from "./ClientesService";

export default {
  components: {
    App,
  },
  data() {
    return {
      clientes: null,
      editDialog: false,
      showDeleteDialog: false,
      deleteDialog: false,
      cliente: {},
      selectedRegs: null,
      filter: "",
      submitted: false,
      loadingTable: true,
      statuses: [
        { label: "Ativo", value: "A" },
        { label: "Inativo", value: "I" },
      ],
    };
  },
  service: null,
  created() {
    this.service = new ClientesService();
    this.debouncedGet = _.debounce(this.getClientes, 500);
  },
  mounted() {
    this.getClientes();
    console.log("process.env.MIX_APP_URL");
    console.log(process.env.MIX_APP_URL);
  },
  watch: {
    filter: function (value) {
      this.debouncedGet();
    },
  },
  methods: {
    novoQuest() {
      this.$router.push({ name: "questioeditar", params: { id: 0 } });
    },

    formatDecimal(value) {
      if (value) {
        var formatter = new Intl.NumberFormat("pt-BR", {
          style: "decimal",
          minimumFractionDigits: 2,
          currency: "BRL",
        });
        return formatter.format(value);
      }
      return 0;
    },

    openNew() {
      this.cliente = {};
      this.submitted = false;
      this.editDialog = true;
    },

    hideDialog() {
      this.editDialog = false;
      this.submitted = false;
    },

    getClientes() {
      this.service.getAll(this.filter).then((data) => {
        this.clientes = data;
        this.loadingTable = false;
      });
    },

    save() {
      this.submitted = true;
      if (this.cliente.nome && this.cliente.status) {
        this.loadingTable = true;
        if (this.cliente.id) {
          // Save editted cliente
          this.cliente.status = this.cliente.status.value
            ? this.cliente.status.value
            : this.cliente.status;

          this.service.update(this.cliente).then((data) => {
            this.clientes[this.findIndexById(data.id)] = data;
            this.$toast.add({
              severity: "success",
              summary: "Successo",
              detail: "Cliente Atualizado",
              life: 3000,
            });
            this.editDialog = false;
            this.cliente = {};
            this.loadingTable = false;
          });
        } else {
          this.cliente.codigo = this.createCode();
          this.cliente.image = "bamboo-watch.jpg"; // Use template image
          this.cliente.status = this.cliente.status
            ? this.cliente.status.value
            : "A";
          this.service.store(this.cliente).then((data) => {
            this.clientes.unshift(data);
            this.$toast.add({
              severity: "success",
              summary: "Successo",
              detail: "Cliente Criado",
              life: 3000,
            });
            this.editDialog = false;
            this.cliente = {};
            this.loadingTable = false;
          });
        }
      }
    },
    // Open edit cliente modal
    edit(cliente) {
      this.service.edit(cliente.id).then((data) => {
        this.cliente = { ...data };
        this.editDialog = true;
      });
    },
    // Open confirm delete cliente modal
    confirmarDelete(cliente) {
      this.cliente = cliente;
      this.showDeleteDialog = true;
    },
    // Delete cliente
    delete() {
      this.service.delete([this.cliente.id]).then((id) => {
        this.clientes = this.clientes.filter((val) => val.id !== Number(id[0]));
        this.showDeleteDialog = false;
        this.cliente = {};
        this.$toast.add({
          severity: "success",
          summary: "Successo",
          detail: "Cliente Deletado",
          life: 3000,
        });
      });
    },
    // Find cliente by id
    findIndexById(id) {
      let index = -1;
      for (let i = 0; i < this.clientes.length; i++) {
        if (this.clientes[i].id === id) {
          index = i;
          break;
        }
      }
      return index;
    },
    // Generate cliente code
    createCode() {
      let code = "";
      var chars =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      for (var i = 0; i < 5; i++) {
        code += chars.charAt(Math.floor(Math.random() * chars.length));
      }
      return code;
    },

    exportCSV() {
      this.$refs.dt.exportCSV();
    },
    // Open confirm delete selected clientes
    confirmDeleteSelected() {
      this.deleteDialog = true;
    },
    // Delete selected clientes
    deleteSelectedRegs() {
      let ids = this.selectedRegs.map((item) => {
        return item.id;
      });

      this.service.delete(ids).then((id) => {
        this.clientes = this.clientes.filter(
          (val) => !id.includes(val.id.toString())
        );
        this.deleteDialog = false;
        this.selectedRegs = null;
        this.$toast.add({
          severity: "success",
          summary: "Successo",
          detail: "Cliente Deletado",
          life: 3000,
        });
      });
    },
  },
};
</script>

<style scoped lang="scss">
.cliente-image {
  width: 100px;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.p-dialog .cliente-image {
  width: 150px;
  margin: 0 auto 2rem auto;
  display: block;
}

.confirmation-content {
  display: flex;
  align-items: center;
  justify-content: center;
}

.cliente-badge {
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
  height: 0.5rem;
  background-color: #d8dadc;

  .p-progressbar-value {
    background-color: #607d8b;
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
  padding: 0.25em 0.5rem;
  text-transform: uppercase;
  font-weight: 700;
  font-size: 12px;
  letter-spacing: 0.3px;

  &.status-qualified {
    background: #c8e6c9;
    color: #256029;
  }

  &.status-unqualified {
    background: #ffcdd2;
    color: #c63737;
  }

  &.status-negotiation {
    background: #feedaf;
    color: #8a5340;
  }

  &.status-new {
    background: #b3e5fc;
    color: #23547b;
  }

  &.status-renewal {
    background: #eccfff;
    color: #694382;
  }

  &.status-proposal {
    background: #ffd8b2;
    color: #805b36;
  }
}

.p-progressbar-value.ui-widget-header {
  background: #607d8b;
}

@media (max-width: 640px) {
  .p-progressbar {
    margin-top: 0.5rem;
  }
}

.product-image {
  width: 100px;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.orders-subtable {
  padding: 1rem;
}

.product-badge {
  border-radius: 2px;
  padding: 0.25em 0.5rem;
  text-transform: uppercase;
  font-weight: 700;
  font-size: 12px;
  letter-spacing: 0.3px;

  &.status-instock {
    background: #c8e6c9;
    color: #256029;
  }

  &.status-outofstock {
    background: #ffcdd2;
    color: #c63737;
  }

  &.status-lowstock {
    background: #feedaf;
    color: #8a5340;
  }
}

.order-badge {
  border-radius: 2px;
  padding: 0.25em 0.5rem;
  text-transform: uppercase;
  font-weight: 700;
  font-size: 12px;
  letter-spacing: 0.3px;

  &.order-delivered {
    background: #c8e6c9;
    color: #256029;
  }

  &.order-cancelled {
    background: #ffcdd2;
    color: #c63737;
  }

  &.order-pending {
    background: #feedaf;
    color: #8a5340;
  }

  &.order-returned {
    background: #eccfff;
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
            padding: 0.4rem;
            min-width: 30%;
            display: inline-block;
            margin: -0.4rem 1rem -0.4rem -0.4rem;
            font-weight: bold;
          }

          .p-progressbar {
            margin-top: 0.5rem;
            display: inline-block;
            width: 60%;
          }

          .p-rating {
            display: inline-block;
          }
        }
      }

      .p-datatable-tbody > tr.p-rowgroup-footer {
        display: flex;
      }
    }
  }
}

.true-icon {
  color: #256029;
}

.false-icon {
  color: #c63737;
}
</style>



