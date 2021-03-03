<template>
    <div class="Admin">
        <div class="header-circle"></div> 
        <section class="col-lg-12">
            <b-row class="header--title">
                <div class="col-6">
                    <img src="images/laptopHuman.png" alt="laptopHuman" class="laptopHuman">
                </div>
                <div class="content--right col-4">
                    <article class="system-title">
                        <h1>SYSTEM</h1>
                        <h2>MANAGEMENT</h2>
                        <span class="line__red"></span>
                        <br>
                        <p>"Fujitsu grows so do its requirements, as well as the need to efficiently manage and safeguard IT and data assets so we centralized system monitoring."<br><small>- DaileDreamer</small></p>
                    </article>
                    <center>
                        <b-button class="btn btn-danger btn-lg">
                            GET STARTED
                        </b-button>
                    </center>

                </div>
            </b-row>
        </section>
      
        <section class=" body-circle col-lg-12">
            <div class="body--management">
                <font-awesome-icon icon="user-shield"  class="icon" style="font-size:100px; margin-bottom:25px; "/>
                <h1>SYSTEM MANAGEMENT</h1>
                <p>Together we connect and manage Systems and Role. </p>
                 <img src="images/systemList.png" alt="listofsystem" class="body--image">
            </div>

            <div class="footer--management">
                <b-row align-h="between">
                    <b-col sm="12" md="4" class="mb-2">
                        <b-button
                        type="button"
                        variant="primary"
                        size="md"
                        class="btn btn-danger"
                        v-b-modal.register-system-modal-insert
                        title="Click to clear form"
                         @click="clearForm"
                        >
                        <font-awesome-icon icon="plus-square" size="lg" class="icon" /> 
                        REGISTER NEW SYSTEM
                        </b-button>
                    </b-col>

                    <b-col sm="12" md="6" lg="5" xl="3" class="mb-2">
                        <b-input-group>
                        <b-form-input
                            id="filter-input"
                            v-model="filterRegister"
                            type="search"
                            placeholder="Type to Search"
                        >
                        </b-form-input>
                        <b-input-group-append>
                            <b-button
                            type="button"
                            size="md"
                            class="btn btn-danger"
                            :disabled="!filterRegister"
                            @click="filterRegister = ''"
                            >
                            <font-awesome-icon icon="eraser" size="sm" class="icon" />
                            Cancel
                            </b-button>
                        </b-input-group-append>
                        </b-input-group>
                    </b-col>
                </b-row>

                <!-- TABLE DATA -->
                <b-table
                id="system_management_table"
                class="alpha__table text-nowrap"
                hover
                bordered
                responsive
                :fields="fields"
                :filter="filterRegister"
                :filter-included-fields="filterOn"
                :items="getSystemManagement.data"
                :per-page="perPage"
                :current-page="currentPage"
                >
                    <template #cell(actions)="data">
                        <b-button
                            type="button"
                            variant="danger"
                            size="sm"
                            title="Click to Add role"
                            v-b-modal.modal-add-role
                            @click="loadRoles(data.item.id)">
                            <font-awesome-icon icon="clipboard-list" size="sm" class="icon" /> 
                            Add Role
                        </b-button>
                        <b-button
                            type="button"
                            variant="secondary"
                            size="sm"
                            title="Click to Deactivate system"
                            v-b-modal.deactivate-modal
                            @click="loadDeactivate(data.item.id)">
                            <font-awesome-icon icon="trash" size="sm" class="icon" /> 
                            Deactivate
                        </b-button>
                    
                    </template>
                </b-table>

                <!-- PAGINATION -->
                <b-pagination
                    align="right"
                    class="alpha__table__pagination"
                    pills
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage">
                </b-pagination> 
            
            </div>
         
        </section>

    <!-- MODALS -->
    <b-modal
        id="register-system-modal-insert"
        size="lg"
        hide-footer
        title="System Form Registration"
        title-class="alpha__modal__title"
    >
        <b-form
        class="pl-4 pr-4"
        id="form-registration"
        @submit.prevent="submitForm"
        method="post"
        >
        <b-row style="padding-top:60px;">
            <b-col cols="9" class="mb-2">
                <b-form-group
                id="input-group-system-name"
                label="System Name :"
                label-class="alpha__form__label"
                label-for="input-system-name"
                >
                    <b-form-input
                    class="alpha-input"
                    id="input-system-name"
                    name="name"
                    type="text"
                    placeholder="Enter system name"
                    required
                    /> 
                </b-form-group>
            </b-col>
            <b-col cols="3" class="mb-2">
                <b-form-group
                id="input-group-abbrevation"
                label="Abbreviation :"
                label-class="alpha__form__label"
                label-for="input-abbrevation"
                >
                    <b-form-input
                    class="alpha-input"
                    id="input-abbrevation"
                    name="abbreviation"
                    type="text"
                    placeholder="Enter abbrevation"
                    required
                    /> 
                </b-form-group>
            </b-col>
            <b-col cols="6" class="mb-2">
                <b-form-group
                id="input-group-section-owner"
                label="Section Owner :"
                label-class="alpha__form__label"
                label-for="input-section-owner"
                >
                <b-form-select
                    class="alpha-input"
                    id="input-section-owner"
                    name="section_owner"
                    type="text"
                    placeholder="Enter section owner"
                    required
                    :options="options_section_owner"
                ></b-form-select>
                </b-form-group>
            </b-col>
            <b-col cols="6" class="mb-2">
                <b-form-group
                id="input-group-status"
                label="Status :"
                label-class="alpha__form__label"
                label-for="input-status"
                >
                <b-form-select
                    class="alpha-input"
                    id="input-status"
                    name="status"
                    type="text"
                    placeholder="Enter status"
                    required
                    :options="options_status"
                ></b-form-select>
                </b-form-group>
            </b-col>
            <b-col cols="12" class="mb-2">
                <b-form-group
                id="input-group-url"
                label="SYSTEM URL :"
                label-class="alpha__form__label"
                label-for="input-url"
                >
                <b-form-input
                    class="alpha-input"
                    id="input-url"
                    name="url"
                    type="text"
                    placeholder="Enter URL"
                    required
                    /> 
                </b-form-group>
            </b-col>
            <b-col cols="4" class="mb-2">
                <b-form-group
                id="input-group-reference-number"
                label="Reference Number :"
                label-class="alpha__form__label"
                label-for="input-reference-number"
                >
                <b-form-input
                    class="alpha-input"
                    id="input-reference-number"
                    name="reference_number"
                    type="text"
                    placeholder="Enter Reference Number"
                    required
                    /> 
                </b-form-group>
            </b-col>
            <b-col cols="4" class="mb-2">
                <b-form-group
                id="input-group-reference-code"
                label="Reference Code :"
                label-class="alpha__form__label"
                label-for="input-reference-cod"
                >
                <b-form-input
                    class="alpha-input"
                    id="input-reference-code"
                    name="reference_code"
                    type="text"
                    placeholder="Enter Reference Code"
                    required
                    /> 
                </b-form-group>
            </b-col>
            <b-col cols="4" class="mb-2">
                <b-form-group
                id="input-group-date-deployed"
                label="Date Deployed :"
                label-class="alpha__form__label"
                label-for="input-date-deployed"
                >
                <b-form-input
                    class="alpha-input"
                    id="input-date-deployed"
                    name="date_deployed"
                    type="date"
                    placeholder="Enter Date Deployed"
                    required
                    /> 
                </b-form-group>
            </b-col>
            <b-col cols="12" class="mb-2">
                <b-form-group
                id="input-group-description"
                label="Description :"
                label-class="alpha__form__label"
                label-for="input-description"
                >
                <b-form-textarea
                    class="alpha-input"
                    id="input-description"
                    name="description"
                    rows="3"
                    max-rows="6"
                    type="text"
                    placeholder="Enter description"
                    required
                    /> 
                </b-form-group>
            </b-col>
        </b-row>
        <hr/>
        <div class="float-right">
            <b-button
            type="button"
            title="Click to clear form"
            class="mr-2"
            @click="clearForm"
            >
            Cancel
            </b-button>
            <b-button
            id="button-submit"
            type="submit"
            title="Click to add new register system"
            variant="danger"
            >
            <font-awesome-icon icon="save" size="sm" class="icon" />  
            Save Information
            </b-button>
        </div>
        </b-form>
    </b-modal>

    <b-modal
        id="deactivate-modal"
        size="sm"
        hide-footer
        title="System Deactivation"
        title-class="alpha__modal__title">
        <b-form
        class="pl-4 pr-4"
        id="form-deactivate"
        @submit.prevent="submitForm"
        method="post"
        >
        <b-row style="padding-top:60px;">
            <h3>Are you sure you want to Deactivate this system?</h3>
        </b-row>
        <hr/>
        <div class="float-right">
            <b-button
            type="button"
            title="Click to clear form"
            class="mr-2"
            @click="$bvModal.hide('deactivate-modal')">
            No
            </b-button>
            <b-button
            id="button-submit"
            type="submit"
            title="Click to deactivate system"
            variant="danger"
            @click="getDeactivate(id)">
            Yes
            </b-button>
        </div>
        </b-form>
    </b-modal> 

    <b-modal
        id="modal-add-role"
        size="xl"
        hide-footer
        title="Register New Role"
        title-class="alpha__modal__title">
      
        <!-- search -->
        <b-row style="padding-top:60px;" align-h="between">
            <b-col sm="12" md="4" class="mb-2"> </b-col>
            <b-col sm="12" md="6" lg="5" xl="5" class="mb-2">
                <b-input-group>
                <b-form-input
                    id="filter-input"
                    v-model="filterRole"
                    type="search"
                    placeholder="Type to Search"
                >
                </b-form-input>
                <b-input-group-append>
                    <b-button
                    type="button"
                    size="md"
                    class="btn btn-danger"
                    :disabled="!filterRole"
                    @click="filterRole = ''"
                    >
                    <font-awesome-icon icon="eraser" size="sm" class="icon" />
                    Cancel
                    </b-button>
                </b-input-group-append>
                </b-input-group>
            </b-col>
        </b-row>

        <!-- body -->
        <b-row>
            <b-col lg="4">
                 <b-form
                    class="pl-4 pr-4"
                    id="form-roles"
                    @submit.prevent="submitFormRoles"
                    method="post"
                    >
                    <b-row style="padding-top:10px;">
                        <b-form-input
                        class="alpha-input"
                        id="input-system-id"
                        name="system_id"
                        type="text"
                        v-model="rolesUpdateID"
                        required
                        hidden
                        /> 
                        <b-col cols="12" class="mb-2">
                            <b-form-group
                            id="input-group-role"
                            label="System Role :"
                            label-class="alpha__form__label"
                            label-for="input-role"
                            >
                                <b-form-input
                                class="alpha-input"
                                id="input-role"
                                name="role"
                                v-model="formroles.role.value"
                                type="text"
                                placeholder="Enter role"
                                required
                                /> 
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" class="mb-2">
                            <b-form-group
                            id="input-group-role-description"
                            label="Description :"
                            label-class="alpha__form__label"
                            label-for="input-role-description"
                            >
                                <b-form-textarea
                                class="alpha-input"
                                id="input-role-description"
                                name="description"
                                v-model="formroles.description.value"
                                type="text"
                                rows="8"
                                max-rows="1"
                                placeholder="Enter role description"
                                required
                                /> 
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <hr/>
                    <div class="float-right">
                        <b-button
                        type="button"
                        title="Click to clear form"
                        class="mr-2"
                        @click="clearFormRoles"
                        >
                        Cancel
                        </b-button>
                        <b-button
                        id="button-submit-role"
                        type="submit"
                        title="Click to add new register system"
                        variant="danger"
                        >
                        <font-awesome-icon icon="save" size="sm" class="icon" />  
                        Save Information
                        </b-button>
                    </div>
                    </b-form>
            </b-col>
            <b-col lg="8" class="footer--role">
                <!-- TABLE DATA -->
                <b-table
                id="system_role_table"
                class="alpha__table text-nowrap"
                hover
                bordered
                responsive
                :fields="fieldsRoles"
                :filter="filterRole"
                :filter-included-fields="filterOn"
                :items="getSystemRole.data"
                :per-page="perPageRole"
                :current-page="currentPageRole"
                >
                    <template #cell(actions)="data">
                        <b-button
                            type="button"
                            variant="danger"
                            size="sm"
                            title="Click to Update"
                            v-b-modal.modal-add-role

                            >
                            <font-awesome-icon icon="clipboard-list" size="sm" class="icon" /> 
                            Update
                        </b-button>
                        <b-button
                            type="button"
                            variant="secondary"
                            size="sm"
                            title="Click to Delete"
                            v-b-modal.role-modal
                            @click="deleteRoleID(data.item.id)">
                        
                            <font-awesome-icon icon="trash" size="sm" class="icon" /> 
                            Delete
                        </b-button>
                    
                    </template>
                </b-table>
                <!-- PAGINATION -->
                <b-pagination
                    align="right"
                    class="alpha__table__pagination_role"
                    pills
                    v-model="currentPageRole"
                    :total-rows="rowsrole"
                    :per-page="perPageRole">
                </b-pagination> 
            </b-col>
            
        </b-row>
        <hr/>
 
    </b-modal> 

    </div>
    
