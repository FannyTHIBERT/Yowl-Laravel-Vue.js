<template>
    <section>
            <p class="text-center"><strong>Leave a comment</strong></p>

            <form v-on:submit.prevent="commenter">
              <div class="mb-3">
              <textarea v-model="comment" class="form-control" placeholder="Your comment here..." id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

              <!-- Checkbox -->
              <div class="form-check d-flex justify-content-center mb-4">
              </div>

              <!-- Submit button -->
              <button style="width: 50%;" type="submit" class="btn btn-primary btn-block mb-4">
                Publish
              </button>
            </form>
          </section>
</template>

<script>
const axios = require('axios')

export default {
    name: 'AddComment',

    props: ['idPost'],
    data: () => {
    return {
        comment: "",
        user_id:"",
        post_id: "",
    };
  },
  methods: {
    commenter(event) {

      event.preventDefault();
      console.log('post comment fonction');
      console.log(this.idPost);
      axios.post("http://localhost:8000/api/comments", {
        comment: this.comment,
        user_id:"",
        post_id: this.idPost,
       
        })
        .then((response) => {
          console.log(this.idPost)
          console.log(response.data);
          var result = response.data;
          if (result != null) {
            window.location.reload();
          }
        })
        .catch((error) => {
          console.log(error);
        }),
        axios
          .get("http://localhost:8000/api/comments", {})
          .then((response) => {
            console.log(response.data);
          })
          .catch((error) => {
            console.log(error);
          });
    },
  },
}
</script>

<style scoped>
.inputcomment {
    border-bottom: 0.5px solid grey;
}
</style>