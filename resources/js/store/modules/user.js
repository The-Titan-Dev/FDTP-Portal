import axios from "axios";

export default {
    state: {
        user_list: []
    },
    mutations: {
        SET_USER_LIST(state, users) {
            state.user_list = users;
        }
    },
    actions: {
        async loadUsers({commit}, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`http://10.164.58.52/FDTP-Portal/public/api/user/load-all-registered-users`)
                    .then(function(response) {
                        commit("SET_USER_LIST", response.data);
                        resolve(response.data);
                    })
                    .catch(function(error) {
                        reject(error);
                    });
            });
        },

        async resetPassword(state,payload){
            return new Promise((resolve, reject) => {
                axios.post(`/user/reset-password/${payload}`, {"id": payload, "_method": "patch"})
                .then(response =>{
                    resolve(reject)
                })
            })
        }
    },
    getters: {
        getUsers: state => state.user_list
    }
};
