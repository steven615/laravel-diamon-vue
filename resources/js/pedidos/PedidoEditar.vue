<template>
    <div class="p-grid p-fluid">
        <div class="p-col-12 p-md-12">


            <div class="p-col-12 p-md-12">
                <div class="card">
                    <div class="p-col-12" style="text-align: right">
                        <span :class="'pedido-badge status-' + (pedido.status ? pedido.status.toLowerCase() : '')">{{ converteTextoStatus(pedido.status) }}</span>
                    </div>

                    <div class="p-col-12">
                        <div class="p-grid p-formgrid">
                            <div class="p-col-12 p-md-6">
                                <h6 class="p-mb-0">ID</h6>
                                <span class="p-input-icon-left">
                                <i class="pi pi-key" />
                                <InputText id="id" type="text" :disabled="true" v-model="pedido.id"/>
                            </span>
                            </div>

                            <div class="p-col-12 p-md-6">
                                <h6 class="p-mb-0">Código</h6>
                                <span class="p-input-icon-left">
                                <i class="pi pi-key" />
                                <InputText id="codigo" type="text" :disabled="true" v-model="pedido.codigo"/>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-col-12 p-md-12">
                <div class="card">


                    <div>
                        <div class="p-col-12">
                            <h6 class="p-mb-0">Cliente</h6>
                            <div class="p-grid p-formgrid">
                                <div class="p-col-12 p-mb-12 p-lg-12 p-mb-lg-12">

                                    <Skeleton v-if="loadingCliente" class="p-mb-2" width="100%" borderRadius="16px"></Skeleton>

                                    <AutoComplete
                                          v-if="!loadingCliente"
                                          placeholder="Pesquisar cliente"
                                          id="cliente"
                                          :dropdown="true"
                                          :multiple="false"
                                          v-model="selectedAutoValueCliente"
                                          :suggestions="autoFilteredValueCliente"
                                          @complete="pesquisaCliente($event)"
                                          @item-select="alteraCliente($event.value.codigo)"
                                          field="nome"
                                          >
                                        <template #item="slotProps">
                                            <div >
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 5%;">
                                                                <img :src="'/images/statuscliente/' + slotProps.item.status + '.png'"
                                                                     height="25" width="25"/> </td>
                                                            <td style="width: 10%;">{{slotProps.item.codigo}}</td>
                                                            <td style="width: 50%; font-weight: bold">{{slotProps.item.nome}}</td>
                                                            <td style="width: 30%;">{{slotProps.item.cnpj}}</td>
                                                            <td style="width: 10%;">{{slotProps.item.cidade}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </template>
                                    </AutoComplete>
                                </div>
                            </div>
                        </div>

                        <div class="p-col-12">

                        </div>

                        <div class="p-col-12">
                            <div class="p-grid p-formgrid">
                                <div class="p-col-12 p-md-6">
                                    <h6 class="p-mb-0">Tipo de Movimento</h6>
                                    <Skeleton v-if="loadingTipoMov" class="p-mb-2" width="100%" borderRadius="16px"></Skeleton>
                                    <AutoComplete placeholder="Pesquisar tipo de movimento"
                                                  v-if="!loadingTipoMov"
                                                  id="tipomov"
                                                  :dropdown="true"
                                                  :multiple="false"
                                                  v-model="selectedAutoValueTipoMov"
                                                  :suggestions="autoFilteredValueTipoMov"
                                                  @complete="pesquisaTipoMov($event)"
                                                  @item-select="alteraTipoMov($event.value.codigo)"
                                                  field="descricao">
                                        <template #item="slotProps">
                                            <div >
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td style="width: 5%;">
                                                            <img :src="'/images/statuscliente/' + slotProps.item.status + '.png'"
                                                                         height="25" width="25"/>
                                                        </td>
                                                        <td style="width: 50%;">{{slotProps.item.descricao}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                    </AutoComplete>


                                </div>

                                <div class="p-col-12 p-md-6">
                                    <h6 class="p-mb-0">Frete</h6>
                                    <Skeleton v-if="loadingTipoFrete" class="p-mb-2" width="100%" borderRadius="16px"></Skeleton>
                                    <AutoComplete placeholder="Pesquisar tipo de frete"
                                                  v-if="!loadingTipoFrete"
                                                  id="frete"
                                                  :dropdown="true"
                                                  :multiple="false"
                                                  v-model="selectedAutoValueFrete"
                                                  :suggestions="autoFilteredValueFrete"
                                                  @complete="pesquisaFrete($event)"
                                                  @item-select="alteraTipoFrete($event.value.codigo)"
                                                  field="descricao">
                                        <template #item="slotProps">
                                            <div >
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td style="width: 5%;">
                                                            <img :src="'/images/statuscliente/' + slotProps.item.status + '.png'"
                                                                         height="25" width="25"/>
                                                        </td>
                                                        <td style="width: 50%;">{{slotProps.item.descricao}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                    </AutoComplete>
                                </div>
                            </div>
                        </div>


                        <div class="p-col-12">
                            <div class="p-grid p-formgrid">
                                <div class="p-col-12 p-md-6">
                                    <h6 class="p-mb-0">Condição de Pagamento</h6>
                                    <Skeleton v-if="loadingCondPgto" class="p-mb-2" width="100%" borderRadius="16px"></Skeleton>
                                    <AutoComplete placeholder="Pesquisar condição de pagamento"
                                                  v-if="!loadingCondPgto"
                                                  id="condpgto"
                                                  :dropdown="true"
                                                  :multiple="false"
                                                  v-model="selectedAutoValueCondPgto"
                                                  :suggestions="autoFilteredValueCondPgto"
                                                  @complete="pesquisaCondPgto($event)"
                                                  @item-select="alteraCondPgto($event.value.codigo)"
                                                  field="descricao">
                                        <template #item="slotProps">
                                            <div >
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td style="width: 5%;">
                                                            <img :src="'/images/statuscliente/' + slotProps.item.status + '.png'"
                                                                 height="25" width="25"/> </td>
                                                        <td style="width: 10%;">{{slotProps.item.codigo}}</td>
                                                        <td style="width: 50%; font-weight: bold">{{slotProps.item.descricao}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                    </AutoComplete>
                                </div>

                                <div class="p-col-12 p-md-6">
                                    <h6 class="p-mb-0">Forma de Pagamento</h6>
                                    <Skeleton v-if="loadingFormaPgto" class="p-mb-2" width="100%" borderRadius="16px"></Skeleton>
                                    <AutoComplete
                                        placeholder="Pesquisar forma de pagamento"
                                        v-if="!loadingFormaPgto"
                                        id="formapgto"
                                        :dropdown="true"
                                        :multiple="false"
                                        v-model="selectedAutoValueFormaPgto"
                                        :suggestions="autoFilteredValueFormaPgto"
                                        @complete="pesquisaFormaPgto($event)"
                                        @item-select="alteraFormaPgto($event.value.codigo)"
                                        field="descricao">
                                        <template #item="slotProps">
                                            <div >
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td style="width: 5%;">
                                                            <img :src="'/images/statuscliente/' + slotProps.item.status + '.png'"
                                                                 height="25" width="25"/> </td>
                                                        <td style="width: 10%;">{{slotProps.item.codigo}}</td>
                                                        <td style="width: 50%; font-weight: bold">{{slotProps.item.descricao}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                    </AutoComplete>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div class="p-col-12 p-md-12">
            <div class="card">
                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Data Emissão </h6>
                            <Calendar :showIcon="false"
                                      :showButtonBar="false"
                                      :modelValue="formatDate(pedido.dtemissao)"
                                      v-model="pedido.dtemissao"
                                      :dateFormat="'dd/mm/yy'"
                                      :touchUI="true">
                            </Calendar>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Data Faturamento</h6>
                            <Calendar :showIcon="false"
                                      :showButtonBar="false"
                                      :modelValue="formatDate(pedido.dtfatura)"
                                      v-model="pedido.dtfatura"
                                      :dateFormat="'dd/mm/yy'"
                                      :touchUI="true">
                            </Calendar>
                        </div>
                    </div>
                </div>

                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Data Entrega</h6>
                            <Calendar :showIcon="false"
                                      :showButtonBar="false"
                                      :modelValue="formatDate(pedido.dtentrega)"
                                      v-model="pedido.dtentrega"
                                      :dateFormat="'dd/mm/yy'"
                                      :touchUI="true">
                            </Calendar>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Número Fatura</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-file-o" />
                                <InputText id="numfatura" type="text" :disabled="true" v-model="pedido.numfatura"/>
                            </span>
                        </div>
                    </div>
                </div>


                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Representante</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-user" />
                                <InputText id="representante" type="text" :disabled="true" v-model="pedido.repres"/>
                            </span>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Ordem de Compra</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-file-o" />
                                <InputText id="ordemcompra" type="text" v-model="pedido.ordemcompra"/>
                            </span>
                        </div>
                    </div>
                </div>


                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">Observações</h6>
                                <Textarea placeholder="observações pedido" :autoResize="true" rows="3" cols="60" v-model="pedido.obs"/>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <div class="p-col-12 p-md-12">
            <div class="card">
                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Criado em</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-calendar" />
                                <InputText id="created_at" type="text" :disabled="true" :modelValue="formatDateTime(pedido.created_at)"/>
                            </span>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Usuário</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-user" />
                                <InputText id="created_by" type="text" :disabled="true" :modelValue="pedido.created_by" />
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Peso</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-download" />
                                <InputText id="peso" type="text" :disabled="true" :modelValue="pedido.peso" />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Valor</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-money-bill" />
                                <InputText id="valor" type="text" :disabled="true" :modelValue="pedido.valor" />
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-col-12 p-md-12">
            <div class="card">
                <Toast />
                <Toolbar class="p-mb-4">

                    <template v-slot:left>
                        <h5 class="p-m-0">Produtos</h5>
                    </template>
                    <template v-slot:right v-if="pedido.status == 'A'">
                        <Button label="Novo Produto" icon="pi pi-plus-circle" class="p-button-info" @click="novoProduto" />
                    </template>

                </Toolbar>

                <DataTable
                    ref="dtitens"
                    :value="pedidoitens"
                    dataKey="itenstable"
                    :loading="loadingTable"
                    responsiveLayout="scroll"
                >
                    <Column header="Imagem">
                        <template #body="slotProps">
                            <span class="p-column-title">Imagem</span>
                            <img src="../../../public/images/product/bamboo-watch.jpg" :alt="slotProps.data.image" class="produto-image" />
                        </template>
                    </Column>
                    <Column field="code" header="Código">
                        <template #body="slotProps">
                            <span class="p-column-title">Código</span>
                            {{ slotProps.data.produto }}
                        </template>
                    </Column>
                    <Column field="descricao" header="Descrição">
                        <template #body="slotProps">
                            <span class="p-column-title">Descrição</span>
                            {{ slotProps.data.descprod }}
                        </template>
                    </Column>
                    <Column field="quantidade" header="Quantidade">
                        <template #body="slotProps">
                            <span class="p-column-title">Quantidade</span>
                            {{ formatDecimal(slotProps.data.quant) }}
                        </template>
                    </Column>
                    <Column field="vlrunit" header="Valor Unit.">
                        <template #body="slotProps">
                            <span class="p-column-title">Valor Unit.</span>
                            {{ formatCurrency(slotProps.data.vlrunit) }}
                        </template>
                    </Column>
                    <Column field="vlrtotal" header="Valor total">
                        <template #body="slotProps">
                            <span class="p-column-title">Valor Total</span>
                            {{ formatCurrency(slotProps.data.vlrtotal) }}
                        </template>
                    </Column>
                    <Column>
                        <template #body="slotProps" v-if="pedido.status == 'A'">
                            <Button icon="pi pi-pencil" class="p-button-rounded p-button-success p-mr-2" @click="editPedidoItem(slotProps.data)" />
                            <Button icon="pi pi-trash" class="p-button-rounded p-button-danger" @click="confirmarDelete(slotProps.data)" />
                        </template>
                    </Column>
                </DataTable>

                <Dialog v-model:visible="editDialogItem" :style="{ width: '450px' }" header="Editar Item do Pedido" :modal="true" class="p-fluid">
                    <div class="p-field">
                        <label for="produto">Produto</label>

                        <AutoComplete
                            placeholder="Pesquisar produto"
                            id="produto"
                            :dropdown="true"
                            :multiple="false"
                            v-model="selectedAutoValueProduto"
                            :suggestions="autoFilteredValueProduto"
                            @complete="pesquisaProduto($event)"
                            @item-select="alteraProduto($event.value.codigo)"
                            field="descricao"
                            required="true"
                            :class="{ 'p-invalid': submittedPedidoItem && !selectedAutoValueProduto }"
                        >
                            <template #item="slotProps">
                                <div >
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td style="width: 5%;">
                                                <img :src="'/images/statuscliente/' + slotProps.item.status + '.png'"
                                                     height="25" width="25"/> </td>
                                            <td style="width: 10%;">{{slotProps.item.codigo}}</td>
                                            <td style="width: 50%; font-weight: bold">{{slotProps.item.descricao}}</td>
                                            <td style="width: 50%; font-weight: bold">{{slotProps.item.preco}}</td>
                                            <td style="width: 10%; font-weight: bold">{{slotProps.item.categoria}}</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </template>
                        </AutoComplete>
                        <small class="p-invalid" v-if="submittedPedidoItem && !selectedAutoValueProduto">Produto é obrigatório.</small>

                    </div>



                    <div class="p-formgrid p-grid">
                        <div class="p-field p-col">
                            <label for="vlrunit">Preço</label>
                            <InputNumber
                                id="vlrunit"
                                v-model="pedidoitem.vlrunit"
                                required="true"
                                :class="{ 'p-invalid': submittedPedidoItem && !pedidoitem.vlrunit }"
                                mode="currency"
                                currency="BRL"
                                locale="pt-BR"
                                @input="calculaTotalPedidoItem($event)">
                            </InputNumber>
                            <small class="p-invalid" v-if="submittedPedidoItem && !pedidoitem.vlrunit">Valor unitário deve ser maior que zero.</small>
                        </div>
                        <div class="p-field p-col">
                            <label for="quant">Quantidade</label>
                            <InputNumber
                                id="quant"
                                v-model="pedidoitem.quant"
                                required="true"
                                :class="{ 'p-invalid': submittedPedidoItem && !pedidoitem.quant }"
                                showButtons
                                mode="decimal"
                                @input="calculaTotalPedidoItemQuant($event)">
                                :min="0">
                            </InputNumber>
                            <small class="p-invalid" v-if="submittedPedidoItem && !pedidoitem.quant">Quantidade deve ser maior que zero.</small>
                        </div>
                    </div>
                    <div class="p-formgrid p-grid">
                        <div class="p-field p-col">
                            <label for="vlrtotal">Valor Total</label>
                            <InputNumber
                                id="vlrtotal"
                                v-model="pedidoitem.vlrtotal"
                                :disabled="true"
                                mode="currency"
                                currency="BRL"
                                locale="pt-BR">
                            </InputNumber>
                        </div>
                    </div>
                    <template #footer>
                        <Button label="Cancelar" icon="pi pi-times" class="p-button-text" @click="hideDialogPedidoItem" />
                        <Button label="Salvar" icon="pi pi-check" class="p-button-text" @click="salvarPedidoItem" />
                    </template>
                </Dialog>

                <Dialog v-model:visible="showDeleteDialog" :style="{ width: '450px' }" header="Excluir Item do Pedido" :modal="true">
                    <div class="confirmation-content">
                        <i class="pi pi-exclamation-triangle p-mr-3" style="font-size: 2rem" />
                        <span v-if="pedidoitem">Tem certeza de que deseja excluir <b>{{ pedidoitem.descprod }}</b> do pedido?</span>
                    </div>
                    <template #footer>
                        <Button label="Não" icon="pi pi-times" class="p-button-text" @click="showDeleteDialog = false" />
                        <Button label="Sim" icon="pi pi-check" class="p-button-text" @click="deletarPedidoItem" />
                    </template>
                </Dialog>


                <Dialog v-model:visible="showCancelaDialog" :style="{ width: '450px' }" header="Cancelar Pedido" :modal="true">
                    <div class="confirmation-content">
                        <i class="pi pi-exclamation-triangle p-mr-3" style="font-size: 2rem" />
                        <span v-if="pedido">Tem certeza de que deseja cancelar o pedido <b>{{ pedido.id }}</b>?</span>
                    </div>
                    <template #footer>
                        <Button label="Não" icon="pi pi-times" class="p-button-text" @click="showCancelaDialog = false" />
                        <Button label="Sim" icon="pi pi-check" class="p-button-text" @click="cancelarPedido" />
                    </template>
                </Dialog>

                <Dialog v-model:visible="showConfirmaDialog" :style="{ width: '450px' }" header="Confirmar Pedido" :modal="true">
                    <div class="confirmation-content">
                        <i class="pi pi-exclamation-triangle p-mr-3" style="font-size: 2rem" />
                        <span v-if="pedido">Tem certeza de que deseja confirmar o pedido <b>{{ pedido.id }}</b>?</span>
                    </div>
                    <template #footer>
                        <Button label="Não" icon="pi pi-times" class="p-button-text" @click="showConfirmaDialog = false" />
                        <Button label="Sim" icon="pi pi-check" class="p-button-text" @click="confirmarPedido" />
                    </template>
                </Dialog>


            </div>
        </div>


        <div class="p-col-12">
            <div class="card toolbar-demo">
                <Toolbar>

                    <template v-slot:left>
                        <Button label="Timeline" icon="pi pi-sort-numeric-down" class="p-button-secondary"
                                @click="showBottomBar = true"
                                style="margin-right: .5em"
                        />
                    </template>
                    <template v-slot:right v-if="pedido.status == 'A'">
                        <Button label="Cancelar" icon="pi pi-trash" class="p-button-warning" style="margin-right: .5em" @click="showCancelaDialog = true"/>
                        <Button label="Salvar" icon="pi pi-save" class="p-button-secondary" style="margin-right: .5em" @click="salvarPedido"/>
                        <Button label="Confirmar" icon="pi pi-check" class="p-button-primary" style="margin-right: .5em" @click="showConfirmaDialog = true"/>
                    </template>
                    <template v-slot:right v-else>
                        <Button label="Plataforma" icon="pi pi-link" class="p-button-primary" style="margin-right: .5em; " @click="pedidoPlataforma"/>
                        <Button label="Nota Fiscal" icon="pi pi-file-pdf" class="p-button-secondary" style="margin-right: .5em; width:350px;" @click="baixarNota"/>
                        <Button label="Boleto" icon="pi pi-file-pdf" class="p-button-secondary" style="margin-right: .5em" @click="baixarBoleto"/>
                    </template>

                </Toolbar>
            </div>
        </div>


        <Sidebar v-model:visible="showBottomBar" :baseZIndex="1500" position="right" :modal="true" style="width:50%;">
            <PedidoTimeline/>
        </Sidebar>

    </div>
</template>
<script>

import _ from 'lodash';
import PedidosService from "./PedidosService";
import PedidoTimeline from "./PedidoTimeline";

export default {
    components:{
        PedidoTimeline
    },
    data() {
        return {
            loadingCliente: true,
            loadingTipoMov: true,
            loadingTipoFrete: true,
            loadingCondPgto: true,
            loadingFormaPgto: true,
            submittedPedidoItem: false,
            pedido: {},
            cliente: {},
            tipomov: {},
            tipofrete: {},
            condpgto: {},
            formapgto: {},
            pedidoitens: null,
            pedidoitem: {},
            produto: {},
            loadingTable: true,
            editDialogItem: false,
            showDeleteDialog: false,
            showConfirmaDialog: false,
            showCancelaDialog: false,
            deleteDialog: false,

            floatValue: null,

            autoValueCliente: null,
            selectedAutoValueCliente: null,
            autoFilteredValueCliente: [],
            autoValueTipoMov: null,
            selectedAutoValueTipoMov: null,
            autoFilteredValueTipoMov: [],
            autoValueCondPgto: null,
            selectedAutoValueCondPgto: null,
            autoFilteredValueCondPgto: [],
            autoValueFormaPgto: null,
            selectedAutoValueFormaPgto: null,
            autoFilteredValueFormaPgto: [],
            autoValueFrete: null,
            selectedAutoValueFrete: null,
            autoFilteredValueFrete: [],
            autoValueProduto: null,
            selectedAutoValueProduto: null,
            autoFilteredValueProduto: [],

            showBottomBar: false,

            calendarValue: null,
            inputNumberValue: null,
            chipsValue: null,
            sliderValue: 50,
            ratingValue: null,
            colorValue: '1976D2',
            radioValue: null,
            checkboxValue: [],
            switchValue: false,
            listboxValue: null,
            dropdownValue: null,
            multiselectValue: null,
            toggleValue: false,
            selectButtonValue1: null,
            selectButtonValue2: null,
            inputGroupValue: false,
            knobValue: 20
        }
    },

    service: null,

    created() {

    },
    mounted() {
        this.service = new PedidosService();
        this.getPedidoItens();
        this.getPedido();
        this.getClientes();
        this.getCondPgtos();
        this.getFormaPgtos();
        this.getFretes();
        this.getTipoMovs();
        this.getPedidoItens();
        this.getProdutos();
    },
    methods: {

        pedidoPlataforma(){
            window.open('https://mobagilefortlevsolartestes.ddns.net/login', '_blank');
        },

        baixarNota() {
            const idPed = this.$route.params.id;
            console.log('baixarNota: ' + idPed);
            this.service.downloadPdfNota().then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                let fname = 'nota_exemplo.pdf';
                link.href = url;
                link.setAttribute('download', fname);
                document.body.appendChild(link);
                link.click();
            });
        },

        baixarBoleto(){
            const idPed = this.$route.params.id;
            console.log('baixarBoleto: ' + idPed);
            this.service.downloadPdfBoleto().then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                let fname = 'boleto_exemplo.pdf';
                link.href = url;
                link.setAttribute('download', fname);
                document.body.appendChild(link);
                link.click();
            });
        },

        cancelarPedido(){
            this.service.cancelaPedido([this.pedido.id]).then((data) => {
                this.pedido = data;
                this.showCancelaDialog = false;
                this.$toast.add({ severity: 'success', summary: 'Successo', detail: 'Pedido cancelado com sucesso', life: 3000 });
            });
        },

        confirmarPedido(){
            this.service.confirmaPedido([this.pedido.id]).then((data) => {
                this.pedido = data;
                this.showConfirmaDialog = false;
                this.$toast.add({ severity: 'success', summary: 'Successo', detail: 'Pedido confirmado com sucesso', life: 3000 });
            });
        },

        converteTagStatus(status){
            switch (status) {
                case 'C':
                    return '#6666ff';
                case 'A':
                    return '#ffcc00';
                case 'X':
                    return '#ff0000';
                case 'F':
                    return '#008000';
            }
        },

        converteTextoStatus(status){
            switch (status) {
                case 'C':
                    return 'Confirmado';
                case 'A':
                    return 'Elaboração';
                case 'X':
                    return 'Cancelado';
                case 'F':
                    return 'Faturado';
            }
        },

        deletarPedidoItem(){
            this.service.deletePedidoItem([this.pedidoitem.id]).then((dataItem) => {
                this.pedidoitens = this.pedidoitens.filter((val) => val.id !== Number(this.pedidoitem.id));
                this.showDeleteDialog = false;
                this.pedidoitem = {};
                this.$toast.add({ severity: 'success', summary: 'Successo', detail: 'Produto Deletado com sucesso', life: 3000 });
            });
        },

        confirmarDelete(pedidoitem) {
            this.pedidoitem = pedidoitem;
            this.showDeleteDialog = true;
        },

        calculaTotalPedidoItem(event){
          this.pedidoitem.vlrtotal = event.value * this.pedidoitem.quant;
        },

        calculaTotalPedidoItemQuant(event){
            this.pedidoitem.vlrtotal = event.value * this.pedidoitem.vlrunit;
        },

        salvarPedidoItem(){
            this.submittedPedidoItem = true;
            if (
                this.selectedAutoValueProduto &&
                this.pedidoitem.quant &&
                this.pedidoitem.vlrunit
            ) {
                this.pedidoitem.produto = this.produto.codigo;
                this.pedidoitem.pedido_id = this.pedido.id;

                this.service.updatePedidoItem(this.pedidoitem).then((data) => {
                    this.pedidoitem = data;
                    this.editDialogItem = false;
                    this.pedidoitem = {};
                    this.getPedidoItens();
                    this.$toast.add({
                        severity: 'success',
                        summary: 'Successo',
                        detail: 'Produto salvo com sucesso',
                        life: 3000
                    });
                });
            }
        },

        novoProduto(){
            this.pedidoitem = {};
            this.produto = {};
            this.selectedAutoValueProduto = null;
            this.editDialogItem = true;

        },

        hideDialogPedidoItem() {
            this.editDialogItem = false;
            this.submittedPedidoItem = false;
        },

        salvarPedido(){

            console.log('salvarPedido');
            this.pedido.cliente = this.cliente.codigo;
            this.pedido.tipo = this.tipomov.codigo;
            this.pedido.frete = this.tipofrete.codigo;
            this.pedido.condpgto = this.condpgto.codigo;
            this.pedido.formapgto = this.formapgto.codigo;

            //console.log(this.formapgto);

                this.service.updatePedido(this.pedido).then((data) => {
                    this.pedido = data;
                    this.$toast.add({ severity: 'success', summary: 'Successo', detail: 'Pedido salvo com sucesso', life: 3000 });
                });
        },

        editPedidoItem(pedidoitem) {
            this.service.editPedidoItem(pedidoitem.id).then((data) => {
                this.pedidoitem = data;

                console.log(data);

                this.selectedAutoValueProduto = data.descprod;
                this.editDialogItem = true;
            });
        },

        formatCurrency(value) {
            if (value) return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            return 0;
        },

        formatDecimal(value) {
            if (value) return value.toLocaleString('pt-BR');
            return 0;
        },

        getPedido() {
            const idPed = this.$route.params.id;
            console.log('getPedido: ' + idPed);
                this.service.getPedido(idPed).then((data) => {
                    this.pedido = data;

                    if (data != null && data.cliente != null && data.cliente != '') {
                        this.service.getCliente(data.cliente).then((dataCli) => {
                            if (dataCli != null) {
                                //console.log('dataCli');
                                //console.log(dataCli);
                                this.selectedAutoValueCliente = dataCli.nome;
                                this.cliente = dataCli;
                                this.loadingCliente = false;
                            }else{
                                this.loadingCliente = false;
                            }
                        });
                    }else{
                        this.loadingCliente = false;
                    }

                    if (data != null && data.tipo != null && data.tipo != '') {
                        this.service.getTipoMov(data.tipo).then((dataTpMov) => {
                            if (dataTpMov != null){
                                this.selectedAutoValueTipoMov = dataTpMov.descricao;
                                this.tipomov = dataTpMov;
                                this.loadingTipoMov = false;
                            }else{
                                this.loadingTipoMov = false;
                            }
                        });
                    }else{
                        this.loadingTipoMov = false;
                    }

                    if (data != null && data.frete != null && data.frete != '') {
                        this.service.getFrete(data.frete).then((dataTpFrete) => {
                            if (dataTpFrete != null){
                                this.selectedAutoValueFrete = dataTpFrete.descricao;
                                this.tipofrete = dataTpFrete;
                                this.loadingTipoFrete = false;
                            }else{
                                this.loadingTipoFrete = false;
                            }
                        });
                    }else{
                        this.loadingTipoFrete = false;
                    }

                    if (data != null && data.condpgto != null && data.condpgto != '') {
                        this.service.getCondPgto(data.condpgto).then((dataCond) => {
                            if (dataCond != null){
                                this.selectedAutoValueCondPgto = dataCond.descricao;
                                this.condpgto = dataCond;
                                this.loadingCondPgto = false;
                            }else{
                                this.loadingCondPgto = false;
                            }
                        });
                    }else{
                        this.loadingCondPgto = false;
                    }

                    if (data != null && data.formapgto != null && data.formapgto != '') {
                        this.service.getFormaPgto(data.formapgto).then((dataForma) => {
                            if (dataForma != null){
                                this.selectedAutoValueFormaPgto = dataForma.descricao;
                                this.formapgto = dataForma;
                                this.loadingFormaPgto = false;
                            }else{
                                this.loadingFormaPgto = false;
                            }
                        });
                    }else{
                        this.loadingFormaPgto = false;
                    }
                });
        },
        getPedidoItens() {
            this.loadingTable = true;
            const idPed = this.$route.params.id;

            this.service.getItensPedido(idPed).then((data) => {
                (this.pedidoitens = data);
                this.loadingTable = false;
            });
        },
        getFretes() {
            this.service.getFretes().then((data) => {
                this.autoValueFrete = data;
            });
        },
        getClientes() {
            this.service.getClientes().then((data) => {
                this.autoValueCliente = data;
            });
        },
        getTipoMovs() {
            this.service.getTipoMovs().then((data) => {
                this.autoValueTipoMov = data;
            });
        },
        getCondPgtos() {
            this.service.getCondPgtos().then((data) => {
                this.autoValueCondPgto = data;
            });
        },
        getFormaPgtos() {
            this.service.getFormaPgtos().then((data) => {
                this.autoValueFormaPgto = data;
            });
        },
        getProdutos() {
            this.service.getProdutos().then((data) => {
                this.autoValueProduto = data;
            });
        },

        alteraProduto(event){
            console.log('alteraProduto');
            console.log(event);
            this.service.getProduto(event).then((dataItem) => {
                this.produto = dataItem;
                this.pedidoitem.vlrunit = dataItem.preco;
            });
        },

        pesquisaProduto(event) {
            console.log('pesquisaProduto');

            if (!event.query.trim().length) {
                this.autoFilteredValueProduto = [...this.autoValueProduto];
            }
            else {
                this.autoFilteredValueProduto = this.autoValueProduto.filter((produto) => {
                    return produto.descricao.toLowerCase().includes(event.query.toLowerCase());
                });
            }
        },

        alteraCliente(event){
            console.log('alteraCliente');
            console.log(event);
            this.service.getCliente(event).then((dataCli) => {
                this.cliente = dataCli;
            });
        },

        pesquisaCliente(event) {
            console.log('pesquisaCliente');

                if (!event.query.trim().length) {
                    this.autoFilteredValueCliente = [...this.autoValueCliente];
                }
                else {
                    this.autoFilteredValueCliente = this.autoValueCliente.filter((cliente) => {
                        return cliente.nome.toLowerCase().includes(event.query.toLowerCase());
                    });
                }
        },

        alteraTipoMov(codigo){
            this.service.getTipoMov(codigo).then((data) => {
                this.tipomov = data;
            });
        },

        pesquisaTipoMov(event) {
            if (!event.query.trim().length) {
                this.autoFilteredValueTipoMov = [...this.autoValueTipoMov];
            }
            else {
                this.autoFilteredValueTipoMov = this.autoValueTipoMov.filter((tipomov) => {
                    return tipomov.descricao.toLowerCase().includes(event.query.toLowerCase());
                });
            }
        },

        alteraTipoFrete(codigo){
            this.service.getFrete(codigo).then((data) => {
                this.tipofrete = data;
            });
        },

        pesquisaFrete(event) {
            if (!event.query.trim().length) {
                this.autoFilteredValueFrete = [...this.autoValueFrete];
            }
            else {
                this.autoFilteredValueFrete = this.autoValueFrete.filter((frete) => {
                    return frete.descricao.toLowerCase().includes(event.query.toLowerCase());
                });
            }
        },

        alteraCondPgto(codigo){
            this.service.getCondPgto(codigo).then((data) => {
                this.condpgto = data;
                console.log(this.condpgto);
            });
        },

        pesquisaCondPgto(event) {
            if (!event.query.trim().length) {
                this.autoFilteredValueCondPgto = [...this.autoValueCondPgto];
            }
            else {
                this.autoFilteredValueCondPgto = this.autoValueCondPgto.filter((condpgto) => {
                    return condpgto.descricao.toLowerCase().includes(event.query.toLowerCase());
                });
            }
        },

        alteraFormaPgto(codigo){
            this.service.getFormaPgto(codigo).then((data) => {
                this.formapgto = data;
                console.log(this.formapgto);

            });
        },

        pesquisaFormaPgto(event) {
            if (!event.query.trim().length) {
                this.autoFilteredValueFormaPgto = [...this.autoValueFormaPgto];
            }
            else {
                this.autoFilteredValueFormaPgto = this.autoValueFormaPgto.filter((formapgto) => {
                    return formapgto.descricao.toLowerCase().includes(event.query.toLowerCase());
                });
            }
        },
        formatDate(value) {
            return new Date(value).toLocaleDateString('pt-BR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
            });
        },
        formatDateTime(value) {
            //console.log('formatDateTime');
            return new Date(value).toLocaleString('pt-BR');
        },
    }
}
</script>

<style scoped lang="scss">
::v-deep(.p-multiselect) {
    min-width: 15rem;
}
::v-deep(.multiselect-custom-virtual-scroll .p-multiselect) {
    min-width: 20rem;
}
::v-deep(.multiselect-custom .p-multiselect-label) {
    padding-top: .25rem;
    padding-bottom: .25rem;
}
::v-deep(.multiselect-custom .country-item.country-item-value) {
    padding: .25rem .5rem;
    border-radius: 3px;
    display: inline-flex;
    margin-right: .5rem;
    background-color: var(--primary-color);
    color: var(--primary-color-text);
}
::v-deep(.multiselect-custom .country-item.country-item-value img.flag) {
    width: 17px;
}
::v-deep(.multiselect-custom .country-item) {
    display: flex;
    align-items: center;
}
::v-deep(.multiselect-custom .country-item img.flag) {
    width: 18px;
    margin-right: .5rem;
}
::v-deep(.multiselect-custom .country-placeholder) {
    padding: 0.25rem;
}
.produto-image {
    width: 100px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.center-div {
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

</style>
