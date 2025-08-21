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
import ClassesOptions from './admin/components/ClassesOptions.vue';

createApp(Dashboard).mount('#dashboard');
createApp(ClassesOptions).mount('#classesOptions');
