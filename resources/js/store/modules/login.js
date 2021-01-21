import axios from "axios";

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
                        commit("SET_AUTHENTICATED_USER", response.data.result.data);
                        resolve(response.data);
                    })
                    .catch(function(error) {
                        reject(error);
                    });
            });
        }
    },
    getters: {
        authenticated_user: state => state.authenticated_user
    }
};
