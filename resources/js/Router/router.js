import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Login from '../components/Login/Login';
import Signup from "../components/Login/Signup";
import Forum from "../components/Forum/Forum";

const routes = [
    { path: '/login', name: 'login', component: Login },
    { path: '/signup',name: 'signup', component: Signup },
    { path: '/forum',name: 'forum', component: Forum },
];


const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

export default router;
