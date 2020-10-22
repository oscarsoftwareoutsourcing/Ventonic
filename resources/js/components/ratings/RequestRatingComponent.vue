<template>
    <div class="form-group row ml-4 mr-4">
        <p>
            No hay valoraciones disponibles
            <button type="button" class="btn btn-primary btn-sm ml-2"
                    data-toggle="modal" data-target="#requestRatings"
                    @click="listContacts">
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
                            <form-wizard title="Solicitud de valoración" @on-complete="sendRequest" subtitle=""
                                         nextButtonText="Siguiente" backButtonText="Atrás"
                                         finishButtonText="Enviar Solicitud">
                                <tab-content title="Inicio">
                                    <p>
                                        A través de este asistente podrás solicitar a clientes con los que has trabajado que publiquen una valoración sobre tus servicios
                                    </p>
                                </tab-content>
                                <tab-content title="Contactos">
                                    <div class="row" v-if="contacts">
                                        <div class="mt-2 col-sm-4" v-for="contact in contacts">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" :id="'contact'+contact.id" name="contact"
                                                       class="custom-control-input"
                                                       :value="(contact.email)?contact.email:contact.id"
                                                       v-model="selectedContacts" @click="verifyEmail(contact)">
                                                <label class="custom-control-label" :for="'contact'+contact.id">
                                                    {{ contact.name }} {{ contact.last_name }}<br>
                                                    {{ contact.email }}
                                                </label>
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
                ratings: [],
                contacts: [],
                selectedContacts: []
            }
        },
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        watch: {
            //
        },
        methods: {
            listContacts() {
                const vm = this;
                axios.get('/contacto/get-company-contacts').then(response => {
                    if (response.data.result) {
                        vm.contacts = response.data.contacts;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            verifyEmail(contact) {
                const vm = this;
                const contactId = contact.id;
                if (!contact.email && $(`#contact${contact.id}`).is(':checked')) {
                    bootbox.alert(
                        `Este contacto no tiene una dirección de correo electrónica asociada.
                        Si quieres enviarle una solicitud tienes que ir a la sección "Contactos"
                        y añadir su correo electrónico`
                    );
                    // Agregar instrucciones para desmarcar el contacto
                }
            },
            sendRequest() {
                const vm = this;
                axios.post('/send-rating-request', {
                    contacts: vm.selectedContacts
                }).then(response => {
                    if (response.data.result) {
                        $(".alert-request").text('Solicitud enviada');
                        $(".alert-request").show();
                    }
                }).catch(error => {
                    console.error(error);
                })
            }
        },
        created() {
            const vm = this;
            vm.listContacts();
        }
    };
</script>

