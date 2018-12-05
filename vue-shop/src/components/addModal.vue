<template>
  <!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="buyTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title" id="exampleModalLongTitle"><img src="../assets/img/logo-all-dark.svg" alt="logo"
              width="130"></span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h3>成功加入購物車！</h3>
        </div>
        <div class="modal-footer">
          <router-link :to="{name:'dessert'}">
            <button type="button" class="btn buy-btn buy-btn--keep" data-dismiss="modal">繼續購物</button>
          </router-link>
          <router-link :to="{name:'cart'}">
            <button type="button" class="btn buy-btn" data-dismiss="modal">前往結帳 <img src="../assets/img/ic-sendEmail.svg" alt="send" class="pb-1"></button></router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
  @import '../assets/css/base.scss';

  .buy-btn {
    border-radius: 0;
    border: 0.0625rem solid lighten($primaryColor, 60%);
    background-color: lighten($primaryColor, 60%);
    padding: 0.625rem 0.3125rem;
    font-size: 1.125rem;
    color:$primaryColor;
    font-weight: 900;
    &:hover {
      background-color: lighten($primaryColor, 50%);
    }
  }

  .modal-body {
    font-weight: 900;
    color: darken($infoColor, 50%);
  }
</style>
