<template>
  <div id="todoInput">
    <h1>寄语留言</h1>
    <form action="" method="post" id="todo">
      <mt-field label="用户名" type="text" placeholder="给自己取个名字吧" v-model="userName" class="userName"></mt-field>
      <mt-field label="寄 语" placeholder="请输入您想说的话" type="textarea" rows="3" v-model="msg" class="msg"></mt-field>
      <mt-button type="primary" @click.self.prevent="addList" class="submit">提交</mt-button>
    </form>
    <div id="todoBox">
      <ul>
        <!-- <li v-for="(item,key) in msgList" :key=key>{{item.userName}}:{{item.msg}}</li> -->
      </ul>
    </div>
  </div>
</template>
<script>
import { Field } from 'mint-ui';
import { Button } from 'mint-ui';
import { MessageBox } from 'mint-ui';
import { Toast } from 'mint-ui';
export default {
  name:"ToDoList",
  data(){
    return{
      userName:'',
      msg:'',
      time:'',
    }
  },
  methods:{
    addList(){
      var self=this;
      if(self.userName==""){
        MessageBox.alert("给自己取个名字吧!","提示");
        return;
      }
      if(self.msg==""){
        MessageBox.alert("说句话呗!","提示");
        return;
      }
      this.time=new Date().getTime();
      var params={userName:self.userName,msg:self.msg,time:self.time}
      this.$emit('addEvent',params)
      this.$axios({
        methods:'POST',
        url:'/sendMsg.php',
        baseURL: 'http://www.haohome.top/yx/data',
        params:params,
        headers : {
          "Content-Type":'application/x-www-form-urlencoded; charset=UTF-8'
        },
        transformResponse:function(data){
          var code=JSON.parse(data).code;
          if(code){
            Toast({
              message: '留言成功',
              iconClass: 'mintui mintui-success',
              duration: 1000
            });
            self.userName="";
            self.msg="";
          }
        },
      })
    }
  }
}
</script>
<style>
  #todoInput{
    height:20rem
  }
  #todoInput h1{
    color:teal;
    margin:.5rem 0
  }
  #todo input,#todo textarea{
    border:.5px solid #ddd;
    padding:.3rem 1rem;
    box-sizing:border-box;
    
  }
  #todo .submit{
    margin-top:.5rem;
    float: right;
    margin-bottom:1rem;
  }
  #todo{
    background-color:rgba(255,255,255,0)
  }
  .mint-field .mint-cell-title{
    text-align: center
  }
  
</style>


