<template>
  <div id="app">
    <navbar></navbar>
    <transition name="fade" mode="out-in">
    <router-view/>
    </transition>
    <shopFooter></shopFooter>
  </div>
</template>

<script>
export default {
  name: "App",
  components: {
  },
  computed: {
  }
};
</script>
<style lang="scss">
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>

