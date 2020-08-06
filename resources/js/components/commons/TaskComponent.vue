<template>
    <div>
        <div class="row">
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" v-model="title">
                    <!-- Validation messages -->
                    <article class="help-block" v-if="titleError">
                        <i class="text-danger">{{ titleError }}</i>
                    </article>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="tasked_at">Fecha</label>
                    <flat-pickr v-model="tasked_at" class="form-control" :config="flatPicker.config"
                                placeholder="dd-mm-yyyy" id="tasked_at"/>
                    <!-- Validation messages -->
                    <article class="help-block" v-if="taskedAtError">
                        <i class="text-danger">{{ taskedAtError }}</i>
                    </article>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="tasked_time">Hora</label>
                    <flat-pickr :config="flatPicker.configTime" class="form-control" v-model="tasked_time"
                                placeholder="00:00" id="tasked_time"/>
                    <!-- Validation messages -->
                    <article class="help-block" v-if="taskedTimeError">
                        <i class="text-danger">{{ taskedTimeError }}</i>
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
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="task_type_id">Tipo</label>
                    <select id="task_type_id" class="custom-select" v-model="task_type_id">
                        <option value="">Seleccione...</option>
                        <option :value="taskType.id" v-for="taskType in taskTypes">
                            {{ taskType.name }}
                        </option>
                    </select>
                    <!-- Validation messages -->
                    <article class="help-block" v-if="taskTypeIdError">
                        <i class="text-danger">{{ taskTypeIdError }}</i>
                    </article>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="task_priority_id">Prioridad</label>
                    <select id="task_priority_id" class="custom-select" v-model="task_priority_id">
                        <option value="">Seleccione...</option>
                        <option :value="taskPriority.id" v-for="taskPriority in taskPriorities">
                            {{ taskPriority.name }}
                        </option>
                    </select>
                    <!-- Validation messages -->
                    <article class="help-block" v-if="taskPriorityIdError">
                        <i class="text-danger">{{ taskPriorityIdError }}</i>
                    </article>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="contact_id">Asignado a</label>
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
        </div>
        <remember-activity ref="taskRemember"></remember-activity>
        <div class="form-group" v-if="showButtonSave">
            <button type="button" class="btn btn-primary" @click="setTask">
                Guardar
            </button>
        </div>
        <div class="form-group" v-if="showList">
            <hr>
            <div id="accordionTask" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingAccordionTask">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="panel-title text-left">
                                    <a data-toggle="collapse" data-parent="#accordionTask" href="#collapseAccordionTask" aria-expanded="true" aria-controls="collapseAccordionTask">
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
                    <div id="collapseAccordionTask"
                         class="panel-collapse collapse in float-none collapse show"
                         role="tabpanel" aria-labelledby="headingAccordionTask">
                        <div class="media-list media-bordered">
                            <div class="media" v-for="task in tasks">
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        {{ task.contact.name }} {{ task.contact.last_name }} -
                                        {{ task.tasked_at }} {{ task.tasked_time }}
                                    </h5>
                                    <div class="mb-0" v-html="task.description"></div>
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
                title: '',
                tasked_at: '',
                tasked_time: '',
                description: '',
                remember_at: '',
                remember_time: '',
                task_queue_id: '',
                task_type_id: '',
                task_priority_id: '',
                contact_id: '',
                titleError: '',
                taskedAtError: '',
                taskedTimeError: '',
                descriptionError: '',
                taskTypeIdError: '',
                taskPriorityIdError: '',
                rememberAtError: '',
                rememberTimeError: '',
                taskQueueIdError: '',
                contactIdError: '',
                tasks: [],
                taskTypes: [],
                taskPriorities: [],
                taskQueues: [],
                contacts: [],
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
            reset() {
                const vm = this;
                vm.title = '';
                vm.tasked_at = '';
                vm.tasked_time = '';
                vm.description = '';
                vm.task_type_id = '';
                vm.task_priority_id = '';
                vm.contact_id = '';
                vm.titleError = '';
                vm.taskedAtError = '';
                vm.taskedTimeError = '';
                vm.descriptionError = '';
                vm.taskTypeIdError = '';
                vm.taskPriorityIdError = '';
                vm.contactIdError = '';
            },
            /**
             * Registra una nueva tarea
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            setTask() {
                const vm = this;

                axios.post('/components/set-task', {
                    title: vm.title,
                    tasked_at: vm.tasked_at,
                    tasked_time: vm.tasked_time,
                    description: vm.description,
                    remember_at: vm.$refs.taskRemember.remember_at,
                    remember_time: vm.$refs.taskRemember.remember_time,
                    task_queue_id: vm.$refs.taskRemember.task_queue_id,
                    task_type_id: vm.task_type_id,
                    task_priority_id: vm.task_priority_id,
                    contact_id: vm.contact_id,
                    modelRelationId: vm.modelRelationId,
                    modelRelationClass: vm.modelRelationClass
                }).then(response => {
                    if (response.data.result) {
                        vm.$refs.taskRemember.reset();
                        vm.reset();
                        vm.getTasks();
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
             * Obtiene un listado de tareas
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            getTasks() {
                const vm = this;

                axios.get(`/components/get-tasks/${vm.modelRelationClass}/${vm.modelRelationId}`).then(response => {
                    if (response.data.result) {
                        vm.tasks = response.data.tasks;
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
             * Obtiene un listado de tipos de tareas
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            getTaskTypes() {
                const vm = this;

                axios.get('/components/get-task-types').then(response => {
                    if (response.data.result) {
                        vm.taskTypes = response.data.taskTypes;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Obtiene un listado de prioridades de tareas
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            getTaskPriorities() {
                const vm = this;

                axios.get('/components/get-task-priorities').then(response => {
                    if (response.data.result) {
                        vm.taskPriorities = response.data.taskPriorities;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
        },
        mounted() {
            this.getTasks();
            this.getContacts();
            this.getTaskTypes();
            this.getTaskPriorities();
        }
    };
</script>
