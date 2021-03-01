<template>
  <b-container fluid >
    <b-row>
      <b-col>
        <AHeader></AHeader>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="p-0">
        <div class="body">
          <router-view></router-view>
        </div>
      </b-col>
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
  width: 100%;
  min-height: 100vh;
  background:#e9ecec;
}
</style>