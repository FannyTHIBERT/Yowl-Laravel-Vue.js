<template>

<div class="container">
  <div class="container loginForm"><!--v-if='login-admin' -->
  <!-- Pills navs -->
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
  
</ul>
<!-- Pills navs -->

<!-- Pills content -->
<div class="tab-content shadow-lg p-3 mb-5 bg-white rounded">

    <form method='put'>
      
      <div class="form-group mb-1">
    <input v-model="title" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Edit title ...">
  </div>

    <div class="form-group mb-2">
    <textarea v-model="content" class="form-control" id="exampleFormControlTextarea1"  placeholder="Edit content ..." rows="3"></textarea>
  </div>


      <!-- Submit button -->
      <button @click="update" type="submit" class="btn btn-primary btn-block mb-3">Edit</button>
    </form>

</div>
</div>
  </div>
</template>

<script>
// @ is an alias to /src
const axios = require('axios');
export default {
  name: "CrudUpdatePost",
  components: {},
  props: ["id"],
  data: () => {
    return {
      title: "",
      user_id:"",
      category_id: "",
      content: "",
      img_post:"",
    };
  },
  methods: {
    update(event){
      event.preventDefault()
      axios.put('http://localhost:8000/api/posts/' + this.id, {
        title: this.title,
        user_id:this.user_id,
        category_id: this.category_id,
        content:this.content,
        img_post: this.img_post,
      })
      .then((response) => {
        console.log(response.data);
        var result = response.data;
        if (result != null){
          alert("Post modifié !")
          window.location.reload();
        }
      })
      .catch((error) => {
        console.log(error);
        console.log("error", error.response.data);
      })
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

 async update(event) {     
      event.preventDefault();
      const preview = document.querySelector('img_post');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();
        let image = '';
        await reader.addEventListener("load", async () => {
          // on convertit l'image en une chaîne de caractères base64
          image = reader.result;
          console.log(image);
          fetch(image)
          .then(res => res.blob())
          .then(blob => {
            console.log(blob)
             axios.put("http://localhost:8000/api/posts" + this.id, {
          title: this.title,
          user_id: '',
          category_id: this.categorie,
          content: this.content,
          img_post: image,
            })          
        })
        .then((response) => {
        console.log(response.data);
        var result = response.data;
        if (result != null){
          alert("Post modifié !")
        }
      })
      .catch((error) => {
        console.log(error);
        console.log("error", error.response.data);
      })
        }, false);

        if (file) {
          await reader.readAsDataURL(file);
          console.log(reader);
          console.log(image);
          
    }
        axios
          .get("http://localhost:8000/api/posts", {})
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