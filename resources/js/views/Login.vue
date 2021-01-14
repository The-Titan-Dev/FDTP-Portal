<template>
  <div class="parent__body">
    <b-container fluid>
      <!-- <div class="headerline"></div> -->
      <img :src="'images/fujitsu.png'" class="fujitsu" />
      <!-- <div class="ball2"></div>
      <div class="ball3"></div> -->
      <b-row align-h="between" class="vh-100" align-v="center">
        <b-col class="d-lg-block d-md-none d-sm-none d-none">
          <div class="left__pane">
            <!-- <div class="ball1"></div> -->

            <div class="image__block">
              <div class="label__image__1__block">
                <img :src="'images/login_1.PNG'" class="label__image__1" />
              </div>
              <div class="label__image__2__block">
                <img :src="'images/login_2.PNG'" class="label__image__2" />
              </div>
            </div>
            <div class="label__block">
              <label class="title"> FDTP<br />SYSTEMS </label>
              <br />
              <hr />
              <p>
               " Welcome to our new all-in-one business solution portal.<br />
                Having only one account to access all new incoming systems. "
              </p>
            </div>
          </div>
        </b-col>
        <b-col xl="5" lg="6" class="d-flex justify-content-center">
          <div class="login__box">
            <div class="block__1">
              <label class="login__label">Let's get you started</label>
              <div class="block__1__image">
                <img :src="'images/girl_laptop.png'" class="image__laptop" />
              </div>
            </div>
            <form id="form-login" class="form__login" method="post">
              <div class="form__login__group">
                <label>Employee Number</label>
                <input type="text" />
              </div>
              <div class="form__login__group mb-3">
                <label>Password</label>
                <input type="password" />
              </div>
              <button type="button" class="login__btn__ok">Login</button>
              <button type="button" class="login__btn__cancel">Cancel</button>
            </form>
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
@import "../../sass/variables";
@import "../../sass/mediascreens";
.parent__body {
  width: 100%;
  height: 100vh;
  background-color: white;
  overflow: hidden;
}

.headerline {
  position: fixed;
  top: 0;
  height: 4px;
  width: 100%;
  background: $red;
  left: 0;
}

.login__box {
  width: 450px;
  height: 600px;
  background-image: url(http://10.164.58.130/fdtp-portal/public/images/redbkg.jpg);
  border-radius: 50px;
  box-shadow: 12px 10px 25px #7d7c7c;
}

.block__1 {
  display: flex;

  .login__label {
    color: white;
    width: 50%;
    font-family: Rubik;
    font-size: 40px;
    float: left;
    text-align: left;
    padding: 40px 0px 0px 15px;
    text-shadow: 7px -4px #ef7b8799;
  }

  .block__1__image {
    width: 270px;
    float: right;
    margin-right: -50px;
    .image__laptop {
      width: 100%;
      height: auto;
      animation: sway 2s infinite ease-in-out;
    }
  }
}

@keyframes sway {
  0% {
    transform: rotate(0deg);
  }
  50% {
    transform: rotate(2deg);
  }
  100% {
    transform: rotate(0deg);
  }
}

@keyframes sway1 {
  0% {
    transform: rotate(0deg);
  }
  50% {
    transform: rotate(1deg);
  }
  100% {
    transform: rotate(0deg);
  }
}

.form__login {
  display: block;
  text-align: left;
  padding: 20px 0px 0px 20px;
  font-family: PoppinsRegular;
  &__group {
    label {
      color: white;
      display: block;
      font-size: 20px;
      margin-bottom: 5px;
    }
    input {
      margin-bottom: 20px;
      border: 0;
      border-radius: 5px;
      outline: none;
      width: 75%;
      height: 35px;
      padding: 10px;
    }
  }

  .login__btn__ok {
    border: 0;
    border-radius: 20px;
    padding: 10px 20px 10px 20px;
    width: 150px;
    background: linear-gradient(160deg, #ff4f5a, #d0242f);
    color: white;
    outline: none;
    transition: all 0.3s;
  }

  .login__btn__ok:hover {
    background: linear-gradient(160deg, #ef7a81, #e25059);
  }

  .login__btn__ok:active {
    font-size: 15px;
  }

  .login__btn__cancel {
    border: 0;
    border-radius: 20px;
    padding: 10px;
    width: 100px;
    background: transparent;
    color: white;
    outline: none;
    transition: 1s;
  }
  .login__btn__cancel:hover {
    color: #ff9393;
  }
}

@include lg {
  .login__box {
    width: 400px;
    height: 560px;
  }

  .block__1 {
    .login__label {
      font-size: 37px;
    }

    .block__1__image {
      width: 247px;
    }
  }

  .form__login {
    &__group {
      label {
        font-size: 18px;
      }
      input {
        margin-bottom: 20px;
        border: 0;
        border-radius: 5px;
        outline: none;
        width: 75%;
        height: 33px;
        padding: 10px;
      }
    }
  }
}

.left__pane {
  width: 100%;
  height: 100%;
  position: relative;
}

.label__block {
  position: absolute;
  top: -80px;
  left: 5%;
  .title {
    font-size: 80px;
    font-family: MontserratLight;
    line-height: 90%;
    color: $red;
  }
  p {
    margin-top: 20px;
    font-size: 23px;
    font-family: MontserratLightItalic;
    color: #8c898a;
  }

  hr {
    border: .5px solid $red;
  }
}

.image__block {
  position: absolute;
  width: 600px;
  height: 500px;
  top: -250px;
  left: 250px;
}

.label__image__1__block {
  width: 600px;
  position: absolute;
  z-index: 2;
  left: 130px;
  .label__image__1 {
    width: 100%;
    height: auto;
    animation: sway1 2s infinite ease-in-out;
  }
}

.label__image__2__block {
  width: 570px;
  position: absolute;
  z-index: 1;
  top: -110px;
  .label__image__2 {
    width: 100%;
    height: auto;
    animation: sway1 2s infinite ease-in-out;
  }
}

.ball1 {
  position: absolute;
  width: 2000px;
  height: 2000px;
  background: #c53c49;
  border-radius: 100%;
  top: -495px;
  left: -935px;
  transition: all 1s;
  box-shadow: 0 0 0px 16px #f0a0a8;
}

.fujitsu {
  position: absolute;
  width:150px;
  left:60px;
  top:30px;
}
</style>