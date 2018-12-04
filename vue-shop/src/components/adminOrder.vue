<template>
  <div>
    <loading v-if="isLoading"></loading>
    <table class="table table-hover" v-else>
      <thead class="thead-dark">
        <tr>
          <th scope="col">訂單ID</th>
          <th scope="col" class="text-left">訂單資訊</th>
          <th scope="col" class="text-left">訂單內容</th>
          <th scope="col">訂單金額</th>
          <th scope="col">編輯</th>
        </tr>
      </thead>
      <tbody v-for="(item, index) in shopOrderList" :key="item.id">
        <tr>
          <th scope="row">{{item.id}}</th>
          <td class="text-left">收件人：{{item.user.name}}<br/>
          收件人電話：{{item.user.tel}}<br/>
          收件人信箱：{{item.user.email}}<br/>
          收件人地址：{{item.user.address}}<br/>
          </td>
          <td class="text-left">
            <span v-for="item in item.products" :key="item.id">{{item.title}} ({{item.count}})<br/></span>
          </td>
          <td>${{item.totalPrice}}</td>
          <td>
            <button type="button" class="btn btn-danger" @click="deleteHandler(index)">刪除</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script type="text/ecmascript-6">
import loading from "@/components/loading";
export default {
  components: {
    loading
  },
  data() {
    return {
      shopOrderList: [],
      isLoading: false
    };
  },
  mounted() {
    this.isLoading = true;
    this.$axios
      .get('orderList')
      .then(res => {
        this.shopOrderList = res.data;
        this.isLoading = false;
      })
      .catch(err => {
        console.log(err);
      });
  },
  methods: {
    deleteHandler(index) {
      let target = this.shopOrderList[index];
      if (confirm(`是否確定刪除此筆訂單資料？`)) {
        this.loading = true;
        this.$axios
          .delete(
            'orderList/' + target.id
          )
          .then(res => {
            this.shopOrderList.splice(index, 1);
            this.isLoading = false;
          })
          .catch(err => {
            console.log(err);
          });
      }
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
.form-control {
  color: $primaryColor;
  font-weight: 900;
}
</style>
