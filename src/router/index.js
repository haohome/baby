import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/Index'
import Msg from '@/components/Msg'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Index',
      component: Index
    },
    {
      path: '/msg',
      name: 'Msg',
      component: Msg
    },
  ]
})
