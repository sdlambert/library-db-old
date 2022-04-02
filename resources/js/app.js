/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap'); // only need axios here?
// import lodash functions individually

window.Vue = require('vue');

import store from './store';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Generic Components
Vue.component('card', require('./components/BaseCard.vue').default);
Vue.component('modal', require('./components/BaseModal.vue').default);
Vue.component('loader', require('./components/BaseLoader').default);

// Book
Vue.component('book-grid', require('./components/BookGrid.vue').default);
Vue.component('book-thumbnail', require('./components/BookThumbnail.vue').default);
Vue.component('book-detail', require('./components/BookDetail.vue').default);

// Book Search
Vue.component('isbn-search', require('./components/ISBNSearch').default);
Vue.component('isbn-scanner', require('./components/ISBNScanner').default);
Vue.component('confirm-book-thumbnail', require('./components/ConfirmBookThumbnail.vue').default);
Vue.component('confirm-book-buttons', require('./components/ConfirmBookButtons').default);


Vue.component('show-button', require('./components/ButtonShow').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  store: store
});

require('./nav');
require('./forms');



