import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex);

import login from "./modules/login";
import home from "./modules/home";

export default new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        login,
        home
    },
    plugins: [createPersistedState({
        key:'userdata',
    })]
});
