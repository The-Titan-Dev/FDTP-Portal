<template>
  <div class="parent__body">
    <b-container fluid>
      <b-row align-h="between" class="vh-100 text-center" align-v="center">
        <b-col class="d-lg-block d-md-none d-sm-none d-none"> </b-col>
        <b-col xl="5" lg="6" class="d-flex justify-content-center">
          <div class="login__box">
            <div class="block__1">
              <label class="login__label">Let's get you started</label>
              <div class="block__1__image">
                <img :src="'images/girl_laptop.png'" class="image__laptop" />
              </div>
            </div>
            <!-- <b-form
                class="pl-4 pr-4"
                id="form-registration"
                @submit.prevent=""
                method="post"
              >
                <b-row>
                  <b-col cols="12" class="mb-2">
                    <b-form-group label="Employee ID" label-for="input-emp-id">
                      <b-form-input
                        id="input-emp-id"
                        name="emp_id"
                        type="text"
                        placeholder="Enter Employee ID"
                        required
                      />
                    </b-form-group>
                  </b-col>
                </b-row>

                <b-row>
                  <b-col cols="12" class="mb-2">
                    <b-form-group label="Password" label-for="input-password">
                      <b-form-input
                        id="input-password"
                        name="password"
                        type="password"
                        placeholder="Enter Password"
                        required
                      />
                    </b-form-group>
                  </b-col>
                </b-row>
              </b-form> -->
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  name: "login",
};
</script>

<style lang="scss">
@import "../../sass/variables.scss";

.parent__body {
  width: 100%;
  height: 100vh;
  background-color: $white;
}

.login__box {
  width: 450px;
  height: 600px;
  background: linear-gradient(340deg, $red, $prime);
  border-radius: 50px;
}

.block__1__image {
  width: 250px;
  float: right;
  margin-right: -70px;
  .image__laptop {
    width: 100%;
    height: auto;
  }
  .login__label{

  }
}
</style>