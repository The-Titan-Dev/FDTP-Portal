import Vue from "vue";
import VueRouter from "vue-router";

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import { BootstrapVue } from "bootstrap-vue";
Vue.use(BootstrapVue);

Vue.use(VueRouter);

import store from "./store";


import App from "./views/App";
import Hello from "./views/Hello";
import Home from "./views/Home";
import Login from "./views/Login";

import axios from "axios";
axios.defaults.baseURL = "http://10.164.58.130/fdtp-portal/public/";

/*TEMPORARY*/
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

const options = {
    // You can set your default options here
};

Vue.use(Toast, options);

const base_url = "/fdtp-portal/public/";
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/fdtp-portal/public/",
            name: "home",
            component: Home
        },
        {
            path: "/hello",
            name: "hello",
            component: Hello
        },
        {
            path: `${base_url}login`,
            name: "login",
            component: Login
        }
    ]
});

const app = new Vue({
    el: "#app",
    components: { App },
    router,
    store
});
