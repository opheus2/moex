import Vue from 'vue'
import Router from 'vue-router'
import land from './components/land'
import Home from './components/gon' // this is the import line to add

Vue.use(Router)


export default new Router({
  routes: [
    {
      path: '/',
      name: 'landing',
      component: land
    },
    {
        path: '/home',
        name: 'Home',
        component: Home
      }
  ]
})