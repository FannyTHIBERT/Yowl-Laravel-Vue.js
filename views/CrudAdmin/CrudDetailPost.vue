<template>
<section>
      <div id="intro" class="container w-50 p-5 text-center "><!--v-if='login-admin' -->
      <!-- <h1 class="mb-0 h4"> {{post.title}}</h1> -->
    </div>
  <!--Main Navigation-->
   
    <div class="container">
      <!--Grid row-->
            <h2>{{ post.title }}</h2>
        <!--Grid column-->
        <div style="width: 50%;" class="container">
          <!--Section: Post data-mdb-->
          <section class="border-bottom mb-4">

             <img :src="post.img_post" class="img-fluid shadow-2-strong rounded-5 mb-4" alt="image_post">


          </section>
          <!--Section: Post data-mdb-->

          <!--Section: Text-->
          <section>
            <p>
             {{ post.content }}
            </p>
<div>
            <Like />
</div>

          </section>
          <!-- faire un v-for pour afficher tous les comments -->
          <!--Section: Comments-->
            <CrudComment :idPost="post.id" />
            
          <!--Section: Reply-->
        </div>
        <!--Grid column-->

        <!--Grid column-->
      
        <!--Grid column-->
      <!--Grid row-->
    </div>
</section>
</template>

<script>
import CrudComment from '../../components/CrudComment.vue';
import Like from '../../components/Like.vue';
const axios = require('axios');

export default {
    name: 'CrudDetailPost',
    components: { CrudComment, Like},
    props: ['id'],
      data() {
        return {
          post: {},
        };
      },
      mounted() {
      axios.get(`http://localhost:8000/api/posts/` + this.id, {})
        .then((response) => {
          console.log(response.data);
          this.post = response.data;
          console.log(response.data)
        })
        .catch((error) => {
          console.log(error);
        })
    },
}



</script>

<style scoped>
  #intro {
        /* Margin to fix overlapping fixed navbar */
        margin-top: 58px;
      }

      @media (max-width: 991px) {
        #intro {
          /* Margin to fix overlapping fixed navbar */
          margin-top: 45px;
        }
      }
</style>