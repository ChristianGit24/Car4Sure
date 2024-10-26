import { createRouter, createWebHistory } from 'vue-router';
import AppDashboard from '@/views/appDashboard.vue';

const routes = [
  {
    path: '/',
    name: 'Dashboard',
    component: AppDashboard,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
