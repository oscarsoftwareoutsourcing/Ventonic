<template>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="float-left">
                            <h5 class="card-title mb-2">Datos Generales</h5>
                        </span>
                        <div class="mr-auto float-right bookmark-wrapper d-flex align-items-center">
                            <ul class="list-inline m-0">
                                <li class="list-inline-item">
                                    <a @click="editContact()">
                                        <i class="feather icon-edit controls"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item controls">
                                    <a @click="deleteContact">
                                        <i class="feather icon-trash-2 controls"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item controls">
                                    <a @click="goBack()">
                                        <i class="feather icon-arrow-left controls"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <img :src="showImage()" alt="imagen de perfil" class="img-fluid" />
                    </div>
                    <div class="col-sm-5">
                        <div class="form-row mb-1">
                            <div class="col-sm-4">
                                <label class="label-font" for>Nombre</label>
                            </div>
                            <div class="col-sm-8">{{ contact.name }}</div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-sm-4">
                                <label for class="label-font">Apellido</label>
                            </div>
                            <div class="col-sm-8">{{ contact.last_name }}</div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-sm-4">
                                <label for class="label-font">Email</label>
                            </div>
                            <div class="col-sm-8">{{ contact.email }}</div>
                        </div>
                        <div class="form-row mb-1" v-if="contact.address">
                            <div class="col-sm-4">
                                <label for class="label-font">Dirección</label>
                            </div>
                            <div class="col-sm-8">{{ contact.address }}</div>
                        </div>
                        <!--
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
                        -->
                    </div>
                    <div class="col-sm-5">
                        <div class="form-row mb-1">
                            <div class="col-sm-7">
                                <label class="label-font" for>Favorito</label>
                            </div>
                            <div class="col-sm-5" v-html="getStatus()"></div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-sm-7">
                                <label for class="label-font">Tipo</label>
                            </div>
                            <div class="col-sm-5" v-html="getRol()"></div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-sm-7">
                                <label for class="label-font">Fecha de registro</label>
                            </div>
                            <div class="col-sm-5">{{ getCreatedAt() }}</div>
                        </div>
                        <div class="form-row mb-1" v-if="contact.address">
                            <div class="col-sm-7">
                                <label for class="label-font">Ver mapa</label>
                            </div>
                            <div class="col-sm-5">
                                <a @click="viewMap()" data-toggle="modal" data-target="#modalMap">
                                    <i class="feather icon-map"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab-justified" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just" aria-selected="false">Actividades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="messages-tab-justified" data-toggle="tab" href="#messages-just" role="tab" aria-controls="messages-just" aria-selected="false">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="settings-tab-justified" data-toggle="tab" href="#settings-just" role="tab" aria-controls="settings-just" aria-selected="false">Documentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="home-tab-justified" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just" aria-selected="true">Correos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="calls-tab-justified" data-toggle="tab" href="#calls-just" role="tab" aria-controls="calls-just" aria-selected="true">Llamadas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tasks-tab-justified" data-toggle="tab" href="#tasks-just" role="tab" aria-controls="tasks-just" aria-selected="true">Tareas</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content pt-1">
                    <div class="tab-pane pb-3 active" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-justified">
                        <!-- Notas -->
                        <note ref="contactNote" :model-relation-id="contact.id" model-relation-class="contact"></note>
                    </div>
                    <div class="tab-pane pb-3" id="messages-just" aria-labelledby="messages-tab-justified" role="tabpanel">
                        <!-- Evento -->
                        <event ref="contactEvent" :model-relation-id="contact.id" model-relation-class="contact"></event>
                    </div>
                    <div class="tab-pane pb-3" id="settings-just" aria-labelledby="settings-tab-justified" role="tabpanel">
                        <!-- Documentos -->
                        <media-file ref="contactDocument" :model-relation-id="contact.id" model-relation-class="contact"></media-file>
                    </div>
                    <div class="tab-pane pb-3" id="home-just" aria-labelledby="home-tab-justified" role="tabpanel">
                        <!-- Correos -->
                        <email-app ref="contactEmail" :default-email="contact.email" :model-relation-id="contact.id" model-relation-class="contact"></email-app>
                    </div>
                    <div class="tab-pane pb-3" id="calls-just" aria-labelledby="calls-tab-justified" role="tabpanel">
                        <!-- Llamadas -->
                        <call-event ref="contactCalls" :model-relation-id="contact.id" model-relation-class="contact"></call-event>
                    </div>
                    <div class="tab-pane pb-3" id="tasks-just" aria-labelledby="tasks-tab-justified" role="tabpanel">
                        <!-- Llamadas -->
                        <task ref="contactTasks" :model-relation-id="contact.id" model-relation-class="contact"></task>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalMap">
                <div class="modal-dialog modal-lg" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title">Mapa</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <span>{{ contact.address }}</span>
                            </div>
                            <div id="address-map-container" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                //
            };
        },
        props: {
            contact: {
                type: Object,
                required: true,
            },
        },
        methods: {
            showImage() {
                return this.contact.image ?
                    "/" + this.contact.image :
                    "/images/anonymous-user.png";
            },
            getStatus() {
                return this.contact.favorite === 1 ?
                    '<i class="ficon feather icon-star warning"></i>' :
                    "";
            },
            getRol() {
                return this.contact.type_contact === "empresa" ?
                    ' <i class="fa fa-building-o text-primary"></i> Empresa' :
                    '<i class="fa fa-male text-primary"></i> Vendedor';
            },
            getCreatedAt() {
                return this.shortDateFormat(this.contact.created_at);
            },
            goBack() {
                return history.go(-1);
            },
            viewMap() {
                const vm = this;
                //popup con  las coredenadas del mapa
                vm.initializeMap(
                    'address-map-container',
                    vm.contact.address,
                    vm.contact.address_latitude,
                    vm.contact.address_longitude
                );
            },

            editContact() {
                //window.location.href = "contacto/editar/" + this.contact.id;
                window.location = "/contacto/editar/" + this.contact.id;
            },
            /**
             * Elimina el contacto
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            deleteContact() {
                const vm = this;
                bootbox.confirm({
                    size: "small",
                    title: "Eliminar contacto",
                    message: "Está a punto de eliminar este contacto ¿Esta seguro de continuar?",
                    callback: function(result) {
                        if (result) {
                            axios.delete(`/contacto/${vm.contact.id}/delete`).then(response => {
                                if (response.data.result) {
                                    window.location = response.data.route;
                                }
                                else {
                                    toastr.warning(response.data.message, "Error!");
                                }
                            }).catch(error => {
                                console.errro(error);
                            });
                        }
                    }
                });
            }
        },
    };
</script>
