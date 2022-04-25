<template>

<div class="container">
  <NavBar />
  <div class="container loginForm">
  <!-- Pills navs -->
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
  
</ul>
<!-- Pills navs -->

<!-- Pills content -->
<div class="tab-content">

    <form>


      <!-- Name input -->
        <div class="form-group mb-1">
    <input v-model="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name">
    </div>

      <!-- Username input -->
        <div class="form-group mb-1">
    <input v-model="nickname" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nickname">
    </div>

      <!-- Email input -->
        <div class="form-group mb-1">
    <input v-model="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Email">
    </div>

      <!-- Password input -->
        <div class="form-group mb-1">
    <input v-model="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="Password">
    </div>

      <!-- Repeat Password input -->
        <div class="form-group mb-2">
    <input v-model="password_confirmation" type="password" class="form-control" id="exampleFormControlInput1" placeholder="Password">
    </div>

      <!-- Image Upload -->
      <div class="form-outline mb-4">
        <label style="float: left; font-weight: bold;" class="form-label" for="avatar">Choose your Avatar</label>
        <input type="file" v-on:change="getImgPost" id="avatar" class="form-control border" />
      </div>

      <!-- Checkbox -->
      <div class="form-check d-flex justify-content-center mb-4">
        <input
          class="form-check-input me-2"
          type="checkbox"
          value=""
          id="registerCheck"
          checked
          aria-describedby="registerCheckHelpText"
        />
        <label class="form-check-label" for="registerCheck">
          I have read and agree to the terms
        </label>
      </div>

      <!-- Submit button -->
      <button @click="signin" type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
    </form>

</div>
</div>
  </div>
</template>

<script>
import NavBar from '../components/NavBar.vue';
import setAdmin from '../Services/auth_service.js';
import setUser from '../Services/auth_service.js';

// @ is an alias to /src
const axios = require('axios');
export default {
  name: "Register",
  components: {NavBar},
  data: () => {
    return {
      name: "",
      nickname:"",
      email: "",
      avatar:"",
      password: "",
      password_confirmation: "",
    };
  },
  methods: {
    async signin(event) {     
      event.preventDefault();
      const preview = document.querySelector('avatar');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();
        let avatarUser = '';
        await reader.addEventListener("load", async () => {
          // on convertit l'image en une chaîne de caractères base64
          avatarUser = reader.result;
          console.log(avatarUser);
          fetch(avatarUser)
          .then(res => res.blob())
          .then(blob => {
            console.log(blob)
             axios.post("http://localhost:8000/api/users", {
                name: this.name,
                nickname:this.nickname,
                email: this.email,
                avatar: avatarUser,
                password: this.password,
                password_confirmation: this.password_confirmation
            })          
        })
        .then((response) => {
          // console.log('table')
          // console.table([this.title,
          // this.user_id,
          // this.category_id,
          // this.content,
          // this.img_post])
          // console.log(response.data);
          
          var result = response.data;
          if (result != null) {
            alert("User bien créé!");
            
          }
        })
        .catch((error) => {
          console.log(error);
        })
        }, false);

        if (file) {
          await reader.readAsDataURL(file);
          console.log(reader);
          console.log(avatarUser);
          localStorage.setItem('admin', '1');
          localStorage.setItem('user', '0');
          this.$router.push("/");

          
    }
        axios
          .get("http://localhost:8000/api/users", {})
          .then((response) => {
            console.log(response.data);
          })
          .catch((error) => {
            alert(error);
            console.log(error);
          });
          
    },
  },
};
</script>
<style>
.loginForm{
  width: 50%;
  margin-top: 150px;
}
</style>

async signin(event) {     
      event.preventDefault();
      const preview = document.querySelector('avatar');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();
        let avatarUser = '';
        await reader.addEventListener("load", async () => {
          // on convertit l'image en une chaîne de caractères base64
          avatarUser = reader.result;
          console.log(avatarUser);
          fetch(avatarUser)
          .then(res => res.blob())
          .then(blob => {
            console.log(blob)
             axios.post("http://localhost:8000/api/users", {
                name: this.name,
                nickname:this.nickname,
                email: this.email,
                avatar: avatarUser,
                password: this.password,
                password_confirmation: this.password_confirmation
            })          
        })
        .then((response) => {
          // console.log('table')
          // console.table([this.title,
          // this.user_id,
          // this.category_id,
          // this.content,
          // this.img_post])
          // console.log(response.data);
          var result = response.data;
          if (result != null) {
            alert("User bien créé!");
            location.reload();
          }
        })
        .catch((error) => {
          console.log(error);
        })
        }, false);

        if (file) {
          await reader.readAsDataURL(file);
          console.log(reader);
          console.log(avatarUser);
          
    }
        axios
          .get("http://localhost:8000/api/users", {})
          .then((response) => {
            console.log(response.data);
          })
          .catch((error) => {
            alert(error);
            console.log(error);
          });
          
    },
  },
};