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
import api     from './components/api'
import about     from './components/about'
import aboutApi     from './components/aboutApi'

Vue.use(Router)


export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/landing',
            component: land
        },
        {
            path: '/landing/home',
            name: 'Home',
            component: Homes
        },
        {
            path: '/landing/terms-of-service',
            name: 'terms-of-service',
            component: terms
        },
        {
            path: '/landing/privacy-policy',
            name: 'Privacy Policy',
            component: privacy
        },
        {
            path: '/landing/contact',
            name: 'Contact',
            component: contact
        },
        {
            path: '/landing/blog',
            name: 'Blog',
            component: blog
        },
        {
            path: '/landing/careers',
            name: 'Careers',
            component: career
        },
        {
            path: '/landing/faq',
            name: 'Faq',
            component: faq
        },
        {
            path: '/landing/api',
            name: 'Api',
            component: api
        },
        {
            path: '/landing/about',
            name: 'About',
            component: about
        },
        {
            path: '/landing/about',
            name: 'aboutApi',
            component: aboutApi
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
