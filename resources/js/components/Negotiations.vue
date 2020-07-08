<template>
    <div id="negotiationsModule" class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper pt-1">
            
            <!-- Module control -->
            <div class="card card-block mb-1">
                <div class="card-body p-0">

                    <!-- Manage Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand">Negociaciones</a>
                        <button class="navbar-toggler p-0 collapsed" type="button" data-toggle="collapse" style="font-size: 1.5rem;" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-chevron-down"></i>
                        </button>

                        <div class="navbar-collapse collapse" id="navbarColor01">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item" style="padding: 5px">
                                    <button type="button" class="btn btn-primary waves-effect waves-light" @click="toggleModal">Nueva</button>
                                </li>
                                <li class="nav-item" style="padding: 5px">
                                    <button type="button" class="btn btn-warning waves-effect waves-light">Archivadas</button>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <!-- Filter Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand d-lg-none">Filtros</a>
                        <button class="navbar-toggler p-0 collapsed d-lg-none" type="button" data-toggle="collapse" style="font-size: 1.5rem;" data-target="#filters" aria-controls="filters" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-chevron-down"></i>
                        </button>

                        <div class="navbar-collapse collapse" id="filters">
                            
                            <!-- Input search -->
                            <form class="form-inline">
                                <input class="form-control mr-sm-2" type="search" placeholder="Buscar..." aria-label="Search">
                            </form>
                            
                            <!-- Filter options -->
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item" style="padding: 5px">
                                    <div class="btn-group">
                                        <div class="dropdown">
                                            <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1 waves-effect waves-light" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Filtro 1
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                <a class="dropdown-item" href="#">Option 1</a>
                                                <a class="dropdown-item" href="#">Option 2</a>
                                                <a class="dropdown-item" href="#">Option 3</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item" style="padding: 5px">
                                    <div class="btn-group">
                                        <div class="dropdown">
                                            <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1 waves-effect waves-light" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Filtro 2
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                <a class="dropdown-item" href="#">Option 1</a>
                                                <a class="dropdown-item" href="#">Option 2</a>
                                                <a class="dropdown-item" href="#">Option 3</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item" style="padding: 5px">
                                    <div class="btn-group">
                                        <div class="dropdown">
                                            <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1 waves-effect waves-light" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Filtro 2
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                <a class="dropdown-item" href="#">Option 1</a>
                                                <a class="dropdown-item" href="#">Option 2</a>
                                                <a class="dropdown-item" href="#">Option 3</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item" style="padding: 5px">
                                    <div class="btn-group">
                                        <div class="dropdown">
                                            <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1 waves-effect waves-light" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Filtro 2
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                <a class="dropdown-item" href="#">Option 1</a>
                                                <a class="dropdown-item" href="#">Option 2</a>
                                                <a class="dropdown-item" href="#">Option 3</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item" style="padding: 5px">
                                    <div class="btn-group">
                                        <div class="dropdown">
                                            <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1 waves-effect waves-light" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Filtro 2
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                <a class="dropdown-item" href="#">Option 1</a>
                                                <a class="dropdown-item" href="#">Option 2</a>
                                                <a class="dropdown-item" href="#">Option 3</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <!-- Apply -->
                            <div class="form-inline">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Aplicar</button>
                            </div>
                        </div>
                    </nav>
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