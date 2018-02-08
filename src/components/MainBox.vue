<template>
  <div class="lazy">
    <h1>嗷嗷百态</h1>
    <ul>
      <li v-for="(item,key) in list" :key=key>
        <img v-lazy="item.img">
        <div class="title">
          <h2>{{item.des}}</h2>
          <p>第 {{item.day}} 天</p>
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
      showSpinner:0
    }
  },
  methods:{
    getList(){
      var self=this;
      this.$axios({
        url:'/getCarrousel.php',
        baseURL: 'http://www.haohome.top/yx/data',
        methods:'post',
        params:{num:self.num},
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
    loadMore(){
      this.num+=4;
      this.getList();
      this.showSpinner=1;
    }
  },
  beforeMount(){
     this.getList();
  }
}
</script>
<style>
image[lazy=loading] {
  width: 40px;
  height: 300px;
  margin: auto;
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
}
.lazy img{
  width:12rem;
  height:auto;
  border:10px solid #fff;
  border-bottom:50px solid #fff;
  /* padding:10px 10px 70px 10px; */
  border-radius:5px;
  box-shadow:2px 2px 3px #aaaaaa;
}
.lazy .title{
  width: 100%;
  position: absolute;
  bottom: .2rem;
  text-align: center;
  color:#333;
  padding:0 .2rem;
  font-family: "Roboto", "Helvetica Neue", sans-serif;
  /* font-size:3rem; */
  font-weight:bold;
  /* text-shadow: 2px 3px 5px rgb(231, 243, 62); */
  box-sizing: border-box;
}
.lazy .title h2{
  font-size:1.6rem;
  margin-bottom:.5rem;
}
.lazy .title p{
  font-size: 1.3rem;
  font-weight: normal;
  width: 4rem;
  height: 1.5rem;
  margin: 0 auto;
  background: red;
  border-radius: 1rem;
  color: #fff;
  padding: 0.07rem .5rem;
  text-shadow: 2px 0px 2px rgb(84, 84, 79);
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
.lazy .btn{
  margin:2rem 0
}
.lazy .btn .spinner{
  position: absolute;
  left: 62%;
  bottom: 15%;
}
</style>


