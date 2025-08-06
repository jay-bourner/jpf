// //libraries
import 'summernote/dist/summernote-lite.js';

// JavaScript imports
import './bootstrap';
import { StartUp } from './startup/StartUp';

new StartUp();

import { createApp } from 'vue';
import App from './admin/App.vue'
createApp(App).mount('#app');