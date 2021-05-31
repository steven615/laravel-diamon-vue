require('./bootstrap');

// Import modules...
import { createApp, h, reactive } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import PrimeVue from 'primevue/config';
import AutoComplete from "primevue/autocomplete";
import Avatar from "primevue/avatar";
import Badge from "primevue/badge";
import Button from 'primevue/button';
import Calendar from 'primevue/calendar';
import Card from 'primevue/card';
import Chart from 'primevue/chart';
import Checkbox from 'primevue/checkbox';
import Chips from 'primevue/chips';
import Column from 'primevue/column';
import ColorPicker from 'primevue/colorpicker';
import DataTable from 'primevue/datatable';
import Dialog from 'primevue/dialog';
import Dropdown from 'primevue/dropdown';
import FileUpload from 'primevue/fileupload';
import FullCalendar from 'primevue/fullcalendar';
import Listbox from 'primevue/listbox';
import Knob from 'primevue/knob';
import MultiSelect from 'primevue/multiselect';
import ProgressBar from 'primevue/progressbar';
import RadioButton from 'primevue/radiobutton';
import Rating from 'primevue/rating';
import ScrollPanel from 'primevue/scrollpanel';
import SelectButton from 'primevue/selectbutton';
import Sidebar from 'primevue/sidebar';
import Skeleton from 'primevue/skeleton';
import Slider from 'primevue/slider';
import InputNumber from 'primevue/inputnumber';
import Password from 'primevue/password';
import InputText from 'primevue/inputtext';
import InputSwitch from 'primevue/inputswitch';
import Tag from 'primevue/tag';
import Textarea from 'primevue/textarea';
import Timeline from 'primevue/timeline';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
import ToggleButton from 'primevue/togglebutton';
import Toolbar from 'primevue/toolbar';
import Menu from 'primevue/menu';
import VueGoogleMaps from '@fawmi/vue-google-maps';

import 'primevue/resources/primevue.min.css';
import 'primevue/resources/themes/saga-blue/theme.css';
import 'primeflex/primeflex.css';
import 'primeicons/primeicons.css';
import '@fullcalendar/core/main.min.css';
import '@fullcalendar/daygrid/main.min.css';
import '@fullcalendar/timegrid/main.min.css';

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
  .use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyCBF5C3nriB3u2cxjLk-aAtmmh9L0rn064',
    },
  })
  .component('Button', Button)
  .component('AutoComplete', AutoComplete)
  .component('Avatar', Avatar)
  .component('Badge', Badge)
  .component('Calendar', Calendar)
  .component('Card', Card)
  .component('Chart', Chart)
  .component('Checkbox', Checkbox)
  .component('Chips', Chips)
  .component('Column', Column)
  .component('ColorPicker', ColorPicker)
  .component('DataTable', DataTable)
  .component('DataView', DataView)
  .component('Dialog', Dialog)
  .component('Dropdown', Dropdown)
  .component('FileUpload', FileUpload)
  .component('FullCalendar', FullCalendar)
  .component('Listbox', Listbox)
  .component('Knob', Knob)
  .component('MultiSelect', MultiSelect)
  .component('ProgressBar', ProgressBar)
  .component('InputNumber', InputNumber)
  .component('InputText', InputText)
  .component('InputSwitch', InputSwitch)
  .component('Password', Password)
  .component('Menu', Menu)
  .component('RadioButton', RadioButton)
  .component('ScrollPanel', ScrollPanel)
  .component('SelectButton', SelectButton)
  .component('Rating', Rating)
  .component('Sidebar', Sidebar)
  .component('Skeleton', Skeleton)
  .component('Slider', Slider)
  .component('Tag', Tag)
  .component('Textarea', Textarea)
  .component('Timeline', Timeline)
  .component('Toast', Toast)
  .component('ToggleButton', ToggleButton)
  .component('Toolbar', Toolbar);


app.config.globalProperties.$appState = reactive({ inputStyle: 'outlined' });

InertiaProgress.init({ color: '#4B5563' });

app.mount(el);
