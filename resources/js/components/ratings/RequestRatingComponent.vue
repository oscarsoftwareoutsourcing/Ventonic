<template>
    <div class="form-group row ml-4 mr-4" v-if="showRequestRating">
        <p>
            No hay valoraciones disponibles
            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light ml-2"
                    data-toggle="modal" data-target="#requestRatings"
                    @click="searchContact">
                Solicitar Valoraciones
            </button>

            <!-- Modal -->
            <div class="modal fade" id="requestRatings" role="dialog"
                 aria-labelledby="requestRatingsTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg"
                     role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="requestRatingsTitle">
                                Solicitud de Valoraciones
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert" v-if="requestRatingError">
                                <h4 class="alert-heading">Error</h4>
                                <p class="mb-0">{{ requestRatingError }}</p>
                            </div>
                            <form-wizard title="Solicitud de valoración" @on-complete="sendRequest"
                                         nextButtonText="Siguiente" backButtonText="Atrás" step-size="sm"
                                         finishButtonText="Enviar Solicitud" subtitle="">
                                <tab-content title="Inicio">
                                    <p>
                                        A través de este asistente podrás solicitar a clientes con los que has trabajado que publiquen una valoración sobre tus servicios
                                    </p>
                                </tab-content>
                                <tab-content title="Contactos" :before-change="hasSelectedContacts">
                                    <div class="row wizard-container-contacts" v-if="contacts">
                                        <div class="col-12">
                                            <article class="help-block" v-if="searchContactError">
                                                <i class="text-danger">{{ searchContactError }}</i>
                                            </article>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" v-model="searchText"
                                                       placeholder="buscar contactos...">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="mt-2 col-sm-4" v-for="(contact, index) in paginate(contacts)">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" :id="'contact'+contact.id"
                                                               name="contact" class="custom-control-input"
                                                               :value="(contact.email)?contact.email:contact.id"
                                                               v-model="selectedContacts"
                                                               @click="verifyEmail(contact, index)">
                                                        <label class="custom-control-label" :for="'contact'+contact.id">
                                                            {{ contact.name }} {{ contact.last_name }}<br>
                                                            {{ contact.email }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <nav class="mt-3">
                                                        <ul class="paginate-links pagination d-flex justify-content-center">
                                                            <li class="left-arrow page-item"
                                                                :class="{'disabled': page_number===1}">
                                                                <a class="page-link" @click="page_number-=1">‹</a>
                                                            </li>
                                                            <li class="number page-item"
                                                                :class="{'active': index===page_number-1}"
                                                                v-for="(page, index) in paginateLinks(contacts)">
                                                                <a href="javascript:void(0)" class="page-link"
                                                                   @click="page_number=page">
                                                                    {{ page }}
                                                                </a>
                                                            </li>
                                                            <li class="right-arrow page-item"
                                                                :class="{'disabled': page_number===page_total}">
                                                                <a class="page-link" @click="page_number+=1">›</a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-else>
                                        <p>No tiene registrado contactos de empresas</p>
                                    </div>
                                </tab-content>
                                <tab-content title="Enviar">
                                    <p>
                                        Has seleccionado {{ selectedContacts.length }} contacto{{ selectedContacts.length > 1 ? 's' : '' }}
                                    </p>
                                </tab-content>
                            </form-wizard>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"
                                    data-dismiss="modal">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </p>
    </div>
</template>

<script>
    import VueFormWizard from "vue-form-wizard";
    import "vue-form-wizard/dist/vue-form-wizard.min.css";
    Vue.use(VueFormWizard);

    export default {
        data() {
            return {
                showRequestRating: true,
                requestRatingError: '',
                ratings: [],
                contacts: [],
                selectedContacts: [],
                searchContactError: '',
                searchText: '',
                page_size: 10,
                page_number: 1,
                page_total: 1
            }
        },
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        watch: {
            searchText: function() {
                const vm = this;
                vm.searchContact();
            },
            page_number() {
                const vm = this;
                vm.paginate;
            },
        },
        methods: {
            searchContact() {
                const vm = this;
                vm.searchContactError = '';
                axios.post('/components/get-contacts-emails', {
                    searchText: vm.searchText
                }).then(response => {
                    if (response.data.result) {
                        vm.contacts = response.data.contacts;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            /*searchContact() {
                const vm = this;
                axios.get('/contacto/get-company-contacts').then(response => {
                    if (response.data.result) {
                        vm.contacts = response.data.contacts;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },*/
            verifyEmail(contact, index) {
                const vm = this;
                const contactId = contact.id;
                if (!contact.email && $(`#contact${contact.id}`).is(':checked')) {
                    bootbox.alert(
                        `Este contacto no tiene una dirección de correo electrónica asociada.
                        Si quieres enviarle una solicitud tienes que ir a la sección "Contactos"
                        y añadir su correo electrónico`
                    );
                    $(`#contact${contact.id}`).prop("checked", false);
                }
            },
            sendRequest() {
                const vm = this;
                axios.post('/send-rating-request', {
                    contacts: vm.selectedContacts
                }).then(response => {
                    if (response.data.result) {
                        $("#requestRatings").find('.close').click();
                        $(".alert-request").text('Solicitud enviada');
                        $(".alert-request").show();
                        //vm.showRequestRating = false;
                        vm.selectedContacts = [];
                    }
                }).catch(error => {
                    console.error(error);
                })
            },
            paginate(array) {
                const vm = this;
                var index = Math.abs(parseInt(vm.page_number));
                index = index > 0 ? index - 1 : index;
                var size = parseInt(vm.page_size);
                size = size < 1 ? 1 : size;
                return [...(array.filter((value, n) => {
                    return (n >= (index * size)) && (n < ((index+1) * size));
                }))];
            },
            paginateLinks(array) {
                const vm = this;
                var numbers = Math.round(array.length / vm.page_size);

                if (numbers.length === 0) {
                    return [1];
                }
                var pages = Array.from({ length: numbers - 1 + 1 }, (_, i) => i+1);
                vm.page_total = pages.length;
                return pages;
            },
            paginateNumber(array, page, index) {

            },
            hasSelectedContacts() {
                const vm = this;
                vm.requestRatingError = '';
                if (vm.selectedContacts.length === 0) {
                    vm.requestRatingError = 'Debe seleccionar al menos un contacto para poder enviar la solicitud';
                }
                return vm.requestRatingError === "";
            }
        },
        created() {
            const vm = this;
            vm.searchContact();
        }
    };
</script>

