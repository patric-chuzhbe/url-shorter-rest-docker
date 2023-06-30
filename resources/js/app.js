require('./bootstrap');

import {createApp} from 'vue';

import ShortLinksGenerator from './components/ShortLinksGenerator.vue';
import Preloader from './components/Preloader.vue';

const app = createApp({});

app
    .component('short-links-generator', ShortLinksGenerator)
    .component('preloader', Preloader)
    .mount('#app');
