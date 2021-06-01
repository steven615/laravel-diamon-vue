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
                @click="novoPedido"
              />
            </template>

            <template v-slot:right>
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
            :value="pedidos"
            v-model:expandedRows="expandedRows"
            dataKey="id"
            :paginator="true"
            :rows="10"
            :loading="loadingTable"
            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            :rowsPerPageOptions="[5, 10, 25]"
            currentPageReportTemplate="Exibindo {first} até {last} de {totalRecords} pedidos"
            responsiveLayout="scroll"
            @row-expand="onRowExpand"
            @row-collapse="onRowCollapse"
          >
            <template #header>
              <div
                class="table-header p-d-flex p-flex-column p-flex-md-row p-jc-md-between"
              >
                <h5 class="p-m-0">Pedidos</h5>
                <span class="p-input-icon-left">
                  <i class="pi pi-search" />
                  <InputText v-model="filter" placeholder="Pesquisar..." />
                </span>
              </div>
            </template>
            <Column :expander="true" headerStyle="width: 3rem" />

            <Column field="code" header="Código" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Código</span>
                {{ slotProps.data.codigo }}
              </template>
            </Column>
            <Column field="nomecli" header="Cliente" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Cliente</span>
                {{ slotProps.data.nomecli }}
              </template>
            </Column>
            <Column field="cidade" header="Cidade" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Cidade</span>
                {{ slotProps.data.cidade }}
              </template>
            </Column>
            <Column field="desccond" header="Condição" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Condição</span>
                {{ slotProps.data.desccond }}
              </template>
            </Column>
            <Column
              field="valor"
              header="Valor"
              :sortable="true"
              class="p-text-right"
            >
              <template #body="slotProps">
                <span class="p-column-title">Valor</span>
                {{ formatDecimal(slotProps.data.valor) }}
              </template>
            </Column>

            <Column field="inventoryStatus" header="Status" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Status</span>
                <span
                  :class="
                    'pedido-badge status-' +
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
                <router-link
                  :to="{
                    name: 'pedidoeditar',
                    params: { id: slotProps.data.id },
                  }"
                  class="logo"
                >
                  <Button
                    icon="pi pi-eye"
                    class="p-button-rounded p-button-success p-mr-2"
                  />
                </router-link>
                <Button
                  icon="pi pi-ban"
                  v-if="slotProps.data.status == 'A'"
                  class="p-button-rounded p-button-danger"
                  @click="confirmarDelete(slotProps.data)"
                />
              </template>
            </Column>

            <template #expansion="slotProps">
              <div class="orders-subtable">
                <h5>Produtos do pedido {{ slotProps.data.codigo }}</h5>
                <DataTable
                  :value="slotProps.data.itens"
                  :loading="
                    slotProps.data.itens != null &&
                    slotProps.data.itens.length > 0
                      ? false
                      : loadingTableItens
                  "
                  responsiveLayout="scroll"
                >
                  <Column field="id" header="Id">
                    <template #body="slotProps">
                      <span class="p-column-title">Id</span>
                      {{ slotProps.data.produto }}
                    </template>
                  </Column>
                  <Column field="produto" header="Produto">
                    <template #body="slotProps">
                      <span class="p-column-title">Produto</span>
                      {{ slotProps.data.descprod }}
                    </template>
                  </Column>
                  <Column field="amount" header="Amount">
                    <template #body="slotProps" :sortable="true">
                      <span class="p-column-title">Amount</span>
                      {{ formatDecimal(slotProps.data.quant) }}
                    </template>
                  </Column>
                  <Column field="amount" header="Amount">
                    <template #body="slotProps" :sortable="true">
                      <span class="p-column-title">Amount</span>
                      R$ {{ formatDecimal(slotProps.data.vlrtotal) }}
                    </template>
                  </Column>
                  <Column field="status" header="Status">
                    <template #body="slotProps">
                      <span class="p-column-title">Status</span>
                      <span
                        :class="
                          'order-badge order-' +
                          (slotProps.data.status
                            ? slotProps.data.status.toLowerCase()
                            : '')
                        "
                        >{{ slotProps.data.status }}</span
                      >
                    </template>
                  </Column>
                  <Column headerStyle="width:4rem">
                    <template #body>
                      <Button
                        icon="pi pi-eye"
                        @click="visualizarItem(slotProps.data)"
                      />
                    </template>
                  </Column>
                </DataTable>
              </div>
            </template>
          </DataTable>

          <Dialog
            v-model:visible="pedidoItemDialog"
            :style="{ width: '450px' }"
            header="Visualizar Item Pedido"
            :modal="true"
            class="p-fluid"
          >
            <div class="p-field">
              <label for="descricao">Produto</label>
              <InputText
                id="descricao"
                v-model.trim="pedidoItem.descprod"
                required="true"
                autofocus
                :class="{ 'p-invalid': submitted && !pedidoItem.descprod }"
                :disabled="true"
              />
              <small class="p-invalid" v-if="submitted && !pedidoItem.descprod"
                >Produto é obrigatório.</small
              >
            </div>

            <div class="p-formgrid p-grid">
              <div class="p-field p-col">
                <label for="qtditens">Observações</label>
                <InputText
                  id="pedidoitemobs"
                  v-model="pedidoItem.obs"
                  :disabled="true"
                />
              </div>
            </div>

            <div class="p-formgrid p-grid">
              <div class="p-field p-col">
                <label for="qtditens">Quantidade</label>
                <InputNumber
                  id="pedidoitemquant"
                  v-model="pedidoItem.quant"
                  :disabled="true"
                />
              </div>

              <div class="p-field p-col">
                <label for="valormin">Valor</label>
                <InputNumber
                  id="pedidoitemvalor"
                  v-model="pedidoItem.vlrtotal"
                  mode="currency"
                  currency="BRL"
                  locale="pt-BR"
                  :disabled="true"
                />
              </div>
            </div>

            <template #footer>
              <Button
                label="Fechar"
                icon="pi pi-times"
                class="p-button-text"
                @click="hideDialog"
              />
            </template>
          </Dialog>

          <Dialog
            v-model:visible="showCancelaDialog"
            :style="{ width: '450px' }"
            header="Confirmar"
            :modal="true"
          >
            <div class="confirmation-content">
              <i
                class="pi pi-exclamation-triangle p-mr-3"
                style="font-size: 2rem"
              />
              <span v-if="pedido"
                >Tem certeza de que deseja cancelar o pedido
                <b>{{ pedido.id }}</b> - <i>{{ pedido.nomecli }}</i
                >?</span
              >
            </div>
            <template #footer>
              <Button
                label="Não"
                icon="pi pi-times"
                class="p-button-text"
                @click="showCancelaDialog = false"
              />
              <Button
                label="Sim"
                icon="pi pi-check"
                class="p-button-text"
                @click="cancelaPedido"
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
import PedidosService from "./PedidosService";

