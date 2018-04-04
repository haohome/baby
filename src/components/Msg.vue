<template>
  <div class="container">
    <mt-header title="所有寄语" class="header">
        <mt-button icon="back" slot="left" @click.self.prevent="goBack()">返回</mt-button>
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
          baseURL: 'https://www.haohome.top/yx/data',
          methods:'post',
          responseType: 'json',
          transformResponse:function(data){
            self.msgList=data;
            console.log(self.msgList);
          },
        })
      },
      goBack(){
        this.$router.go(-1)
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
    padding-left: 1rem;
    height:auto
  }
  #msg ul{
    list-style-type: disc;
    list-style-position: inside;
  }
  #msg .msg{
    font-size:1.6rem;
    margin:1rem 0;
  }
  #msg .msg span{
    font-size:1rem;
    color:rgb(83, 86, 236)
  } 
</style>

