require('./bootstrap');

window.Vue = require('vue');

import router from './route'
import Landing from './components/App'

window.Landing = new Vue({
    el: '#app',
    router,
    components: { Landing },
});
