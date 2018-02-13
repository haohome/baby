<template>
  <div class="lazy">
    <h1>嗷嗷百态</h1>
    <a href="#" @click.self.prevent="getList(1)" v-show="order" class="order">倒序查看</a>
    <a href="#" @click.self.prevent="getList(0)" v-show="!order" class="order">正序查看</a>
    <ul>
      <li v-for="(item,key) in list" :key=key>
        <img v-lazy="item.img" @click.self.prevent="zoom(item.img,item.des)">
        <div class="title">
          <h2>{{item.des}}</h2>
          <p>第 {{item.day}} 天</p>
          <div class="thumb">
            <i class="heart" :style="star" :class="{hover:parseInt(item.isHover)}" @click="heart(item)"></i>
            <span class="count">{{item.count}}</span>
            <!-- <input type="checkbox" :checked="parseInt(item.isHover)"> -->
          </div>
        </div>
      </li>
    </ul>
    <mt-button type="default" size="large" class="btn" @click.native="loadMore" :disabled="disabled">
      <mt-spinner type="snake" :size="20" v-show="showSpinner" class="spinner"></mt-spinner>
      {{load}}</mt-button>
  </div>
</template>
<script>
export default {
  name:'MainBox',
  data(){
    return {
      list:[],
      num:10,
      load:"更多精彩",
      disabled:false,
      showSpinner:0,
      order:true,
      star:{
        backgroundImage:'url(' + require('../../assets/img/web_heart_animation.png') + ')'
      },
      isHover:false
    }
  },
  methods:{
    getList(index){
      if(index==1){
        this.order=false
      }else{
        this.order=true
      }
      var self=this;
      this.$axios({
        url:'/getCarrousel.php',
        baseURL: 'http://www.haohome.top/yx/data',
        methods:'post',
        params:{num:self.num,order:index},  //num:请求数量{num:10,请求10张图片,num:0,每组请求一个}  order:查看顺序{order:0 正序,order:1倒序}
        responseType: 'json',
        transformResponse:function(data){
          self.list=data;
          if(data.length<self.num){
            self.load="没有啦";
            self.disabled=true;
          }
          self.showSpinner=0
        },
      })
    },
    updateCount(pid,count){
      this.$axios({
        url:'/updateCarrousel.php',
        baseURL: 'http://www.haohome.top/yx/data',
        methods:'post',
        params:{pid:pid,count:count},  
        responseType: 'json',
        transformResponse:function(data){
          var code=data.code;
          if(code){
          console.log("点赞成功");
          }else{
            console.log("点赞失败");
          }
        },
      })
    },
    loadMore(){
      this.num+=10;
      this.getList(1);
      this.showSpinner=1;
    },
    zoom(img,des){
      this.$layer.open({
        type: 1, //0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
        title: '',
        content: `<img src="${img}" style="width:100%;">`,
        area: 'auto',
        offset: 'auto',
        time: 0,
        shade: true,
        shadeClose: true,
      })
    },
    heart(item){
      if(item.isHover=="0"){
        item.isHover="1",
        item.count++;
      }else{
        item.isHover="0"
        item.count--;
      }
      this.updateCount(item.pid,item.count)
    }
  },
  beforeMount(){
     this.getList(0);
  }
}
</script>
<style>
image[lazy=loading] {
  width: 40px;
  height: 300px;
  margin: auto;
}
.lazy{
  position: relative;
}
.lazy h1{
  color:teal
}
.lazy ul{
  width:100%;
  display:flex;
  flex-wrap: wrap;
  justify-content:space-around;
  align-items:center
}
.lazy li{
  margin-top:2rem;
  position: relative;
  border-radius:5px;
  border:10px solid #fff;
  border-bottom:3px solid #fff;
  box-shadow:2px 2px 3px #aaaaaa;
  box-sizing: border-box;
}
.lazy img{
  width:12rem;
  height:auto;
  border-radius:5px;
}
.lazy .title{
  width: 12rem;
  text-align: center;
  color:#333;
  font-family: "Roboto", "Helvetica Neue", sans-serif;
  font-weight:bold;
  background:#fff;
  box-sizing: border-box;
}
.lazy .title h2{
  font-size: 1.5rem;
  margin-bottom: .3rem;
}
.lazy .title p{
  display:inline-block;
  font-size: 1.3rem;
  font-weight: normal;
  width: auto;
  line-height: 1.3rem;
  margin: 0 auto;
  background: red;
  border-radius: 1rem;
  color: #fff;
  padding: 0.2rem .5rem;
  text-shadow: 2px 1px 2px rgb(84, 84, 79);
}
.lazy .title .talk{
  position: absolute;
  bottom: 0.5rem;
  right: 0.5rem;
  width: 2rem;
  height: 2rem;
  background-position: center;
  display: block;
  background-size: 1.5rem;
  background-repeat: no-repeat;
}
.title .thumb{
  position: absolute;
  bottom: -2rem;
  right: -.5rem;
}
.title .heart{
  display: inline-block;
  width: 5rem;
  height: 5rem;
  background-size: auto 5rem;
  background-position: 0 0;
}
/* .title .heart:hover { 
  background-position: -140rem 0; 
  transition: background 1s steps(28); 
} */
.title .heart.hover { 
  transition: background 1s steps(28); 
  background-position: -140rem 0; 
}
.title .count{
  position: absolute;
  bottom: 2.2rem;
  right: .5rem;
}
.lazy .btn{
  margin:2rem 0;
  background-color: #eee
}
.lazy .btn .spinner{
  position: absolute;
  left: 62%;
  bottom: 15%;
}
.lazy .order{
  position: absolute;
  font-size: 1.5rem;
  right: .5rem;
  top: .2rem;
  color:#333;
  cursor: pointer;
}
</style>


