import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';


import App from './components/followButton.vue'

// createApp(App).component('followButton',App)

const appss = createApp({
    
 });
 appss.component('follow-button', App); //global registration

 appss.mount('#apps');
// createApp(App).mount("#apps")
