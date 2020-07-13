<template>
    <div class="row">
        <div class="col-sm-12 col-lg-8">
            <div class="card overflow-hidden">

                <!-- Negotiation title with contact -->
                <div class="card-header">
                    <h2 class="card-title">{{ detailedNeg.title }} con {{ showContact(detailedNeg.contact) }}</h2>
                </div>
                <div class="card-content">
                    <div class="card-body">

                        <!-- Responsable -->
                        <p><b>Responsable:</b> {{ showOwner(detailedNeg.owner) }}</p>

                        <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just" aria-selected="true">Correos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab-justified" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just" aria-selected="false">Notas personales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="messages-tab-justified" data-toggle="tab" href="#messages-just" role="tab" aria-controls="messages-just" aria-selected="false">Eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="settings-tab-justified" data-toggle="tab" href="#settings-just" role="tab" aria-controls="settings-just" aria-selected="false">Documentos</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content pt-1">
                            <div class="tab-pane active" id="home-just" role="tabpanel" aria-labelledby="home-tab-justified">
                                <p>GESTIÓN DE CORREOS</p>
                            </div>
                            <div class="tab-pane" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-justified">
                                <p>GESTIÓN DE NOTAS PERSONALES</p>
                            </div>
                            <div class="tab-pane" id="messages-just" role="tabpanel" aria-labelledby="messages-tab-justified">
                                <p>GESTIÓN DE EVENTOS</p>
                            </div>
                            <div class="tab-pane" id="settings-just" role="tabpanel" aria-labelledby="settings-tab-justified">
                                <p>GESTIÓN DE DOCUMENTOS</p>
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
                    <p>{{ detailedNeg.description }}</p>
                    
                    <!-- Status -->
                    <div class="mt-1">
                        <h6 class="mb-0">Estado:</h6>
                        <p v-if="detailedNeg.status.id === 3" class="text-primary">En Proceso<i title="En proceso" class="feather icon-loader ml-1"></i></p>
                        <p v-if="detailedNeg.status.id === 1" class="text-success">Ganada<i class="fa fa-trophy ml-1" title="Ganada"></i></p>
                        <p v-if="detailedNeg.status.id === 2" class="text-danger">Perdida<i class="fa fa-thumbs-o-down ml-1" title="Perdida"></i></p>
                    </div>

                    <!-- Shared with -->
                    <div class="mt-1" v-if="detailedNeg.extras.sharedWith.length > 0">
                        <h6 class="mb-0">Compartida con:</h6>
                        <ul>
                            <li v-for="(group, index) in negGroups" :key="index">{{ group.name }}</li>
                        </ul>
                    </div>

                    <!-- Amount -->
                    <div class="mt-1">
                        <h6 class="mb-0">Importe:</h6>
                        <p>{{ formatImp(detailedNeg.amount) }}</p>
                    </div>

                    <!-- Deadline -->
                    <div class="mt-1">
                        <h6 class="mb-0">Fecha de cierre:</h6>
                        <p>{{ (detailedNeg.deadline !== null) ? formatDate(detailedNeg.deadline) : 'N/A' }}</p>
                    </div>

                    <!-- Created at -->
                    <div class="mt-1">
                        <h6 class="mb-0">Creada el:</h6>
                        <p>{{ formatDate(detailedNeg.created_at) }}</p>
                    </div>

                    <!-- Last update -->
                    <div class="mt-1">
                        <h6 class="mb-0">Actualizado el:</h6>
                        <p>{{ (detailedNeg.deadline !== null) ? formatDate(detailedNeg.updated_at) : 'No se ha actualizado' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data() {
        return {
            negGroups: []
        }
    },
    mounted() {
        if(this.getNegotiation.groups.length > 0) {
            this.getNegotiation.groups.forEach(g => {
                this.getUserGroups.forEach(ug => {
                    if(g === ug.id) {
                        this.negGroups.push(ug);
                    }
                });
            });
        }
    },
    methods: {
        showContact(contact) {
            if(contact.last_name !== null) {
                return contact.name + ' ' + contact.last_name;
            } else {
                return contact.name;
            }
        },
        showOwner(owner) {
            if(owner.last_name !== null) {
                return owner.name + ' ' + owner.last_name;
            } else {
                return owner.name;
            }
        },
        formatImp(i) {
            return new Intl.NumberFormat('de-ES', { style: 'currency', currency: 'EUR' }).format(i);
        },
        formatDate(d) {
            let date = new Date(d);
            return date.getDate() + ' de ' + new Intl.DateTimeFormat('es-ES', { month: 'long'}).format(date) + ' del ' + date.getFullYear();
        }
    },
    computed: {
        ...mapGetters(['getNegotiation', 'getNegotiations', 'getDetailedNegIndex', 'getUserGroups']),
        detailedNeg() {
            return this.getNegotiations['list-' + this.getNegotiation.neg_process_id][this.getDetailedNegIndex];
        }
    }
}
</script>

<style>

</style>