require('./bootstrap');

// Import modules...
import { createApp, h, reactive } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import PrimeVue from 'primevue/config';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
import Dialog from 'primevue/dialog';
import DataTable from 'primevue/datatable';
import Dropdown from 'primevue/dropdown';
import Toolbar from 'primevue/toolbar';
import Column from 'primevue/column';
import RadioButton from 'primevue/radiobutton';
import Rating from 'primevue/rating';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import InputSwitch from 'primevue/inputswitch';
import InputNumber from 'primevue/inputnumber';
import Password from 'primevue/password';
import FileUpload from 'primevue/fileupload';
import Textarea from 'primevue/textarea';

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
  .use(ToastService)
  .component('Toast', Toast)
  .component('Dialog', Dialog)
  .component('DataTable', DataTable)
  .component('Dropdown', Dropdown)
  .component('Toolbar', Toolbar)
  .component('Column', Column)
  .component('RadioButton', RadioButton)
  .component('Button', Button)
  .component('InputText', InputText)
  .component('InputSwitch', InputSwitch)
  .component('InputNumber', InputNumber)
  .component('FileUpload', FileUpload)
  .component('Rating', Rating)
  .component('Textarea', Textarea)
  .component('Password', Password);
  

app.config.globalProperties.$appState = reactive({ inputStyle: 'outlined' });

InertiaProgress.init({ color: '#4B5563' });

app.mount(el);
