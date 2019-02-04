import Vue from 'vue'
import Router from 'vue-router'
import land from './components/Landing'
import Homes from './components/gon'
import terms from './components/terms'
import privacy from './components/privacy'
import contact from './components/contact'
import faq from './components/faq'
import career from './components/career'
import blog from './components/blog'

Vue.use(Router)


export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/landing',
            name: 'landing',
            component: land
        },
        {
            path: '/home',
            name: 'Home',
            component: Homes
        },
        {
            path: '/terms-of-service',
            name: 'terms-of-service',
            component: terms
        },
        {
            path: '/privacy-policy',
            name: 'Privacy Policy',
            component: privacy
        },
        {
            path: '/contact',
            name: 'Contact',
            component: contact
        },
        {
            path: '/blog',
            name: 'Blog',
            component: blog
        },
        {
            path: '/careers',
            name: 'Careers',
            component: career
        },
        {
            path: '/faq',
            name: 'Faq',
            component: faq
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
