import { createApp } from 'vue';
import HomePage from './views/HomePage.vue';
import router from './router';

const app = createApp({});
app.use(router); // <-- this is required
app.component('home-page', HomePage);
app.mount('#app');