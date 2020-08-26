import VueChatScroll from "vue-chat-scroll";
import PerfectScrollbar from "vue2-perfect-scrollbar";
import "vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css";
import Vuelidate from "vuelidate";
// Import store modules.
import store from "./store/index.js";
import moment from "moment";
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import '@ckeditor/ckeditor5-build-classic/build/translations/es';
import Datepicker from 'vuejs-datepicker';
import { es } from 'vuejs-datepicker/dist/locale';
import VueFlatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import {Spanish} from 'flatpickr/dist/l10n/es.js';
import VuePaginate from 'vue-paginate';


require("./bootstrap");

window.Vue = require("vue");
Vue.use(VueChatScroll);
Vue.use(Vuelidate);
Vue.use(PerfectScrollbar);
Vue.use(CKEditor);
Vue.use(VueFlatPickr);
Vue.use(VuePaginate);

Vue.component("search-sellers", () =>
    import("./components/SearchSellersComponent.vue")
);
Vue.component("chat", () => import("./components/ChatComponent.vue"));
Vue.component("free-apps", () => import("./components/FreeApp.vue"));

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
Vue.component('call-event', () => import("./components/commons/CallEventComponent.vue"));
Vue.component('task', () => import("./components/commons/TaskComponent.vue"));
Vue.component('remember-activity', () => import('./components/commons/RememberActivityComponent.vue'));

/** Gestión de contactos */
Vue.component('contact-detail', () => import('./components/ContactDetailComponent.vue'));

/** Componentes de configuración */
Vue.component('email-template', () => import('./components/settings/EmailTemplateComponent.vue'));

Vue.mixin({
    components: {
        Datepicker
    },
    data() {
        return {
            distance: '', //Distancia entre 2 puntos de un mapa
            linkGmap: '',
            errors: {},
            ckeditor: {
                editor: ClassicEditor,
                editorConfig: {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'blockQuote', 'link',
                        'numberedList', 'bulletedList', '|',
                        'insertTable', 'tableColumn', 'tableRow', 'mergeTableCells', '|',
                        'undo', 'redo'
                    ],
                    language: 'es'
                }
            },
            datepicker: {
                language: es,
                format: 'dd-MM-yyyy',
                class: 'form-control',
            },
            flatPicker: {
                config: {
                    wrap: true, // set wrap to true only when using 'input-group'
                    altFormat: 'd-m-Y',
                    altInput: true,
                    dateFormat: 'd-m-Y',
                    locale: Spanish, // locale for this instance only
                },
                configTime: {
                    enableTime: true,
                    enableSeconds: false,
                    noCalendar: true,
                    time_24hr: true,
                    defaultHour: 0,
                    minuteIncrement: 1
                }
            }
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
        shortDateFormat(value, separator = '-') {
            return moment(String(value)).format(`DD${separator}MM${separator}YYYY`);
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
        /**
         * Obtiene el nombre de un archivo a partir del path del mismo
         *
         * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
         *
         * @param     {string}       filePath    Ruta del archivo
         *
         * @return    {string}       Nombre del archivo
         */
        getFileName(filePath) {
            var pathSections = filePath.split("/");
            return pathSections[pathSections.length - 1];
        },
        /**
         * Inicializa los datos del mapa
         *
         * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
         *
         * @param     {string}         mapContainerId    Identificador del contenedor del mapa
         * @param     {string}         address           Dirección bajo la cual establecer un marcador en el mapa
         * @param     {float}          lat               Coordenada de latitud de la dirección
         * @param     {float}          lng               Coordenada de longitud de la dirección
         * @param     {Boolean}        otherLocation     Establece si se va a mostrar otra ubicación a partir de la
         *                                               localización del usuario autenticado
         */
        initializeMap(mapContainerId, address, lat, lng, otherLocation = false) {
            const vm = this;
            const geocoder = new google.maps.Geocoder();
            let marker = null;

            const map = new google.maps.Map(document.getElementById(mapContainerId), {
                center: {lat: lat || 0, lng: lng || 0},
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            if (!lat && !lng) {
                const localAddress = address.replace('\n', ' ');
                var locationLat = 0, locationLng = 0;
                /*const queryAddress = `https://maps.googleapis.com/maps/api/geocode/json?address=${localAddress}&key=AIzaSyCN7QXrQX8mlDNTdtcSY5dzZzrVJ1516hw`;

                if (queryAddress.results.length === 0) {
                    return false;
                }*/
                geocoder.geocode({'address': localAddress}, function(results, status) {
                    if (status == 'OK') {
                        map.setCenter(results[0].geometry.location);
                        marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location
                        });
                        marker.setVisible(true);
                        vm.linkGmap = `https://www.google.com/maps/dir/${marker.getPosition().lat()},${marker.getPosition().lng()}/`;
                    }
                });
            }
            else {
                marker = new google.maps.Marker({
                    map: map,
                    position: {lat: lat, lng: lng}
                });
                marker.setVisible(true);
                vm.linkGmap = `https://www.google.com/maps/dir/${marker.getPosition().lat()},${marker.getPosition().lng()}/`;
            }


            /**
             * Si se ha indicado que existe otra localización bajo la cual se debe establecer una distancia
             * entre ambas localizaciones
             */
            if (otherLocation && navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var latlng = {
                        lat: parseFloat(position.coords.latitude),
                        lng: parseFloat(position.coords.longitude)
                    };
                    geocoder.geocode({ 'location': latlng }, function (results, status) {
                        if (status === 'OK') {
                            var myMarker = new google.maps.Marker({
                                map: map,
                                position: results[0].geometry.location
                            });
                            myMarker.setVisible(true);
                            var line = new google.maps.Polyline({
                                map: map,
                                path: [
                                    {lat: lat, lng: lng}, //posición 1
                                    {lat: latlng.lat, lng: latlng.lng} // posición actual del usuario
                                ]
                            });

                            vm.distance = vm.measureGeometryDistance(marker, myMarker);
                            const myLat = myMarker.getPosition().lat();
                            const myLng = myMarker.getPosition().lng();
                            const contactLat = marker.getPosition().lat();
                            const contactLng = marker.getPosition().lng();
                            vm.linkGmap = `https://www.google.com/maps/dir/${myLat},${myLng}/${contactLat},${contactLng}/`;
                        }
                    });
                });
            }
        },
        /**
         * Calcula la distancia entre dos marcadores del mapa
         *
         * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
         *
         * @param     {object}                   mk1    Objeto con datos del marcador 1
         * @param     {object}                   mk2    Objeto con datos del marcador 2
         *
         * @return    {float}                    Distancia calculada en kilómetros
         */
        measureGeometryDistance(mk1, mk2) {
            var R = 3958.8; // Radius of the Earth in miles
              var rlat1 = mk1.position.lat() * (Math.PI/180); // Convert degrees to radians
              var rlat2 = mk2.position.lat() * (Math.PI/180); // Convert degrees to radians
              var difflat = rlat2-rlat1; // Radian difference (latitudes)
              var difflon = (mk2.position.lng()-mk1.position.lng()) * (Math.PI/180); // Radian difference (longitudes)

              /** @type {float} Distancia en millas */
              var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
              // retorna la distancia en kilómetros
              return d * 1.609344;
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
