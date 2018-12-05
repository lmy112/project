<template>
  <div class="dessert__container container">
    <loading v-if="isLoading"></loading>
    <header class="jumbotron jumbotron-fluid" v-else>
    </header>
    <!-- List group -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="list-group col-md-4" id="myList">
          <h4 class="dessert__title">甜點類別</h4>
          <a class="list-group-item list-group-item-action active" data-toggle="list" href="#home">所有甜點</a>
          <a class="list-group-item list-group-item-action" data-toggle="list" href="#today">本日精選</a>
          <a class="list-group-item list-group-item-action" data-toggle="list" href="#hot">人氣推薦</a>
          <a class="list-group-item list-group-item-action mb-2" data-toggle="list" href="#new">新品上市</a>
        </div>
        <!-- Tab panes -->
        <div class="tab-content col-md-8">
          <div class="tab-pane active" id="home" role="tabpanel">
            <div class="container justify-content-center">
              <div class="row mb-2">
                <div class="col-md-6 mb-3" v-for="item in shopDesserts" :key="item.id">
                  <div class="product-img" :style="{ 'background-image': 'url(' + item.img + ')' }">
                    <span class="topic--tag">{{item.type}}</span>
                  </div>
                  <div class="product-info row m-0 py-2">
                    <span class="product-name col-md align-middle text-nowrap">{{item.title}}</span>
                    <span class="product-price col-md align-middle text-nowrap">NT$ {{item.price}}</span>
                  </div>
                  <button type="button" name="" id="" class="btn btn-light btn-block buy-btn" data-toggle="modal"
                    data-target="#addModal" @click="addCart(item.id-1)">加入購物車</button>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="today" role="tabpanel">
            <div class="container justify-content-center">
              <div class="row mb-2">
                <div class="col-md-6 mb-3" v-for="item in shopDesserts" :key="item.id" v-show="item.type==='本日精選'">
                  <div class="product-img" :style="{ 'background-image': 'url(' + item.img + ')' }">
                    <span class="topic--tag">{{item.type}}</span>
                  </div>
                  <div class="product-info row m-0 py-2">
                    <span class="product-name col-md align-middle text-nowrap">{{item.title}}</span>
                    <span class="product-price col-md align-middle text-nowrap">NT$ {{item.price}}</span>
                  </div>
                  <button type="button" class="btn btn-light btn-block buy-btn" data-toggle="modal" data-target="#addModal"
                    @click="addCart(item.id-1)">加入購物車</button>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="hot" role="tabpanel">
            <div class="container justify-content-center">
              <div class="row mb-2">
                <div class="col-md-6 mb-3" v-for="item in shopDesserts" :key="item.id" v-show="item.type==='人氣推薦'">
                  <div class="product-img" :style="{ 'background-image': 'url(' + item.img + ')' }">
                    <span class="topic--tag">{{item.type}}</span>
                  </div>
                  <div class="product-info row m-0 py-2">
                    <span class="product-name col-md align-middle text-nowrap">{{item.title}}</span>
                    <span class="product-price col-md align-middle text-nowrap">NT$ {{item.price}}</span>
                  </div>
                  <button type="button" class="btn btn-light btn-block buy-btn" data-toggle="modal" data-target="#addModal"
                    @click="addCart(item.id-1)">加入購物車</button>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="new" role="tabpanel">
            <div class="container justify-content-center">
              <div class="row mb-2">
                <div class="col-md-6 mb-3" v-for="item in shopDesserts" :key="item.id" v-show="item.type==='新品上市'">
                  <div class="product-img" :style="{ 'background-image': 'url(' + item.img + ')' }">
                    <span class="topic--tag">{{item.type}}</span>
                  </div>
                  <div class="product-info row m-0 py-2">
                    <span class="product-name col-md align-middle text-nowrap">{{item.title}}</span>
                    <span class="product-price col-md align-middle text-nowrap">NT$ {{item.price}}</span>
                  </div>
                  <button type="button" class="btn btn-light btn-block buy-btn" data-toggle="modal" data-target="#addModal"
                    @click="addCart(item.id-1)">加入購物車</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <add-modal></add-modal>
      </div>
    </div>
  </div>
</template>

<script type="text/ecmascript-6">
  import loading from "@/components/loading";
  import addModal from "@/components/addModal";
  export default {
    data() {
      return {
        shopDesserts: [],
        isLoading: false
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

  .jumbotron {
    height: 31.25rem;
    background: url("../assets/img/dessert-header.jpeg") no-repeat center center;
    background-size: cover;
  }

  .dessert__title {
    margin: 0;
    padding: 0.3125rem;
    color: white;
    background-color: $primaryColor;
  }

  .list-group-item {
    color: $primaryColor;
    font-weight: 900;
    font-size: 1.25rem;
  }

  .list-group-item.active,
  .list-group-item-action:hover, {
    background-color: lighten($primaryColor, 60%);
    border-color: lighten($primaryColor, 60%);
    color:$primaryColor;
  }

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
      color:$primaryColor;
    }
  }

  .topic--tag {
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

</style>
