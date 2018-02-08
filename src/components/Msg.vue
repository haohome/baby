<template>
  <div class="container">
    <mt-header title="所有寄语" class="header">
      <router-link to="/" slot="left">
        <mt-button icon="back">返回</mt-button>
      </router-link>
    </mt-header>
    <div id="msg">
      <ul>
        <li class="msg" v-for="(item,key) in msgList" :key=key>
          <b>{{item.userName}}</b>：{{item.msg}}
          <span>{{new Date(parseInt(item.time)).toLocaleString()}}</span>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
  export default {
    name:'Msg',
    data(){
      return {
        msgList:[]
      }
    },
    components:{
    },
    methods:{
      getMsg(){
        var self=this;
        this.$axios({
          url:'/getMsgList.php',
          baseURL: 'http://www.haohome.top/yx/data',
          methods:'post',
          responseType: 'json',
          transformResponse:function(data){
            self.msgList=data;
            console.log(self.msgList);
          },
        })
      }
    },
    beforeMount(){
      this.getMsg();
    },
  }
</script>
<style scoped>
  .header{
    background-color:rgba(176, 184, 187, 0.5);
  }
  #msg{
    padding:0 .5rem;
    height:auto
  }
  #msg .msg{
    font-size:1.8rem;
    margin:1rem;
  }
  #msg .msg span{
    font-size:1rem;
    color:rgb(83, 86, 236)
  } 
</style>

