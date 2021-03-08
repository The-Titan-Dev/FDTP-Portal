import Vue from "vue";

import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";


import { faUser, faLaptop, faUserShield, faCog, faHome, faBars,faUserCircle, faInfoCircle,  faPlusSquare, faEraser, faClipboardList, faSave, faTrash } from "@fortawesome/free-solid-svg-icons";

library.add(faUser,faLaptop, faUserShield, faCog, faHome, faBars, faUserCircle, faInfoCircle,  faPlusSquare, faEraser, faClipboardList, faSave, faTrash);


Vue.component("font-awesome-icon", FontAwesomeIcon);
