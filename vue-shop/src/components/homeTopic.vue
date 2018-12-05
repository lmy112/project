<template>
  <div class="topic container mb-5">
    <div class="topic__cards row">
      <div class="topic__cards__today col">
        <router-link class="nav-link" :to="{name:'dessert'}">
          <div class="card-img-overlay">
            <span class="card-title">本日精選</span>
          </div>
        </router-link>
      </div>
      <div class="topic__cards__hot col line">
        <router-link class="nav-link" :to="{name:'dessert'}">
          <div class="card-img-overlay">
            <span class="card-title">人氣推薦</span>
          </div>
        </router-link>
      </div>
      <div class="topic__cards__new col">
        <router-link class="nav-link" :to="{name:'dessert'}">
          <div class="card-img-overlay">
            <span class="card-title">新品上市</span>
          </div>
        </router-link>
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

<style scoped lang="scss">
  @import '../assets/css/base.scss';
.topic {
  position: relative;
  padding: 0 3.75rem;
  top: -3.125rem;

  &__cards {
    height: 15.625rem;
    background-color: rgba($primaryColor, 0.9);

    &__today {
      ::before {
        content: "";
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: -1;
        top: 0;
        left: 0;
        background-image: url("../assets/img/topic__today.jpeg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
      }

      &:hover {
        background-color: rgba($successColor, 0.8);

        .card-title {
          color: $primaryColor;
        }
      }
    }

    &__hot {
      ::before {
        content: "";
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: -1;
        top: 0;
        left: 0;
        background-image: url("../assets/img/topic__hot.jpeg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
      }

      &:hover {
        background: rgba($successColor, 0.8);
        cursor: pointer;

        .card-title {
          color: $primaryColor;
        }
      }
    }

    &__new {
      ::before {
        content: "";
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: -1;
        top: 0;
        left: 0;
        background-image: url("../assets/img/topic__new.jpeg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
      }

      &:hover {
        background: rgba($successColor, 0.8);

        .card-title {
          color: $primaryColor;
        }
      }
    }
  }
}

.line {
  border-left: 0.0625rem solid white;
  border-right: 0.0625rem solid white;
}

.card-title {
  -webkit-writing-mode: vertical-lr;
  writing-mode: vertical-lr;
  height: 13.125rem;
  font-size: 1.75rem;
  margin: 0 auto;
  color: white;
  cursor: pointer;
}
</style>
