// routes.js
import login from './components/auth/login.vue';
import register from './components/auth/register.vue';
import forget from './components/auth/forget.vue';
import logout from './components/auth/logout.vue';
//end of auth........
import Home from './components/home.vue';
//employee .....
import Employee from './components/employee/create.vue';
import AllEmployee from './components/employee/index.vue';

export const routes = [
  { path: '/', component: Home, name: '/' },
  { path: '/login', component: login, name: 'login' },
  { path: '/register', component: register, name:'register' },
  { path: '/forget', component: forget, name:'forget' },
  { path: '/logout', component: logout, name:'logout' },
  //employee
  { path: '/add-employee', component: Employee, name:'add-employee' },
  { path: '/all-employee', component: AllEmployee, name:'all-employee' },
  
];