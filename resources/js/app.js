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

Vue.component('book-grid', require('./components/BookGridComponent.vue').default);
Vue.component('book-thumbnail', require('./components/BookThumbnailComponent.vue').default);
Vue.component('book-search-form-component', require('./components/BookSearchFormComponent').default);
Vue.component('confirm-book-form-component', require('./components/ConfirmBookFormComponent').default);
Vue.component('confirm-book-thumbnail', require('./components/ConfirmBookThumbnailComponent.vue').default);
Vue.component('show-button', require('./components/buttons/ButtonShow').default);
Vue.component('isbn-scanner', require('./components/ISBNScanner').default)

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



