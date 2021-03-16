<template>
    <div class="user-account-modal">
        <div class="user-triangle"></div>
        <a class="nav-a" v-b-modal.modal-change-pw><font-awesome-icon icon="unlock-alt" />&nbsp;Change Password</a>
        <hr>
        <a  class="nav-a" @click="showModal"><font-awesome-icon icon="sign-out-alt" />&nbsp;Logout</a>
        
        <b-modal id="modal-change-pw" title="Change Password" hide-footer no-close-on-esc no-close-on-backdrop>
            <div  style="margin-top: 15%">
                 <b-form
                    class="pl-4 pr-4"
                    id="form-change-pw"
                    @submit.prevent="submitForm"
                    method="post"
                    >
                    <b-form-group class="mb-4" id="input-group-system-name" label="Current Password :" label-class="user__label" label-for="current_password" >
                        <b-form-input  class="alpha-input" id="current_password" name="current_password" :type="show_pw_status" placeholder="Input text here" required /> 
                    </b-form-group>
                    <b-form-group class="mb-4" id="input-group-system-name" label="New Password :" label-class="user__label" label-for="password" 
                    description="Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character">
                        <b-form-input  class="alpha-input" id="password" name="password" :type="show_pw_status" placeholder="Input text here" required /> 
                    </b-form-group>
                    <b-form-group class="mb-4" id="input-group-system-name" label="Confirm Password :" label-class="user__label" label-for="password_confirmation" >
                        <b-form-input  class="alpha-input" id="password_confirmation" name="password_confirmation" :type="show_pw_status" placeholder="Input text here" required /> 
                    </b-form-group>
                    <b-form-checkbox
                        id="checkbox-show-pw"
                        v-model="show_pw_status"
                        name="checkbox-show-pw"
                        value="text"
                        unchecked-value="password"
                        >
                        Show Password
                        </b-form-checkbox>
                     <b-button
                        id="button-submit"
                        type="submit"
                        title="Click to add new register system"
                        variant="danger"
                        class="float-right">
                    <font-awesome-icon icon="save" size="sm" class="icon" />  
                        Change Password
                    </b-button>
                </b-form>
            </div>
        </b-modal>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
export default {
    name: "UserAccountModal",
    computed: {
        ...mapGetters(["get_pw_visibility"])
    },
    data(){
        return {
            show_pw_status : "password"
        }
    },
    mounted() {
        this.$root.$on('bv::modal::hide', (bvEvent, modalId) => {
            console.log('trigger')
            this.$store.dispatch("changeVisibility", this.get_pw_visibility)
        })
    },
    methods:{
        showModal:function(){
            this.$store.dispatch('addLogoutConfirmation',{
                    variant: "primary",
            });
        },

        submitForm(){
            //submit change password
            let formData = new FormData(document.getElementById('form-change-pw'));
            formData.append("_method", "patch");
            this.$store.dispatch("changePassword",formData)
            .then((response) => {
                console.log(response);
                if(response.data.status.toLowerCase() == "success")
                {
                    this.toast(response.data.status,response.data.message);
                    document.getElementById("form-change-pw").reset();
                    this.$bvModal.hide("modal-change-pw");
                    this.show_pw_status = "password"
                }
                else
                {
                    this.toast(response.data.status,response.data.data);
                }
              
            }).catch((error)=>{
                let error_data = error.data;
                let status = error.status;
                for(const[key] of Object.entries(error_data.password))
                {
                    this.toast(status,error_data.password[key]);
                };
                
            })
        },

        toast: function (status, message) {
            this.$toast(message, {
                type: status,
                toastClassName: `toastification--${status}`,
                position: "top-center",
            });
         },
        
    }
}
</script>

<style lang="scss">
@import "../../sass/variables";
    .user-account-modal
    {
        background-color: white;
        height: 115px;
        width: 180px;
        border-radius: 5px;
        position: absolute;
        right: 1%;
        top: 90%;
        box-shadow: 0 0 3px rgb(211, 211, 211);
        padding: 15px;
        cursor: pointer;
        & a{
            color: $black;
        }
        & a:hover {
            text-decoration: none;
            color: $red;
        }

        .user-triangle
        {
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            border-bottom: 15px solid white;
            
            position: absolute;
            top: -10%;
            right: 35%;

        }
    }

    .user__label{
        font-weight: bold;
    }
    
</style>