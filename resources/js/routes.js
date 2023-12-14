// routes.js
import login from './components/auth/login.vue';
import register from './components/auth/register.vue';

export const routes = [
  { path: '/', component: login, name: '/' },
  { path: '/register', component: register, name:'/register' },
  
];