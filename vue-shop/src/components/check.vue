<template>
  <div class="check container">
    <loading v-if="isLoading"></loading>
    <div class="row justify-content-around" v-else>
      <div class="send__container col-md-7 pt-5 px-0 mb-3">
        <div>
          <div class="px-3 pb-2">
            <div class="form-row align-items-center pb-2">
              <h1 class="col-md-6 text-left form__title">訂單資訊</h1>
            </div>
            <div class="form-row">
              <div class="col-md-12 mb-3 text-left">
                <label for="name">收件人姓名
                  <span class="text-warning" v-if="errors.has('name')">請輸入姓名</span>
                </label>
                <input type="text" class="form-control" autocomplete="on" name="name" id="name" v-model="form.user.name"
                  placeholder="王小明" v-validate="'required'">
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 text-left">
                <label for="tel">電話
                  <span class="text-warning" v-if="errors.has('tel')">請輸入正確的手機號碼</span>
                </label>
                <input type="text" class="form-control mb-3" autocomplete="on" name="tel" id="tel" placeholder="0912-345-678"
                  v-model="form.user.tel" v-validate="{required:true,regex: /^[09]{2}[0-9]{8}$/}">
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-12 text-left">
                <label for="email">電子信箱
                  <span class="text-warning" v-if="errors.has('email')">請輸入正確格式的信箱</span>
                </label>
                <input type="email" v-validate="{required:true,regex: /^\w+\.*\w+@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/}" autocomplete="on" v-model="form.user.email" name="email"
                  class="form-control mb-3" id="email" placeholder="name@example.com">
              </div>
            </div>
            <div class="form-row mb-4">
              <div class="col-md-12 text-left">
                <label for="address">收件人地址
                  <span class="text-warning" v-if="errors.has('address')">請輸入地址</span>
                </label>
                <input type="text" class="form-control" name="address" id="address" autocomplete="on" v-model="form.user.address"
                  placeholder="高雄市新興區幸福路520號" v-validate="'required'">
              </div>
            </div>
          </div>
          <button class="btn success-btn btn-block py-3" @click="submitHandler">
            送出訂單
          </button>
        </div>
      </div>
      <div class="order__container col-md-4 px-0 mb-5">
        <div class="card col-12 mb-3">
          <div class="card-header row justify-content-center">
            訂單摘要
          </div>
          <div class="card-body">
            <div class="row justify-content-between">
              <p class="text-left">
                小計
              </p>
              <p class="text-right">
                NT$ {{$store.getters.getCartTotal}}
              </p>
            </div>
            <div class="row justify-content-between">
              <p class="text-left">
                運費
              </p>
              <p class="text-right" v-if="$store.getters.getCartTotal<1500  && $store.getters.getCartTotal>0">
                NT$ 300
              </p>
              <p class="text-right" v-else>
                NT$ 0
              </p>
            </div>
            <div class="row justify-content-between">
              <p class="text-left">
                總計
              </p>
              <p class="text-right">
                NT$ {{$store.getters.getBuyTotal}}
              </p>
            </div>
          </div>
        </div>
        <div class="card col-12">
          <div class="card-header row justify-content-center">
            購物清單
          </div>
          <div class="card-body">
            <div v-if="$store.getters.getCartTotal===0">尚未購買</div>
            <!-- 購物清單項 -->
            <div class="row align-items-center list__item py-3" v-for="item in $store.state.cart" :key="item.id">
              <div class="col-md">
                <img :src="item.img" height="110" width="110">
              </div>
              <div class="col-md text-left">
                <h5> {{item.title}} ({{item.count}})</h5>
                <h5> $ {{item.amount}}</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/ecmascript-6">
import loading from "@/components/loading";
export default {
  data() {
    return {
      form: {
        user: {
          email: "",
          name: "",
          tel: "",
          address: ""
        },
        products: this.$store.state.cart,
        totalPrice: this.$store.getters.getBuyTotal
      },
      isLoading: false
    }
  },
  components: {
    loading
  },
  methods: {
    submitHandler() {
      this.$validator.validate().then(result => {
      if (result) {
        this.isLoading = true;
        this.$axios
          .post(
            'orderList',
            this.form
          )
          .then(res => {
            this.$store.commit("removeAllCart");
            this.$router.push("/order")
            this.isLoading = false;
          })
          .catch(err => {
            console.log(err);
          })
          }else{
            return alert("請輸入完整資料");
          }})
      }
    }
};
</script>

<style scoped lang="scss">
@import "../assets/css/base.scss";

.check {
  font-size: 1.25rem;
}

.send__container {
  background-color: $primaryColor;
  color: white;
  font-weight: 900;
  height: 100%;
}

.order__container {
  font-weight: 900;
  color: darken($infoColor, 30%);
}

.card-header {
  background-color: $infoColor;
  font-size: 1.875rem;
  border: none;
}

.form__title {
  font-size: 2.5rem;
}

.success-btn {
  background-color: $successColor;
  color: $primaryColor;
  border-radius: 0;
  font-size: 1.25rem;
  font-weight: 900;

  &:hover {
    background-color: darken($successColor, 10%);
  }
}

input {
  background-color: $infoColor;
}
</style>
