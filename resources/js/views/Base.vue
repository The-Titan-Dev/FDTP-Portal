<template>
  <b-container fluid>
    <AHeader></AHeader>
    <b-row>
    <div class="body">
      <router-view></router-view>
    </div>
    
    </b-row>
    <AFooter></AFooter>
  </b-container>
</template>

<script>
import AHeader from "../components/AHeader.vue";
import AFooter from "../components/AFooter.vue";
export default {
  name: "Base",
  components: {
    AHeader,
    AFooter
  },
};
</script>

<style lang="scss">
.body {
  width:100%;
  // min-height:100vh;
  height:100%;
  
}

body{
  background-color: #eef2f3;
  overflow-x: hidden;
}

html {
  scroll-behavior: smooth;
}
</style>