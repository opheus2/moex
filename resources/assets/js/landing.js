require('./bootstrap');

window.Vue = require('vue');

import router from './route'
import Landing from './components/App'
import {ClientTable} from 'vue-tables-2';

Vue.use(ClientTable);

window.Landing = new Vue({
    el: '#app',
    router,
    template: '<Landing/>',
    components: { Landing },
});
