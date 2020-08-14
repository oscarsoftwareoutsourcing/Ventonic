<template>
    <div>
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
                            <div class="col-sm-4 mt-2" v-for="emailResult in emailResults" v-if="emailResult.email">
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
                                <h6 class="panel-title text-left">
                                    <a data-toggle="collapse" data-parent="#accordionEmail" href="#collapseAccordionEmail" aria-expanded="true" aria-controls="collapseAccordionEmail">
                                        Vista detallada
                                    </a>
                                </h6>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="panel-title text-right">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-cogs"></i> Más opciones
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div id="collapseAccordionEmail"
                         class="panel-collapse collapse in float-none collapse show"
                         role="tabpanel" aria-labelledby="headingAccordionEmail">
                        <div class="media-list media-bordered">
                            <div class="media" v-for="e in emails">
                                <a class="align-self-start media-left" href="#">
                                    <img :src="(e.to_user!==null && e.to_user.photo)?e.to_user.photo:'/images/anonymous-user.png'" alt="user avatar" width="64" height="64">
                                </a>
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        {{ e.to_user.name }} {{ e.to_user.last_name }} -
                                        {{ e.created_at }}
                                    </h5>
                                    <h6 class="media-heading">Asunto: {{ e.subject }}</h6>
                                    <p class="mb-0">Mensaje: {{ e.message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
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
                searchEmailError: ''
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
                    vm.$parent.success = response.data.result;
                }).catch(error => {
                    if (typeof(error.response) !="undefined") {
                        for (var index in error.response.data.errors) {
                            if (error.response.data.errors[index]) {
                                vm.errors[index] = error.response.data.errors[index][0];
                            }
                        }
                    }
                    vm.$parent.success = false;
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
        },
        mounted() {
            this.email.email = this.defaultEmail;
            this.getEmails();
        },
    };
</script>
