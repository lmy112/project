<template>
  <div class="info">
    <section class="home__info container-fluid d-none d-sm-block">
      <div class="row justify-content-between infom">
        <div class="info__img do__img col-12 col-md-4">
        </div>
        <div class="info__description do__description col-12 col-md-4 text-left pt-5">
          <p>
            青山依舊在，幾度夕陽紅。慣看秋月春風。
          </p>
          <p>一壺濁酒喜相逢，浪花淘盡英雄。是非成敗轉頭空，滾滾長江東逝水，白髮漁樵江渚上，古今多少事，都付笑談中。</p>
          <p> 是非成敗轉頭空，滾滾長江東逝水，白髮漁樵江渚上，古今多少事，都付笑談中。</p>
        </div>
        <div class="info__title do__title col-12 col-md-4">
          <img src="../assets/img/home_info_do.svg" alt="info__title" class="img-fluid" width="88">
        </div>
      </div>
    </section>
    <section class="home__info container-fluid d-none d-sm-block">
      <div class="row justify-content-between infom">
        <div class="info__img why__img  col-12 col-md-4">
        </div>
        <div class="info__description why__description col-12 col-md-4 text-left pt-5">
          <p>
            青山依舊在，幾度夕陽紅。慣看秋月春風。
          </p>
          <p>一壺濁酒喜相逢，浪花淘盡英雄。是非成敗轉頭空，滾滾長江東逝水，白髮漁樵江渚上，古今多少事，都付笑談中。</p>
          <p> 是非成敗轉頭空，滾滾長江東逝水，白髮漁樵江渚上，古今多少事，都付笑談中。</p>
        </div>
        <div class="info__title why__title col-12 col-md-4">
          <img src="../assets/img/home__info_why.svg" alt="info__title" class="img-fluid" width="88">
        </div>
      </div>
    </section>

    <section class="home__info--sm container-fluid d-block d-sm-none">
      <div class="row info--sm">
        <div class="info__title--sm do__title--sm col-12 mb-3">
          <img src="../assets/img/sm-do.svg" alt="info__title" class="img-fluid" width="200">
        </div>
        <div class="info__img--sm do__img--sm col-12">
        </div>
        <div class="info__description--sm do__description--sm col-12 text-left py-4">
          <p>
            青山依舊在，幾度夕陽紅。慣看秋月春風。
          </p>
          <p>一壺濁酒喜相逢，浪花淘盡英雄。是非成敗轉頭空，滾滾長江東逝水，白髮漁樵江渚上，古今多少事，都付笑談中。</p>
          <p> 是非成敗轉頭空，滾滾長江東逝水，白髮漁樵江渚上，古今多少事，都付笑談中。</p>
        </div>
      </div>
    </section>
    <section class="home__info--sm container-fluid d-block d-sm-none">
      <div class="row justify-content-between info--sm">
        <div class="info__title--sm why__title--sm col-12 my-3">
          <img src="../assets/img/sm-why.svg" alt="info__title" class="img-fluid" width="200">
        </div>
        <div class="info__img--sm why__img--sm  col-12">
        </div>
        <div class="info__description--sm why__description--sm col-12 text-left py-4">
          <p>
            青山依舊在，幾度夕陽紅。慣看秋月春風。
          </p>
          <p>一壺濁酒喜相逢，浪花淘盡英雄。是非成敗轉頭空，滾滾長江東逝水，白髮漁樵江渚上，古今多少事，都付笑談中。</p>
          <p> 是非成敗轉頭空，滾滾長江東逝水，白髮漁樵江渚上，古今多少事，都付笑談中。</p>
        </div>
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
  @import '../assets/css/base.scss';

.home__info {
  background-color: $infoColor;
  position: relative;
  margin-bottom: 6.25rem;
  height: 26.25rem;
}

.info__title {
  position: absolute;
  top: -1.4375rem;
}

.do__title {
  right: 0;
}

.why__title {
  left: 23.75rem;
}

.info__img {
  position: absolute;
  top: -1.875rem;
  width: 33.75rem;
  height: 29.25rem;
  background-size: 30.625rem 33.75rem;
  background-repeat: no-repeat;
  background-position: center center;
}

.do__img {
  background-image: url("../assets/img/home__info1.jpeg");
  left: 12.5rem;
  &--sm {
    height: 22.5rem;
    background-image: url("../assets/img/home__info1.jpeg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
  }
}

.why__img {
  background-image: url("../assets/img/cart-product.jpeg");
  right: 12.5rem;
  &--sm {
    height: 22.5rem;
    background-image: url("../assets/img/cart-product.jpeg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
  }
}

.info--sm {
  position: relative;
}

.info__description {
  position: absolute;
  line-height: 2.1875rem;
  -webkit-writing-mode: vertical-rl;
  writing-mode: vertical-rl;
  height: 21.875rem;
  &--sm {
    background-color: $infoColor;
    &> p {
      margin: 0;
      line-height: 2.1875rem;
    }
  }
}

.do__description {
  right: 25rem;
}

.why__description {
  left: 1.25rem;
}
</style>
