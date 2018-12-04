<template>
  <div>
    <loading v-if="isLoading"></loading>
    <div v-else>
      <table class="table text-center bg-warning my-4">
        <thead>
          <tr>
            <th scope="col">商品圖片</th>
            <th scope="col">商品名稱</th>
            <th scope="col">商品類型</th>
            <th scope="col">商品價格</th>
            <th scope="col">增加/修改商品</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" class="form-control" id="image" placeholder="請輸入圖片連結" v-model.trim="input.img"></td>
            <td><input type="text" class="form-control" id="title" placeholder="請輸入標題" v-model.trim="input.title"></td>
            <td>
              <select v-model="input.type">
                <option v-for="(chooseType,index) in types" :key="index">{{chooseType}}</option>
              </select>
              </td>
            <td><input type="number" class="form-control" id="price" placeholder="請輸入價格" v-model.trim="input.price"></td>
            <td>
            <button type="button" class="btn btn-primary" @click="submitHandler">送出</button>
            <button type="button" class="btn btn-danger" @click="cancelHandler">取消</button>
            </td>
          </tr>
        </tbody>
      </table>
      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">商品項目</th>
            <th scope="col">商品圖片</th>
            <th scope="col">商品名稱</th>
            <th scope="col">商品類型</th>
            <th scope="col">商品價格</th>
            <th scope="col">編輯</th>
          </tr>
        </thead>
        <tbody v-for="(item, index) in shopDesserts" :key="item.id">
          <tr>
            <th scope="row">{{item.id}}</th>
            <td><img :src="item.img" class="img-fluid" width="80"></td>
            <td>{{item.title}}</td>
            <td>{{item.type}}</td>
            <td>{{item.price}}</td>
            <td>
              <a href="#">
              <button type="button" class="btn btn-success" @click="editHandler(index)">修改</button></a>
              <button type="button" class="btn btn-danger" @click="deleteHandler(index)">刪除</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
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
      shopDesserts: [],
      input: {
        img: "",
        title: "",
        type: "",
        price: 0
      },
      types:['本日精選','人氣推薦','新品上市'],
      editIndex: null,
      isLoading: false
    };
  },
  mounted() {
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
  },
  methods: {
    submitHandler() {
      let { img, title, type, price } = this.input;
      if (!img || !title || !type || price === 0)
        return alert("請輸入完整資料");
      this.isLoading = true;
      if (this.editIndex == null) {
        this.$axios
          .post('desserts', this.input)
          .then(res => {
            this.shopDesserts.push(res.data);
            this.cancelHandler();
            this.isLoading = false;
          })
          .catch(err => {
            console.log(err);
          });
      } else {
        let { id } = this.shopDesserts[this.editIndex];
        this.$axios
          .put(
            'desserts/' + id,
            this.input
          )
          .then(res => {
            this.shopDesserts[this.editIndex] = res.data;
            this.cancelHandler();
            this.isLoading = false;
          })
          .catch(err => {
            console.log(err);
          });
      }
    },
    cancelHandler() {
      (this.editIndex = null),
        (this.input = {
          img: "",
          title: "",
          type: "",
          price: 0
        });
    },
    deleteHandler(index) {
      let target = this.shopDesserts[index];
      if (confirm(`是否確定刪除「${target.title}」此筆資料？`)) {
        this.loading = true;
        this.$axios
          .delete(
            'desserts/' + target.id
          )
          .then(res => {
            this.shopDesserts.splice(index, 1);
            this.isLoading = false;
          })
          .catch(err => {
            console.log(err);
          });
      }
    },
    editHandler(index) {
      let { img, title, type, price } = this.shopDesserts[index];
      (this.editIndex = index),
        (this.input = {
          img,
          title,
          type,
          price
        });
    }
  },
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
