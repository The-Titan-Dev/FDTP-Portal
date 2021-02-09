<template>
  <b-container fluid>
    <AHeader></AHeader>
    <b-row>
    <div class="body">
      <router-view></router-view>
    </div>
    </b-row>
  </b-container>
</template>

<script>
import AHeader from "../components/AHeader.vue";
export default {
  name: "Base",
  components: {
    AHeader,
  },
};
</script>

<style lang="scss">
.body {
  width:100%;
  min-height:100vh;
}
</style>