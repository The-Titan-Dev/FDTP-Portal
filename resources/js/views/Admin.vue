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
                        <hr>
                        <p>Fujitsu grows so do its requirements, as well as the need to efficiently manage and safeguard IT and data assets so we centralized system monitoring.<br><small>- DaileDreamer</small></p>
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
                <p>Fujitsu grows so do its requirements, as well as the need to efficiently manage and safeguard IT and data assets so we centralized system monitoring.<br><small>- DaileDreamer</small></p>
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
                        >
                        <font-awesome-icon icon="plus-square" size="lg" class="icon" /> 
                        REGISTER NEW SYSTEM
                        </b-button>
                    </b-col>

                    <b-col sm="12" md="6" lg="5" xl="3" class="mb-2">
                        <b-input-group>
                        <b-form-input
                            id="filter-input"
                            v-model="filter"
                            type="search"
                            placeholder="Type to Search"
                        >
                        </b-form-input>
                        <b-input-group-append>
                            <b-button
                            type="button"
                            size="md"
                            class="btn btn-danger"
                            :disabled="!filter"
                            @click="filter = ''"
                            >
                            <font-awesome-icon icon="eraser" size="sm" class="icon" />
                            Cancel
                            </b-button>
                        </b-input-group-append>
                        </b-input-group>
                    </b-col>
                </b-row>

                <b-table
                id="system_management_table"
                class="alpha__table text-nowrap"
                hover
                bordered
                responsive
                :fields="fields"
                :filter="filter"
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
                    @click="loadRoles(data.item.id)"
                    >
                  
                    <font-awesome-icon icon="clipboard-list" size="sm" class="icon" /> 
                    Add Role
                    </b-button>
                
                </template>
                </b-table>

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
        <!-- <b-modal
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
                <b-col cols="3" class="mb-2">
                    <b-form-group
                    id="input-group-system-name"
                    label="System Name :"
                    label-class="alpha__form__label"
                    label-for="input-system-name"
                    >
                        <b-form-input
                        class="alpha-input"
                        id="input-system-name"
                        name="systemName"
                        type="text"
                        placeholder="Enter system name"
                        required
                        /> 
                    </b-form-group>
                </b-col>
                <b-col cols="3" class="mb-2">
                    <b-form-group
                    id="input-group-abbrevation"
                    label="System Name :"
                    label-class="alpha__form__label"
                    label-for="input-system-name"
                    >
                        <b-form-input
                        class="alpha-input"
                        id="input-system-name"
                        name="systemName"
                        type="text"
                        placeholder="Enter system name"
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
                size="sm"
                class="mr-2"
              
              >
                Cancel
              </b-button>
              <b-button
                id="button-submit"
                type="submit"
                title="Click to add new register system"
                variant="danger"
              >
                <font-awesome-icon icon="save" size="sm" class="icon" />Save
                Information
              </b-button>
            </div>
          </b-form>
        </b-modal> -->

      
    </div>
    
</template>

<script>
import { mapGetters } from "vuex";
export default {
        name:"Admin",
        data() {
        return {
            currentPage: 1,
            perPage: 10,
            filter: null,
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
        ]
        };
    },
        
    mounted() {
        this.loadTable();
    },
    computed: {
        ...mapGetters(["getSystemManagement"]),
        rows() {
        if (!this.getSystemManagement.data) {
            return 1;
        } else {
            return this.getSystemManagement.data.length;
        }
        },
    },
    methods: {
        loadTable: function () {
            this.$store.dispatch("loadSystemManagement").then((result) => {
                this.toast(result.status, result.message);
            });
        },
        loadRoles: function(id) {
            alert(id);
        }
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

    .laptopHuman {
        height:300px;
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
            }

            h2 {
                font-size: 50px;
            }

            hr {
                background: red;
                font-weight: 2em;
                width: 600px;
            }
            
            p {
                font-size: 25px;
                
            }
        }
    }
}

.body-circle {
    background: white;
    border-radius: 70% 70% 0% 0%;
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

    .page-link {
        color: white;
    }

    th {
        background: #e84656 ;
        color: white;
    }
 
}

</style>