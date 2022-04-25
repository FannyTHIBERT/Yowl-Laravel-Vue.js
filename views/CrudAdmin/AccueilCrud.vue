<template>
  
  <div class="container"><!--v-if='login-admin' -->
    <NavBar />
    <div v-if="user.is_admin == 1" class="container shadow-lg p-3 mb-5 bg-white rounded">
    <h1 class='admin'>Admin Dashboard</h1>
      <router-link :to="'/CrudUsers'"><button href="#" type="button" id='crud' class="btn btn-outline-dark mt-3">Users</button></router-link>
      <router-link :to="'/CrudPosts'"><button href="#" type="button" id='crud' class="btn btn-outline-dark mt-3">Posts</button></router-link>
    </div>
      <h1 style="margin-top: 100px;" v-if="user.is_admin == 0">You don't have admin rights</h1>
  </div>
  

</template>

<script>
import NavBar from '@/components/NavBar.vue'
import Footer from '@/components/Footer.vue'
import axios from 'axios'


export default {
  name: 'AccueilCrud',
  components: { NavBar, Footer },  
  data: () => {
    return { 
      user: {}
      };
  },
  mounted(){
    this.token = localStorage.getItem('myToken');
        axios.get('http://localhost:8000/api/user', {
          headers: {
            'Authorization': `Bearer ${this.token}` 
          }
        })
        .then((response) => {
        console.log(response.data)
        this.user = response.data
      })
  },
}
</script>

<style scoped>
.footerHome{
  margin-top: 150px;
}
#crud{
    margin-left: 10px;
    margin-top: 30px;
}
.admin{
    margin-top: 80px;
    margin-bottom: 30px;
}
</style>