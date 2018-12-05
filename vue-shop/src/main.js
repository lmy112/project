// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store/store.js'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.css'
import navbar from './components/navbar.vue'
import shopFooter from './components/shopFooter.vue'
import Axios from 'axios'
Vue.prototype.$axios = Axios
Axios.defaults.baseURL = 'https://blooming-beach-52575.herokuapp.com/'
Axios.defaults.withCredentials = true
Vue.component('navbar', navbar)
Vue.component('shopFooter', shopFooter)

Vue.config.productionTip = false
/* eslint-disable no-new */

new Vue({
  el: '#app',
  store,
  router,
  components: {
    App
  },
  template: '<App/>'
})
