<template>
  <section>
    <div id="intro" class="container w-50 p-5 text-center"><!--v-if='login-admin' -->
      <!-- <h1 class="mb-0 h4"> {{post.title}}</h1> -->
    </div>
    <!--Main Navigation-->

    <div class="container">
      <!--Grid row-->
      <h2>{{ user.name }}</h2>
      <!--Grid column-->
      <div style="width: 50%" class="container">
        <!--Section: Post data-mdb-->
        <section class="border-bottom mb-4">
          <img
            :src="user.avatar"
            alt="user__image"
            class="user__image"
          />
        </section>
        <!--Section: Post data-mdb-->

        <!--Section: Text-->
        <section>
          <h3>{{ user.nickname }}</h3>
          <h6>{{ user.name }}</h6>
          User id : {{ user.id }}
          <p>
         
            {{ user.email }}
          </p>
        </section>
      </div>
    </div>
  </section>
</template>

<script>
const axios = require("axios");

export default {
  name: "CrudDetailUser",
  components: {},
  props: ["id"],
  data() {
    return {
      user: {},
    };
  },
  mounted() {
    axios.get(`http://localhost:8000/api/users/` + this.id, {})
      .then((response) => {
        console.log(response.data);
        this.user = response.data;
        console.log(response.data);
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
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
.user__image {
  border-radius: 50%;
  height: 100px;
}
</style>