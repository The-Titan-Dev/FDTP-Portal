import axios from "axios";
import { reject } from "lodash";

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
        },
        
        async changePassword(state, payload){
            let lstorage = JSON.parse(localStorage.getItem('userdata'));
            let emp_id = lstorage.data.data.emp_id;
            return new Promise((resolve, reject) => {
                axios
					.post(`user/update-password/${emp_id}`, payload)
					.then(function(response) {
						resolve(response);
					})
					.catch(function(error) {
						reject(error.response.data);
						// console.log("ERRRR:: ",error.response.data.errors);
					});
            })
           
        }
    },

    getters: {
        get_pw_visibility: state => state.change_pw_visibility
    }

};
