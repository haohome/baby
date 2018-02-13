<template>
  <div id="todoList">
    <h1>最新寄语</h1>
    <router-link to="/msg" class="moreMsg">查看更多</router-link>
    <ul>
      <li class="msg" v-for="(item,key) in msg" :key=key v-if="key<5">
        <b>{{item.userName}}</b>：{{item.msg}}
        <span>{{new Date(parseInt(item.time)).toLocaleString()}}</span>
      </li>
      <span v-show="msg.length>=5" style="color:#333">▪▪▪</span>
    </ul>
  </div>
</template>
<script>
export default {
  props:['myList'],
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
        },
      })
    }
  },
  beforeMount(){
    this.getMsg();
  },
  computed:{
    msg(){
      this.msgList.unshift(...this.myList);
      return this.msgList;
    }
  }
}
</script>
<style>
  #todoList{
    position: relative;
    margin-top: 1rem; 
    height:auto
  }
  #todoList ul{
    list-style-type: disc;
  }
  #todoList h1{
    color:teal
  }
  #todoList .msg{
    font-size:1.5rem;
    margin:1rem;
  }
  #todoList .msg span{
    font-size:1rem;
    color:rgb(83, 86, 236)
  } 
  #todoList .moreMsg{
    position: absolute;
    font-size: 1.5rem;
    right: .5rem;
    top: .2rem;
    color:#333;
    cursor: pointer;
  }
</style>
