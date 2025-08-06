//libraries
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;
import 'summernote/dist/summernote-lite.js';

// JavaScript imports
import './bootstrap';
import { StartUp } from './startup/StartUp';

new StartUp();

// Vue.js imports and initialisation
import { createApp } from 'vue';
import App from './admin/App.vue'
createApp(App).mount('#app');