<template>
  <div class="orderPage container">
    <section class="jumbotron row align-content-center">
      <div class="col-md-12 justify-content-center pb-4">
        <img src="../assets/img/order-title.svg" alt="付款成功" width="200">
      </div>
      <div class="col-md-12 justify-content-center">
        <router-link :to="{name:'dessert'}" class="btn success-btn">繼續逛逛</router-link>
      </div>
    </section>
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

<style scoped lang="scss">
  @import "../assets/css/base.scss";

  .jumbotron {
    height: 31.25rem;
    background-image: url("../assets/img/order.jpeg");
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    border-radius: 0;
  }

  .success-btn {
    background-color: $successColor;
    color: $primaryColor;
    border-radius: 0;
    font-size: 1.25rem;
    font-weight: 900;
    padding: 0.625rem 6.25rem;

    &:hover {
      background-color: darken($successColor, 10%);
    }
  }

</style>
