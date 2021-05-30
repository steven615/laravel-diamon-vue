require('./bootstrap');

// Import modules...
import { createApp, h, reactive } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import PrimeVue from 'primevue/config';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';

import 'primevue/resources/primevue.min.css';
import 'primevue/resources/themes/saga-blue/theme.css';
import 'primeflex/primeflex.css';
import 'primeicons/primeicons.css';

const el = document.getElementById('app');

const app = createApp({
  render: () =>
    h(InertiaApp, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: (name) => require(`./Pages/${name}`).default,
    }),
})
  .mixin({ methods: { route } })
  .use(InertiaPlugin)
  .use(PrimeVue, { ripple: true })
  .component('Button', Button)
  .component('InputText', InputText)
  .component('Password', Password);
  

app.config.globalProperties.$appState = reactive({ inputStyle: 'outlined' });

InertiaProgress.init({ color: '#4B5563' });

app.mount(el);
