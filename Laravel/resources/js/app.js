/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuetify = require('vuetify');

import L from 'leaflet';

delete L.Icon.Default.prototype._getIconUrl;

L.Icon.Default.mergeOptions({
    iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
    iconUrl: require('leaflet/dist/images/marker-icon.png'),
    shadowUrl: require('leaflet/dist/images/marker-shadow.png')
});

import Vuebar from 'vuebar';
Vue.use(Vuebar);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


import store from './store/session-store'


Vue.component('main-page',
    require('./MainPage').default);

Vue.component('first-page',
    require('./components/FirstPage').default
);

Vue.component('route-list',
    require('./components/Routes').default
);

Vue.component('map-page',
    require('./components/MapPage').default
);

Vue.component('login-screen',
    require('./components/auth/loginScreen').default
);


import VueResizeText from 'vue-resize-text';
Vue.use(VueResizeText);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    Vuetify,
    store,
    methods: {
        disableInputEvents(element) {
            L.DomEvent.disableClickPropagation(element.$el);
            L.DomEvent.disableScrollPropagation(element.$el);
        }
    }
});
