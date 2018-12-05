<template>
  <div class="container justify-content-center my-5">
    <loading v-if="isLoading"></loading>
    <div class="row mb-2" v-else>
      <div class="col-md-4" v-for="item in shopDesserts" :key="item.id" v-show="item.type==='本日精選'">
        <div class="product-img" :style="{ 'background-image': 'url(' + item.img + ')' }">
          <span class="topic-today">{{item.type}}</span>
        </div>
        <div class="product-info row m-0 py-2">
          <span class="product-name col-md align-middle text-nowrap">{{item.title}}</span>
          <span class="product-price col-md align-middle">NT$ {{item.price}}</span>
        </div>
        <button type="button" class="btn btn-light btn-block mb-4 buy-btn" data-toggle="modal"
          data-target="#addModal" @click="addCart(item.id-1)">加入購物車</button>
      <add-modal></add-modal>
      </div>
    </div>
  </div>
</template>

<script>
import loading from "@/components/loading";
import addModal from "@/components/addModal";
export default {
  data() {
    return {
      shopDesserts: [],
      isLoading:false
    };
  },
  components: {
    loading,
    addModal
  },
  methods: {
    addCart(i) {
      let buyInfo = {
        id: this.shopDesserts[i].id,
        title: this.shopDesserts[i].title,
        price: this.shopDesserts[i].price,
        img: this.shopDesserts[i].img,
        count: 1,
        amount: 1 * this.shopDesserts[i].price
      };
      this.$store.commit("addToCart", buyInfo);
    }
  },
  created() {
    this.isLoading = true;
    this.$axios
      .get('desserts')
      .then(res => {
        this.shopDesserts = res.data
        this.isLoading=false

      })
      .catch(err => {
        console.log(err);
      });
  }
};
</script>

<style scoped lang="scss">
@import "../assets/css/base.scss";

.product-img {
  position: relative;
  background-size: cover;
  background-position: center center;
  height: 18.75rem;
}

.product-info {
  border: 0.0625rem solid lighten($primaryColor, 60%);
  border-bottom: none;
  font-size: 1.25rem;
  color: lighten($primaryColor, 10%);
}

.product-name {
  border-right: 0.0625rem solid lighten($primaryColor, 60%);
}

.btn-light,
.buy-btn {
  border-radius: 0;
  border: 0.0625rem solid lighten($primaryColor, 60%);
  background-color: lighten($primaryColor, 60%);
  padding: 0.625rem 0.3125rem;
  font-size: 1.25rem;
  font-weight: 900;
  color: darken($infoColor, 50%);

  &:hover {
    background-color: lighten($primaryColor, 50%);
    color: lighten($primaryColor, 10%);
  }
}

.topic-today {
  position: absolute;
  top: 0;
  left: 0.625rem;
  background-color: $primaryColor;
  color: white;
  font-size: 1rem;
  padding: 0.9375rem 0.625rem;
  -webkit-writing-mode: vertical-lr;
  writing-mode: vertical-lr;
}

.modal-body {
  font-weight: 900;
  color: darken($infoColor, 50%);
}
</style>
