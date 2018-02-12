<template>
<div class="container" :style="backgroundDiv">
  <MyHeader/>
  <Banner/>
  <ToDoList :myList="list" />
  <MainBox/>  
  <ToDoInput @addEvent="add($event)"/>
</div>
</template>
<script>
  import Header from './common/Header';
  import Banner from './index/Banner';
  import ToDoInput from './index/ToDoInput.vue'
  import MainBox from './index/MainBox.vue'
  import ToDoList from './index/ToDoList.vue'
  export default {
    name: 'Index',
    data () {
      return {
        list:[],
        backgroundDiv: {
          backgroundImage: 'url(' + require('../assets/img/bg.jpg') + ')',
        }
      }
    },
    components: {  
      'MyHeader':Header,
      'Banner':Banner,
      'MainBox':MainBox, 
      'ToDoInput':ToDoInput,
      'ToDoList':ToDoList 
    },
    methods:{
      add(msg){
        this.list.unshift(msg)
      },
    },
  }
</script>
<style scoped>
.container{
  padding:0 1.5rem;
  background: no-repeat center;
  background-size:cover;
}
</style>
