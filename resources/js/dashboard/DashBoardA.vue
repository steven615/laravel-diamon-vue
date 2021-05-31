<template>
    <div class="layout-dashboard">
        <div class="p-grid">
            <div class="p-col-12 p-md-6 p-xl-3">
                <div class="card no-gutter widget-overview-box widget-overview-box-1">
                    <span class="overview-icon">
                        <i class="pi pi-shopping-cart"></i>
                    </span>
                    <span class="overview-title">Pedidos</span>
                    <div class="p-grid overview-detail">
                        <div class="p-col-6">
                            <div class="overview-number">640</div>
                            <div class="overview-subtext">Pendente</div>
                        </div>
                        <div class="p-col-6">
                            <div class="overview-number">1420</div>
                            <div class="overview-subtext">Faturado</div>
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
                            <div class="overview-number">8272</div>
                            <div class="overview-subtext">Ativos</div>
                        </div>
                        <div class="p-col-6">
                            <div class="overview-number">148</div>
                            <div class="overview-subtext">Novos</div>
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
                        <h4>Pedidos</h4>
                        <Menu id="orders-button" :popup="true" :model="items" ref="menu" appendTo="body"></Menu>
                        <Button icon="pi pi-search" class="p-button-text p-button-secondary" @click="menuToggle($event)" aria-controls="orders-button" aria-haspopup="true"></Button>
                    </div>



                    <div class="p-grid">
                        <div class="p-col-12 mt-4">
                            <div id="order-tabs-container" class="p-grid order-tabs">
                                <div class="order-tab order-tab-new p-col-6 p-md-3" @click="changeDataset($event); refreshDataset($event);"
                                     data-label="Pedidos em Elaboração" data-index="0" data-stroke="#BBDEFB" data-fill="rgba(100, 181, 246, 0.2)" >
                                    <i class="pi pi-plus-circle"></i>
                                    <span class="order-label">Elaboração</span>
                                    <i class="stat-detail-icon icon-arrow-right-circle"></i>


                                    <img src="../../../public/images/dashboard/graph-new.svg" alt="diamond-vue" />
                                </div>
                                <div class="order-tab order-tab-completed p-col-6 p-md-3" @click="changeDataset($event); refreshDataset($event);"
                                     data-label="Pedidos Confirmados" data-index="1" data-stroke="#C5CAE9" data-fill="rgba(121, 134, 203, 0.2)">
                                    <i class="pi pi-check-circle"></i>
                                    <span class="order-label">Confirmado</span>
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
                        <h4>Últimos Pedidos</h4>
                        <Dropdown :options="orderWeek" v-model="selectedOrderWeek" optionLabel="name" @change="recentSales($event)" class="dashbard-demo-dropdown"></Dropdown>
                    </div>

                    <p>Sua atividade de vendas ao longo do tempo.</p>

                    <DataTable
                        :value="products"
                        :paginator="true"
                        :rows="5"
                        :loading="loadingPedidos"
                        responsiveLayout="scroll">
                        <Column field="id" header="ID" :sortable="true">
                            <template #body="slotProps">
                                <span class="p-column-title">Id</span>
                                {{slotProps.data.id}}
                            </template>
                        </Column>
                        <Column field="category" header="Categoria" :sortable="true">
                            <template #body="slotProps">
                                <span class="p-column-title">Categoria</span>
                                {{slotProps.data.categoria}}
                            </template>
                        </Column>
                        <Column field="price" header="Preço" :sortable="true">
                            <template #body="slotProps">
                                <span class="p-column-title">Preço</span>
                                {{ formatCurrency(slotProps.data.preco) }}
                            </template>
                        </Column>
                        <Column field="inventoryStatus" header="Status" :sortable="true">
                            <template #body="slotProps">
                                <span :class="'product-badge status-' + slotProps.data.status.toLowerCase()">{{ slotProps.data.status }}</span>
                            </template>
                        </Column>
                        <Column bodyStyle="text-align: center">
                            <template #body> <Button type="button" icon="pi pi-search"></Button></template
                            ></Column>
                    </DataTable>
                </div>
            </div>

            <div class="p-col-12 p-lg-4">
                <div class="card widget-tasks">
                    <h4>Chamados</h4>
                    <p>Visão geral sobre chamados.</p>
                    <div>
                        <div class="task task-1">
                            <div class="task-name"><span>12 Chamados</span> concluídos</div>
                            <div class="task-progress">
                                <div></div>
                            </div>
                        </div>
                        <div class="task task-2">
                            <div class="task-name"><span>2 Chamados</span> aguardando aprovação</div>
                            <div class="task-progress">
                                <div></div>
                            </div>
                        </div>
                        <div class="task task-3">
                            <div class="task-name"><span>3 Chamados</span> aguardando sua revisão</div>
                            <div class="task-progress">
                                <div></div>
                            </div>
                        </div>
                        <div class="task task-4">
                            <div class="task-name"><span>6 Chamados</span> cancelados</div>
                            <div class="task-progress">
                                <div></div>
                            </div>
                        </div>
                        <div class="task task-5">
                            <div class="task-name"><span>2 Chamados</span> em elaboração</div>
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
                    <h4>Fluxo de Receita</h4>
                    <p>Comparação de suas fontes de receita.</p>
                    <div class="revenue-chart-container">
                        <Chart type="pie" id="revenue-chart" :data="revenueChart"></Chart>
                    </div>
                </div>

                <div class="card">
                    <h4>Membros do time</h4>
                    <ul class="widget-person-list">
                        <li>
                            <div class="person-item">
                                <img src="../../../public/images/avatar/amyelsner.png" alt="diamond-layout" />
                                <div class="person-info">
                                    <div class="person-name">Ana Maria</div>
                                    <div class="person-subtext">Financeiro</div>
                                </div>
                            </div>
                            <div class="person-actions">
                                <Button class="p-button-rounded p-button-success" icon="pi pi-envelope"></Button>
                                <Button class="p-button-rounded p-button-warning" icon="pi pi-cog"></Button>
                            </div>
                        </li>
                        <li>
                            <div class="person-item">
                                <img src="../../../public/images/avatar/annafali.png" alt="diamond-layout" />
                                <div class="person-info">
                                    <div class="person-name">Maria da Penha</div>
                                    <div class="person-subtext">Comercial</div>
                                </div>
                            </div>
                            <div class="person-actions">
                                <Button class="p-button-rounded p-button-success" icon="pi pi-envelope"></Button>
                                <Button class="p-button-rounded p-button-warning" icon="pi pi-cog"></Button>
                            </div>
                        </li>
                        <li>
                            <div class="person-item">
                                <img src="../../../public/images/avatar/bernardodominic.png" alt="diamond-layout" />
                                <div class="person-info">
                                    <div class="person-name">Bernardo da Silva</div>
                                    <div class="person-subtext">SAC</div>
                                </div>
                            </div>
                            <div class="person-actions">
                                <Button class="p-button-rounded p-button-success" icon="pi pi-envelope"></Button>
                                <Button class="p-button-rounded p-button-warning" icon="pi pi-cog"></Button>
                            </div>
                        </li>
                        <li>
                            <div class="person-item">
                                <img src="../../../public/images/ivanmagalhaes.png" alt="diamond-layout" />
                                <div class="person-info">
                                    <div class="person-name">José da Silva</div>
                                    <div class="person-subtext">Assistência Técnica</div>
                                </div>
                            </div>
                            <div class="person-actions">
                                <Button class="p-button-rounded p-button-success" icon="pi pi-envelope"></Button>
                                <Button class="p-button-rounded p-button-warning" icon="pi pi-cog"></Button>
                            </div>
                        </li>
                        <li>
                            <div class="person-item">
                                <img src="../../../public/images/xuxuefeng.png" alt="diamond-layout" />
                                <div class="person-info">
                                    <div class="person-name">João da Silva</div>
                                    <div class="person-subtext">Diretoria</div>
                                </div>
                            </div>
                            <div class="person-actions">
                                <Button class="p-button-rounded p-button-success" icon="pi pi-envelope"></Button>
                                <Button class="p-button-rounded p-button-warning" icon="pi pi-cog"></Button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductService from './DashBoardService';
