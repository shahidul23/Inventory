import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';
import { createRouter, createWebHashHistory } from 'vue-router';
import { routes } from './routes';

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

const app = createApp({});

app.use(router); 
app.mount('#app');


