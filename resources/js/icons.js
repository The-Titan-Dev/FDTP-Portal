import Vue from "vue";

import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";


import { faUser,faBars } from "@fortawesome/free-solid-svg-icons";

library.add(faUser,faBars);

Vue.component("font-awesome-icon", FontAwesomeIcon);