export default {
    data() {
        return {
            loadingPedidos: true,
            selectedOrderWeek: null,
            products: null,
            productsThisWeek: null,
            productsLastWeek: null,
            productService: null,
            cols: [
                { field: 'vin', header: 'Vin' },
                { field: 'year', header: 'Year' },
                { field: 'brand', header: 'Brand' },
                { field: 'color', header: 'Color' },
            ],

            items: [
                {
                    label: 'Shipments',
                    items: [
                        { label: 'Tracker', icon: 'pi pi-compass' },
                        { label: 'Map', icon: 'pi pi-map-marker' },
                        { label: 'Manage', icon: 'pi pi-pencil' },
                    ],
                },
            ],

            ordersChart: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho'],
                datasets: [
                    {
                        label: 'Confirmado',
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
                { name: 'Mês', code: '1' },
            ],

            revenueChart: {
                labels: ['Categoria 1', 'Categoria 2', 'Categoria 3'],
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
        this.productService = new ProductService();
    },
    mounted() {


        this.productService.getProducts().then((data) => {
            this.products = data;
            this.loadingPedidos = false;
            //console.log('getProducts');
            //console.log(data);
        });
        this.productService.getProducts().then((data) => (this.productsThisWeek = data));
        this.productService.getProductsMixed().then((data) => (this.productsLastWeek = data));

        this.selectedOrderWeek = this.orderWeek[0];

        //console.log('montou');


    },
    methods: {
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
