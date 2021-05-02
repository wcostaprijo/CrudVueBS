import Index from './components/cliente/Index.vue'
import Create from './components/cliente/Create.vue'
import Show from './components/cliente/Show.vue'
import Update from './components/cliente/Update.vue'

export const routes = [
    {
        name: 'clientes',
        path: '/vue/clientes',
        component: Index
    },
    {
        name: 'clientes.create',
        path: '/vue/clientes/create',
        component: Create
    },
    {
        name: 'clientes.show',
        path: '/vue/clientes/:id',
        component: Show
    },
    {
        name: 'clientes.show',
        path: '/vue/clientes/:id/edit',
        component: Update
    },
];