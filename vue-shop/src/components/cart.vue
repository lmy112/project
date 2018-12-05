<template>
  <section class="cart container">
    <loading v-if="isLoading"></loading>
    <div class="list row justify-content-around" v-else>
      <div class="col-md-7">
        <div class="list__header row justify-content-center mb-3 mx-0">
          <h3 class="list__header__title py-3 mb-0">您的購物車</h3>
        </div>
        <div class="mb-3" v-if="$store.getters.getCartTotal===0">尚未購買</div>
        <!-- 購物清單項 -->
        <div class="row list__item py-3" v-for="item in $store.state.cart" :key="item.id">
          <div class="col">
            <div class="row">
              <div class="col-md-4 text-left">
                <img :src="item.img" alt="" height="110" width="110">
              </div>
              <div class="col-md-6 text-left ml-3 mt-4 d-none d-sm-block">
                <h5 v-text="item.title"></h5>
                <h5 v-text="'$'+item.price"></h5>
              </div>
            </div>
          </div>
          <div class="col d-flex align-items-center">
            <div class="row">
              <div class="col-sm-12 text-left d-block d-sm-none">
                <h5 v-text="item.title"></h5>
                <h5 v-text="'$'+item.price"></h5>
              </div>
              <div class="input-group col-sm-12 col-md">
                <div class="row px-2 px-md-0">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary btn--count" type="button" @click="substract(item.id-1)">-</button>
                  </div>
                  <input :value="item.count" type="text" class="form-control text-center" ref="numbox"
                    @change="updateNum(item.id-1)" readonly>
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn--count" type="button" @click="increase(item.id-1)">+</button>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md">
                <h5 class="product-price text-right">${{item.amount}}</h5>
              </div>
              <div class="col-sm-12 col-md text-right d-none d-sm-block">
                <a href="#"><button class="btn" type="button" @click="remove(item.id-1)"><img src="../assets/img/ic-delete.svg"
                    alt="delete"></button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card col-md-4 px-0 mb-5">
        <div class="card-body pb-0">
          <h4 class="card-title py-3">訂單摘要</h4>
          <div class="row justify-content-between">
            <p class="col text-left">
              小計
            </p>
            <p class="col text-right">
              NT$ {{$store.getters.getCartTotal}}
            </p>
          </div>
          <div class="row justify-content-between">
            <p class="col text-left">
              運費
            </p>
            <p class="col text-right" v-if="$store.getters.getCartTotal<1500 && $store.getters.getCartTotal>0">
              NT$ 300
            </p>
            <p class="col text-right" v-else>
              NT$ 0
            </p>
          </div>
          <div class="row justify-content-between">
            <p class="col text-left">
              總計
            </p>
            <p class="col text-right">
              NT$ {{$store.getters.getBuyTotal}}
            </p>
          </div>
        </div>
          <router-link :to="{name:'check'}" class="card-footer btn" v-show="$store.getters.getBuyTotal>0">結帳</router-link>
          <router-link :to="{name:'dessert'}" class="card-footer btn" v-show="$store.getters.getBuyTotal===0">去逛逛</router-link>
      </div>
    </div>
  </section>
</template>

<script type="text/ecmascript-6">
import loading from "@/components/loading";
export default {
  data() {
    return {
      shopDesserts: [],
      isLoading: false
    };
  },
  components: {
    loading
  },
  methods: {
    updateNum(i) {
      this.$store.commit("updateBuyCount", {
        count: this.$refs.numbox.value
      });
    },
    substract(i) {
      let buyInfo = {
        id: this.shopDesserts[i].id,
        title: this.shopDesserts[i].title,
        price: this.shopDesserts[i].price,
        img: this.shopDesserts[i].img,
        count: this.$refs.value,
        amount: this.$refs.value * this.shopDesserts[i].price
      };
      this.$store.commit("delCount", buyInfo);
    },
    increase(i) {
      let buyInfo = {
        id: this.shopDesserts[i].id,
        title: this.shopDesserts[i].title,
        price: this.shopDesserts[i].price,
        img: this.shopDesserts[i].img,
        count: this.$refs.value,
        amount: this.$refs.value * this.shopDesserts[i].price
      };
      this.$store.commit("addCount", buyInfo);
    },
    remove(i) {
      let buyInfo = {
        id: this.shopDesserts[i].id,
        title: this.shopDesserts[i].title,
        price: this.shopDesserts[i].price,
        img: this.shopDesserts[i].img,
        count: this.$refs.value,
        amount: this.$refs.value * this.shopDesserts[i].price
      };
      if (confirm(`確定要刪除 「${buyInfo.title}」 這項商品嗎？`)) {
        this.$store.commit("removeCartProduct", buyInfo);
      }
    }
  },
  created() {
    this.isLoading = true;
    this.$axios
      .get('desserts')
      .then(res => {
        this.shopDesserts = res.data;
        this.isLoading = false;
      })
      .catch(err => {
        console.log(err);
      });
  }
};
</script>

<style scoped lang="scss">
@import "../assets/css/base.scss";

.cart {
  color: lighten($primaryColor, 10%);
}
.list__header {
  background-color: $infoColor;
  color: $primaryColor;
}

.list__item:not(:last-child) {
  border-bottom: 1px solid #ccc;
}

.btn--count {
  border-radius: 0;
  border-color: #ccc;
}

.product-price {
  margin-top: 0.5rem;
}

.card {
  max-height: 15.625rem;
  font-weight: 900;
  border: none;
  border-radius: 0;
  background-color: $primaryColor;
  color: white;

  &-title {
    border-bottom: 0.0625rem solid white;
  }

  &-footer {
    font-size: 1.25rem;
    font-weight: 900;
    background-color: $successColor;
    color: $primaryColor;
    border-radius: 0;
  }
}

.form-control:disabled, .form-control[readonly] {
    background-color: #fff
    ;}
</style>
