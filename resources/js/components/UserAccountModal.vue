<template>
    <div class="user-account-modal" >
        <a class="nav-a" v-b-modal.modal-1><font-awesome-icon icon="unlock-alt" />&nbsp;Change Password</a>
        <hr>
        <a  class="nav-a" @click="showModal"><font-awesome-icon icon="sign-out-alt" />&nbsp;Logout</a>

        <b-modal id="modal-1" title="Change Password" hide-footer no-close-on-esc no-close-on-backdrop>
            <div  style="margin-top: 15%">
                 <b-form
                    class="pl-4 pr-4"
                    id="form-registration1"
                    @submit.prevent="submitForm"
                    method="post"
                    >
                    <b-form-group id="input-group-system-name" label="Current Password :" label-class="alpha__form__label" label-for="input-system-name" >
                        <b-form-input  class="alpha-input" id="input-current-password" name="current_password" type="password" placeholder="Input text here" required /> 
                    </b-form-group>
                    <b-form-group id="input-group-system-name" label="New Password :" label-class="alpha__form__label" label-for="input-system-name" >
                        <b-form-input  class="alpha-input" id="input-new-password" name="password" type="password" placeholder="Input text here" required /> 
                    </b-form-group>
                    <b-form-group id="input-group-system-name" label="Confirm Password :" label-class="alpha__form__label" label-for="input-system-name" >
                        <b-form-input  class="alpha-input" id="input-confirm-password" name="password_confirmation" type="password" placeholder="Input text here" required /> 
                    </b-form-group>
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
            console.log('trigger')
        },

        openCloseUserModal(){
            // this.$store.dispatch("changeVisibility", this.get_pw_visibility)
            // .then(response => {
            //     console.log(response)
            // })
        }
    }
}
</script>

<style lang="scss">
@import "../../sass/variables";
    .user-account-modal
    {
        background-color: white;
        height: 120px;
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
    }
    
</style>