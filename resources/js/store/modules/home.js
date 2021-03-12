import axios from "axios";

export default {
    state: {
      change_pw_visibility : false
    },
    mutations: {
        set_pw_visibility(state,user) {
            state.change_pw_visibility = user
        }
    },
    actions: {
        async changeVisibility({commit}, payload){
            commit("set_pw_visibility", !payload)
        }
    },
    getters: {
        get_pw_visibility: state => state.change_pw_visibility
    }
};
