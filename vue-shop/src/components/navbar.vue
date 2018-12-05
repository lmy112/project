<template>
  <nav class="container navbar navbar-expand-md navbar-light my-4 justify-content-between">

    <router-link class="navbar-brand d-none d-sm-block" :to="{name:'home'}">
      <img src="../assets/img/logo-all-dark.svg" height="40" width="220" alt="logo">
    </router-link>

    <button class="navbar-toggler navbar-brand" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <router-link class="navbar-brand d-block d-sm-none" :to="{name:'home'}">
      <img src="../assets/img/logotype-sm-dark.svg" height="40" width="120" alt="logo" class="text-center">
    </router-link>

    <router-link class="nav-link d-block d-sm-none" :to="{name:'cart'}">    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAL2SURBVGhD7Zk7iNRAGMf3QBSfqKW2PhobxeIKIXI7mcmx64mw8bGT+EKuUa86EVt7URS0FREUH41eIdhoZXOtdiIqiFYW56M4PP3P7bewj2832WSS3ZP84F/Nt//vm3yTmWRTKigoiIcbyDkRqPlOuYF672rvCIWNPq5WH1H0X1ZavqKw0afvRJbl7qHQ0SZyIlreodDRRtZl1Q09vyncH3dbJyK0+oHJPBqmUMM5Kjc+4rjYhgkstk5m2BLaG6fyBgNdecwZDkfyDZU1OGWtDvKm+QvL6iiVlYgxXIm3nHGuwkbkOM4qqikZIpAXWPMchRpmqZzkeNrbBLOFTvMcteCccjZTOelAa28zCfLSTSojPeZUZxJkLqHlHxnIHVSGHbAVv+aSZSmz/VN6e5jtj0uWpRIfgP3wfX81do8vXMJslOIAjAITuconta+0B2BfJk5WtiNJ9s9fNg7AKJDkCZvcoqwcgFFgK57gkluUvQMwgjF05R1TgC3ZOwD7gY6sx434jSkgtTI5AHuBblziirAiLZ9SmmzhuyHnKvXKFhvyLnprKFW2mN2kfRJqSYRiPw2vDHp1g4ZXDv9FN6rT1XVd3dDqN27Ol5kqUDNUgh2YbuQjvNBRCekx3YDp164kecjmRIbWDSObEzGfFHDaTg9DIvQOUBkFPRmv1daalx4sucto/2lZk1tpKDHGA35nlj1Dzzc5aCgblFb7RKA+dazj7+affAoZmHKoDhuPVk88PH4oh95eCrHL1Nmpjbhi7Ds7Ev8UJ8ROCo0NLsxuPB38Yj0D+dnxnQ0Uag9z83EJm0LiaxQaG0ziBufVFJbw4N9DooDx9c5EbdLyBYXGxvyG9SIluTiRwPhKZ6I2aXmPQmODK36f9SKZm59C7VEOJ3fBvPc/KHV3kkJjgyfqQ6xXQ4tYztm8LcJ8BlpqSdaQVrcoZGDM6d3l18hxnkKywXzFwhb8EJrH0nhm9n0aSgy272Pwe97wlA9wojs0VFBQYIVS6R9+rqk6u1hz4QAAAABJRU5ErkJggg==" width="26" class="pb-1"></router-link>

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
    <router-link class="nav-link d-none d-sm-block" :to="{name:'cart'}" >
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAL2SURBVGhD7Zk7iNRAGMf3QBSfqKW2PhobxeIKIXI7mcmx64mw8bGT+EKuUa86EVt7URS0FREUH41eIdhoZXOtdiIqiFYW56M4PP3P7bewj2832WSS3ZP84F/Nt//vm3yTmWRTKigoiIcbyDkRqPlOuYF672rvCIWNPq5WH1H0X1ZavqKw0afvRJbl7qHQ0SZyIlreodDRRtZl1Q09vyncH3dbJyK0+oHJPBqmUMM5Kjc+4rjYhgkstk5m2BLaG6fyBgNdecwZDkfyDZU1OGWtDvKm+QvL6iiVlYgxXIm3nHGuwkbkOM4qqikZIpAXWPMchRpmqZzkeNrbBLOFTvMcteCccjZTOelAa28zCfLSTSojPeZUZxJkLqHlHxnIHVSGHbAVv+aSZSmz/VN6e5jtj0uWpRIfgP3wfX81do8vXMJslOIAjAITuconta+0B2BfJk5WtiNJ9s9fNg7AKJDkCZvcoqwcgFFgK57gkluUvQMwgjF05R1TgC3ZOwD7gY6sx434jSkgtTI5AHuBblziirAiLZ9SmmzhuyHnKvXKFhvyLnprKFW2mN2kfRJqSYRiPw2vDHp1g4ZXDv9FN6rT1XVd3dDqN27Ol5kqUDNUgh2YbuQjvNBRCekx3YDp164kecjmRIbWDSObEzGfFHDaTg9DIvQOUBkFPRmv1daalx4sucto/2lZk1tpKDHGA35nlj1Dzzc5aCgblFb7RKA+dazj7+affAoZmHKoDhuPVk88PH4oh95eCrHL1Nmpjbhi7Ds7Ev8UJ8ROCo0NLsxuPB38Yj0D+dnxnQ0Uag9z83EJm0LiaxQaG0ziBufVFJbw4N9DooDx9c5EbdLyBYXGxvyG9SIluTiRwPhKZ6I2aXmPQmODK36f9SKZm59C7VEOJ3fBvPc/KHV3kkJjgyfqQ6xXQ4tYztm8LcJ8BlpqSdaQVrcoZGDM6d3l18hxnkKywXzFwhb8EJrH0nhm9n0aSgy272Pwe97wlA9wojs0VFBQYIVS6R9+rqk6u1hz4QAAAABJRU5ErkJggg==" width="26" class="pb-1"><span
        class="badge badge-danger px-2" v-show="$store.getters.getAllCount>0">{{$store.getters.getAllCount}}</span></router-link>
  </nav>
</template>

<script type="text/ecmascript-6">
export default {
  data() {
    return {
      user: {
        account: "",
        password: "",
        u_id: ""
      }
    };
  },
  methods: {
    logout() {
      let userData = {
        account: '',
        password: '',
        u_id: '',
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

.badge {
  position: relative;
  top: -0.9375rem;
  left: 0.3125rem;
  border-radius: 100%;
  font-size: 1.125rem;
}
</style>
