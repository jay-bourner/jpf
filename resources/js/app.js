//libraries
import '../sass/app.scss';

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
import Settings from './admin/components/settings/Settings.vue';

createApp(Dashboard).mount('#dashboard');
createApp(ClassesOptions).mount('#classesOptions');
createApp(Settings).mount('#settings');
