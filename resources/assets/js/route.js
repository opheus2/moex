import Vue      from 'vue'
import Router   from 'vue-router'
import land     from './components/Landing'
import Homes    from './components/gon'
import terms    from './components/terms'
import privacy  from './components/privacy'
import contact  from './components/contact'
import faq      from './components/faq'
import career   from './components/career'
import blog     from './components/blog'
import about     from './components/about'
import error404 from "./components/404";

Vue.use(Router)


export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'land',
            component: land
        },
        {
            path: '/home',
            name: 'home',
            component: Homes
        },
        {
            path: '/terms-of-service',
            name: 'terms-of-service',
            component: terms
        },
        {
            path: '/privacy-policy',
            name: 'privacy-policy',
            component: privacy
        },
        {
            path: '/contact',
            name: 'contact',
            component: contact
        },
        {
            path: '/blog',
            name: 'blog',
            component: blog
        },
        {
            path: '/careers',
            name: 'careers',
            component: career
        },
        {
            path: '/faq',
            name: 'faq',
            component: faq
        },
        {
            path: '/about',
            name: 'about',
            component: about
        },
        {
            path: '*',
            component: error404,
        }
    ],
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { x: 0, y: 0 }
        }
    }
})
