<template>
    <div id="negotiationsModule" class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            
            <!-- Module control -->
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Negociaciones |</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <button type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" @click="toggleModal">Nueva</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Process lists -->
            <div class="row">
                <div class="col">
                    <div id="listsContainer" class="row no-gutters flex-row flex-nowrap scrolling-wrapper">
                        <negotiation-process-list v-for="(process, index) in getProcesses" :key="index" :processData="process" />
                    </div>
                </div>
            </div>

            <!-- Negotiation Modal -->
            <negotiation-form />

            <!-- Archive Confirm Modal -->
            <div id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-modal="true" class="modal fade text-left show" style="display: block;" v-if="getShowConfirm">
                <div role="document" class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xs">
                    <div class="modal-content">
                        <div class="modal-header bg-danger white">
                            <h5 id="myModalLabel120" class="modal-title">¡Alerta!</h5>
                            <button @click.stop="cancelArchive" type="button" data-dismiss="modal" aria-label="Close" class="close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro de archivar esta negociación?</p>
                        </div>
                        <div class="modal-footer">
                            <button @click.stop="toggleActivation" type="button" id="confirmDelete" class="btn btn-danger waves-effect waves-light">Sí</button>
                            <button @click.stop="cancelArchive" type="button" data-dismiss="modal" class="btn btn-success waves-effect waves-light">No</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-backdrop fade show" v-if="getShowModal || getShowConfirm"></div>
        </div>
    </div>
</template>

<script>
import { mapMutations, mapGetters, mapActions } from 'vuex';
import draggable from 'vuedraggable';
export default {
    components: {
        draggable
    },
    props: ['types', 'statuses', 'processes', 'negotiations', 'user', 'contacts'],
    mounted() {
        this.setTypes(this.types);
        this.setStatuses(this.statuses);
        this.setProcesses(this.processes.processes);
        this.setNegotiations(this.negotiations);
        this.setUserId(this.user);
        this.setContacts(this.contacts);
    },
    methods: {
        ...mapActions(['toggleActivation']),
        ...mapMutations({
            toggleModal: 'TOGGLE_MODAL',
            toggleConfirm: 'TOGGLE_CONFIRM',
            setTypes: 'SET_TYPES',
            setStatuses: 'SET_STATUSES',
            setProcesses: 'SET_PROCESSES',
            setNegotiations: 'SET_NEGOTIATIONS',
            setUserId: 'SET_USER_ID',
            setContacts: 'SET_CONTACTS',
            resetNeg: 'RESET_NEGOTIATION',
        }),
        cancelArchive() {
            this.resetNeg();
            this.toggleConfirm();
        }
    },
    computed: {
        ...mapGetters(['getProcesses', 'getNegsLists', 'getShowModal', 'getShowConfirm']),
    }
}
</script>

<style>
    .list-height {
        min-height: 200px !important;
    }
    .negotiation-card {
        background-color: #262C49 !important;
    }
</style>