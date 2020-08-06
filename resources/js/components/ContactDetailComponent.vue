<template>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h5 class="card-title mb-2">Datos Generales</h5>
                <div class="row">
                    <div class="col-sm-2">
                        <img :src="showImage()" alt="imagen de perfil" class="img-fluid">
                    </div>
                    <div class="col-sm-5">
                        <div class="form-row mb-1">
                            <div class="col-sm-4">
                                <label class="label-font" for="">Nombre</label>
                            </div>
                            <div class="col-sm-8">{{ contact.name }}</div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-sm-4">
                                <label for="" class="label-font">Apellido</label>
                            </div>
                            <div class="col-sm-8">{{ contact.last_name }}</div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-sm-4">
                                <label for="" class="label-font">Email</label>
                            </div>
                            <div class="col-sm-8">{{ contact.email }}</div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-sm-4">
                                <label for="" class="label-font">Chat</label>
                            </div>
                            <div class="col-sm-8">
                                <button type="button"
                                        class="btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light">
                                    <i class="feather icon-mail"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-row mb-1">
                            <div class="col-sm-7">
                                <label class="label-font" for="">Estatus</label>
                            </div>
                            <div class="col-sm-5">{{ getStatus() }}</div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-sm-7">
                                <label for="" class="label-font">Rol</label>
                            </div>
                            <div class="col-sm-5">{{ getRol() }}</div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-sm-7">
                                <label for="" class="label-font">Fecha de registro</label>
                            </div>
                            <div class="col-sm-5">{{ getCreatedAt() }}</div>
                        </div>
                    </div>
                </div>
                <hr>
                <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab-justified" data-toggle="tab"
                           href="#profile-just" role="tab" aria-controls="profile-just" aria-selected="false">
                            Actividades
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="messages-tab-justified" data-toggle="tab" href="#messages-just"
                           role="tab" aria-controls="messages-just" aria-selected="false">
                            Eventos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="settings-tab-justified" data-toggle="tab" href="#settings-just"
                           role="tab" aria-controls="settings-just" aria-selected="false">
                            Documentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="home-tab-justified" data-toggle="tab" href="#home-just"
                           role="tab" aria-controls="home-just" aria-selected="true">
                            Correos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="calls-tab-justified" data-toggle="tab" href="#calls-just"
                           role="tab" aria-controls="calls-just" aria-selected="true">
                            Llamadas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tasks-tab-justified" data-toggle="tab" href="#tasks-just"
                           role="tab" aria-controls="tasks-just" aria-selected="true">
                            Tareas
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content pt-1">
                    <div class="tab-pane pb-3 active" id="profile-just" role="tabpanel"
                         aria-labelledby="profile-tab-justified">
                        <!-- Notas -->
                        <note ref="contactNote" :model-relation-id="contact.id"
                              model-relation-class="contact"></note>
                    </div>
                    <div class="tab-pane pb-3" id="messages-just" aria-labelledby="messages-tab-justified"
                         role="tabpanel">
                        <!-- Evento -->
                        <event ref="contactEvent" :model-relation-id="contact.id"
                               model-relation-class="contact"></event>
                    </div>
                    <div class="tab-pane pb-3" id="settings-just" aria-labelledby="settings-tab-justified"
                         role="tabpanel">
                         <!-- Documentos -->
                        <media-file ref="contactDocument" :model-relation-id="contact.id"
                                    model-relation-class="contact"></media-file>
                    </div>
                    <div class="tab-pane pb-3" id="home-just" aria-labelledby="home-tab-justified"
                         role="tabpanel">
                         <!-- Correos -->
                        <email-app ref="contactEmail" :model-relation-id="contact.id"
                                   model-relation-class="contact"></email-app>
                    </div>
                    <div class="tab-pane pb-3" id="calls-just" aria-labelledby="calls-tab-justified"
                         role="tabpanel">
                         <!-- Llamadas -->
                        <call-event ref="contactCalls" :model-relation-id="contact.id"
                                    model-relation-class="contact"></call-event>
                    </div>
                    <div class="tab-pane pb-3" id="tasks-just" aria-labelledby="tasks-tab-justified"
                         role="tabpanel">
                         <!-- Llamadas -->
                        <task ref="contactTasks" :model-relation-id="contact.id"
                              model-relation-class="contact"></task>
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
                //
            }
        },
        props: {
            contact: {
                type: Object,
                required: true
            }
        },
        methods: {
            showImage() {
                return (this.contact.user.photo) ? '/' + this.contact.user.photo : '/images/anonymous-user.png';
            },
            getStatus() {
                return (this.contact.user.estatus===1) ? 'Activo' : 'Inactivo';
            },
            getRol() {
                return (this.contact.user.type === "E") ? 'Empresa' : 'Vendedor';
            },
            getCreatedAt() {
                return this.shortDateFormat(this.contact.user.created_at);
            }
        }
    };
</script>
"storage/files/5ebda6e14a1a85.67820891.png"
