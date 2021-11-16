require('./bootstrap');

import Vue from 'vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App1.vue';
Vue.use(VueAxios, axios);
import HomeComponent from './pos_components/HomeComponent.vue';

const routes = [
    {
        name: 'homepos',
        path: '/pos/home',
        component: HomeComponent
    },
  ];

const router = new VueRouter({ mode: 'history', routes: routes});

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app1');
