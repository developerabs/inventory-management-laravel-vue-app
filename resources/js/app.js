require( './bootstrap');
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router"; 
//user helper function
import User from './helpers/User'; 
window.User = User 
//sweet alert 
import Swal from 'sweetalert2'
window.Swal = Swal 

const app = createApp(App);

app.use(router); 
app.mount("#app");
