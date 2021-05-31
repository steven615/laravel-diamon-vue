<template>
    <div class="layout-dashboard">
        <div class="p-grid">
            <div class="p-col-12 p-md-6 p-xl-3">
                <div class="card no-gutter widget-overview-box widget-overview-box-1">
                    <span class="overview-icon">
                        <i class="pi pi-shopping-cart"></i>
                    </span>
                    <span class="overview-title">Conversão</span>
                    <div class="p-grid overview-detail">
                        <div class="p-col-6">
                            <div class="overview-number">640</div>
                            <div class="overview-subtext">Orçado</div>
                        </div>
                        <div class="p-col-6">
                            <div class="overview-number">1420</div>
                            <div class="overview-subtext">Realizado</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-col-12 p-md-6 p-xl-3">
                <div class="card no-gutter widget-overview-box widget-overview-box-2">
                    <span class="overview-icon">
                        <i class="pi pi-dollar"></i>
                    </span>
                    <span class="overview-title">Faturamento</span>
                    <div class="p-grid overview-detail">
                        <div class="p-col-6">
                            <div class="overview-number">5.800.200,10</div>
                            <div class="overview-subtext">Mês</div>
                        </div>
                        <div class="p-col-6">
                            <div class="overview-number">415.800,64</div>
                            <div class="overview-subtext">Semana</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-col-12 p-md-6 p-xl-3">
                <div class="card no-gutter widget-overview-box widget-overview-box-3">
                    <span class="overview-icon">
                        <i class="pi pi-users"></i>
                    </span>
                    <span class="overview-title">Clientes</span>
                    <div class="p-grid overview-detail">
                        <div class="p-col-6">
                            <div class="overview-number">1272</div>
                            <div class="overview-subtext">Positivados</div>
                        </div>
                        <div class="p-col-6">
                            <div class="overview-number">148</div>
                            <div class="overview-subtext">Sem Compras</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-col-12 p-md-6 p-xl-3">
                <div class="card no-gutter widget-overview-box widget-overview-box-4">
                    <span class="overview-icon">
                        <i class="pi pi-comment"></i>
                    </span>
                    <span class="overview-title">Chamados</span>
                    <div class="p-grid overview-detail">
                        <div class="p-col-6">
                            <div class="overview-number">2</div>
                            <div class="overview-subtext">Novos</div>
                        </div>
                        <div class="p-col-6">
                            <div class="overview-number">85</div>
                            <div class="overview-subtext">Atendidos</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-col-12 p-xl-6">
                <div class="card no-gutter orders">
                    <div class="card-header mt-4">
                        <h4>Índice de Conversão das Vendas</h4>
                        <Menu id="orders-button" :popup="true" :model="items" ref="menu" appendTo="body"></Menu>
                        <Button icon="pi pi-search" class="p-button-text p-button-secondary" @click="menuToggle($event)" aria-controls="orders-button" aria-haspopup="true"></Button>
                    </div>



                    <div class="p-grid">
                        <div class="p-col-12 mt-4">
                            <div id="order-tabs-container" class="p-grid order-tabs">
                                <div class="order-tab order-tab-new p-col-6 p-md-3" @click="changeDataset($event); refreshDataset($event);"
                                     data-label="Pedidos Orçados" data-index="0" data-stroke="#BBDEFB" data-fill="rgba(100, 181, 246, 0.2)" >
                                    <i class="pi pi-plus-circle"></i>
                                    <span class="order-label">Orçado</span>
                                    <i class="stat-detail-icon icon-arrow-right-circle"></i>


                                    <img src="../../../public/images/dashboard/graph-new.svg" alt="diamond-vue" />
                                </div>
                                <div class="order-tab order-tab-completed p-col-6 p-md-3" @click="changeDataset($event); refreshDataset($event);"
                                     data-label="Pedidos Realizados" data-index="1" data-stroke="#C5CAE9" data-fill="rgba(121, 134, 203, 0.2)">
                                    <i class="pi pi-check-circle"></i>
                                    <span class="order-label">Realizado</span>
                                    <i class="stat-detail-icon icon-arrow-right-circle"></i>
                                    <img src="../../../public/images/dashboard/graph-completed.svg" alt="diamond-vue" />
                                </div>
                                <div class="order-tab order-tab-refunded p-col-6 p-md-3" @click="changeDataset($event); refreshDataset($event);"
                                     data-label="Pedidos Faturados" data-index="2" data-stroke="#B2DFDB" data-fill="rgba(224, 242, 241, 0.5)">
                                    <i class="pi pi-refresh"></i>
                                    <span class="order-label">Faturado</span>
                                    <i class="stat-detail-icon icon-arrow-right-circle"></i>
                                    <img src="../../../public/images/dashboard/graph-refunded.svg" alt="diamond-vue" />
                                </div>
                                <div class="order-tab order-tab-cancelled p-col-6 p-md-3" @click="changeDataset($event);  refreshDataset($event);"
                                     data-label="Pedidos Cancelados" data-index="3" data-stroke="#B2EBF2" data-fill="rgba(224, 247, 250, 0.5)">
                                    <i class="pi pi-times-circle"></i>
                                    <span class="order-label">Cancelado</span>
                                    <i class="stat-detail-icon icon-arrow-right-circle"></i>
                                    <img src="../../../public/images/dashboard/graph-cancelled.svg" alt="diamond-vue" />
                                </div>
                            </div>
                        </div>
                        <div class="p-col-12">
                            <div class="overview-chart">
                                <Chart ref="chart" type="line" :data="ordersChart" :options="ordersChartOptions" id="order-chart"></Chart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-col-12 p-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Top 10 Clientes</h4>
                        <Dropdown :options="orderWeek" v-model="selectedOrderWeek" optionLabel="name" @change="recentSales($event)" class="dashbard-demo-dropdown"></Dropdown>
                    </div>

                    <p>Sua atividade de vendas ao longo do tempo.</p>

                    <DataTable
                        :value="pedidostop10"
                        :paginator="true"
                        :rows="5"
                        :loading="loadingPedidos"
                        responsiveLayout="scroll">
                        <Column field="cliente" header="Código" :sortable="true">
                            <template #body="slotProps">
                                <span class="p-column-title">Código</span>
                                {{slotProps.data.cliente}}
                            </template>
                        </Column>
                        <Column field="category" header="Razão" :sortable="true">
                            <template #body="slotProps">
                                <span class="p-column-title">Razão</span>
                                {{slotProps.data.nome}}
                            </template>
                        </Column>
                        <Column field="price" header="Valor" :sortable="true">
                            <template #body="slotProps">
                                <span class="p-column-title">Preço</span>
                                {{ formatDecimal(slotProps.data.valor) }}
                            </template>
                        </Column>

                        <Column>
                            <template #body="slotProps">
                                <router-link :to="{ name: 'clientes'}"  class="logo">
                                    <Button icon="pi pi-search" class="p-button-rounded p-mr-2"  />
                                </router-link>
                            </template>
                        </Column>
