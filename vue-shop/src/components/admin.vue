<template>
  <div>
    <div class="container">
      <h2>Sweetaste Admin</h2>
      <p>Hi,
        <strong>{{user.account}}</strong> !</p>
        <transition name="fade" mode="out-in">
        <router-view></router-view>
        </transition>
    </div>
  </div>
</template>

<script>
export default {
  components: {
  },
  data() {
    return {};
  },
  mounted() {
    if (this.user.u_id !== "KOKDWEDOJOCO3") {
      this.$router.push("login");
    }
  },
  computed: {
    user() {
      return this.$store.state.user;
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../assets/css/base.scss";
.table th,
.table td {
  vertical-align: middle !important;
}
.form-control{
  color:$primaryColor;
  font-weight: 900;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
