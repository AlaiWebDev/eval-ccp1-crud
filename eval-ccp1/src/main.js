import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import Modal from './components/Modal.vue';

createApp(App).component('Modal', Modal).use(store).use(router).mount('#app');
