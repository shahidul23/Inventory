import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';
import { createRouter, createWebHashHistory } from 'vue-router';
import { routes } from './routes';
import User from './Helpers/User';
window.User = User;
import Swal from 'sweetalert2';
window.Swal = Swal;
import Notification from './Helpers/notification';
window.Notification = Notification

const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
window.Toast = Toast;


const router = createRouter({
  history: createWebHashHistory(),
  routes
});

const app = createApp({});

app.use(router); 
app.mount('#app');


