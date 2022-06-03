/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//import 'bootstrap';

require('./bootstrap');

// Import jQuery plugins
import 'datatables.net-bs4';
import 'datatables.net-buttons-bs4';
import 'datatables.net-buttons/js/buttons.flash.js';
import 'datatables.net-buttons/js/buttons.html5.js';
import 'datatables.net-buttons/js/buttons.print.js';

//Import perfect scrollbar 
//window.PerfectScrollbar = require('perfect-scrollbar').default;

//Import chart.js
window.Chart = require('chart.js/auto').default;

//Import Leaflet

require('leaflet/dist/leaflet.js');
require('leaflet-sleep');
require('leaflet-search');

L.Icon.Default.imagePath = '/images';
L.Icon.Default.mergeOptions({
    iconRetinaUrl: '/marker-icon-2x.png',
    iconUrl: '/marker-icon.png',
    shadowUrl: '/marker-shadow.png',
});

//Import Select2
//window.select2 = require('select2');
//import select2 from 'select2';

//import 'bootstrap-notify';

window.Vue = require('vue').default;

window.events = new Vue();

window.flash = function(message, type) {
  window.events.$emit('flash', message, type);
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('clientsmap', require('./components/ClientsMap.vue').default);
Vue.component('calendar', require('./components/Calendar.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
}).$mount();




