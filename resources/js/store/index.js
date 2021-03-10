import Vue from "vue";
import Vuex from "vuex";
// import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex);

import login from "./modules/login";
import home from "./modules/home";
import user from "./modules/user";
import logoutNotification from "./modules/logoutNotification";
import deleteConfirmation from "./modules/deleteConfirmation";
import admin from "./modules/admin";

export default new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        login,
        home,
        user,
        logoutNotification,
        admin,
        deleteConfirmation
    },
    // plugins: [createPersistedState({
    //     key:'test',
    // })]
});
