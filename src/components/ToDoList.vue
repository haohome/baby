<template>
  <div id="todoList">
    <h1>最新寄语</h1>
    <ul>
      <li class="msg" v-for="(item,key) in msgList" :key=key v-if="key<5">
        <b>{{item.userName}}</b>：{{item.msg}}
        <span>{{new Date(parseInt(item.time)).toLocaleString()}}</span>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  name:"ToDoList",
  data(){
    return {
      msgList:[]
    }
  },
  methods:{
    getMsg(){
      var self=this;
      this.$axios({
        url:'/getMsgList.php',
        baseURL: 'http://www.haohome.top/yx/data',
        methods:'post',
        params:{num:5},
        responseType: 'json',
        transformResponse:function(data){
          self.msgList=data;
          console.log(self.msgList);
        },
      })
    }
  },
  mounted(){
    this.getMsg();
  }
}
</script>
<style>
  #todoList{
    height:auto
  }
  #todoList h1{
    color:teal
  }
  #todoList .msg{
    font-size:1.8rem;
    margin:1rem;
  }
  #todoList .msg span{
    font-size:1rem;
    float:right;
  }
</style>
