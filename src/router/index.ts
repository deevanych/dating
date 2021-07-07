import Vue from 'vue';
import VueRouter, { RouteConfig } from 'vue-router';
import Home from '@/views/Home.vue';
import Matches from '@/views/Matches.vue';
import Inbox from '@/views/Inbox.vue';
import Settings from '@/views/Settings.vue';

Vue.use(VueRouter);

const routes: Array<RouteConfig> = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/matches',
    name: 'Matches',
    component: Matches,
  },
  {
    path: '/inbox',
    name: 'Inbox',
    component: Inbox,
  },
  {
    path: '/settings',
    name: 'Settings',
    component: Settings,
  },
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

export default router;
