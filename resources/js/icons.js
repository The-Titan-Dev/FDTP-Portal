import Vue from "vue";

import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";


import { faUser, faLaptop, faUserShield, faCog, faHome, faBars } from "@fortawesome/free-solid-svg-icons";

library.add(faUser,faLaptop, faUserShield, faCog, faHome, faBars);


Vue.component("font-awesome-icon", FontAwesomeIcon);
