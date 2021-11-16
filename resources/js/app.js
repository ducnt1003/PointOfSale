require('./bootstrap');

import Vue from 'vue';


import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
import 'vue-search-select/dist/VueSearchSelect.css';

import App from './App.vue';
Vue.use(VueAxios, axios);

import HomeComponent from './components/HomeComponent.vue';
import CreateComponent from './components/CreateComponent.vue';
import IndexComponent from './components/IndexComponent.vue';
import EditComponent from './components/EditComponent.vue';
import PosComponent from './components/PosComponent.vue';
import CustomerComponent from './components/CustomerComponent.vue';

const routes = [
    {
        name: 'home',
        path: '/brands/home',
        component: HomeComponent
    },
    {
        name: 'create',
        path: '/brands/create',
        component: CreateComponent
    },
    {
        name: 'posts',
        path: '/brands/posts',
        component: IndexComponent
    },
    {
        name: 'edit',
        path: '/brands/edit/:id',
        component: EditComponent
    },
    {
        name: 'pos',
        path: '/brands/pos',
        component: PosComponent
    },
    {
        name: 'customer',
        path: '/brands/pos/customer',
        component: CustomerComponent
    }
];

const router = new VueRouter({ mode: 'history', routes: routes });

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
