<template>
    <div class="footer">
        
        <div class="footer__line">
            Copyright © 2021 FDTP. All Rights Reserved. 
        </div>
    </div>    
</template>

<script>
export default {
    name: "Footer"
}
</script>


<style lang="scss">
    @import "../../sass/variables";
    @import "../../sass/mediascreens";
    @import "../../sass/main";
  

    .footer{
        background-color: $prime;
        height: 500px;
        width: 100%;
        position: absolute;
        left:0%;
        // bottom: 0px;

        &__line{
            background-color: $violet;
            height: 50px;
            width: 100%;
            position:absolute;
            bottom: 0;
            text-align: center;
            color: $white;
            padding-top: 10px;
        }
    }
</style>