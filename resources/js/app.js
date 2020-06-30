import VueChatScroll from 'vue-chat-scroll';
import PerfectScrollbar from 'vue2-perfect-scrollbar';
import 'vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css';
import Vuelidate from 'vuelidate';
// Import store modules.
import store from './store/index.js';

require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueChatScroll);
Vue.use(Vuelidate);
Vue.use(PerfectScrollbar);


Vue.component('search-sellers', () => import('./components/SearchSellersComponent.vue'));
Vue.component('chat', () => import('./components/ChatComponent.vue'));
Vue.component('notification', () => import('./components/NotificationComponent.vue'));
Vue.component('notification-item', () => import('./components/NotificationItemComponent.vue'));

// Notes module components
Vue.component('todos-module', () => import('./components/Todos.vue'));
Vue.component('todo-sidebar', () => import('./components/TodoSidebar.vue'));
Vue.component('todo-list', () => import('./components/TodoList.vue'));
Vue.component('todo-form', () => import('./components/TodoForm.vue'));

// Negotiations module components
Vue.component('negotiations-module', () => import('./components/Negotiations.vue'));
Vue.component('negotiation-process-list', () => import('./components/NegProcessList.vue'));
Vue.component('negotiation-card', () => import('./components/NegCard.vue'));
Vue.component('negotiation-form', () => import('./components/NegForm.vue'));

const app = new Vue({
    el: '#app',
    store
});

$(document).ready(function() {
    $('input[name^="filter_"]').on('click', function() {
        var filter = [];
        $('input[name^="filter_"]').each(function() {
            if ($(this).is(':checked')) {
                filter.push($(this).val());
            }
        });

        if (filter.length > 0 || $('#searchSeller').val()) {
            axios.post('/filtro', {
                options: filter, search_input: $('#searchSeller').val()
            }).then(response => {
                var results = '';
                if (response.data) {
                    $(response.data).each(function() {
                        results += `<tr>
                                        <td>${this.name}</td>
                                        <td>${this.last_name}</td>
                                        <td>${this.email}</td>
                                        <td>${(this.status) ? 'Conectado' : 'Desconectado'}</td>
                                    </tr>`;
                    });
                }
                $("#tableResultSellers").find("tbody").html(results);
            }).catch(error => {
                console.error(error);
            });
        }
    });


});