</template>

<script>
import { mapGetters } from "vuex";
export default {
        name:"Admin",
        data() {
        return {
            getDeactivateID: "",
            options_status:[
                { text: 'Development', value: 'Development' },
                { text: 'Production', value: 'Production' },
            ],
            options_section_owner: [],
            currentPage: 1,
            perPage: 10,
            filterRegister: null,
            filterOn: [],
            fields: [
            {
            key: "name",
            sortable: true,
            },
            {
            key: "abbreviation",
            sortable: true,
            },
            {
            key: "reference_code",
            sortable: true,
            },
            {
            key: "reference_number",
            sortable: true,
            },
            {
            key: "description",
            sortable: true,
            },
            {
            key: "status",
            sortable: true,
            },
            {
            key: "section_owner",
            sortable: true,
            },
            
            { 
            key: "actions",
            label: "Actions" 
            },
            ],
            form: {
                name: {
                    value: "",
                    state: null,
                    validation: "",
                },
                abbreviation: {
                    value: "",
                    state: null,
                    validation: "",
                },
                section_owner: {
                    value: "",
                    state: null,
                    validation: "",
                },
                status: {
                    value: "",
                    state: null,
                    validation: "",
                },
                description: {
                    value: "",
                    state: null,
                    validation: "",
                },
                reference_code: {
                    value: "",
                    state: null,
                    validation: "",
                },
                reference_number: {
                    value: "",
                    state: null,
                    validation: "",
                },
            },
            fieldsRoles:[
                {
                    key: "role",
                    sortable: true,
                },
                {
                    key: "description",
                    sortable: true,
                },
                { 
                    key: "actions",
                    label: "Actions" 
                },

            ],
            formroles: {
                role: {
                    value: "",
                    state: null,
                    validation: "",
                },
                description: {
                    value: "",
                    state: null,
                    validation: "",
                }, 
            },
            currentPageRole: 1,
            perPageRole: 6,
            rolesUpdateID:"",
            filterRole: null,
            
        };
    },        
    mounted() {
        this.loadTable();
        this.loadSectionOwner();
    },
    computed: {
        ...mapGetters(["getSystemManagement","getSystemRole"]),
        rows() {
            if (!this.getSystemManagement.data) {
                return 1;
            } else {
                return this.getSystemManagement.data.length;
            }
        },
        rowsrole() {
            if (!this.getSystemRole.data) {
                return 1;
            } else {
                return this.getSystemRole.data.length;
            }
        },
    },
    methods: {
        //Utility
        toast: function (status, message) {
            this.$toast(message, {
                type: status,
                toastClassName: `toastification--${status}`,
                position: "bottom-right",
            });
        },
        clearForm: function () {
            this.form = {
                name: {
                    value: "",
                    state: null,
                    validation: "",
                },
                abbreviation: {
                    value: "",
                    state: null,
                    validation: "",
                },
                section_owner: {
                    value: "",
                    state: null,
                    validation: "",
                },
                status: {
                    value: "",
                    state: null,
                    validation: "",
                },
                description: {
                    value: "",
                    state: null,
                    validation: "",
                },
                reference_code: {
                    value: "",
                    state: null,
                    validation: "",
                },
                reference_number: {
                    value: "",
                    state: null,
                    validation: "",
                },
            };
        },
        clearFormRoles: function (){
            this.formroles= {
                role: {
                    value: "",
                    state: null,
                    validation: "",
                },
                description: {
                    value: "",
                    state: null,
                    validation: "",
                },
            };
        },
        //System Registration
        loadTable: function () {
          
            this.$store.dispatch("loadSystemManagement").then((result) => {
            this.toast(result.status, result.message);
                
            });
        },
        loadDeactivate: function (id) {
            this.getDeactivateID = id;
        },
        getDeactivate: function () {
            var id = this.getDeactivateID;
            this.$store
                .dispatch("deleteDeactivate", id)
                .then((response) => {
                    let status = response.data.status;
                    if (status == "success") {
                        this.loadTable();
                        this.$bvModal.hide("deactivate-modal");
                    } else if (status == "warning") {
                        this.toast(status, "Please review your inputs.");
                    } else if (status == "error") {
                        this.toast(status, response.data.message);
                    }
                })
                .catch((error) => {
                    this.toast("error", "Something went wrong");
            });
        },
        submitForm: function () {
        var formData = new FormData(document.getElementById("form-registration"));
        document.getElementById("button-submit").disabled = true;
        this.$store
            .dispatch("insertSystemRegistration", formData)
            .then((response) => {
            let status = response.data.status;
            if (status == "success") {
                this.toast(status, response.data.message);
                this.loadTable();
                this.$bvModal.hide("register-system-modal-insert");
            } else if (status == "warning") {
                Object.keys(response.data.data).forEach((key) => {
                this.form[key]["state"] = false;
                this.form[key]["validation"] = response.data.data[key][0];
                });
                this.toast(status, "Please review your inputs.");
            } else if (status == "error") {
                this.toast(status, response.data.message);
            }
            })
            .catch((error) => {
            this.toast("error", "Something went wrong");
            console.log(error);
            })
            .finally(() => {
            document.getElementById("button-submit").disabled = false;
            });
        },
        loadSectionOwner: function () {
            this.$store.dispatch("loadSectionOwner").then((result) => {
                Object.keys(result).forEach((key) => {
                let obj = {};
                obj["value"] = result[key]["id"];
                obj["text"] = result[key]["section"];
                this.options_section_owner.push(obj);
                });
            });
        },
        //System Role
        loadRoles: function (system_id) {
            this. rolesUpdateID= system_id;
            this.$store.dispatch("loadSystemRole", system_id).then((result) => {
                this.toast(result.status, result.message);
                console.log(result.data)
            });
        },
        deleteRoleID: function (id) {
            this.$store
                .dispatch("deleteRoleID", id)
                .then((response) => {
                    let status = response.data.status;
                    if (status == "success") {
                        this.loadRoles(this.rolesUpdateID);
                    } else if (status == "warning") {
                        this.toast(status, "Please review your inputs.");
                    } else if (status == "error") {
                        this.toast(status, response.data.message);
                    }
                 })
                .catch((error) => {
                    this.toast("error", "Something went wrong");
            });
        },
        submitFormRoles: function () {
        var formData = new FormData(document.getElementById("form-roles"));
        document.getElementById("button-submit-role").disabled = true;
        this.$store
            .dispatch("insertSystemRoles", formData)
            .then((response) => {
            let status = response.data.status;
            if (status == "success") {
                this.toast(status, response.data.message);
                this.loadRoles(this.rolesUpdateID);
                this.clearFormRoles();
            } else if (status == "warning") {
                Object.keys(response.data.data).forEach((key) => {
                this.formroles[key]["state"] = false;
                this.formroles[key]["validation"] = response.data.data[key][0];
                });
                this.toast(status, "Please review your inputs.");
            } else if (status == "error") {
                this.toast(status, response.data.message);
            }
            })
            .catch((error) => {
            this.toast("error", "Something went wrong");
            console.log(error);
            })
            .finally(() => {
            document.getElementById("button-submit-role").disabled = false;
            });
        },
    }
 
}
</script>
<style lang="scss">
.Admin {
    background-color:#eef2f3;
    padding: 0%; 
    margin: 0%;
    width: 100%;
    height: 100%;
}

