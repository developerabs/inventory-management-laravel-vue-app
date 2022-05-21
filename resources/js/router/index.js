import { createRouter, createWebHistory } from "vue-router"
import HomeView from "../views/HomeView.vue"
import Login from '../auth/login.vue'
import Register from '../auth/register.vue'
import Dashboard from '../components/Dashboard.vue'

//employee components
import allEmployee from '../components/employee/index.vue'
import storeEmployee from '../components/employee/create.vue'
import editEmployee from '../components/employee/edit.vue'

const router = createRouter({
  history: createWebHistory('/'),
  routes: [
    { path: "/", name: "login", component: Login },
    { path: "/register", name: "register", component: Register },
    { path: "/dashboard", name: "dashboard", component: Dashboard },
    { path: "/about", name: "about", component: () => import("../views/AboutView.vue") },

    //employee routes  
    { path: "/all-employee", name: "allEmployee", component: allEmployee },
    { path: "/store-employee", name: "storeEmployee", component: storeEmployee },
    { path: "/edit-employee/:id", name: "editEmployee", component: editEmployee },
  ],
});

export default router;
