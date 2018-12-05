<template>
  <div class="loading">
    <img src="../assets/img/logo.svg" class="rotation" alt="logoLoading" height="100">
  </div>
</template>

<script>
export default {
  name: "loading"
};
</script>

<style lang="scss">
.loading{
  background: rgba(white,.8);
  width: 100%;
  height: 100vh;
  overflow: hidden;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1000;
  display: flex;
  justify-content: center;
  align-items: center;
  img{
    opacity: .9 ;
  }
}
@keyframes rotation {
    from {transform: rotate(0deg);
}to {
    transform: rotate(360deg);
}}

.rotation {
    transform: rotate(360deg);
    animation: rotation 5s linear infinite;
}
</style>
