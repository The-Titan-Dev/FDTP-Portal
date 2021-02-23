import Vue from "vue";
import VueRouter from "vue-router";

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import { BootstrapVue } from "bootstrap-vue";
Vue.use(BootstrapVue);

Vue.use(VueRouter);

import store from "./store";

import "./icons.js";

import axios from "axios";
axios.defaults.baseURL = "http://10.164.30.173/fdtp-portal/public/api/";

/*TEMPORARY*/
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

const options = {
    // You can set your default options here
};

Vue.use(Toast, options);

import App from "./views/App";
import Base from "./views/Base";
import Login from "./views/Login";
import UserManagement from "./views/UserManagement";
import Admin from "./views/Admin";
import SystemManagement from "./views/SystemManagement";

const base_url = "/fdtp-portal/public/";
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: `${base_url}login`,
            name: "login",
            component: Login
        },
        {
            path: `${base_url}`,
            name: "base",
            component: Base,
            children: [
                {
                    path: `${base_url}admin`,
                    name: "Admin",
                    component: Admin
                },
                {
                    path: `${base_url}user-management`,
                    name: "UserManagement",
                    component: UserManagement
                },
                {
                    path: `${base_url}system-management`,
                    name: "SystemManagement",
                    component: SystemManagement
                }
            ]
        }
    ]
});

const app = new Vue({
    el: "#app",
    components: { App },
    router,
    store
});
