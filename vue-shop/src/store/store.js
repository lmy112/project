import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const LS = {
  load (item) {
    return JSON.parse(window.localStorage.getItem(item)) || []
  },
  save (item, data) {
    window.localStorage.setItem(item, JSON.stringify(data))
  }
}
const SS = {
  load (item) {
    return JSON.parse(window.sessionStorage.getItem(item)) || []
  },
  save (item, data) {
    window.sessionStorage.setItem(item, JSON.stringify(data))
  }
}

const store = new Vuex.Store({
  strict: true,
  state: {
    cart: LS.load('cart'),
    user: SS.load('user')
  },
  mutations: {
    setUserData (state, userData) {
      state.user.account = userData.account
      state.user.password = userData.password
      state.user.u_id = userData.u_id
      state.user.isLogin = userData.isLogin
      if (userData.u_id) {
        state.user.push(userData)
      } else if (userData.u_id === '') {
        state.user.pop(userData)
      }
      SS.save('user', state.user)
    },
    addToCart (state, buyInfo) {
      let flag = false
      state.cart.some(item => {
        if (item.id === buyInfo.id) {
          item.count += parseInt(buyInfo.count)
          item.amount = item.count * item.price
          flag = true
          return true
        }
      })
      if (!flag) {
        state.cart.push(buyInfo)
      }
      LS.save('cart', state.cart)
    },
    updateBuyCount (state, buyInfo) {
      state.cart.some(item => {
        if (item.id === buyInfo.id) {
          item.count = parseInt(buyInfo.count)
          item.amount = parseInt(buyInfo.amount)
          return true
        }
      })
      LS.save('cart', state.cart)
    },
    addCount (state, buyInfo) {
      state.cart.some(item => {
        if (item.id === buyInfo.id) {
          item.count++
          item.amount = item.count * item.price
          return true
        }
      })
      LS.save('cart', state.cart)
    },
    delCount (state, buyInfo) {
      state.cart.some(item => {
        if (item.id === buyInfo.id) {
          if (item.count > 1) {
            item.count--
          } else {
            item.count = 1
          }
          item.amount = item.count * item.price
          return true
        }
      })
      LS.save('cart', state.cart)
    },
    removeCartProduct (state, buyInfo) {
      state.cart.some((item, i) => {
        if (item.id === buyInfo.id) {
          state.cart.splice(i, 1)
          return true
        }
      })
      LS.save('cart', state.cart)
    },
    removeAllCart (state) {
      state.cart.splice(0, state.cart.length)
      LS.save('cart', state.cart)
    }
  },
  getters: {
    isLogin: state => {
      let isLogin = false
      state.user.forEach(item => {
        isLogin = item.isLogin
      })
      return isLogin
    },
    getAllCount (state) {
      let num = 0
      state.cart.forEach(item => {
        num += item.count
      })
      return num
    },

    getCartTotal (state) {
      let total = 0
      state.cart.forEach((item) => {
        total += item.price * item.count
      })
      return total
    },
    getBuyTotal (state) {
      let total = 0
      let Freight = 300
      state.cart.forEach((item) => {
        total += item.price * item.count
      })
      if (total < 1500 && total > 0) {
        total += Freight
      }
      return total
    }
  }
})
export default store
