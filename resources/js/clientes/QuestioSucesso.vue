<template>
    <div class="p-grid p-fluid">
        <div class="p-col-12 p-md-12">


            <div class="p-col-12 p-md-12">
                <div class="card">
                    <div class="p-col-12" style="text-align: right">
                        <span :class="'pedido-badge status-a'">Efetivado</span>
                    </div>

                    <div class="p-col-12">
                        <div class="p-grid p-formgrid">
                            <div class="p-col-12 p-md-6">
                                <h6 class="p-mb-0">ID</h6>
                                <span class="p-input-icon-left">
                                <i class="pi pi-key" />
                                <InputText id="id" type="text" />
                            </span>
                            </div>

                            <div class="p-col-12 p-md-6">
                                <h6 class="p-mb-0">Código</h6>
                                <span class="p-input-icon-left">
                                <i class="pi pi-key" />
                                <InputText id="codigo" type="text" />
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

<!--                                    <Skeleton v-if="loadingCliente" class="p-mb-2" width="100%" borderRadius="16px"></Skeleton>-->

                                    <AutoComplete

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

                                    </AutoComplete>
                                </div>
                            </div>
                        </div>

                        <div class="p-col-12">
                            <div class="p-grid p-formgrid">
                                <div class="p-col-12 p-md-6">
                                    <h6 class="p-mb-0">Principal Distribuidor</h6>
                                    <AutoComplete
                                        placeholder="Pesquisar distribuidor"

                                        :dropdown="true"
                                        :multiple="false"
                                        field="nome"
                                    >
                                    </AutoComplete>
                                </div>

                                <div class="p-col-12 p-md-6">
                                    <h6 class="p-mb-0">Trabalha com mais algum Distribuidor</h6>
                                    <AutoComplete
                                        placeholder="Pesquisar distribuidor"

                                        :dropdown="true"
                                        :multiple="false"
                                        field="nome"
                                    >
                                    </AutoComplete>
                                </div>
                            </div>
                        </div>

                        <div class="p-col-12">
                            <div class="p-grid p-formgrid">
                                <div class="p-col-12 p-md-4">
                                    <h6 class="p-mb-0">Ticket Médio Valor</h6>
                                    <span class="p-input-icon-left">
                                        <i class="pi pi-money-bill" />
                                        <InputText type="text" />
                                    </span>
                                </div>

                                <div class="p-col-12 p-md-4">
                                    <h6 class="p-mb-0">Ticket Médio Potência</h6>
                                    <span class="p-input-icon-left">
                                        <i class="pi pi-power-off" />
                                        <InputText type="text" />
                                    </span>
                                </div>

                                <div class="p-col-12 p-md-4">
                                    <h6 class="p-mb-0">Número de Instalações</h6>
                                    <span class="p-input-icon-left">
                                        <i class="pi pi-chart-bar" />
                                        <InputText type="text" />
                                    </span>
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
                            <h6 class="p-mb-0">Raio de Atuação</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-external-link" />
                                <InputText type="text"  />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Número de Representantes</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-user" />
                                <InputText id="ordemcompra" type="text" />
                            </span>
                        </div>

                    </div>
                </div>

                <div class="p-col-12">
                    <div class="p-grid p-formgrid">

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Principal Banco para Financiamento</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-credit-card" />
                                <InputText type="text"  />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Potência KwP de seu maior sistema?</h6>
                            <span class="p-input-icon-left">
                                        <i class="pi pi-power-off" />
                                        <InputText type="text" />
                                    </span>
                        </div>


                    </div>
                </div>


                <div class="p-col-12 p-mt-3">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">Realiza</h6>
                            <SelectButton v-model="selectButtonValue2" :options="selectButtonValues2" optionLabel="name" :multiple="true"/>
                        </div>
                    </div>
                </div>

                <div class="p-col-12 p-mt-2">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">Descrição Local Estrutura Física</h6>
                            <Textarea placeholder="Descrição Local Estrutura Física" :autoResize="true" rows="2" cols="60"/>
                        </div>
                    </div>
                </div>

                <div class="p-col-12 p-mt-2">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">Observações</h6>
                            <Textarea placeholder="observações" :autoResize="true" rows="3" cols="60"/>
                        </div>
                    </div>
                </div>


                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-4">
                            <h6 class="p-mb-0">Possui Pós Venda?</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-money-bill" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-4">
                            <h6 class="p-mb-0">Valoriza Qualidade do Produto?</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-power-off" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-41">
                            <h6 class="p-mb-0">Valoriza Resposta Rápida de Garantia?</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-power-off" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-col-12 p-mt-3">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">Tipo de Pós Venda</h6>
                            <SelectButton v-model="selectButtonValue3" :options="selectButtonValues3" optionLabel="name" :multiple="true"/>
                        </div>
                    </div>
                </div>


                <div class="p-col-12 p-mt-3">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">Nicho de Mercado Residencial</h6>
                            <SelectButton v-model="selectButtonValue4" :options="selectButtonValues4" optionLabel="name" :multiple="true"/>
                        </div>
                    </div>
                </div>

                <div class="p-col-12 p-mt-3">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">Nicho de Mercado Comercial</h6>
                            <SelectButton v-model="selectButtonValue5" :options="selectButtonValues5" optionLabel="name" :multiple="true"/>
                        </div>
                    </div>
                </div>

                <div class="p-col-12 p-mt-3">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">Nicho de Mercado Industrial</h6>
                            <SelectButton v-model="selectButtonValue6" :options="selectButtonValues6" optionLabel="name" :multiple="true"/>
                        </div>
                    </div>
                </div>

                <div class="p-col-12 p-mt-3">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">Nicho de Mercado Agro Negócio</h6>
                            <SelectButton v-model="selectButtonValue7" :options="selectButtonValues7" optionLabel="name" :multiple="true"/>
                        </div>
                    </div>
                </div>

                <div class="p-col-12 p-mt-3">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">Nicho de Mercado Governo</h6>
                            <SelectButton v-model="selectButtonValue8" :options="selectButtonValues8" optionLabel="name" :multiple="true"/>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <div class="p-col-12 p-md-12">
            <div class="card">

                <div class="p-col-12">
                    <h6 class="p-mb-0">Quais os tipos de estrutura que mais utiliza?</h6>
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-mb-12 p-lg-12 p-mb-lg-12">

                            <MultiSelect v-model="multiselectValue" :options="multiselectValues" optionLabel="name" placeholder="Select Countries" class="multiselect-custom">
                                <template #value="slotProps">
                                    <div class="country-item country-item-value" v-for="option of slotProps.value" :key="option.code">
                                        <div>{{option.name}}</div>
                                    </div>
                                    <template >
                                        <div class="country-placeholder">
                                            Selecionar tipos de estrutura
                                        </div>
                                    </template>
                                </template>
                                <template #option="slotProps">
                                    <div class="country-item">
                                        <div>{{slotProps.option.name}}</div>
                                    </div>
                                </template>
                            </MultiSelect>

                        </div>
                    </div>
                </div>


                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Possui engenheiro em seu quadro técnico?</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-money-bill" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Engenheiro possui registro no CREA?</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-power-off" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Possui equipe própria de instalação?</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-money-bill" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-3">
                            <h6 class="p-mb-0">Possui NR10</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-power-off" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-3">
                            <h6 class="p-mb-0">Possui NR15</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-power-off" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>
                    </div>
                </div>



                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Possui software para monitoramento de usina?</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-money-bill" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Trabalha com alguma tecnologia MLPE?</h6><small>Module Level Power Electronics</small>
                            <span class="p-input-icon-left">
                                <i class="pi pi-power-off" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>
                    </div>
                </div>


                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Trabalha com alguma tecnologia de bombeamento solar?</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-money-bill" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Pretendo trabalhar com alguma tecnologia de bombeamento solar</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-power-off" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>
                    </div>
                </div>



                <div class="p-col-12">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Trabalha com alguma plataforma para comprar equipamentos?</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-money-bill" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Tem interesse em receber nossa Newsletter?</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-power-off" />
                                <InputSwitch v-model="switchValue" />
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="p-col-12 p-md-12">
            <div class="card">

                <div class="p-col-12 p-mt-2">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">O que você acha que falta em um distribuidor de energia eletrovoltáica?</h6>
                            <Textarea placeholder="" :autoResize="true" rows="3" cols="60"/>
                        </div>
                    </div>
                </div>

                <div class="p-col-12 p-mt-2">
                    <div class="p-grid p-formgrid">
                        <div class="p-col-12 p-md-12">
                            <h6 class="p-mb-0">Qual sua principal dificuldade no mercado?</h6>
                            <Textarea placeholder="" :autoResize="true" rows="3" cols="60"/>
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
                                <InputText id="created_at" type="text" />
                            </span>
                        </div>

                        <div class="p-col-12 p-md-6">
                            <h6 class="p-mb-0">Usuário</h6>
                            <span class="p-input-icon-left">
                                <i class="pi pi-user" />
                                <InputText id="created_by" type="text" />
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
                        <h5 class="p-m-0">Anexos</h5>
                    </template>
                    <template v-slot:right>
                        <Button label="Novo Anexo" icon="pi pi-plus-circle" class="p-button-info"/>
                    </template>

                </Toolbar>

                <DataTable
                    ref="dtitens"
                    dataKey="itenstable"
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
                        <template #body="slotProps" >
                            <Button icon="pi pi-pencil" class="p-button-rounded p-button-success p-mr-2" @click="editPedidoItem(slotProps.data)" />
                            <Button icon="pi pi-trash" class="p-button-rounded p-button-danger" @click="confirmarDelete(slotProps.data)" />
                        </template>
                    </Column>
                </DataTable>


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
                    <template v-slot:right >
                        <Button label="Cancelar" icon="pi pi-trash" class="p-button-warning" style="margin-right: .5em" @click="showCancelaDialog = true"/>
                        <Button label="Salvar" icon="pi pi-save" class="p-button-secondary" style="margin-right: .5em" />
                        <Button label="Confirmar" icon="pi pi-check" class="p-button-primary" style="margin-right: .5em" @click="showConfirmaDialog = true"/>
                    </template>


                </Toolbar>
            </div>
        </div>


        <Sidebar v-model:visible="showBottomBar" :baseZIndex="1500" position="right" :modal="true" style="width:50%;">
            <QuestioSucessoTimeLine/>
        </Sidebar>

    </div>
