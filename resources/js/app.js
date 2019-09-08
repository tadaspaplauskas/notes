// // window._ = require('lodash');
// require('bootstrap');
// window.Vue = require('vue');
// window.axios = require('axios');

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// let token = document.head.querySelector('meta[name="csrf-token"]');

// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }

// // Separate Vue instance to communicate between components that are siblings
// window.EventBus = new Vue();

// // autoloading vuejs components
// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// const app = new Vue({
//     el: '#app',
// });

