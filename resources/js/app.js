import VueChatScroll from "vue-chat-scroll";
import PerfectScrollbar from "vue2-perfect-scrollbar";
import "vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css";
import Vuelidate from "vuelidate";
// Import store modules.
import store from "./store/index.js";
import moment from "moment";

require("./bootstrap");

window.Vue = require("vue");
Vue.use(VueChatScroll);
Vue.use(Vuelidate);
Vue.use(PerfectScrollbar);

Vue.component("search-sellers", () =>
    import("./components/SearchSellersComponent.vue")
);
Vue.component("chat", () => import("./components/ChatComponent.vue"));
Vue.component("email-setting", () =>
    import("./components/EmailSettingComponent.vue")
);
Vue.component("email", () => import("./components/EmailComponent.vue"));
Vue.component("notification", () =>
    import("./components/NotificationComponent.vue")
);
Vue.component("notification-item", () =>
    import("./components/NotificationItemComponent.vue")
);

// Notes module components
Vue.component("todos-module", () => import("./components/Todos.vue"));
Vue.component("todo-sidebar", () => import("./components/TodoSidebar.vue"));
Vue.component("todo-list", () => import("./components/TodoList.vue"));
Vue.component("todo-form", () => import("./components/TodoForm.vue"));

// Negotiations Module
Vue.component("negotiations-module", () => import("./components/Negotiations.vue"));
Vue.component("negotiations-controls", () => import("./components/NegControls.vue"));
Vue.component("negotiations-filters", () => import("./components/NegFilters.vue"));
Vue.component("negotiations-list", () => import("./components/NegsList.vue"));
Vue.component("negotiation-card", () => import("./components/NegCard.vue"));

Vue.component("negotiation-form", () => import("./components/NegForm.vue"));
Vue.component("negotiation-details", () => import("./components/NegDetails.vue"));
Vue.component("negotiation-event-modal", () => import("./components/NegEventModal.vue"));
Vue.component("negotiation-file-modal", () => import("./components/NegFileModal.vue"));
Vue.component("negotiation-confirm-modal", () => import("./components/NegConfirmModal.vue"));

/** Componentes comúnes */
Vue.component("email-app", () => import("./components/commons/EmailAppComponent.vue"));
Vue.component('note', () => import("./components/commons/NoteComponent.vue"));
Vue.component('event', () => import("./components/commons/EventComponent.vue"));
Vue.component('media-file', () => import("./components/commons/MediaFileComponent.vue"));

Vue.mixin({
    data() {
        return {
            errors: {}
        };
    },
    methods: {
        /**
         * Determina si un campo del formulario contiene algún error de validación
         *
         * @param     {string}     field    Nombre del campo a validar
         *
         * @return    {Boolean}    Devuelve verdadero si el campo a validar contiene algún error,
         *                         de lo contrario devuelve falso
         */
        hasErrors(field) {
            const vm = this;
            return typeof vm.errors[field] !== "undefined";
        },
        /**
         * Establece el formato de fecha y hora para una cadena de texto
         *
         * @param     {string}           value    Cadena de texto con la fecha y hora a ser formateada
         *
         * @return    {string}           Devuelve la fecha y hora en formato MMMM Do YYYY, h:mm:ss a
         */
        datetime_format(value) {
            return moment(String(value)).format("MMMM Do YYYY, h:mm:ss a");
        },
        /**
         * Establece el formato de fecha para una cadena de texto
         *
         * @param     {string}       value    Cadena de texto con la fecha a ser formateada
         *
         * @return    {string}       Devuelve la fecha en formato MMMM Do YYYY
         */
        date_format(value) {
            return moment(String(value)).format("MMMM Do YYYY");
        },
        /**
         * Estableve el formato de hora para una cadena de texto
         *
         * @param     {string}       value    Cadena de texto con la hora a ser formateada
         *
         * @return    {string}       Devuelve la hora en formato h:mm:ss a
         */
        time_format(value) {
            return moment(String(value)).format("h:mm:ss a");
        },
        getFileName(filePath) {
            var pathSections = filePath.split("/");
            return pathSections[pathSections.length - 1];
        }
    }
});



const app = new Vue({
    el: "#app",
    store
});

$(document).ready(function() {
    $('input[name^="filter_"]').on("click", function() {
        var filter = [];
        $('input[name^="filter_"]').each(function() {
            if ($(this).is(":checked")) {
                filter.push($(this).val());
            }
        });

        if (filter.length > 0 || $("#searchSeller").val()) {
            axios
                .post("/filtro", {
                    options: filter,
                    search_input: $("#searchSeller").val()
                })
                .then(response => {
                    var results = "";
                    if (response.data) {
                        $(response.data).each(function() {
                            results += `<tr>
                                        <td>${this.name}</td>
                                        <td>${this.last_name}</td>
                                        <td>${this.email}</td>
                                        <td>${
                                            this.status
                                                ? "Conectado"
                                                : "Desconectado"
                                        }</td>
                                    </tr>`;
                        });
                    }
                    $("#tableResultSellers")
                        .find("tbody")
                        .html(results);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
});
