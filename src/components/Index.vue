<template>
<div id="container">
  <mt-header fixed title="小宝贝" class="header"></mt-header>
  <Banner/>
  <ToDoList/>
  <MainBox/>  
  <ToDoInput/>
</div>
</template>

<script>
import { Header } from 'mint-ui';
import Banner from './Banner';
import ToDoInput from './ToDoInput.vue'
import MainBox from './MainBox.vue'
import ToDoList from './ToDoList.vue'
export default {
  name: 'Index',
  data () {
    return {
    }
  },
  components: {  
    'Banner':Banner,
    'MainBox':MainBox, 
    'ToDoInput':ToDoInput,
    'ToDoList':ToDoList 
  },
}
</script>
<style>
header.header{
  background-color:rgba(176, 184, 187, 0.5);
  font-size:2rem;
}
.header h1{
  font-weight:bold;
}
#container{
  padding:0 2rem
}
</style>
