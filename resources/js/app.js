require("./bootstrap");
window.Vue = require("vue");
window.moment = require("moment");
window.moment.locale("es");

//Packages Imports
import "vue-select/dist/vue-select.css";
import VueApexCharts from 'vue-apexcharts';
import VueRouter from "vue-router";
import Vuex from "vuex";
import VueAxios from "vue-axios";
import { routes } from "./routes";
import axios from "axios";
import { ClientTable } from "vue-tables-2";
import vSelect from "vue-select";
import VAnimateCss from 'v-animate-css';
import App from "./App.vue";

//Vue Used Packages
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueAxios, axios);
Vue.use(ClientTable);
Vue.use(VAnimateCss);

//New VueRouter Instance
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes
});

//General Components
Vue.component("v-select", vSelect);
Vue.component('apexchart', VueApexCharts);
Vue.component('app-component', App);


//Base Url
axios.defaults.baseURL = 'http://laravel.local/';


//New Vue Instance
const app = new Vue({
    el: "#app",
    router: router,
});
