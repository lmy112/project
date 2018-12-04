<template>
  <nav class="container navbar navbar-expand-md navbar-light my-4 justify-content-between">

    <router-link class="navbar-brand d-none d-sm-block" :to="{name:'home'}">
      <img src="../assets/images/logo-all-dark.svg" height="40" width="220" alt="logo">
    </router-link>

    <button class="navbar-toggler navbar-brand" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <router-link class="navbar-brand d-block d-sm-none" :to="{name:'home'}">
      <img src="../assets/images/logotype-sm-dark.svg" height="40" width="120" alt="logo" class="text-center">
    </router-link>

    <router-link class="nav-link d-block d-sm-none" :to="{name:'cart'}"><span class="fa fa-shopping-cart"></span></router-link>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav text-left ml-auto">
        <li class="nav-item">
          <router-link class="nav-link" :to="{name:'home'}">首頁</router-link>
        </li>
        <li class="nav-item px-md-5">
          <router-link class="nav-link" :to="{name:'dessert'}">甜點</router-link>
        </li>
        <li class="nav-item pr-md-4" v-if="!$store.getters.isLogin">
          <router-link class="nav-link" :to="{name:'login'}">管理員登入</router-link>
        </li>
        <li class="nav-item pr-md-4" v-if="$store.getters.isLogin">
          <router-link class="nav-link" :to="{name:'adminDessert'}">商品管理</router-link>
        </li>
        <li class="nav-item pr-md-4" v-if="$store.getters.isLogin">
          <router-link class="nav-link" :to="{name:'adminOrder'}">訂單管理</router-link>
        </li>
        <li class="nav-item pr-md-4" v-if="$store.getters.isLogin">
          <button class="btn nav-link btn-link" @click="logout">登出</button>
        </li>
      </ul>
    </div>
    <router-link class="nav-link d-none d-sm-block" :to="{name:'cart'}" ><span class="fa fa-shopping-cart"></span><span
        class="badge badge-danger" v-show="$store.getters.getAllCount>0">{{$store.getters.getAllCount}}</span></router-link>
  </nav>
</template>

<script type="text/ecmascript-6">
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
    logout() {
      let userData = {
        account: '',
        password: '',
        isLogin: false
      };
      this.$store.commit("setUserData", userData);
      this.$router.push("/login");
    }
  },
  components: {}
};
</script>

<style scoped lang="scss">
@import "../assets/css/base.scss";

.nav-link {
  font-size: 1.125rem;
  color: $primaryColor;
}

.navbar-light .navbar-nav .nav-link {
  color: lighten($primaryColor, 30%);
}

.navbar-light .navbar-nav .show > .nav-link,
.navbar-light .navbar-nav .active > .nav-link,
.navbar-light .navbar-nav .nav-link.show,
.navbar-light .navbar-nav .nav-link.active,
.navbar-light .navbar-nav .nav-link:focus,
.navbar-light .navbar-nav .nav-link:hover {
  color: $primaryColor;
}

.fa-shopping-cart {
  font-size: 1.25rem;
}

.badge {
  position: relative;
  top: -0.9375rem;
  left: 0.3125rem;
  border-radius: 50%;
  font-size: 1.125rem;
}
</style>
