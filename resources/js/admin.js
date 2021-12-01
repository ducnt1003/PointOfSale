require('./bootstrap');

import Vue from 'vue';


import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import Admin from './Admin.vue';
Vue.use(VueAxios, axios);

const routes = [


];

const router = new VueRouter({ mode: 'history', routes: routes });

const admin = new Vue(Vue.util.extend({ router }, Admin)).$mount('#admin');
