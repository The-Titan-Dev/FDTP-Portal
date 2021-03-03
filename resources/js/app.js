import Vue from "vue";
import VueRouter from "vue-router";
import Middleware from "./middleware";

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import { BootstrapVue } from "bootstrap-vue";

Vue.use(BootstrapVue);

Vue.use(VueRouter);

import store from "./store";

import "./icons.js";

import axios from "axios";
axios.defaults.baseURL = "http://10.164.58.52/FDTP-Portal/public/api/";

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
import Home from "./views/Home";

const base_url = "/fdtp-portal/public/";
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: `${base_url}login`,
            name: "login",
            component: Login,
            beforeEnter(to, from, next) {
                let middleware = new Middleware(next, router);
                middleware.guest();
            }
        },
        {
            path: `${base_url}`,
            name: "base",
            component: Base,
            children: [
                {
                    path: `${base_url}admin`,
                    name: "Admin",
                    component: Admin,
                    beforeEnter(to, from, next) {
                        let middleware = new Middleware(next, router);
                        middleware.auth(to, from);
                    }
                },
                {
                    path: `${base_url}user-management`,
                    name: "UserManagement",
                    component: UserManagement,
                    beforeEnter(to, from, next) {
                        let middleware = new Middleware(next, router);
                        middleware.auth(to, from);
                    }
                },
                {
                    path: `${base_url}home`,
                    name: "Home",
                    component: Home,
                    beforeEnter(to, from, next) {
                        let middleware = new Middleware(next, router);
                        middleware.auth(to, from);
                    }
                }
            ]
        }
    ],
    scrollBehavior: function (to) {
        if (to.hash) {
          return {
            selector: to.hash
          }
        }
      },
});

const app = new Vue({
    el: "#app",
    components: { App },
    router,
    store
});

router.beforeEach((to, from, next) => {

    // check if the user is logged in

    if (localStorage.getItem("userdata") !== null && to.name === 'login') {
        alert('back to login');
        router.push({ name: from.name });
    }

    else if (localStorage.getItem("userdata") === null && to.name !== 'login') {
        alert('back to login');
        router.push({ name: 'login' });
    }
    
    next();
    
   
  })

