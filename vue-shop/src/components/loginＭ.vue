<template>
  <section class="login container my-5">
    <div class="row justify-content-center no-gutters">
      <div class="col-12 col-md-5">
        <form class="member">
          <div class="py-4 container">
            <h1 class="my-0 pt-4 pb-md-5 login__title">會員登入</h1>
            <div class="card-body row  d-sm-none">
              <button class="btn btn-light col"><img src="../assets/img/ic-facebook-logotype.svg" alt="fb-link"
                  height="10"></button>
              <button class="btn btn-light col mx-1"><img src="../assets/img/ic-google.svg" alt="fb-link" height="10"></button>
              <button class="btn btn-light col"><img src="../assets/img/ic-yahoo.svg" alt="fb-link" height="10"></button>
            </div>
            <div class="form-group row mx-2 justify-content-center">
              <label for="email" class="col-2 col-form-label label--bg py-3"><i class="fa fa-user"></i></label>
              <input type="email" class="form-control py-3 col-10 input--bg" id="email" v-validate="'required|email'"
                name="email" placeholder="電子信箱">
            </div>
            <span class="row justify-content-center">{{ errors.first('email') }}</span>
            <div class="form-group row m-2">
              <label for="password" class="col-2 col-form-label label--bg py-3"><i class="fa fa-key"></i></label>
              <input v-validate="'required|alpha_num'" type="password" class="form-control py-3 col-10 input--bg" id="password"  name="password" placeholder="請輸入使用者密碼">
            </div>
            <span class="row justify-content-center">{{ errors.first('password') }}</span>
          </div>
          <button type="submit" class="btn btn-successColor py-3 btn-block">登入帳號</button>
        </form>
      </div>
      <div class="col-12 col-md-5 mt-3 d-none d-sm-block">
        <div class="card text-center">
          <div class="card-body pb-5">
            <h4 class="card-title py-2">—— 連結社群帳號 ——</h4>
            <button class="btn btn-light py-3 btn-block"><img src="../assets/img/ic-facebook-logotype.svg" alt="fb-link"
                width="108"></button>
            <button class="btn btn-light py-3 btn-block my-4"><img src="../assets/img/ic-google.svg" alt="fb-link"
                width="94"></button>
            <button class="btn btn-light py-3 btn-block"><img src="../assets/img/ic-yahoo.svg" alt="fb-link" width="97"></button>
          </div>
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
    return {};
  },
  components: {}
};
</script>

<style scoped lang="scss">
@import "../assets/css/base.scss";

form {
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
