import { createRouter, createWebHistory, onBeforeRouteLeave } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ProfilView from '../views/ProfilView.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import PostDetailsView from '../views/PostDetailsView.vue'
import AccueilCrud from '../views/CrudAdmin/AccueilCrud.vue'
import CrudPosts from '../views/CrudAdmin/CrudPosts.vue'
import CrudUsers from '../views/CrudAdmin/CrudUsers.vue'
import CrudDetailPost from '../views/CrudAdmin/CrudDetailPost.vue'
import CrudDetailUser from '../views/CrudAdmin/CrudDetailUser.vue'
import CrudUpdateUser from '../views/CrudAdmin/CrudUpdateUser.vue' 
import CrudUpdatePost from '../views/CrudAdmin/CrudUpdatePost.vue'
import * as auth from '../Services/auth_service.js';


const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    children: 
    [
      

    ],
    beforeEnter(to, from, next)
    {
      if(!auth.isLogged()){
        next('/login');
      } else {
        next();
      }
    }
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/profil',
    name: 'profil',
    component: ProfilView,
  },
  

  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/post/:id',
    name: 'post',
    component: PostDetailsView,
    props: true
  },
  {
    path: '/AccueilCrud',
    name: 'AccueilCrud',
    component: AccueilCrud
  },
  {
    path: '/CrudPosts',
    name: 'CrudPosts',
    component: CrudPosts
  },
  {
    path: '/CrudUsers',
    name: 'CrudUsers',
    component: CrudUsers
  },
  {
    path: '/CrudDetailPost/:id',
    name: 'CrudDetailPost',
    component: CrudDetailPost,
    props: true
  },
  {
    path: '/CrudDetailUser/:id',
    name: 'CrudDetailUser',
    component: CrudDetailUser,
    props: true
  },
  {
    path: '/CrudUpdateUser/:id',
    name: 'CrudUpdateUser',
    component: CrudUpdateUser,
    props: true
  },
  {
    path: '/CrudUpdatePost/:id',
    name: 'CrudUpdatePost',
    component: CrudUpdatePost,
    props: true
  },
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
