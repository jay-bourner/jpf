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
import Dashboard from './admin/components/Dashboard.vue'
import ClassesMenu from './admin/components/ClassesMenu.vue';

createApp(Dashboard).mount('#dashboard');
createApp(ClassesMenu).mount('#classesMenu');