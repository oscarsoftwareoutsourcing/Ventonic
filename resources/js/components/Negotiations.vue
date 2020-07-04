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

            <div class="modal-backdrop fade show" v-if="getShowModal"></div>
        </div>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex';
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
        ...mapMutations({
            toggleModal: 'TOGGLE_MODAL',
            setTypes: 'SET_TYPES',
            setStatuses: 'SET_STATUSES',
            setProcesses: 'SET_PROCESSES',
            setNegotiations: 'SET_NEGOTIATIONS',
            setUserId: 'SET_USER_ID',
            setContacts: 'SET_CONTACTS',
        })
    },
    computed: {
        ...mapGetters(['getProcesses', 'getNegsLists', 'getShowModal']),
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