<template>
  <section class="login container my-5">
    <div class="row justify-content-center no-gutters">
      <div class="col-12 col-md-5">
        <div class="admin">
          <div class="py-4 container">
            <h1 class="my-0 pt-4 pb-4 login__title">管理員登入</h1>
            <div class="form-group row mx-2 justify-content-center">
              <label for="email" class="col-2 col-form-label label--bg py-3"><i class="fa fa-user"></i></label>
              <input type="email" class="form-control py-3 col-10 input--bg" id="email" v-validate="'required|email'"
                name="email" v-model="user.account" placeholder="電子信箱">
            </div>
            <span class="row justify-content-center text-warning"><strong>{{ errors.first('email') }}</strong></span>
            <div class="form-group row m-2">
              <label for="password" class="col-2 col-form-label label--bg py-3"><i class="fa fa-key"></i></label>
              <input v-validate="'required|alpha_num'" type="password" class="form-control py-3 col-10 input--bg" id="password"
                name="password" placeholder="請輸入密碼" v-model="user.password">
            </div>
            <span class="row justify-content-center text-warning"><strong>{{ errors.first('password') }}</strong></span>
          </div>
          <button class="btn btn-successColor py-3 btn-block" @click="login"><strong>登入後台</strong></button>
        </div>
      </div>
    </div>
  </section>
</template>

<script type="text/ecmascript-6">
import Vue from "vue";
import VeeValidate, { Validator } from "vee-validate";
import zh_TW from "vee-validate/dist/locale/zh_TW";
Vue.use(VeeValidate);
Validator.localize("zh_TW", zh_TW);
export default {
  data() {
    return {
      user: {
        account: "",
        password: ""
      }
    };
  },
  methods: {
    login() {
      this.$validator.validate().then(result => {
      if (result) {
      if (
        this.user.account === "admin@test.com" &&
        this.user.password === "admin"
      ) {
        let userData={
          account:this.user.account,
          password:this.user.password,
          isLogin:true
        }
        this.$store.commit("setUserData", userData)
        this.$router.push("/admin/adminDessert");
        }else {
          return alert('登入失敗，請重新登入')
      }
        }})
    }
  }
};
</script>

<style scoped lang="scss">
@import "../assets/css/base.scss";

.admin {
  background-color: $primaryColor;
  color: white;
}

i {
  font-size: 1.875rem;
  color: $primaryColor;
}

.login__title {
  font-size: 1.875rem;
}

.btn-successColor {
  background-color: $successColor;
  border-radius: 0;
  color: $primaryColor;
  font-size: 1.125rem;

  &:hover {
    background-color: darken($successColor, 10%);
  }
}

.label--bg,
.input--bg {
  background-color: $infoColor;
  border-radius: 0;
  border-color: $infoColor;
}

.card {
  background-color: $infoColor;
}

.card-title {
  font-weight: 900;
  color: lighten($primaryColor, 30%);
}
</style>