<!--                        -->
<!--                        <Column bodyStyle="text-align: center">-->
<!--                            <router-link :to="{ name: 'clientes'}"  class="logo">-->
<!--                                <Button type="button" icon="pi pi-search"></Button>-->
<!--                            </router-link>-->
<!--                        </Column>-->
                    </DataTable>
                </div>
            </div>

            <div class="p-col-12 p-lg-4">
                <div class="card widget-tasks">
                    <h4>Indicadores</h4>
                    <p>Visão geral sobre os principais números.</p>
                    <div>
                        <div class="task task-1">
                            <div class="task-name"><span>12 Clientes</span> orçando e não comprando</div>
                            <div class="task-progress">
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h4>Mais vendidos</h4>
                    <p>Produtos mais populares de sua coleção.</p>

                    <ul class="widget-image-list">
                        <li>
                            <span>Produto</span>
                            <span>Volume</span>
                        </li>
                        <li>
                            <span>
                                <img src="../../../public/images/bamboo-watch.jpg" alt="diamond-layout" />
                                <span>Produto Teste 1</span>
                            </span>
                            <span class="listitem-value">802</span>
                        </li>
                        <li>
                            <span>
                                <img src="../../../public/images/product/blue-band.jpg" alt="diamond-layout" />
                                <span>Produto Teste 2</span>
                            </span>
                            <span class="listitem-value">751</span>
                        </li>
                        <li>
                            <span>
                                <img src="../../../public/images/product/game-controller.jpg" alt="diamond-layout" />
                                <span>Produto Teste 3</span>
                            </span>
                            <span class="listitem-value">640</span>
                        </li>
                        <li>
                            <span>
                                <img src="../../../public/images/product/lime-band.jpg" alt="diamond-layout" />
                                <span>Produto Teste 4</span>
                            </span>
                            <span class="listitem-value">620</span>
                        </li>
                        <li>
                            <span>
                                <img src="../../../public/images/product/gold-phone-case.jpg" alt="diamond-layout" />
                                <span>Produto Teste 5</span>
                            </span>
                            <span class="listitem-value">505</span>
                        </li>
                        <li>
                            <span>
                                <img src="../../../public/images/product/green-t-shirt.jpg" alt="diamond-layout" />
                                <span>Produto Teste 6</span>
                            </span>
                            <span class="listitem-value">448</span>
                        </li>
                        <li>
                            <span>
                                <img src="../../../public/images/product/purple-t-shirt.jpg" alt="diamond-layout" />
                                <span>Produto Teste 7</span>
                            </span>
                            <span class="listitem-value">32</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="p-col-12 p-lg-8">
                <div class="card revenue">
                    <h4>Receita por Região</h4>
                    <p>Comparação de suas fontes de receita.</p>
                    <div class="revenue-chart-container">
                        <Chart type="pie" id="revenue-chart" :data="revenueChart"></Chart>
                    </div>
                </div>

                <div class="card">
                    <h4>Mapa de Calor (Orçado x Realizado)</h4>
                    <div >
                        <GMapMap
                            :center="center"
                            :zoom="3.5"
                            map-type-id="terrain"
                            style="width: 100%; height: 300px"
                        >
                            <GMapCluster>
                                <GMapMarker
                                    :key="index"
                                    v-for="(m, index) in markers"
                                    :position="m.position"
                                    :clickable="true"
                                    :draggable="true"
                                    @click="center=m.position"
                                />
                            </GMapCluster>
                        </GMapMap>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import DashboardService from './DashBoardService';

