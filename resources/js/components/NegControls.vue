<template>
    <div id="controls-card" ref="controlsCard" class="card card-block mb-1">
        <div class="card-body p-0">

            <!-- Manage Navbar -->
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand">Negociaciones</a>
                <button class="navbar-toggler p-0 collapsed" type="button" data-toggle="collapse" style="font-size: 1.5rem;" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-chevron-down"></i>
                </button>

                <div class="navbar-collapse collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item" style="padding: 5px" v-if="!getShowForm && !archiveNegs">
                            <button type="button" class="btn btn-primary waves-effect waves-light" @click="newNegotiation">Nueva</button>
                        </li>
                        <li class="nav-item" style="padding: 5px" v-if="!archiveNegs">
                            <button type="button" class="btn btn-warning waves-effect waves-light" @click="renderArchived">Archivadas</button>
                        </li>
                        <li class="nav-item" style="padding: 5px" v-if="archiveNegs">
                            <button type="button" class="btn btn-success waves-effect waves-light" @click="renderActives">Activas</button>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Filter Navbar -->
            <nav class="navbar navbar-expand-lg" v-if="!getShowForm">
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
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
export default {
    data() {
        return {
            archiveNegs: false
        }
    },
    mounted() {
        this.setControlsHeight(this.$refs.controlsCard.offsetHeight);
    },
    methods: {
        ...mapMutations({
            setControlsHeight: 'SET_CONTROLS_HEIGHT',
            toggleForm: 'TOGGLE_FORM',
            toggleLists: 'TOGGLE_LISTS',
            setArchivedNegs: 'SEPARATE_ARCHIVED_NEGOTIATIONS',
            setActives: 'SEPARATE_NEGOTIATIONS',
        }),
        newNegotiation() {
            this.toggleLists();
            this.toggleForm();
        },
        renderArchived() {
            this.archiveNegs = true;
            this.setArchivedNegs();
        },
        renderActives() {
            this.archiveNegs = false;
            this.setActives();
        }
    },
    computed: {
        ...mapGetters(['getShowForm'])
    }
}
</script>

<style>

</style>