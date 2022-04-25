<template>
  <div class="container">
    <!--v-if='login-admin' -->
    <NavBar />
  <h1 class="mt-5 mb-5">Manage Posts</h1>
    <div class="containercards">
        
      <div class="card" v-for="post in posts" :key="post.id">
        <div class="card__header"></div>
        <div class="card__body">
          <router-link
            style="text-decoration: none"
            :to="{ name: 'post', params: { id: post.id } }"
            ><h4>{{ post.title }}</h4>
          </router-link>

          <p>
            {{ post.content}}
            {{ post.category_id }}
          </p>
        </div>
        <div class="card__footer">
          <div class="user">
            <small>{{ post.created_at.substr(0, 16) }}</small>
            <div>
              <router-link
                :to="{ name: 'CrudDetailPost', params: { id: post.id } }"
                ><button
                  href="#"
                  type="button"
                  id="crud"
                  class="btn btn-outline-dark"
                >
                  Voir
                </button></router-link
              >
              <router-link
                :to="{ name: 'CrudUpdatePost', params: { id: post.id } }"
                ><button
                  href="#"
                  type="button"
                  id="crud"
                  class="btn btn-outline-dark"
                >
                  Modifier
                </button></router-link
              >
              <button
                v-on:click.prevent="deletePost(post)"
                href="#"
                type="button"
                id="crud"
                class="btn btn-outline-dark"
              >
                Supprimer
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";
const axios = require("axios");
export default {
  name: "CrudPosts",
  components: { NavBar, Footer },
  props: [
    "title",
    "category_id",
    "idPost",
    "content",
    "created_at",
    "img_post",
    "comment",
    "user_id",
    "post_id",
  ],

  data() {
    return {
      posts: "",
    };
  },
  mounted() {
    axios
      .get("http://localhost:8000/api/posts")
      .then((response) => {
        // console.log(response.data);
        this.posts = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  methods: {
    getPost() {
      axios.get("http://localhost:8000/api/posts/").then((response) => {
        console.log(response);
        this.posts = response.data;
      });
    },
    deletePost(post) {
      console.log(post);
      if (confirm("Supprimer ce post ?")) {
        axios
          .delete("http://localhost:8000/api/posts/" + post.id, {})
          .then((response) => {
            console.log(this.id);
            this.posts = response.data;
            // console.log(response.data);
            window.location.reload();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap");

body {
  font-family: "Quicksand", sans-serif;
  display: grid;
  place-items: center;
  height: 100vh;
  background: #7f7fd5;
  background: linear-gradient(to right, #91eae4, #86a8e7, #7f7fd5);
}

.containercards {
  margin: auto;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  max-width: 1200px;
  margin-block: 2rem;
  gap: 2rem;
}

img {
  max-width: 100%;
  display: block;
  object-fit: cover;
}

.card {
  display: flex;
  flex-direction: column;
  width: clamp(20rem, calc(20rem + 2vw), 15rem);
  overflow: hidden;
  box-shadow: 0 0.1rem 1rem rgba(0, 0, 0, 0.1);
  border-radius: 1em;
  background: #ece9e6;
  background: linear-gradient(to right, #ffffff, #ece9e6);
}

.card__body {
  padding: 1rem;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.tag {
  align-self: flex-start;
  padding: 0.25em 0.75em;
  border-radius: 1em;
  font-size: 0.75rem;
}

.tag + .tag {
  margin-left: 0.5em;
}

.tag-blue {
  background: #56ccf2;
  background: linear-gradient(to bottom, #2f80ed, #56ccf2);
  color: #fafafa;
}

.tag-brown {
  background: #d1913c;
  background: linear-gradient(to bottom, #ffd194, #d1913c);
  color: #fafafa;
}

.tag-red {
  background: #cb2d3e;
  background: linear-gradient(to bottom, #ef473a, #cb2d3e);
  color: #fafafa;
}

.card__body h4 {
  font-size: 1.5rem;
  text-transform: capitalize;
}

.card__footer {
  display: flex;
  padding: 1rem;
  margin-top: auto;
}

.user {
  display: flex;
  gap: 0.5rem;
}

.user__image {
  border-radius: 50%;
  height: 50px;
}

.user__info > small {
  color: #666;
}
#crud {
  margin-left: 5px;
  margin-top: 5px;
}
</style>