</template>
<script>

import _ from 'lodash';
import ClientesService from './ClientesService';
import QuestioSucessoTimeLine from './QuestioSucessoTimeLine';

export default {
    components:{
        QuestioSucessoTimeLine
    },
    data() {
        return {
            loadingCliente: true,
            autoValueCliente: null,
            selectedAutoValueCliente: null,
            autoFilteredValueCliente: [],

            multiselectValue: null,
            multiselectValues: [
                {name: 'Fibrocimento', code: 'FBC'},
                {name: 'Metálica', code: 'MTL'},
                {name: 'Colonial', code: 'CLN'},
                {name: 'Calhetão', code: 'CLT'},
                {name: 'Solo', code: 'SOL'},
                {name: 'Tracker', code: 'TRK'}
            ],

            selectButtonValues2: [
                {name: 'Projeto', code: 'P'},
                {name: 'Instalação', code: 'I'},
                {name: 'Venda', code: 'V'},
            ],
            selectButtonValue2: null,

            selectButtonValues3: [
                {name: 'Manutenção Corretiva', code: 'MC'},
                {name: 'Manutenção Preventiva', code: 'MP'},
                {name: 'Gestão de Usina', code: 'GU'},
            ],
            selectButtonValue3: null,

            selectButtonValues4: [
                {name: 'Pqueno', code: 'P'},
                {name: 'Médio', code: 'M'},
                {name: 'Grande', code: 'G'},
            ],
            selectButtonValue4: null,

            selectButtonValues5: [
                {name: 'Pqueno', code: 'P'},
                {name: 'Médio', code: 'M'},
                {name: 'Grande', code: 'G'},
            ],
            selectButtonValue5: null,

            selectButtonValues6: [
                {name: 'Pqueno', code: 'P'},
                {name: 'Médio', code: 'M'},
                {name: 'Grande', code: 'G'},
            ],
            selectButtonValue6: null,

            selectButtonValues7: [
                {name: 'Pqueno', code: 'P'},
                {name: 'Médio', code: 'M'},
                {name: 'Grande', code: 'G'},
            ],
            selectButtonValue7: null,

            selectButtonValues8: [
                {name: 'Municipal', code: 'M'},
                {name: 'Estadual', code: 'E'},
                {name: 'Federal', code: 'F'},
            ],
            selectButtonValue8: null,

            inputGroupValue: false,
            switchValue: false,

            showBottomBar: false,
        }
    },

    service: null,

    created() {

    },
    mounted() {
        this.service = new ClientesService();
        this.autoValueTiposEstrutura = [
          'UM','DOIS'
        ];
    },
    methods: {


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
