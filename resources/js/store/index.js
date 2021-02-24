import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex);

import login from "./modules/login";
import system_management from "./modules/system_management";

export default new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        login,
        system_management
    },
    plugins: [createPersistedState({
        key:'userdata',
    })]
});
