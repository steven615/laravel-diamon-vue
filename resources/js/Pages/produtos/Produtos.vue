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
                label="Exportar"
                icon="pi pi-upload"
                class="p-button-info"
                @click="exportCSV($event)"
              />
            </template>
          </Toolbar>

          <DataTable
            ref="dt"
            :value="produtos"
            v-model:selection="selectedRegs"
            dataKey="id"
            :paginator="true"
            :rows="10"
            :loading="loadingTable"
            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            :rowsPerPageOptions="[5, 10, 25]"
            currentPageReportTemplate="Exibindo {first} até {last} de {totalRecords} produtos"
            responsiveLayout="scroll"
          >
            <template #header>
              <div
                class="table-header p-d-flex p-flex-column p-flex-md-row p-jc-md-between"
              >
                <h5 class="p-m-0">Produtos</h5>
                <span class="p-input-icon-left">
                  <i class="pi pi-search" />
                  <InputText v-model="filter" placeholder="Pesquisar..." />
                </span>
              </div>
            </template>

            <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
            <Column header="Imagem">
              <template #body="slotProps">
                <span class="p-column-title">Imagem</span>

                <img
                  src="images/product/black-watch.jpg"
                  :alt="slotProps.data.image"
                  class="produto-image"
                />
              </template>
            </Column>
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
            <Column
              field="saldo"
              header="Saldo"
              :sortable="true"
              class="p-text-right"
            >
              <template #body="slotProps">
                <span class="p-column-title">Saldo</span>
                {{ formatDecimal(slotProps.data.saldo) }}
              </template>
            </Column>
            <Column
              field="preco"
              header="Preço"
              :sortable="true"
              class="p-text-right"
            >
              <template #body="slotProps">
                <span class="p-column-title">Preço</span>
                {{ formatDecimal(slotProps.data.preco) }}
              </template>
            </Column>
            <Column field="category" header="Categoria" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Categoria</span>
                {{ slotProps.data.categoria }}
              </template>
            </Column>
            <Column field="rating" header="Avaliações" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Avaliações</span>
                <Rating
                  :modelValue="slotProps.data.rating"
                  :readonly="true"
                  :cancel="false"
                />
              </template>
            </Column>
            <Column field="inventoryStatus" header="Status" :sortable="true">
              <template #body="slotProps">
                <span class="p-column-title">Status</span>
                <span
                  :class="
                    'produto-badge status-' +
                    (slotProps.data.status
                      ? slotProps.data.status.toLowerCase()
                      : '')
                  "
                  >{{ slotProps.data.status }}</span
                >
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
            <img
              src="images/product/bamboo-watch.jpg"
              :alt="produto.image"
              class="produto-image"
              v-if="produto.image"
            />
            <div class="p-field">
              <label for="descricao">Descrição</label>
              <InputText
                id="descricao"
                v-model.trim="produto.descricao"
                required="true"
                autofocus
                :class="{ 'p-invalid': submitted && !produto.descricao }"
              />
              <small class="p-invalid" v-if="submitted && !produto.descricao"
                >Descrição é obrigatório.</small
              >
            </div>

            <div class="p-field">
              <label for="status" class="p-mb-3">Status</label>
              <Dropdown
                id="status"
                v-model="produto.status"
                :options="statuses"
                optionLabel="label"
                required="true"
                :class="{ 'p-invalid': submitted && !produto.status }"
                placeholder="Selecionar Status"
              >
                <template #value="slotProps">
                  <div v-if="slotProps.value && slotProps.value.value">
                    <span
                      :class="'produtos-badge status-' + slotProps.value.value"
                      >{{ slotProps.value.label }}</span
                    >
                  </div>
                  <div v-else-if="slotProps.value && !slotProps.value.value">
                    <span
                      :class="
                        'produtos-badge status-' + slotProps.value.toLowerCase()
                      "
                      >{{ slotProps.value }}</span
                    >
                  </div>
                  <span v-else>
                    {{ slotProps.placeholder }}
                  </span>
                </template>
              </Dropdown>
              <small class="p-invalid" v-if="submitted && !produto.status"
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
                    v-model="produto.categoria"
                  />
                  <label for="categoria1">Categoria 1</label>
                </div>
                <div class="p-field-radiobutton p-col-6">
                  <RadioButton
                    id="category2"
                    name="categoria"
                    value="categoria2"
                    v-model="produto.categoria"
                  />
                  <label for="categoria2">Categoria 2</label>
                </div>
                <div class="p-field-radiobutton p-col-6">
                  <RadioButton
                    id="category3"
                    name="categoria"
                    value="categoria3"
                    v-model="produto.categoria"
                  />
                  <label for="categoria3">Categoria 3</label>
                </div>
                <div class="p-field-radiobutton p-col-6">
                  <RadioButton
                    id="category4"
                    name="categoria"
                    value="categoria4"
                    v-model="produto.categoria"
                  />
                  <label for="categoria4">Categoria 4</label>
                </div>
              </div>
            </div>

            <div class="p-formgrid p-grid">
              <div class="p-field p-col">
                <label for="preco">Preço</label>
                <InputNumber
                  id="preco"
                  v-model="produto.preco"
                  mode="currency"
                  currency="BRL"
                  locale="pt-BR"
                />
              </div>
              <div class="p-field p-col">
                <label for="saldo">Saldo</label>
                <InputNumber id="saldo" v-model="produto.saldo" integeronly />
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
              <span v-if="produto"
                >Tem certeza de que deseja excluir <b>{{ produto.name }}</b
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
              <span v-if="produto"
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
import ProdutoService from "./ProdutoService";

