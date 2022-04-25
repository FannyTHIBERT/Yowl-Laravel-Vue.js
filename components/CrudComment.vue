

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
                <div>
          <button
            v-on:click.prevent="deleteCom(comment)"
            href="#"
            type="button"
            id="crud"
            class="btn btn-outline-dark"
          >
            Supprimer
          </button>
        </div>
        </div>

  </section>
</template>

<script>
const axios = require("axios");
export default {
  name: "CrudComment",
  props: ["idPost", "comment", "user_id", "post_id"],
  data() {
      return {
        comments: {},
      };
    },
  async mounted() {
    const getComments = async () => {
      try {
        const resp = axios
          .get(
            "http://localhost:8000/api/comments/" + this.$route.params.id,
            {}
          )
          .then((response) => {
            console.log(this.idPost);
            this.comments = response.data;
            console.log(response.data);
          })
          .catch((error) => {
            console.log(error);
          });
      } catch (err) {
        Console.error(err);
      }
    };
    getComments();
  },
  methods: {
    getComment(){axios
          .get("http://localhost:8000/api/comments/")
          .then((response) => {
            console.log(response)
            this.comments = response.data
          })
    },
    deleteCom(comment) { 
      console.log(comment);
     if(confirm("Supprimer ce commentaire ?")) { axios.delete("http://localhost:8000/api/comments/" + comment.id, {})
    .then((response) => {
            console.log(this.id);
            this.comments = response.data;
            console.log(response.data);
          })
          .catch((error) => {
            console.log(error);
          });
          }
      }
  }

};
</script>

<style scoped>
#crud {
  margin-right: 5px;
  margin-bottom: 10px;
}
</style>

