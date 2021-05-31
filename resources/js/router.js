import {createRouter, createWebHistory} from 'vue-router';

const routes = [

    {
        path: '/activitylogs',
        name: 'activitylogs',
        component: () => import('./activitylogs/ActivityLogs'),
        meta: {
            breadcrumb: [{ parent: 'Administrativo', label: "Log's de Atividade" }],
        },
    },
    {
        path: '/',
        name: 'dashboard',
        exact: true,
        component: () => import('./dashboard/DashBoardB'),
        meta: {
            breadcrumb: [{ parent: 'Dashboard', label: 'Dashboard' }],
        },
    },
    {
        path: '/clientes',
        name: 'clientes',
        component: () => import('./clientes/Clientes'),
        meta: {
            breadcrumb: [{ parent: 'Cadastro', label: 'Clientes' }],
        },
    },
    {
        path: '/calendario',
        name: 'calendario',
        component: () => import('./calendario/Calendario'),
        meta: {
            breadcrumb: [{ parent: 'Administrativo', label: "Calendário" }],
        },
    },
    {
        path: '/condpgtos',
        name: 'condpgtos',
        component: () => import('./condpgtos/CondPgtos'),
        meta: {
            breadcrumb: [{ parent: 'Cadastro', label: 'Condições de Pagamento' }],
        },
    },
    {
        path: '/financeiros',
        name: 'financeiros',
        component: () => import('./financeiros/Financeiros'),
        meta: {
            breadcrumb: [{ parent: 'Cadastro', label: 'Financeiro' }],
        },
    },
    {
        path: '/formapgtos',
        name: 'formapgtos',
        component: () => import('./formapgtos/FormaPgtos'),
        meta: {
            breadcrumb: [{ parent: 'Cadastro', label: 'Formas de Pagamento' }],
        },
    },
    {
        path: '/pedidos',
        name: 'pedidos',
        component: () => import('./pedidos/Pedidos'),
        meta: {
            breadcrumb: [{ parent: 'Cadastro', label: 'Pedidos' }],
        },
    },
    {
        path: '/pedidoeditar/:id',
        name: 'pedidoeditar',
        component: () => import('./pedidos/PedidoEditar'),
        meta: {
            breadcrumb: [{ parent: 'Cadastro', label: 'Editar Pedidos' }],
        },
    },
    {
        path: '/produtos',
        name: 'produtos',
        component: () => import('./produtos/Produtos'),
        meta: {
            breadcrumb: [{ parent: 'Cadastro', label: 'Produtos' }],
        },
    },
    {
        path: '/questioeditar/:id',
        name: 'questioeditar',
        component: () => import('./clientes/QuestioSucesso'),
        meta: {
            breadcrumb: [{ parent: 'Cadastro', label: 'Editar Questionário' }],
        },
    },
    {
        path: '/tipomovs',
        name: 'tipomovs',
        component: () => import('./tipomovs/TipoMovs'),
        meta: {
            breadcrumb: [{ parent: 'Cadastro', label: 'Tipos de Movimento' }],
        },
    },
    {
        path: '/tipofretes',
        name: 'tipofretes',
        component: () => import('./tipofretes/TipoFretes'),
        meta: {
            breadcrumb: [{ parent: 'Cadastro', label: 'Tipos de Frete' }],
        },
    },
    {
        path: '/users',
        name: 'users',
        component: () => import('./users/Users'),
        meta: {
            breadcrumb: [{ parent: 'Administrativo', label: 'Usuários' }],
        },
    },

    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: () => import('./pages/NotFound')
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
