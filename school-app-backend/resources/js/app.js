//import './bootstrap';
import { createApp } from 'vue';
import HelloVue from './components/HelloVue.vue';

// createApp({
//     components: {
//         HelloVue,
//     }
// }).mount('#app');

createApp({})
  .component('HelloVue', HelloVue)
  .mount('#app')