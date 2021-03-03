import { faLongArrowAltUp } from "@fortawesome/free-solid-svg-icons";
import axios from "axios";
import createPersistedState from "vuex-persistedstate";
export default {
    state: {
        authenticated_user: []
    },
    mutations: {
        SET_AUTHENTICATED_USER(state, user) {
            state.authenticated_user = user;
        }
    },
    actions: {
        async login({commit}, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .post(`user/login`, payload)
                    .then(function(response) {
                        commit("SET_AUTHENTICATED_USER", response.data);
                        if(response.data.data.status === 3){
                            localStorage.userdata = JSON.stringify(response.data);
                        }
                        resolve(response.data);
                    })
                    .catch(function(error) {
                        reject(error);
                    });
            });
        },

        async logout({commit}, payload){
            // console.log(payload)
            return new Promise((resolve, reject) => {
                axios
                    .delete(`user/logout/${payload}`)
                    .then(function(response) {
                        localStorage.clear();
                        resolve(response.data);
                        // localStorage.userdata = JSON.stringify(response.data);
                    })
                    .catch(function(error) {
                        reject(error);
                    });
            });
        }
    },
    getters: {
        authenticated_user: state => state.authenticated_user
    },
    plugins: [createPersistedState({
        key:'userdata',
    })]
};
