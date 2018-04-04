<template>
  <div class="swiper">  
    <h1>每日一晒</h1>
    <swiper :options="swiperOption">  
      <div class="swiper-slide img-slide" v-for="(item, index) in carrouselList" :key="index">
        <div class="title">第{{item.day}}天<br/>
          <i style="font-size:10px;">{{item.date}}</i> 
        </div>
        <!-- <video v-show="item.img.slice(3)=='mp4'" src="http://ojis8rp6f.bkt.clouddn.com/%E5%AE%9D%E5%A8%83%E7%9E%AA%E7%9C%BC%E7%9D%9B.mp4" height="250" preload="meta" controls="controls"></video> -->
        <img :src="item.img">
        <!-- <div class="swiper-lazy-preloader"></div> -->
      </div>
      <div class="swiper-pagination"  slot="pagination"></div>
    </swiper>  
  </div>
</template>
<script>
import { swiper, swiperSlide } from 'vue-awesome-swiper';
export default {
  name: 'Banner',
  data () {
    return {
      carrouselList:[],
      swiperOption: {  
          // debugger: true,
          // autoplay:{
          //   stopOnlastSlide:true
          // }, 
          // speed:500,  
          mousewheel: true,     //开启鼠标滑轮滚动     
          slidesPerView: "3",//设置slider容器能够同时显示的slides数量(carousel模式)。可以设置为数字（可为小数，小数不可loop），或者 'auto'则自动根据slides的宽度来设定数量。loop模式下如果设置为'auto'还需要设置另外一个参数loopedSlides。  
          centeredSlides: true,
          pagination: {
            el: '.swiper-pagination', //分页器的class类
            type : 'bullets',         //分页器的类型
            dynamicBullets:true,      //隐藏
            clickable:true,            //设置分页器可点击
          },
          lazy: {
             loadPrevNext: true,      //开启懒加载
             loadPrevNextAmount: 2,   //预加载2个
             loadOnTransitionStart: true,//开启过渡即加载
          },
          autoHight:true,
          paginationClickable :true,
          slideToClickedSlide:true,     //点击slide会过渡到这个slide
        }  
    }
  },
  components: {  
    swiper,  
    swiperSlide,
  },
  methods:{
    getList(){
      var self=this;
      this.$axios({
        url:'/getCarrousel.php',
        baseURL: 'https://www.haohome.top/yx/data',
        methods:'post',
        params:{list:0},
        responseType: 'json',
        transformResponse:function(data){
          self.carrouselList=data;
          console.log(self.carrouselList);
        },
      })
    },
  },
  created(){
    this.getList();
  },
}
</script>
<style>
.swiper{
  margin: 0rem auto; 
  padding-top:2rem; 
  margin-bottom:0;
  width:100%; 
  overflow:hidden;  
} 
.swiper h1{
  padding-top:2rem;
  color:teal
}
.img-slide{
    width: 15rem;
    height:20rem;
    display:flex;
    justify-content: center  
  }
.img-slide img{
  margin-top:1rem;
  margin-bottom: 1rem;
  display: block;
  /* width: 11rem;   */
  height: 14.5rem;
  opacity: .5;
  border:7px solid #fff;
  border-radius:3px;
  box-shadow:2px 2px 3px #aaaaaa; 
  -webkit-transition: all .3s ease 0s; 
    -moz-transition: all .3s ease 0s;  
    -ms-transition: all .3s ease 0s;  
    -o-transition: all .3s ease 0s;
    transition: all .3s ease 0s;
}
.swiper-slide-active{
  z-index:2
}
.swiper-slide-active img{
  transform: scale(1.1);
  opacity: 1;
} 
.swiper-slide .title{
  position: absolute;
  z-index:10;
  bottom:1.5rem;
  color:#fff;
  font-size:1.5rem;
  font-weight:bold;
  text-shadow: 2px 3px 5px rgb(54, 56, 18);
}
.swiper-pagination{
  position: relative;
}
</style>

