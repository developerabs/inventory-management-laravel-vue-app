import { createRouter, createWebHistory } from "vue-router"
import HomeView from "../views/HomeView.vue"
import Login from '../auth/login.vue'
import Register from '../auth/register.vue'
import Dashboard from '../components/Dashboard.vue'

const router = createRouter({
  history: createWebHistory('/'),
  routes: [
    {
      path: "/",
      name: "login",
      component: Login,
    },
    {
      path: "/register",
      name: "register",
      component: Register,
    },
    {
      path: "/dashboard",
      name: "dashboard",
      component: Dashboard,
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/AboutView.vue"),
    },
  ],
});

export default router;
