<template>
<div class="container backdrop"><!--v-if='login' -->
<div class="createPostForm">
  
<button  type="button" class="btn btn-outline-dark mb-1" data-mdb-ripple-color="dark" @click="closeCreatePost"><i  style="float: right; font-size: 20px;" class="bi bi-x-lg"></i></button>
    
        <form v-on:submit.prevent="post">
        <!-- Name input -->
        <div class="form-outline mb-4">
          <input  v-model="title" type="text" id="title" class="form-control border" />
          <label class="form-label" for="title">Title</label>
        </div>
        
          
        <!-- Message input -->
        <div class="form-outline mb-4">
          <textarea v-model="content" class="form-control border" id="content" rows="4"></textarea>
          <label class="form-label" >Content</label>
        </div>
     
      <!-- Image Upload -->
      <div class="form-outline mb-4">
        <label class="form-label" for="img_post"> Post Image</label>
        <input type="file" v-on:change="getImgPost" id="img_post" class="form-control border" />
      </div>
          <!-- <input type="file" class="form-control my-2" id="img_post" /> -->


        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Post</button> 
    
</form>
    </div>
  </div>
</template>

<script>
const axios = require("axios");
export default {
  name: "post",
  components: {},
   props: ['idUser', 'user_id'],
  data: () => {
    return {
      title: "",
      user_id: "",
      category_id: "",
      content: "",
      img_post: "",
      categorie: "",
          };
  },
  methods: {
    closeCreatePost(){
      this.$emit('close')
    },
    async post(event) {     
      event.preventDefault();
      console.log(this.user_id);
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
             axios.post("http://localhost:8000/api/posts", {
          title: this.title,
          user_id: '',
          category_id: this.categorie,
          content: this.content,
          img_post: image,
            })          
        })
        .then((response) => {
          console.log('table')
          console.table([this.title,
          this.user_id,
          this.category_id,
          this.content,
          this.img_post])
          console.log(response.data);
          var result = response.data;
          if (result != null) {
            alert("Post bien créé!");
            
          }
        })
        .catch((error) => {
          console.log(error);
        })
        }, false);

        if (file) {
          await reader.readAsDataURL(file);
          setTimeout(() => {

          location.reload()

          }, 2000);


          
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
</script>

<style scoped>
.createPostForm {
  width: 50%;
  padding: 20px;
  margin: 100px auto;
  background: white;
}
.backdrop {
  top: 0;
  position: fixed;
  background: rgba(0, 0, 0, 0.5);
  width: 100%;
  height: 100%;

}
</style>