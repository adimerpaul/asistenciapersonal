require('./bootstrap');
import Vue from 'vue'
// import VueToastr2 from 'vue-toastr-2'
// import 'vue-toastr-2/dist/vue-toas
// import plugin
import VueToastr from "vue-toastr";
// use plugin
Vue.use(VueToastr, {
    /* OverWrite Plugin Options if you need */
});

Vue.config.productionTip = false;

import FunctionalCalendar from 'vue-functional-calendar';
Vue.use(FunctionalCalendar, {
    dayNames: ['L', 'M', 'M', 'J', 'V', 'S', 'D']
});

const moment = require('moment')
require('moment/locale/es')

Vue.use(require('vue-moment'), {
    moment
})
// Vue.use(require('vue-moment'));
import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);

import VueRouter from 'vue-router'
Vue.use(VueRouter)
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('asistencia-component', require('./components/asistencias.vue').default);

import home from './components/home';
import personas from './components/personas';
import imprimir from './components/imprimir';
const routes = [
    { path: '/home', component: home },
    { path: '/personas', component: personas },
    { path: '/imprimir', component: imprimir },
]
const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});



const app = new Vue({
    components: {
        FunctionalCalendar
    },
    el: '#app',
    router,
    data: {
        selectedDate: null,
    },
    mounted() {


        // You are athis.$toastr.s("SUCCESS MESSAGE", "Success Toast Title");ble to access plugin from everywhere via this.$toastr
        // this.$toastr.defaultPosition = "toast-top-left";
        // Send message to browser screen
        // this.$toastr.s(
        //     "This Message From Toastr Plugin\n You can access this plugin : <font color='yellow'>this.$toastr</font>"
        // );
    }
});
