<template>
  <div id="app" :style="backgroundDiv">
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App',
  data(){
    return {
      backgroundDiv: {
          backgroundImage: 'url(' + require('./assets/img/bg.jpg') + ')',
        }
    }
  }
}
</script>

<style scoped>
  html{
    font-size:10px;
  }
  #app{
    overflow: hidden;
    background: no-repeat center;
    background-size:cover;
  }
</style>
