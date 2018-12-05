import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/home'
import Dessert from '@/components/dessert'
import Login from '@/components/login'
import Cart from '@/components/cart'
import Check from '@/components/check'
import Order from '@/components/order'
import Admin from '@/components/admin'
import AdminDessert from '@/components/adminDessert'
import AdminOrder from '@/components/adminOrder'
Vue.use(Router)

const router = new Router({
  scrollBehavior (to, from, savedPosition) {
    return {
      x: 0,
      y: 0
    }
  },
  linkActiveClass: 'active',
  routes: [
    {
      path: '/',
      redirect:
      {
        name: 'home'
      }
    },
    {
      path: '/home',
      name: 'home',
      component: Home
    },
    {
      path: '/dessert',
      name: 'dessert',
      component: Dessert
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/cart',
      name: 'cart',
      component: Cart
    },
    {
      path: '/check',
      name: 'check',
      component: Check
    },
    {
      path: '/order',
      name: 'order',
      component: Order
    },
    {
      path: '/admin',
      name: 'admin',
      component: Admin,
      children: [
        {
          path: 'adminDessert',
          name: 'adminDessert',
          component: AdminDessert,
          meta: { requiresAuth: true }
        },
        {
          path: 'adminOrder',
          name: 'adminOrder',
          component: AdminOrder,
          meta: {
            requiresAuth: true
          }
        }
      ]
    }, {
      path: '*',
      redirect: {
        name: 'home'
      }
    }
  ]
})
router.beforeEach((to, from, next) => {
  let user = window.sessionStorage.getItem('user')
  if (to.meta.requireAuth) {
    if (user) {
      next()
    } else {
      next({
        path: '/login',
        query: {
          redirect: to.fullPath
        }
      })
    }
  } else {
    next()
  }
})

export default router
