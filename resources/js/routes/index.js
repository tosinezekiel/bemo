

import PageNotFound from '../Pages/PageNotFound.vue'
import Dashboard from '../Pages/Dashboard.vue'

export const routes = [
    {
        path: '/',
        name: 'Dashboard',
        component: Dashboard,
    },
    { path: '/:pathMatch(.*)*', component: PageNotFound },
]
