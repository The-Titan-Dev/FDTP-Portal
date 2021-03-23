<template>
    <div>
        <b-modal id="set-admin-account-modal" size="lg" hide-footer>
            <b >Add Admin Account to System</b>
            <div class="mt-5">

                {{employee_number}}
                <div class="left-panel">
                    <img :src="'images/search_image.svg'" alt="Search Image" class="search_image mb-4"/>
                        Set this user as an administrator account for the systems listed below.
                    <b-form-select v-model="selected_system" :options="options_system" class="form_select" @change="load_system_roles"></b-form-select>
                    <b-form-select v-model="selected_roles" :options="options_roles" class="form_select"></b-form-select>
                    <b-button variant="danger" class="btn btn-primary form_button">Add Role</b-button>
                </div>
                <div class="right-panel">
                     <b-table  hover :items="items"  no-border-collapse style="border: solid 1px lightgray;"></b-table>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "SetAdminAccount",
    props: {
        employee_number : Number,
        default: 1
    },
    data() {
      return {
        items: [
          { age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          { age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          { age: 89, first_name: 'Geneva', last_name: 'Wilson' },
          { age: 38, first_name: 'Jami', last_name: 'Carney' }
        ],
        selected_system: null,
        options_system: [
          { value: null, text: 'Please select a system' },
        //   { value: 'a', text: 'This is First option' },
        //   { value: 'b', text: 'Selected Option' },
        //   { value: { C: '3PO' }, text: 'This is an option with object value' },
        //   { value: 'd', text: 'This one is disabled', disabled: true }
        ],
        selected_roles: null,
        options_roles: [
            { value: null, text: 'Please select a role' }
        ]
      
      }
    },
    mounted() {
        this.load_system_names()
    },
    methods:{
        load_system_names(){
            this.$store.dispatch("loadSystemManagement")
            .then(response => {
                

                for(const[key,value] of Object.entries(response.data))
                {
                    this.options_system.push({
                        "value": value.id,
                        text   : value.name
                    })
                }
            })
        },
        load_system_roles(){
            this.$store.dispatch("loadSystemRole", this.selected_system)
            .then(response => {
                this.options_roles = [
                    { value: null, text: 'Please select a role' }
                ];
                this.selected_roles = null;
                for(const[key,value] of Object.entries(response.data))
                {
                    this.options_roles.push({
                        "value": value.id,
                        text   : value.role
                    })

                }
            })
        }
    }
}
</script>

<style lang="scss" scoped>
    @import "../../sass/variables";
    .left-panel{
        // border: solid 3px blue;
        float: left;
        width: 40%;
        text-align: center;
        padding: 20px;
        .search_image{
            width: 90%;
        }
        .form_select
        {
            margin-top: 10px;
        }
        .form_button
        {
            width: 80%;
            margin-top: 10px;
        }
    }

    .right-panel{
        // border: solid 3px red;
        float: right;
        width: 60%;
    }
    
</style>