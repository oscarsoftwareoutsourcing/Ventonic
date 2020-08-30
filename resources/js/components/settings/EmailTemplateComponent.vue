<template>
    <div class="card">
        <div class="header_ventonic-description">
            <div class="card_vetonic-description">
                <div class="text_vetonic-description">
                    Crear Plantilla
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-2">
                <div class="col">
                    <div class="form-group">
                        <label class="mb-1">Plantilla de correo</label>
                        <select class="form-control" :class="{'is-invalid': mailableError}" v-model="mailable"
                                data-toggle="tooltip" title="Seleccione el tipo de plantilla a implementar">
                            <option value="">Seleccione...</option>
                            <option :value="mail.class" v-for="mail in mailables" @click="setVariables(mail.variables)">
                                {{ mail.text }}
                            </option>
                        </select>
                        <div class="alert alert-danger" v-if="mailableError">{{ mailableError }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="mb-1">Módulo o Sección</label>
                        <select class="form-control" :class="{'is-invalid': moduleError}" v-model="module"
                                title="Seleccione el módulo u opción del sistema para el cual aplicar la plantilla"
                                data-toggle="tooltip">
                            <option value="">Seleccione...</option>
                            <option :value="mod.class" v-for="mod in modules">
                                {{ mod.text }}
                            </option>
                        </select>
                        <div class="alert alert-danger" v-if="moduleError">{{ moduleError }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="mb-1">Tipo</label>
                        <select class="form-control" :class="{'is-invalid': typeError}" v-model="type"
                                data-toggle="tooltip" title="Seleccione el tipo de correo al cual aplicar la plantilla">
                            <option value="">Seleccione...</option>
                            <option :value="tp.id" v-for="tp in types">{{ tp.text }}</option>
                        </select>
                        <div class="alert alert-danger" v-if="typeError">{{ typeError }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="mb-1">Nombre</label>
                        <input type="text" class="form-control" :class="{'is-invalid': nameError}"
                               placeholder="Nombre" data-toggle="tooltip" v-model="name"
                               title="Nombre con el cual identificar la plantilla" required>
                        <div class="alert alert-danger" v-if="nameError">{{ nameError }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="mb-1">Asunto</label>
                        <input type="text" class="form-control" :class="{'is-invalid': subjectError}" v-model="subject"
                               placeholder="Asunto" data-toggle="tooltip" title="Asunto del correo electrónico" required>
                        <div class="alert alert-danger" v-if="subjectError">{{ subjectError }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="body-column mb-1">Cuerpo del mensaje</label>
                        <ckeditor :editor="ckeditor.editor" v-model="body" :config="ckeditor.editorConfig"
                                  data-toggle="tooltip" title="Cuerpo del mensaje del correo electrónico"></ckeditor>
                        <div class="alert alert-danger" v-if="bodyError">{{ bodyError }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <fieldset>
                        <legend>Variables:</legend>
                        <p>A continuación se muestra un listado de variables a incorporar en la plantilla.</p>
                        <div v-for="variable in variables">
                            <b class="mr-2">
                                <span v-html="'{{ '"></span>{{ variable.name }}<span v-html="' }}'"></span>
                            </b>
                            {{ variable.description }}
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-1 mb-1" @click="setTemplate">Guardar</button>
            <button type="reset" class="btn btn-outline-warning mr-1 mb-1" @click="toBack">Cancelar</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                subject: '',
                mailable: '',
                mailables: [],
                module: '',
                modules: [],
                type: '',
                types: [
                    {id: 'N', text: 'Notificación'},
                    {id: 'E', text: 'Evento'},
                    {id: 'O', text: 'Otro'},
                ],
                body: '',
                variables: [],
                mailableError: '',
                moduleError: '',
                typeError: '',
                nameError: '',
                subjectError: '',
                bodyError: ''
            }
        },
        props: {
            listUrl: {
                type: String,
                required: true
            },
            emailTemplate: {
                type: Object,
                required: true
            },
            variables: {
                type: Array,
                required: true,
                default: []
            }
        },
        methods: {
            /**
             * Obtiene un listado de objetos mailable (tipo de plantilla de correo)
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             */
            getMailables() {
                const vm = this;
                axios.get('/sistema/correo/plantillas/get-mailables').then(response => {
                    vm.mailables = response.data.mailables;
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Establece las variables a mostrar para su incorporación en la plantilla
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             *
             * @param     {array}        variables    Arreglo con información de las variables
             */
            setVariables(variables) {
                this.variables = variables;
            },
            /**
             * Obtiene un listado de variables asociadas al tipo de plantilla seleccionada
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             */
            getVariables() {
                const vm = this;
                if (!vm.mailable) {
                    vm.variables = [];
                    return false;
                }
                axios.post('/sistema/correo/plantillas/get-variables', {mailable: vm.mailable}).then(response => {
                    vm.variables = response.data.variables;
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Obtiene un listado de módulos u opciones del sistema
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             */
            getModules() {
                const vm = this;
                axios.get('/sistema/correo/plantillas/get-modules').then(response => {
                    vm.modules = response.data.modules;
                })
            },
            /**
             * Registra la información de la plantila
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             */
            setTemplate() {
                const vm = this;
                axios.post('/sistema/correo/plantillas', {
                    mailable: vm.mailable,
                    name: vm.name,
                    module: vm.module,
                    type: vm.type,
                    subject: vm.subject,
                    body: vm.body
                }).then(response => {
                    if (response.data.result) {
                        location.href = vm.listUrl;
                    }
                }).catch(error => {
                    vm.errors = {};

                    if (typeof error.response != "undefined") {
                        if (error.response.data.errors['mailable']) {
                            vm.mailableError = error.response.data.errors['mailable'][0];
                        }
                        else if (error.response.data.errors['name']) {
                            vm.nameError = error.response.data.errors['name'][0];
                        }
                        else if (error.response.data.errors['type']) {
                            vm.typeError = error.response.data.errors['type'][0];
                        }
                        else if (error.response.data.errors['subject']) {
                            vm.subjectError = error.response.data.errors['subject'][0];
                        }
                        else if (error.response.data.errors['body']) {
                            vm.bodyError = error.response.data.errors['body'][0];
                        }
                    }
                });
            },
            toBack() {
                location.href = this.listUrl;
            }
        },
        created() {
            const vm = this;
            vm.name = vm.emailTemplate.name;
            vm.subject = vm.emailTemplate.subject;
            vm.body = vm.emailTemplate.html_template;
            vm.variables = vm.variables;
        },
        mounted() {
            const vm = this;
            this.getMailables();
            this.getModules();

        }
    };
</script>
