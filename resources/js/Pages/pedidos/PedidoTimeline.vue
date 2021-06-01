<template>
    <ScrollPanel :style="{width: '95%', height: '800px'}">
    <div class="p-grid">
        <div class="p-col-12">
                <h4>Timeline</h4>

                <Timeline :value="customEvents" align="alternate" class="customized-timeline">
                    <template #marker="slotProps">
                <span class="custom-marker p-shadow-2" :style="{backgroundColor: slotProps.item.color}">
                    <i :class="slotProps.item.icon"></i>
                </span>
                    </template>
                    <template #content="slotProps">
                        <Card>
                            <template #title>
                                {{slotProps.item.status}}
                            </template>
                            <template #subtitle>
                                {{slotProps.item.date}}
                            </template>
                            <template #content>
                                <p>Observações etapa inserção pedido</p>
                            </template>
                        </Card>
                    </template>
                </Timeline>
        </div>
    </div>
    </ScrollPanel>
</template>

<script>
export default {
    data() {
        return {
            customEvents: [
                {
                    status: 'Criado',
                    date: '15/10/2020 10:30',
                    icon: 'pi pi-shopping-cart',
                    color: '#9C27B0',
                    image: 'game-controller.jpg'
                },
                {
                    status: 'Confirmado',
                    date: '15/10/2020 14:00',
                    icon: 'pi pi-cog',
                    color: '#673AB7'
                },
                {
                    status: 'Abertura de Chamado',
                    date: '15/10/2020 16:15',
                    icon: 'pi pi-envelope',
                    color: '#FF9800'
                },
                {
                    status: 'Entregue',
                    date: '16/10/2020 10:00',
                    icon: 'pi pi-check',
                    color: '#607D8B'
                }
            ],
        }
    }
}
</script>

<style lang="scss" scoped>
.custom-marker {
    display: flex;
    width: 2rem;
    height: 2rem;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    border-radius: 50%;
    z-index: 1;
}

::v-deep(.p-button) {
    min-width: 8em;
}

::v-deep(.p-timeline-event-content) {
    line-height: 1;
}
::v-deep(.p-timeline-event-opposite) {
    line-height: 1;
}
@media screen and (max-width: 960px) {
    ::v-deep(.customized-timeline) {
        .p-timeline-event:nth-child(even) {
            flex-direction: row !important;

            .p-timeline-event-content {
                text-align: left !important;
            }
        }
        .p-timeline-event-opposite {
            flex: 0;
        }
        .p-card {
            margin-top: 1rem;
        }
    }
}

</style>
