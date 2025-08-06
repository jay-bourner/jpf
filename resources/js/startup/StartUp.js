// import { createApp } from 'vue';
// import App from './App.vue';
import { Modules } from './Modules';

class StartUp {
    constructor() {
        new Modules();
        // createApp(App).mount('#app');
    }
}

export { StartUp }