export default {
  components: {
    App,
  },
  data() {
    return {
      produtos: null,
      editDialog: false,
      showDeleteDialog: false,
      deleteDialog: false,
      produto: {},
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
    this.service = new ProdutoService();
    this.debouncedGet = _.debounce(this.getProdutos, 500);
  },
  mounted() {
    this.getProdutos();
  },
  watch: {
    filter: function (value) {
      this.debouncedGet();
    },
  },
  methods: {
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
      this.produto = {};
      this.submitted = false;
      this.editDialog = true;
    },

    hideDialog() {
      this.editDialog = false;
      this.submitted = false;
    },

    getProdutos() {
      this.service.getAll(this.filter).then((data) => {
        this.produtos = data;
        this.loadingTable = false;
      });
    },

    save() {
      console.log("save");
      this.submitted = true;
      if (this.produto.descricao && this.produto.status) {
        this.loadingTable = true;
        if (this.produto.id) {
          // Save editted produtos
          this.produto.status = this.produto.status.value
            ? this.produto.status.value
            : this.produto.status;

          this.service.update(this.produto).then((data) => {
            this.produtos[this.findIndexById(data.id)] = data;
            this.$toast.add({
              severity: "success",
              summary: "Successo",
              detail: "Produto Atualizado",
              life: 3000,
            });
            this.editDialog = false;
            this.produto = {};
            this.loadingTable = false;
          });
        } else {
          this.produto.codigo = this.createCode();
          this.produto.image = "bamboo-watch.jpg"; // Use template image
          this.produto.status = this.produto.status
            ? this.produto.status.value
            : "A";
          this.service.store(this.produto).then((data) => {
            this.produtos.unshift(data);
            this.$toast.add({
              severity: "success",
              summary: "Successo",
              detail: "Produto Criado",
              life: 3000,
            });
            this.editDialog = false;
            this.produto = {};
            this.loadingTable = false;
          });
        }
      }
    },
    // Open edit produtos modal
    edit(produto) {
      this.service.edit(produto.id).then((data) => {
        this.produto = { ...data };
        this.editDialog = true;
      });
    },
    // Open confirm delete produtos modal
    confirmarDelete(produto) {
      this.produto = produto;
      this.showDeleteDialog = true;
    },
    // Delete produtos
    delete() {
      this.service.delete([this.produto.id]).then((id) => {
        this.produtos = this.produtos.filter((val) => val.id !== Number(id[0]));
        this.showDeleteDialog = false;
        this.produto = {};
        this.$toast.add({
          severity: "success",
          summary: "Successo",
          detail: "Produto Deletado",
          life: 3000,
        });
      });
    },
    // Find produtos by id
    findIndexById(id) {
      let index = -1;
      for (let i = 0; i < this.produtos.length; i++) {
        if (this.produtos[i].id === id) {
          index = i;
          break;
        }
      }
      return index;
    },
    // Generate produtos code
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
    // Open confirm delete selected produtos
    confirmDeleteSelected() {
      this.deleteDialog = true;
    },
    // Delete selected produtos
    deleteSelectedRegs() {
      let ids = this.selectedRegs.map((item) => {
        return item.id;
      });

      this.service.delete(ids).then((id) => {
        this.produtos = this.produtos.filter(
          (val) => !id.includes(val.id.toString())
        );
        this.deleteDialog = false;
        this.selectedRegs = null;
        this.$toast.add({
          severity: "success",
          summary: "Successo",
          detail: "Produto Deletado",
          life: 3000,
        });
      });
    },
  },
};
</script>

<style lang="scss">
.table-header {
  display: flex;
  justify-content: space-between;
}

.produto-image {
  width: 100px;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.p-dialog .produto-image {
  width: 150px;
  margin: 0 auto 2rem auto;
  display: block;
}

.confirmation-content {
  display: flex;
  align-items: center;
  justify-content: center;
}

.produto-badge {
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

/* Responsive */
.p-datatable-customers .p-datatable-tbody > tr > td .p-column-title {
  display: none;
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
          text-align: left;
          display: block;
          border: 0 none !important;
          width: 100% !important;
          float: left;
          clear: left;
          border: 0 none;

          &:last-child {
            text-align: center;
          }

          .p-column-title {
            padding: 0.4rem;
            min-width: 30%;
            display: inline-block;
            margin: -0.4rem 1rem -0.4rem -0.4rem;
            font-weight: bold;
          }

          .p-progressbar {
            margin-top: 0.5rem;
          }

          .p-rating {
            display: inline-block;
          }
        }
      }
    }
  }

  ::v-deep(.p-toolbar) {
    flex-wrap: wrap;

    .p-button {
      margin-bottom: 0.25rem;
    }
  }
}
</style>
