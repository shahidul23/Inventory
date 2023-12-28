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
import EditEmployee from './components/employee/edit.vue';
// supplier
import Supplier from './components/supplier/create.vue';
import AllSupplier from './components/supplier/index.vue';
import EditSuplier from './components/supplier/edit.vue';

export const routes = [
  { path: '/', component: Home, name: '/' },
  { path: '/login', component: login, name: 'login' },
  { path: '/register', component: register, name:'register' },
  { path: '/forget', component: forget, name:'forget' },
  { path: '/logout', component: logout, name:'logout' },
  //employee
  { path: '/add-employee', component: Employee, name:'add-employee' },
  { path: '/all-employee', component: AllEmployee, name:'all-employee' },
  { path: '/edit-employee/:id', component: EditEmployee, name:'edit-employee' },
  //supplier
  { path: '/add-supplier', component: Supplier, name:'add-supplier' },
  { path: '/all-supplier', component: AllSupplier, name:'all-supplier' },
  { path: '/edit-supplier/:id', component: EditSuplier, name:'edit-supplier' },
  
];