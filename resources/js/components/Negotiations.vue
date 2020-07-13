<template>
    <div id="negotiationsModule" class="app-content content">
        <div class="content-overlay"></div>
        <div ref="headerNavbarShadow" class="header-navbar-shadow"></div>
        <div class="content-wrapper pt-1">
            
            <!-- Module control -->
            <negotiations-controls />

            <!-- Negotiations -->
            <negotiations-lists v-if="getShowLists" />

            <!-- Negotiation Form -->
            <negotiation-form v-if="getShowForm" />

            <!-- Negotiation Details -->
            <negotiation-details v-if="getShowDetails" />

            <!-- Note Modal -->
            <todo-form v-if="getShowNoteForm" />

            <!-- Event Modal -->
            <negotiation-event-modal v-if="getShowEventForm" />

            <!-- Files Modal -->
            <negotiation-file-modal v-if="getShowFileForm" />

            <!-- Confirm Modal -->
            <negotiation-confirm-modal v-if="getShowConfirm" />
            
            <div class="modal-backdrop fade show" v-if="getShowConfirm"></div>
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
    props: ['types', 'statuses', 'processes', 'negotiations', 'user', 'contacts', 'a'],
    mounted() {
        this.setHeaderNavbarShadowHeight(this.$refs.headerNavbarShadow.offsetHeight);
        this.setUserId(this.user);
        this.setTypes(this.types);
        this.setStatuses(this.statuses);
        this.setProcesses(this.processes.processes);
        this.setContacts(this.contacts);
        this.setUserGroups(this.a);
        this.setNegotiations(this.negotiations);
        this.separateNegotiations();
    },
    methods: {
        ...mapActions(['toggleActivation']),
        ...mapMutations({
            setHeaderNavbarShadowHeight: 'SET_HEADER_NAVBAR_SHADOW_HEIGHT',
            setUserId: 'SET_USER_ID',
            setTypes: 'SET_TYPES',
            setStatuses: 'SET_STATUSES',
            setProcesses: 'SET_PROCESSES',
            setContacts: 'SET_CONTACTS',
            setUserGroups: 'SET_USER_GROUPS',
            setNegotiations: 'SET_NEGOTIATIONS',
            separateNegotiations: 'SEPARATE_NEGOTIATIONS',
        })
    },
    computed: {
        ...mapGetters([
            'getShowLists',
            'getShowForm',
            'getShowDetails',
            'getShowNoteForm',
            'getShowEventForm',
            'getShowFileForm',
            'getShowConfirm'
        ]),
    }
}
</script>

<style>
    .navbar-toggler {
        color: #ffffff;
    }
    .list-height {
        min-height: 200px !important;
    }
    .negotiation-card {
        background-color: #262C49 !important;
    }
</style>