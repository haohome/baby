import Vue from 'vue'
import App from './App'
import router from './router'
import Axios from 'axios'
import Mint from 'mint-ui';
import VueAwesomeSwiper from 'vue-awesome-swiper';
import layer from 'vue-layer';
import './assets/css/normalize.css'
import './assets/css/base.css'
import 'mint-ui/lib/style.css';
import 'swiper/dist/css/swiper.css'

Vue.use(Mint);
Vue.prototype.$layer = layer(Vue);
Vue.prototype.$axios = Axios
Vue.use(VueAwesomeSwiper)/* { default global options } */
Vue.config.productionTip = false
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