.header-circle{
    background-color: white;
    border-radius: 50%;
    height:650px;
    width:650px;
    margin-top: -100px;
    margin-left: -100px;
    position: absolute;
}

.header--title {
    margin-bottom: 300px;
    font-family: MontserratLight;

    .laptopHuman {
        height:350px;
        margin-top: 200px;
        margin-left: 125px;
    }

    .content--right {
        margin-top: 300px;
        margin-left: 150px;
        .system-title {
            padding-bottom: 60px;

            h1 {
                font-size: 60px;
                font-weight: 900;
            }

            h2 {
                font-size: 50px;
                font-weight: 900;
            }

            .line__red
            {
             
                height: 5px;
                width: 0%;
                position: absolute;
                animation: line_slide 0.7s;
                animation-fill-mode: forwards;
                animation-delay: 0.1s;
            }
            
            p {
                font-size: 25px;
                
            }
        }
    }
}

.body-circle {
    background: white;
    border-radius: 50% 50% 0% 0%;
    margin-bottom: 0;
    padding: 0;
    width: 100%;
    height: auto;
    padding-bottom: 50px;;
    
    
}

.body--management {
    
    padding-top: 5%;
    width: 100%;
    text-align: center;
    margin-bottom: 50px;
     font-family: MontserratLight;
    
    p {
        width: 300px;
        margin-left: 42%;
        margin-right: 42%;
    }

    .body--image {
        height:300px;
        margin-top: -120px;
        margin-left: 1000px;
    }
   

}

.footer--management {
    padding: 0;
    margin: 0px 200px 0px 200px;
    
 
   .alpha__table__pagination button.page-link {
        background: #c82333;
        
    }

  
 
}
.footer--role {
    .alpha__table__pagination_role button.page-link {
        background: #c82333;
     }
}
    

    .page-link {
        color: white;
    }

    th {
        background: #e84656 ;
        color: white;
    }


</style>