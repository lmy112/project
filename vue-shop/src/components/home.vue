<template>
  <div id="homePage">
    <home-carousel></home-carousel>
    <home-topic></home-topic>
    <home-info></home-info>
    <div class="container my-5">
      <img src="../assets/img/home__info__res.svg" alt="res" width="88" class="d-none d-sm-block img-fluid m-auto">
      <img src="../assets/img/sm-res.svg" alt="res" width="250" class="d-block d-sm-none m-auto img-fluid">
    </div>
    <home-recommend></home-recommend>
  </div>
</template>

<script type="text/ecmascript-6">
import homeCarousel from "../components/homeCarousel.vue";
import homeTopic from "../components/homeTopic.vue";
import homeInfo from "../components/homeInfo.vue";
import homeRecommend from "../components/homeRecommend.vue";
export default {
  data() {
    return {};
  },
  components: {
    homeTopic,
    homeInfo,
    homeRecommend,
    homeCarousel
  }
};
</script>

<style scoped lang="scss">
#homePage {
  position: relative;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}
</style>

