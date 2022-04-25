<template>

<div class="container"><!--v-if='login-admin' -->
  <div class="container loginForm">
  <!-- Pills navs -->
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
  
</ul>
<!-- Pills navs -->

<!-- Pills content -->
<div class="tab-content shadow-lg p-3 mb-5 bg-white rounded">

    <form method='put'>


      <!-- Name input -->
      <div class="form-outline mb-4">
        <input v-model="name" type="text" id="registerName" class="form-control" />
        <label  class="form-label" for="registerName">Name</label>
      </div>

      <!-- Username input -->
      <div class="form-outline mb-4">
        <input v-model="nickname" type="text" id="registerUsername" class="form-control" />
        <label class="form-label" for="registerUsername">Nickname</label>
      </div>

      <!-- Email input -->
      <div class="form-outline mb-4">
        <input v-model="email"  type="email" id="registerEmail" class="form-control" />
        <label class="form-label" for="registerEmail">Email</label>
      </div>

      <!-- Password input -->
      <div class="form-outline mb-4">
        <input v-model="password" type="password" id="registerPassword" class="form-control" />
        <label class="form-label" for="registerPassword">Password</label>
      </div>

      <!-- Repeat Password input -->
      <div class="form-outline mb-4">
        <input v-model="password_confirmation" type="password" id="registerRepeatPassword" class="form-control" />
        <label class="form-label" for="registerRepeatPassword">Repeat password</label>
      </div>


      <!-- Submit button -->
      <button @click="update" type="submit" class="btn btn-primary btn-block mb-3">Modifier</button>
    </form>

</div>
</div>
  </div>
</template>

<script>
// @ is an alias to /src
const axios = require('axios');
export default {
  name: "CrudUpdateUser",
  components: {},
  props: ["id"],
  data: () => {
    return {
      name: "",
      nickname:"",
      email: "",
      avatar:"",
      password: "",
      password_confirmation: "",
    };
  }, mounted() {
      axios.get('http://localhost:8000/api/users/' + this.$route.params.id,{})
        .then((response) => {
          console.log("getdataupdateuser")
          console.log(response.data);
          this.posts = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
    },
  methods: {
    update(event){
      event.preventDefault()
      axios.put('http://localhost:8000/api/users/' + this.$route.params.id, {
        name: this.name,
        nickname: this.nickname,
        email: this.email,
        avatar: this.avatar,
        password: this.password,
        password_confirmation: this.password_confirmation
      })
      .then((response) => {
        console.log('putdata');
        console.log(response.data);
        var result = response.data;
        if (result != null){
          alert("Utilisateur modifié !")
          window.location.reload();
        }
      }).catch((error) => {
        console.log('errorputdata');
          console.log(error);
        })
      
      /*})
      .catch((error) => {
        console.log(error);
        console.log("error", error.response.data);
      })*/
    },

  }
};
</script>
<style>
.loginForm{
  width: 50%;
  margin-top: 150px;
}
</style>