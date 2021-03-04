<template>
    <div style="font-family: MontserratLight">
        <div class="circle__wrapper" style="">
            <div class="circle"></div>
        </div>
        <b-row>
            <b-col xl="8" lg="12" md="12">
                <img :src="'images/pc.png'" class="image__pc" />
            </b-col>
            <b-col xl="4" lg="12" md="12">
                <div class="title__container">
                    <span style="font-size: 85px;" class="color-black">FDTP</span>
                    <br>
                    <span style="font-size: 75px;" class="color-black">SYSTEMS</span>
                    <br>
                    <span class="line__red"></span>
                    <div class="title__tagline">
                        " Welcome to our new all-in-one business solution portal. Having only one account to access all new incoming systems. "
                        <div class="title__controls">
                            <button class="title__btn">GET STARTED</button>
                        </div>
                    </div> 
                </div>
            </b-col>
            <b-col xl="12">
                <div class="system_list text-center" id="system_list">
                    <svg id="computer-24px" xmlns="http://www.w3.org/2000/svg" width="116.969" height="89.253" viewBox="0 0 116.969 89.253">
                        <path id="Path_5" data-name="Path 5" d="M0,0H116.969V89.253H0Z" fill="none"/>
                        <path id="Path_6" data-name="Path 6" d="M97.474,75.1a9.947,9.947,0,0,0,9.7-10.157l.049-50.783A9.988,9.988,0,0,0,97.474,4H19.495A9.988,9.988,0,0,0,9.747,14.157V64.94A9.988,9.988,0,0,0,19.495,75.1H0V85.253H116.969V75.1ZM19.495,14.157H97.474V64.94H19.495Z" fill="#242424"/>
                    </svg>
                    <br>
                    <div class="system_list__title mt-1">
                    FDTP SYSTEMS
                    </div>
                    
                    <div class="system_list__details">
                        Connecting all your system access in one portal for easy access.<br>
                        You can request to the System Administrator or Section heads <br>if the system you're looking for is not on the list.<br>
                    </div>

                    <div class="system_list__content">
                        <b-row v-if="user_count > 0">
                            <b-col xl="4" lg="12" v-for="user_data in user_info" :key="user_data.id">
                                <ACard 
                                    :system_description="user_data.description"
                                    :system_name="user_data.name"
                                    :system_path="user_data.url">
                                </ACard>
                            </b-col>
                        </b-row>
                        <b-row v-if="user_count == 0">
                            <b-col lg="12">
                               <h3>You have no access to any system. Contact your section head to add your account in a system.</h3>
                            </b-col>
                        </b-row>
                    </div>
                </div>
            </b-col>
        </b-row>
        {{user_count}}
        <!-- <div class="row" style="position:relative;z-index: 2;">

            <div class="col-xl-12">
               
            </div>
        </div>  -->
        
    </div>    
</template>

<script>
import ACard from "../components/ACard.vue";
import {mapGetters} from 'vuex';
export default {
    name: "Home",
    components:{
        ACard
    },
    data(){
        return{
            user_info : [],
            user_count : 0
        }
    },
    mounted(){
        this.get_userdata()
    },
    methods:{
        get_userdata(){
            
            let lstorage = JSON.parse(localStorage.getItem('userdata'));
            this.user_info = lstorage.data.data.systems;
            if (this.user_info !== undefined)
            {
                this.user_count = this.user_info.length;
            }
        },
    },
    
}
</script>

<style lang="scss">
    @import "../../sass/variables";
    @import "../../sass/mediascreens";
    @import "../../sass/main";
  
    .color-black{
        color: $black;
    }
   
    
    .image__pc{
        width: 85%;
        left: 15%;
        top: 20%;
        opacity: 0;
        position: inherit;
        animation: fadeIn 1s;
        animation-fill-mode: forwards;
    }

    .title__container{
        line-height: 40px;
        position: inherit;
        top: 25%;
        padding-top: 10%;
        padding-left: 5%;
        padding-right: 5%;
        font-family: MontserratLight;
        animation: fadeIn 0.5s;
        

        .title__tagline{
            margin-top: 20px;
            line-height: 35px;
            font-size: 30px;
            font-family: MontserratLightItalic;
            color: $black;
            // border: solid 3px black;
            position: absolute;
            left: 100%;
            animation: slideToLeft 0.5s;
            animation-fill-mode: forwards;
            height: 100%;
            width: 100%;
            padding-left: 5%;
        }

        .title__btn{
            background: linear-gradient(160deg, #ff4f5a, #d0242f);
            color: white;
            border: 0;
            box-shadow: 0 0 5px $black;
            padding: 5px 20px 5px 20px;
            outline: none;
            font-size: 20px;
            font-family: MontserratLight;
            transition: ease 1s;
            opacity: 0;
            animation: fadeIn 1s;
            animation-fill-mode: forwards;
            animation-delay: 0.4s;
        }

        .title__btn:hover{
            background: linear-gradient(160deg, #ef7a81, #e25059);
        }

        .title__controls
        {
            text-align: center;
            margin-top: 10%;
        }
    }



    .line__red
    {
        background: $prime;
        height: 5px;
        width: 0%;
        position: absolute;
        animation: line_slide 0.7s;
        animation-fill-mode: forwards;
        animation-delay: 0.1s;
    }


    .system_list{
        border-radius: 40% 40% 0 0;
        background-color: white;
        // position: absolute;
        // width: 138%;
        // height: 100vh;
        // top: 180px;
        // left:-18%;
        padding-top: 25px;

        width: 150%;
        height: 100vh;
        padding-top: 25px;
        margin-top: 235px;
        margin-left: -25%;
        
        &__laptop{
        color: $black;
        }

        &__title{
            color: $black;
            font-size: 60px;
        }

        &__details{
            color: $black;
        }

        &__content{
            // border: solid 3px black;
           width: 100vw;
            position: absolute;
            left: 0%;
            padding: 50px;
            background-color: white;
        }
    } 


    @keyframes line_slide{
        0%{
            width: 0%;
        }
        100%{
            width: 90%
        }
    }

    @keyframes fadeIn{
        0%{
            opacity: 0;
        }
        100%{
            opacity: 1;
        }
    }

    @keyframes slideToLeft{
        0%{
            left: 100%;
        }
        100%{
            left: 0%;
        }
    }

    @keyframes slideToRight{
        0%{
            right: 100%;
        }
        100%{
            right: 0%;
        }
    }

    @keyframes growImg{
        0%{
            width: 0%;
            left: 0%;
        }
        100%{
            width: 85%;
            left: 15%;
        }
    }

</style>