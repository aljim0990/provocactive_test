
require('./bootstrap');
window.Vue = require('vue').default;

import { Form, HasError, AlertError } from 'vform';
import Multiselect from "vue-multiselect";
import JsonExcel from 'vue-json-excel';
import VueSimpleAlert from "vue-simple-alert";
window.Form = Form;
Vue.use(VueSimpleAlert);
Vue.component('multiselect', Multiselect);
Vue.component('downloadExcel', JsonExcel);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user-list', require('./components/UsersList.vue').default);
// Vue.component('admin-user-voucher-list', require('./components/AdminsUsersVouchersList.vue').default);
 const app = new Vue({
    el: '#app'
});