export default {
    components: {
    },
    data() {
        return {
            center: {lat: -15.533773, lng: -55.625290},
            markers: [
                {
                    position: {lat: -15.533773, lng: -55.625290},
                }
                , // Along list of clusters
            ],

            pedidostop10: null,

            loadingPedidos: true,
            selectedOrderWeek: null,
            products: null,
            productsThisWeek: null,
            productsLastWeek: null,
            dashboardService: null,
            cols: [
                { field: 'vin', header: 'Vin' },
                { field: 'year', header: 'Year' },
                { field: 'brand', header: 'Brand' },
                { field: 'color', header: 'Color' },
            ],

            items: [
                {
                    label: 'Exibição de Dados',
                    items: [
                        { label: 'Valor', icon: 'pi pi-money-bill' },
                        { label: 'Potência', icon: 'pi pi-power-off' },
                        { label: 'Quantidade de Propostas', icon: 'pi pi-tags' },
                    ],
                },
            ],

            ordersChart: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho'],
                datasets: [
                    {
                        label: 'Pedidos Orçados',
                        data: [2, 7, 20, 9, 16, 9, 5],
                        backgroundColor: ['rgba(100, 181, 246, 0.2)'],
                        borderColor: ['#64B5F6'],
                        borderWidth: 3,
                        fill: true,
                    },
                ],
            },

            ordersChartOptions: {
                legend: {
                    display: true,
                },
                responsive: true,
                hover: {
                    mode: 'index',
                },
                scales: {
                    yAxes: [
                        {
                            ticks: { min: 0, max: 20},
                        },
                    ],
                },
            },

            orderWeek: [
                { name: 'Semana', code: '0' },
                { name: 'Trimestre', code: '1' },
                { name: 'Ano', code: '2' },
            ],

            revenueChart: {
                labels: ['ES', 'RJ', 'SP'],
                datasets: [
                    {
                        data: [40, 35, 25],
                        backgroundColor: ['#64B5F6', '#7986CB', '#4DB6AC'],
                    },
                ],
            }
        };
    },
    created() {
        this.dashboardService = new DashboardService();
    },
    mounted() {


        this.dashboardService.getPedidosTop10().then((data) => {
            this.pedidostop10 = data;
            this.loadingPedidos = false;
            //console.log('getPedidosTop10');
            //console.log(data);
        });


        this.dashboardService.getProducts().then((data) => {
            this.products = data;
            this.loadingPedidos = false;
            //console.log('getProducts');
            //console.log(data);
        });
        this.dashboardService.getProducts().then((data) => (this.productsThisWeek = data));
        this.dashboardService.getProductsMixed().then((data) => (this.productsLastWeek = data));

        this.selectedOrderWeek = this.orderWeek[0];

        //console.log('montou');


    },
    methods: {
        formatDecimal(value) {
            if (value){
                var formatter = new Intl.NumberFormat('pt-BR', {
                    style: 'decimal',
                    minimumFractionDigits: 2,
                    currency: 'BRL',
                });
                return formatter.format(value);
            }
            return 0;
        },

        changeDataset(event) {
            const dataSet = [
                [2, 7, 20, 9, 16, 9, 5],
                [2, 4, 9, 20, 16, 12, 20],
                [2, 17, 7, 15, 4, 20, 8],
                [2, 2, 20, 4, 17, 16, 20],
            ];

            this.ordersChart.datasets[0].data = dataSet[parseInt(event.currentTarget.getAttribute('data-index'))];
            this.ordersChart.datasets[0].label = event.currentTarget.getAttribute('data-label');
            this.ordersChart.datasets[0].borderColor = event.currentTarget.getAttribute('data-stroke');
            this.ordersChart.datasets[0].backgroundColor = event.currentTarget.getAttribute('data-fill');
        },

        recentSales($event) {
            if ($event.value.code === '0') {
                this.products = this.productsThisWeek;
            } else {
                this.products = this.productsLastWeek;
            }
        },

        shuffle() {
            for (let i = this.products.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [this.products[i], this.products[j]] = [this.products[j], this.products[i]];
            }
            return this.products;
        },

        menuToggle($event) {
            this.$refs.menu.toggle($event);
        },

        refreshDataset($event) {
            this.$refs.chart.refresh($event);
        },

        formatCurrency(value) {
            return value.toLocaleString('en-US', {
                style: 'currency',
                currency: 'USD',
            });
        },
    },
};
</script>


<style lang="scss" scoped>
.layout-dashboard {
    .orders {
        h4 {
            margin-bottom: 20px;
        }

        .p-button {
            margin-top: -20px;
        }

        .order-tabs {
            margin-bottom: 1rem;

            .order-tab {
                padding: 1rem 2rem 2rem 1rem;
                position: relative;
                transition: box-shadow 0.2s;

                &:hover {
                    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.15);
                    cursor: pointer;
                }

                i {
                    font-size: 1rem;
                    vertical-align: middle;
                }

                .order-label {
                    margin-left: 0.25rem;
                    vertical-align: middle;
                }

                .stat-detail-icon {
                    position: absolute;
                    right: 1rem;
                    top: 2.25rem;
                    height: 1rem;
                    width: 1rem;
                }

                img {
                    position: absolute;
                    bottom: 0;
                    left: 5%;
                    width: 90%;
                }
            }
        }
    }

    .overview-chart {
        overflow: auto;
    }

    .dashbard-demo-dropdown {
        min-width: 8rem;
        margin-left: auto;
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
}
</style>
