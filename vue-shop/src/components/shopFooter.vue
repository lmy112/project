<template>
  <div class="shop-footer">
    <div class="email__container container-fluid">
      <div class="container justify-content-center py-2">
        <div class="row align-items-center">
          <div class="col-12 col-md-5">
            <img src="../assets/img/logo-light.svg" alt="logo" class="email__container__brand mr-md-1" width="38">
            <h4 class="email__container__text d-inline align-middle">訂閱你我的甜蜜郵件</h4>
          </div>
          <div class="input-group col-12 col-md-5">
            <div class="input-group-prepend">
              <span class="input-group-text pt-3 pb-3"><img src="../assets/img/ic-email.svg" alt="Email"></span>
            </div>
            <input type="email" class="form-control input-email pt-3 pb-3" placeholder="Email">
            <div class="input-group-append">
              <button class="btn btn-success pt-3 pb-3" type="button"><img src="../assets/img/ic-sendEmail.svg" alt="sendEmail">
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="jumbotron jumbotron-fluid py-4 mb-0">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-5 text-left mt-0">
            <img src="../assets/img/logo_name.svg" alt="logo_name" height="27" class="mb-5">
            <p class="text-left mt-md-5">
              07-1234-5678<br />
              sweetaste@email.com<br />
              800 高雄市新興區幸福路 520 號
            </p>
          </div>
          <div class="col-md-5 d-none d-sm-block">
            <div class="row justify-content-center">
              <div class="col-md text-right">
                <img src="../assets/img/footer-title.svg" alt="logo_name" width="60">
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center pt-2">
          <div class="col-md-5 text-left align-middle">
            <img src="../assets/img/ic-line@.svg" alt="line" width="32">
            <img src="../assets/img/ic-facebook.svg" alt="fb" width="32">
          </div>
          <div class="d-none d-sm-block col-md-5 text-right pt-2">
            <span class="align-middle">© 2018 Sweetaste* All Rights Reserved</span>
          </div>
          <div class="d-block d-sm-none text-left col-12 pt-2">
            <span>© 2018 Sweetaste* All Rights Reserved</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/ecmascript-6">
  export default {
    data() {
      return {};
    },
    components: {}
  };

</script>

<style lang="scss" scoped>
  @import "../assets/css/base.scss";

  .input-group {
    min-width: 15.625rem;
    max-width: 31.25rem;
    margin: 0.625rem auto;
  }

  .email__container {
    background-color: $primaryColor;
  }

  .email__container__brand {
    max-width: 4.375rem;
  }

  .email__container__text {
    color: white;
    margin: 0;
  }

  .input-group-text,
  .input-email {
    background-color: $infoColor;
    border-color: $infoColor;
    border-bottom: none;
  }

  .btn-success {
    background-color: $successColor;
    border: none;

    &:hover {
      background-color: darken($successColor, 10%);
    }
  }

</style>
