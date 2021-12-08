require('./bootstrap');

import Vue from 'vue';


import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import Admin from './Admin.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import CategoryComponent from './admin_components/CategoryComponent.vue';
import ProductComponent from './admin_components/ProductComponent.vue';
import PurchaseComponent from './admin_components/PurchaseComponent.vue';
Vue.use(VueAxios, axios);

const routes = [
    {
        name: 'example',
        path: '/admin/vue/example',
        component: ExampleComponent
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
        name: 'purchases',
        path: '/admin/vue/purchases',
        component: PurchaseComponent,
    }
];

const router = new VueRouter({ mode: 'history', routes: routes });

const admin = new Vue(Vue.util.extend({ router }, Admin)).$mount('#admin');
