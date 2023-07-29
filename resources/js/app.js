
require('./bootstrap');
require('../../public/plugins/tinymce/tinymce.min.js');

import Vue from 'vue';
import VueResource from 'vue-resource';
window.Vue = require('vue');
window.$ = window.jQuery = require('jquery');
window.jQuery = jQuery
Vue.prototype.jQuery = jQuery

import VueRouter from 'vue-router';
Vue.use(VueRouter);


//import "../../public/plugins/tinymce/tinymce.min.js";

import router from "./router";
import App from './components/App.vue';
import 'vue-toast-notification/dist/theme-default.css';
import "vue-loading-overlay/dist/vue-loading.css";
import "../../public/assets/css/bootstrap-select.min.css"
import Vuelidate from 'vuelidate';
import moment from "moment";
export default {
    data() {
        return {
            moment: moment
        }
    } }
Vue.use(Vuelidate);
Vue.use(VueResource) 

Vue.config.productionTip = false;

new Vue({
  router,
  render: h => h(App),
}).$mount("#app");








