<template>
   <section class="border-bottom mb-3">
       <p class="text-center"><strong>Comments</strong></p>

        <div v-for="comment in comments" :key="comment.id" class="row card mb-4">
            <div class="card-body">
              <span class="card-comment">
              {{comment.comment}} 
              </span>
            </div>
             <span class="commentDate">
                {{comment.created_at.substr(0, 10)}}
                </span>
        </div>

  </section>
</template>
<script>
const axios = require('axios')


export default {
  name: 'Post',
  props: ['idPost','comment', 'user_id', 'post_id'],

  async mounted() {
      const getComments = async () => {
        try{
          const resp = axios.get('http://localhost:8000/api/comments/' + this.$route.params.id)
        .then((response) => {
          console.log(this.idPost);
          this.comments = response.data; 
          console.log(response.data) 
        })
        .catch((error) => {  
          console.log(error); 
        }) 
        } catch (err) {
          Console.error(err)
        };
      };
       getComments();
    },
  component: {},
      data() { 
        return {
          comments: {}
        };
      },
      
  }
</script>

<style scoped>
.card-comment {
  float: left;
}
.commentDate {
  float: left;
}
</style>