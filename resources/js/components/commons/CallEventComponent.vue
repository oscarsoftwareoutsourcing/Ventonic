<template>
    <div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="contact_id">Contactado</label>
                    <select id="contact_id" class="custom-select" v-model="contact_id">
                        <option value="">Seleccione...</option>
                        <option :value="contact.id" v-for="contact in contacts">
                            {{ contact.name }} - {{ contact.email }}
                        </option>
                    </select>
                    <!-- Validation messages -->
                    <article class="help-block" v-if="contactIdError">
                        <i class="text-danger">{{ contactIdError }}</i>
                    </article>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="call_result_id">Resultado de la llamada</label>
                    <select id="call_result_id" class="custom-select" v-model="call_result_id">
                        <option value="">Seleccione...</option>
                        <option :value="callResult.id" v-for="callResult in callResults">
                            {{ callResult.name }}
                        </option>
                    </select>
                    <!-- Validation messages -->
                    <article class="help-block" v-if="callResultIdError">
                        <i class="text-danger">{{ callResultIdError }}</i>
                    </article>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="called_at">Fecha</label>
                    <flat-pickr v-model="called_at" class="form-control" :config="flatPicker.config"
                                placeholder="dd-mm-yyyy"/>
                    <!-- Validation messages -->
                    <article class="help-block" v-if="calledAtError">
                        <i class="text-danger">{{ calledAtError }}</i>
                    </article>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="called_time">Hora</label>
                    <flat-pickr :config="flatPicker.configTime" class="form-control" v-model="called_time"
                                placeholder="00:00" />
                    <!-- Validation messages -->
                    <article class="help-block" v-if="calledTimeError">
                        <i class="text-danger">{{ calledTimeError }}</i>
                    </article>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <ckeditor :editor="ckeditor.editor" v-model="description" :config="ckeditor.editorConfig"></ckeditor>
                    <!-- Validation messages -->
                    <article class="help-block" v-if="descriptionError">
                        <i class="text-danger">{{ descriptionError }}</i>
                    </article>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="createTaskFollow" v-model="createTaskFollow">
                        <label class="form-check-label" for="createTaskFollow">
                            Crear una tarea de seguimiento
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <flat-pickr v-model="follow_task" class="form-control" :config="flatPicker.config"
                                placeholder="dd-mm-yyyy" :disabled="!createTaskFollow"/>
                    <!-- Validation messages -->
                    <article class="help-block" v-if="followTaskError">
                        <i class="text-danger">{{ followTaskError }}</i>
                    </article>
                </div>
            </div>
        </div>
        <div class="form-group" v-if="showButtonSave">
            <button type="button" class="btn btn-primary" @click="setCall">
                Guardar
            </button>
        </div>
        <div class="form-group" v-if="showList">
            <hr>
            <div id="accordionCall" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingAccordionCall">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="panel-title text-left">
                                    <a data-toggle="collapse" data-parent="#accordionCall" href="#collapseAccordionCall" aria-expanded="true" aria-controls="collapseAccordionCall">
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
                    <div id="collapseAccordionCall"
                         class="panel-collapse collapse in float-none collapse show"
                         role="tabpanel" aria-labelledby="headingAccordionCall">
                        <div class="media-list media-bordered">
                            <div class="media" v-for="call in calls">
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        {{ call.contact.name }} {{ call.contact.last_name }} -
                                        {{ call.called_at }} {{ call.called_time }}
                                    </h5>
                                    <div class="mb-0" v-html="call.description"></div>
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
                contact_id: '',
                call_result_id: '',
                called_at: '',
                called_time: '',
                description: '',
                createTaskFollow: false,
                follow_task: null,
                calls: [],
                contactIdError: '',
                callResultIdError: '',
                calledAtError: '',
                calledTimeError: '',
                descriptionError: '',
                followTaskError: '',
                contacts: [],
                callResults: [],
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
             * Permite registrar una llamada
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            setCall() {
                const vm = this;
                axios.post('/components/set-call', {
                    contact_id: vm.contact_id,
                    call_result_id: vm.call_result_id,
                    called_at: vm.called_at,
                    called_time: vm.called_time,
                    description: vm.description,
                    createTaskFollow: vm.createTaskFollow,
                    follow_task: vm.follow_task,
                    modelRelationId: vm.modelRelationId,
                    modelRelationClass: vm.modelRelationClass
                }).then(response => {
                    if (response.data.result) {
                        vm.contact_id = '';
                        vm.call_result_id = '';
                        vm.called_at = '';
                        vm.called_time = '';
                        vm.description = '';
                        vm.createTaskFollow = false;
                        vm.follow_task = null;
                        vm.contactIdError = '';
                        vm.callResultIdError = '';
                        vm.calledAtError = '';
                        vm.calledTimeError = '';
                        vm.descriptionError = '';
                        vm.followTaskError = '';
                        vm.getCalls();
                    }
                    vm.$parent.success = response.data.result;
                }).catch(error => {
                    vm.$parent.success = false;
                    if (typeof(error.response) !="undefined") {
                        for (var index in error.response.data.errors) {
                            if (error.response.data.errors[index]) {
                                //
                            }
                        }
                    }
                });
            },
            /**
             * Obtiene un listado de llamadas
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            getCalls() {
                const vm = this;

                axios.get(`/components/get-calls/${vm.modelRelationClass}/${vm.modelRelationId}`).then(response => {
                    if (response.data.result) {
                        vm.calls = response.data.calls;
                    }
                }).catch(error => {
                    console.error(error);
                })
            },
            /**
             * Obtiene un listado de contactos
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            getContacts() {
                const vm = this;

                axios.get('/contacto/get-contacts').then(response => {
                    if (response.data.result) {
                        vm.contacts = response.data.contacts;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Obtiene un listado de resultados de llamadas
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             *
             * @return    {[type]}          [description]
             */
            getCallResults() {
                const vm = this;

                axios.get('/components/get-call-results').then(response => {
                    if (response.data.result) {
                        vm.callResults = response.data.callResults;
                    }
                }).catch(error => {
                    console.log(error);
                });
            }
        },
        mounted() {
            this.getContacts();
            this.getCallResults();
            this.getCalls();
        }
    };
</script>
