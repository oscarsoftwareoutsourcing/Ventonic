<template>
    <div>
        <div v-if="configured">
            <div class="modal" tabindex="-1" role="dialog" id="modalSearchEmail">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Buscar Email</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <article class="help-block" v-if="searchEmailError">
                                <i class="text-danger">{{ searchEmailError }}</i>
                            </article>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" v-model="searchText"
                                               placeholder="buscar contactos...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mt-2 col-sm-4" v-for="emailResult in emailResults" v-if="emailResult.email">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" :id="'result'+emailResult.id" name="result"
                                               class="custom-control-input" :value="emailResult.email"
                                               v-model="selectedEmail">
                                        <label class="custom-control-label" :for="'result'+emailResult.id">
                                            {{ emailResult.name }} {{ emailResult.last_name }}<br>
                                            {{ emailResult.email }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" @click="addEmail">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="alert alert-success alert-dismissible" role="alert" v-if="success">
                    <p class="mb-0">Correo enviado</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="form-group">
                <label for="searchEmail">Email contacto</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Correo electrónico"
                           aria-describedby="searchEmail" v-model="email.email">
                    <button type="button" class="input-group-addon btn btn-primary btn-input-group-right" data-toggle="modal"
                            data-target="#modalSearchEmail" @click="searchEmail">
                        Buscar Email
                    </button>
                </div>
                <article class="help-block" v-if="errors.email">
                    <i class="text-danger">{{ errors.email }}</i>
                </article>
            </div>
            <div class="form-group">
                <label for="subject">Asunto</label>
                <input type="text" class="form-control" placeholder="Asunto" v-model="email.subject">
            </div>
            <div class="form-group">
                <label for="message">Mensaje</label>
                <ckeditor :editor="ckeditor.editor" v-model="email.message" :config="ckeditor.editorConfig"></ckeditor>
            </div>
            <div class="form-group" v-if="showButtonSave">
                <button type="button" class="btn btn-primary" @click="setEmail">
                    Enviar
                </button>
            </div>
            <div class="form-group" v-if="showList">
                <hr>
                <div id="accordionEmail" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingAccordionEmail">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="text-left panel-title">
                                        <a data-toggle="collapse" data-parent="#accordionEmail" href="#collapseAccordionEmail" aria-expanded="true" aria-controls="collapseAccordionEmail">
                                            Vista detallada
                                        </a>
                                    </h6>
                                </div>
                                <!--<div class="col-sm-6">
                                    <h6 class="text-right panel-title">
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-cogs"></i> Más opciones
                                        </a>
                                    </h6>
                                </div>-->
                            </div>
                        </div>
                        <div id="collapseAccordionEmail"
                             class="float-none panel-collapse collapse in show"
                             role="tabpanel" aria-labelledby="headingAccordionEmail">
                            <div class="media-list media-bordered">
                                <div class="media" v-for="e in emails">
                                    <a class="align-self-start media-left" href="#">
                                        <img :src="(e.to_user!==null && e.to_user.photo)?e.to_user.photo:'/images/anonymous-user.png'" alt="user avatar" width="64" height="64">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            {{ (e.to_user!==null) ? (e.to_user.name + ' ' + e.to_user.last_name + ' - ') : '' }}
                                            {{ e.created_at }}
                                        </h5>
                                        <h6 class="media-heading">Asunto: {{ e.subject }}</h6>
                                        <div class="accordion" :id="'accordionMsg_'+e.id">
                                            <div class="card">
                                                <div class="card-header" :id="'headingMsg_'+e.id" style="padding:0">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link" type="button"
                                                                data-toggle="collapse" :data-target="'#collapseMsg_'+e.id"
                                                                aria-expanded="true" :aria-controls="'collapseMsg_'+e.id"
                                                                style="padding:0;color:#FFFFFF;">
                                                            Mensaje
                                                            <i aria-hidden="true" class="ml-3 feather icon-chevron-down"
                                                               style="color:#ffffff"></i>
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div :id="'collapseMsg_'+e.id" class="collapse"
                                                     :aria-labelledby="'headingMsg_'+e.id"
                                                     :data-parent="'#accordionMsg_'+e.id">
                                                    <div class="card-body">
                                                        <p class="mb-0">
                                                            <div v-html="e.message"></div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <p class="text-center">
                Para poder enviar emails desde Ventonic tiene que vincular su cuenta de Gmail.<br>
                Abra la sección Email para iniciar el asistente de sincronización.
            </p>
            <div class="mt-2 row">
                <div class="col-12">
                    <a href="/email" class="float-right mb-1 mr-1 btn btn-ventonic waves-effect waves-light" data-toggle="tooltip"
                       title="Pulse sobre el enlace para ir a la configuración de la cuenta de correo">
                        Vincular cuenta
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueLoading from "vuejs-loading-plugin";
    Vue.use(VueLoading, {
        dark: true,
        text: "Procesando",
        loading: false,
        background: "rgba(16, 22, 58, .5)",
    });
    export default {
        data() {
            return {
                success: false,
                email: {
                    email: '',
                    subject: '',
                    message: ''
                },
                emails: [],
                errors: {
                    email: ''
                },
                searchText: '',
                emailResults: [],
                selectedEmail: [],
                searchEmailError: '',
                configured: false,
            }
        },
        props: {
            modelRelationId: {
                type: Number,
                required: true
            },
            modelRelationClass: {
                type: String,
                required: true
            },
            showButtonSave: {
                type: Boolean,
                required: false,
                default: true
            },
            showList: {
                type: Boolean,
                required: false,
                default: true
            },
            defaultEmail: {
                type: String,
                required: false,
                default: ''
            }
        },
        watch: {
            searchText: function() {
                const vm = this;
                vm.searchEmail();
                /*if (vm.searchText) {

                }
                else {
                    vm.emailResults = [];
                }*/
            }
        },
        methods: {
            /**
             * Realiza el procedimiento de consulta de correos de acuerdo a lo indicado por el usuario
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            searchEmail() {
                const vm = this;
                vm.selectedEmail = [];
                vm.searchEmailError = '';
                axios.post('/components/get-contacts-emails', {
                    searchText: vm.searchText
                }).then(response => {
                    if (response.data.result) {
                        vm.emailResults = response.data.contacts;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Agrega el correo electrónico seleccionado por el usuario
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            addEmail() {
                const vm = this;

                if (vm.selectedEmail.length === 0) {
                    vm.searchEmailError = 'Debe seleccionar un contacto';
                    return false;
                }

                $.each(vm.selectedEmail, function(index) {
                    vm.email.email += ((vm.email.email) ? ', ' : '') + vm.selectedEmail[index];
                });

                //vm.email.email = vm.selectedEmail;

                $("#modalSearchEmail").find('.close').click();
            },
            /**
             * Realiza las acciones necesarias para registrar y enviar un correo electrónico
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            setEmail() {
                const vm = this;
                vm.$loading(true);

                axios.post('/components/set-email', {
                    email: vm.email.email,
                    subject: vm.email.subject,
                    message: vm.email.message,
                    modelRelationId: vm.modelRelationId,
                    modelRelationClass: vm.modelRelationClass
                }).then(response => {
                    if (response.data.result) {
                        vm.email = {
                            email: '',
                            subject: '',
                            message: ''
                        };
                        vm.errors.email = '';
                        vm.getEmails();
                    }
                    else {
                        vm.errors.email = response.data.message;
                    }
                    vm.success = response.data.result;
                    vm.$loading(false);
                }).catch(error => {
                    if (typeof(error.response) !="undefined") {
                        for (var index in error.response.data.errors) {
                            if (error.response.data.errors[index]) {
                                vm.errors[index] = error.response.data.errors[index][0];
                            }
                        }
                    }
                    vm.success = false;
                    vm.$loading(false);
                });
            },
            /**
             * Obtiene un listado de correos enviados desde algún módulo de la aplicación
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            getEmails() {
                const vm = this;
                axios.get(`/components/get-emails/${vm.modelRelationClass}/${vm.modelRelationId}`).then(response => {
                    if (response.data.result) {
                        vm.emails = response.data.emails;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Determina si se ha configurado una cuenta externa para la gestión de correos
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             *
             * @return    {Boolean}    Devuelve verdadero si tiene una cuenta configurada, de lo contrario retorna falso
             */
            isConfigured() {
                const vm = this;
                axios.get('/email/is-configured').then(response => {
                    vm.configured = response.data.result;
                }).catch(error => {
                    console.error(error);
                });
            }
        },
        created() {
            this.isConfigured();
        },
        mounted() {
            this.email.email = this.defaultEmail;
            this.getEmails();
        },
    };
</script>
