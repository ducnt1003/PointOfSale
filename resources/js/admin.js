require('./bootstrap');

import Vue from 'vue';


import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
import 'vue-search-select/dist/VueSearchSelect.css';
//import 'materialize-css';
//import 'materialize-css/dist/css/materialize.css';

import Admin from './Admin.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import DashboardComponent from './admin_components/DashboardComponent.vue';
import CategoryComponent from './admin_components/CategoryComponent.vue';
import ProductComponent from './admin_components/ProductComponent.vue';
import CustomerComponent from './admin_components/CustomerComponent.vue';
import CustomerListComponent from './admin_components/CustomerListComponent.vue';
import CreateProductComponent from './admin_components/CreateProductComponent.vue';
import PurchaseComponent from './admin_components/PurchaseComponent.vue';
import PurchaseListComponent from './admin_components/PurchaseListComponent.vue';
Vue.use(VueAxios, axios);
Vue.prototype.$user = document.querySelector("meta[name='user_id']").getAttribute('content');

const routes = [
    {
        name: 'example',
        path: '/admin/vue/example',
        component: ExampleComponent
    },
    {
        name: 'dashboard',
        path: '/admin/vue/dashboard',
        component: DashboardComponent,
    },
    {
        name: 'categories',
        path: '/admin/vue/categories',
        component: CategoryComponent,
    },
    {
        name: 'products',
        path: '/admin/vue/products',
        component: ProductComponent,
    },
    {
        name: 'products.create',
        path: '/admin/vue/products/create',
        component: CreateProductComponent,
    },
    {
        name: 'purchases.create',
        path: '/admin/vue/purchases/create',
        component: PurchaseComponent,
    },
    {
        name: 'purchases.list',
        path: '/admin/vue/purchases/list',
        component: PurchaseListComponent,
    },
    {
        name: 'customers-list',
        path: '/admin/vue/customer-list',
        component: CustomerListComponent,
    },
    {
        name: 'customer',
        path: '/admin/vue/customer/:id',
        component: CustomerComponent,
    },
];

const router = new VueRouter({ mode: 'history', routes: routes });

const admin = new Vue(Vue.util.extend({ router }, Admin)).$mount('#admin');
