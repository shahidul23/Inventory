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
//caregoty
import Category from './components/category/create.vue';
import AllCategory from './components/category/index.vue';
import EditCategory from './components/category/edit.vue';
//product
import Product from './components/product/create.vue';
import AllProduct from './components/product/index.vue';
import EditProduct from './components/product/edit.vue';
import Stock from './components/stock/stock.vue';
import EditStock from './components/stock/edit.vue';
//expense
import Expense from './components/expense/create.vue';
import AllExpense from './components/expense/index.vue';
import EditExpense from './components/expense/edit.vue';
//salary
import GivenSalary from './components/salary/all_employee.vue';
import Salary from './components/salary/create.vue';
import AllSalary from './components/salary/index.vue';
import EditSalary from './components/salary/edit.vue';
//custome
import Customer from './components/customer/create.vue';
import AllCustomer from './components/customer/index.vue';
import EditCustomer from './components/customer/edit.vue';
//point of sale
import Ops from './components/pos/pointofsale.vue';

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
  //category
  { path: '/add-categoty', component: Category, name:'add-categoty' },
  { path: '/all-categoty', component: AllCategory, name:'all-categoty' },
  { path: '/edit-categoty/:id', component: EditCategory, name:'edit-categoty' },
  //product
  { path: '/add-product', component: Product, name:'add-product' },
  { path: '/all-product', component: AllProduct, name:'all-product' },
  { path: '/edit-product/:id', component: EditProduct, name:'edit-product' },
  { path: '/stock/', component: Stock, name:'stock'},
  { path: '/edit-stock/:id', component: EditStock, name:'edit-stock'},
  //expense
  { path: '/add-expense', component: Expense, name:'add-expense' },
  { path: '/all-expense', component: AllExpense, name:'all-expense' },
  { path: '/edit-expense/:id', component: EditExpense, name:'edit-expense' },
  //salary
  { path: '/given-salary', component: GivenSalary, name:'given-salary' },
  { path: '/pay-salary/:id', component: Salary, name:'pay-salary' },
  { path: '/all-salary', component: AllSalary, name:'all-salary' },
  { path: '/edit-salary/:id', component: EditSalary, name:'edit-salary' },
  //customer
  { path: '/customer', component: Customer, name:'customer' },
  { path: '/all-customer', component: AllCustomer, name:'all-customer' },
  { path: '/edit-customer/:id', component: EditCustomer, name:'edit-customer' },
  // point of sale
  { path: '/pos', component: Ops, name:'pos' },
  
];