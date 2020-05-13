require('./bootstrap');

window.Vue = require('vue');
import VueChatScroll from 'vue-chat-scroll';
Vue.use(VueChatScroll);

Vue.component('search-sellers', () => import('./components/SearchSellersComponent.vue'));
Vue.component('chat', () => import('./components/ChatComponent.vue'));

const app = new Vue({
    el: '#app',
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