export default {
  components: {
    App,
  },
  data() {
    return {
      pedidos: null,
      expandedRows: [],
      pedidoItemDialog: false,
      showCancelaDialog: false,
      deleteDialog: false,
      pedido: {},
      pedidoItem: {},
      filter: "",
      submitted: false,
      loadingTable: true,
      loadingTableItens: true,
      statuses: [
        { label: "Ativo", value: "A" },
        { label: "Inativo", value: "I" },
      ],
    };
  },
  service: null,
  created() {
    this.service = new PedidosService();
    this.debouncedGet = _.debounce(this.getPedidos, 500);
  },
  mounted() {
    this.getPedidos();
  },
  watch: {
    filter: function (value) {
      this.debouncedGet();
    },
  },
  methods: {
    novoPedido() {
      this.service
        .storePedido({
          status: "A",
          dtemissao: new Date(),
        })
        .then((data) => {
          this.$router.push({ name: "pedidoeditar", params: { id: data.id } });
        });
    },

    onRowExpand(event) {
      //this.itens = [];
      this.loadingTableItens = true;
      this.service.getItensPedido(event.data.id).then((data) => {
        console.log("getItensPedido onRowExpand");
        console.log(data);
        this.itens = data;
        this.pedidos[this.findIndexById(event.data.id)].itens = data;
        this.loadingTableItens = false;
      });
    },
    onRowCollapse(event) {},

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
      this.pedido = {};
      this.submitted = false;
      this.pedidoItemDialog = true;
    },

    hideDialog() {
      this.pedidoItemDialog = false;
      this.submitted = false;
    },

    getPedidos() {
      this.service.getAll(this.filter).then((data) => {
        this.pedidos = data;
        this.loadingTable = false;
      });
    },

    save() {
      this.submitted = true;
      if (this.pedido.descricao.trim()) {
        if (this.pedido.id) {
          // Save editted pedido
          this.pedido.status = this.pedido.status.value
            ? this.pedido.status.value
            : this.pedido.status;

          this.service.update(this.pedido).then((data) => {
            this.pedidos[this.findIndexById(data.id)] = data;
            this.$toast.add({
              severity: "success",
              summary: "Successo",
              detail: "Pedido Atualizado",
              life: 3000,
            });
          });
        } else {
          this.pedido.code = this.createCode();
          this.pedido.image = "bamboo-watch.jpg"; // Use template image
          this.pedido.status = this.pedido.status
            ? this.pedido.status.value
            : "A";
          this.service.store(this.pedido).then((data) => {
            this.pedidos.unshift(data);
            this.$toast.add({
              severity: "success",
              summary: "Successo",
              detail: "Pedido Criado",
              life: 3000,
            });
          });
        }
        this.pedidoItemDialog = false;
        this.pedido = {};
      }
    },

    visualizarItem(itemPedido) {
      this.service.editPedidoItem(itemPedido.id).then((data) => {
        console.log(data);
        this.pedidoItem = { ...data };
        this.pedidoItemDialog = true;
      });
    },

    confirmarDelete(pedido) {
      this.pedido = pedido;
      this.showCancelaDialog = true;
    },
    // Delete pedido
    cancelaPedido() {
      this.loadingTable = true;
      this.service.cancelaPedido([this.pedido.id]).then((id) => {
        this.getPedidos();
        this.showCancelaDialog = false;
        this.pedido = {};
        this.$toast.add({
          severity: "success",
          summary: "Successo",
          detail: "Pedido Cancelado com Sucesso",
          life: 3000,
        });
      });
    },
    // Find pedido by id
    findIndexById(id) {
      let index = -1;
      for (let i = 0; i < this.pedidos.length; i++) {
        if (this.pedidos[i].id === id) {
          index = i;
          break;
        }
      }
      return index;
    },
    // Generate pedido code
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
    // Open confirm delete selected pedidos
  },
};
</script>

<style scoped lang="scss">
.pedido-image {
  width: 100px;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.p-dialog .pedido-image {
  width: 150px;
  margin: 0 auto 2rem auto;
  display: block;
}

.confirmation-content {
  display: flex;
  align-items: center;
  justify-content: center;
}

.pedido-badge {
  border-radius: 2px;
  padding: 0.25em 0.5rem;
  text-transform: uppercase;
  font-weight: 700;
  font-size: 12px;
  letter-spacing: 0.3px;

  &.status-c {
    background: #7eb8d4;
    color: #ffffff;
  }

  &.status-x {
    background: #d47e7e;
    color: #ffffff;
  }

  &.status-f {
    background: #7ed482;
    color: #ffffff;
  }

  &.status-a {
    background: #d4c17e;
    color: #ffffff;
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



