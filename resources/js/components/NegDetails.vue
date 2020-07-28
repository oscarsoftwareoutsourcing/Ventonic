<template>
    <div class="row">
        <div class="col-sm-12 col-lg-8">
            <div class="card overflow-hidden">

                <!-- Negotiation title with contact -->
                <div class="card-header">
                    <h2 class="card-title">{{ title }} con {{ contact }}</h2>
                </div>
                <div class="card-content">
                    <div class="card-body">

                        <!-- Responsable -->
                        <p><b>Responsable:</b> {{ owner }}</p>

                        <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab-justified" data-toggle="tab"
                                   href="#profile-just" role="tab" aria-controls="profile-just" aria-selected="false">
                                    Notas personales
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
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content pt-1">
                            <div class="tab-pane pb-3 active" id="profile-just" role="tabpanel"
                                 aria-labelledby="profile-tab-justified">
                                <div class="form-group">
                                    <label for="note">Nota</label>
                                    <textarea rows="4" class="form-control" id="note"
                                              placeholder="Agregar una nota"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary float-left">
                                        Enviar
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane" id="messages-just" aria-labelledby="messages-tab-justified"
                                 role="tabpanel">
                                <p>GESTIÓN DE EVENTOS</p>
                            </div>
                            <div class="tab-pane" id="settings-just" aria-labelledby="settings-tab-justified"
                                 role="tabpanel">
                                <p>GESTIÓN DE DOCUMENTOS</p>
                            </div>
                            <div class="tab-pane" id="home-just" aria-labelledby="home-tab-justified"
                                 role="tabpanel">
                                <p>GESTIÓN DE CORREOS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information -->
        <div class="col-sm-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Acerca de la negociación</h4>
                    <!-- <i class="feather icon-more-horizontal cursor-pointer"></i> -->
                </div>
                <div class="card-body">
                    <!-- Description -->
                    <p>{{ description }}</p>

                    <!-- Status -->
                    <div class="mt-1">
                        <h6 class="mb-0">Estado:</h6>
                        <p v-if="status.id === 3" class="text-primary">
                            En Proceso <i title="En proceso" class="feather icon-loader ml-1"></i>
                        </p>
                        <p v-if="status.id === 1" class="text-success">
                            Ganada <i class="fa fa-trophy ml-1" title="Ganada"></i>
                        </p>
                        <p v-if="status.id === 2" class="text-danger">
                            Perdida <i class="fa fa-thumbs-o-down ml-1" title="Perdida"></i>
                        </p>
                    </div>

                    <!-- Shared with -->
                    <div class="mt-1" v-if="isShared">
                        <h6 class="mb-0">Compartida con:</h6>
                        <ul>
                            <li v-for="(group, index) in negGroups" :key="index">{{ group.name }}</li>
                        </ul>
                    </div>

                    <!-- Amount -->
                    <div class="mt-1">
                        <h6 class="mb-0">Importe:</h6>
                        <p>{{ amount }}</p>
                    </div>

                    <!-- Deadline -->
                    <div class="mt-1">
                        <h6 class="mb-0">Fecha de cierre:</h6>
                        <p>{{ deadline }}</p>
                    </div>

                    <!-- Created at -->
                    <div class="mt-1">
                        <h6 class="mb-0">Creada el:</h6>
                        <p>{{ createdAt }}</p>
                    </div>

                    <!-- Last update -->
                    <div class="mt-1">
                        <h6 class="mb-0">Actualizado el:</h6>
                        <p>{{ updatedAt }}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn btn-block waves-effect waves-light"
                            @click="returnList">
                        Volver
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapMutations } from 'vuex'
    export default {
        data() {
            return {
                negGroups: []
            }
        },
        mounted() {
            if(this.getDetailedNeg.groups.length > 0) {
                this.getDetailedNeg.groups.forEach(g => {
                    this.getUserGroups.forEach(ug => {
                        if(g === ug.id) {
                            this.negGroups.push(ug);
                        }
                    });
                });
            }
        },
        methods: {
            ...mapMutations({
                setNegotiationGroups: 'SET_NEGOTIATION_GROUPS',
                setDetailedNeg: 'SET_DETAILED_NEG',
                toggleLists: 'TOGGLE_LISTS',
                toggleDetails: 'TOGGLE_DETAILS',
            }),
            formatImp(i) {
                return new Intl.NumberFormat('de-ES', { style: 'currency', currency: 'EUR' }).format(i);
            },
            formatDate(d) {
                return d.getDate() + ' de ' + new Intl.DateTimeFormat('es-ES', { month: 'long'}).format(d) + ' del ' + d.getFullYear();
            },
            returnList() {
                this.setNegotiationGroups(null);
                this.setDetailedNeg(null);
                this.toggleLists();
                this.toggleDetails();
            }
        },
        computed: {
            ...mapGetters(['getNegotiation', 'getNegotiations', 'getDetailedNeg', 'getUserGroups']),
            title() {
                return this.getDetailedNeg.title
            },
            contact() {
                if(this.getDetailedNeg.contact.last_name !== null) {
                    return this.getDetailedNeg.contact.name + ' ' + this.getDetailedNeg.contact.last_name;
                } else {
                    return this.getDetailedNeg.contact.name;
                }
            },
            owner() {
                if(this.getDetailedNeg.owner.last_name !== null) {
                    return this.getDetailedNeg.owner.name + ' ' + this.getDetailedNeg.owner.last_name;
                } else {
                    return this.getDetailedNeg.owner.name;
                }
            },
            status() {
                return this.getDetailedNeg.status;
            },
            description() {
                return this.getDetailedNeg.description;
            },
            isShared() {
                return (this.getDetailedNeg.extras.sharedWith.length > 0) ? true : false;
            },
            amount() {
                return this.formatImp(this.getDetailedNeg.amount);
            },
            deadline() {
                return (this.getDetailedNeg.deadline !== null) ? this.formatDate(this.getDetailedNeg.deadline) : 'N/A';
            },
            createdAt() {
                return this.formatDate(this.getDetailedNeg.created_at);
            },
            updatedAt() {
                return (this.getDetailedNeg.updated_at !== null)
                       ? this.formatDate(this.getDetailedNeg.updated_at)
                       : 'No se ha actualizado';
            },
        }
    };
</script>
