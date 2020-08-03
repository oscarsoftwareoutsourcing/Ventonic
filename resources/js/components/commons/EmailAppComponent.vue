<template>
    <div>
        <div class="form-group">
            <label for="searchEmail">Email contacto</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Correo electrónico"
                       aria-describedby="searchEmail" v-model="email.email">
                <span class="input-group-addon" id="searchEmail">Buscar Email</span>
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
            <textarea id="message" class="form-control" rows="10" v-model="email.message"
                      placeholder="Agregar un mensaje"></textarea>
        </div>
        <div class="form-group" v-if="showButtonSave">
            <button type="button" class="btn btn-primary" @click="setEmail">
                Guardar
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
                                    <img :src="(e.to_user.photo)?e.to_user.photo:'/images/anonymous-user.png'" alt="user avatar" width="64" height="64">
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
                }
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
            }
        },
        methods: {
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
                    vm.success = response.data.result;
                }).catch(error => {
                    if (typeof(error.response) !="undefined") {
                        for (var index in error.response.data.errors) {
                            if (error.response.data.errors[index]) {
                                vm.errors[index] = error.response.data.errors[index][0];
                            }
                        }
                    }
                    vm.success = false;
                });
            },
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
            this.getEmails();
        },
    };
</script>
