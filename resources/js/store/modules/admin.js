import axios from "axios";

export default {
	state: {
		systemmanagement: [],
	},
	mutations: {
		SET_SYSTEMMANAGEMENT(state, systemmanagement) {
			state.systemmanagement = systemmanagement;
		},
	},
	actions: {
		async loadSystemManagement({ commit }) {
			return new Promise((resolve, reject) => {
				axios
					.get("systems/load")
					.then(function(response) {
						commit("SET_SYSTEMMANAGEMENT", response.data);
						let result = {
							code: response.data.code,
							status: response.data.status,
							message: response.data.message,
							data: response.data.data,
						};
						resolve(result);
					})
					.catch(function(error) {
						reject(error);
					});
			});
		},

	
	
	
	},
	getters: {
		getSystemManagement: (state) => state.systemmanagement,
	},
};
