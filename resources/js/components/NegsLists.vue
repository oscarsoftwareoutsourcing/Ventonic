<template>
    <perfect-scrollbar class="w-100 ps-width">
        <div id="listsContainer" class="lists pb-1">

            <!-- List -->
            <div class="list" v-for="(process) in getProcesses" :key="process.id">

                <!-- Header -->
                <header class="d-flex w-100 justify-content-between headerList p-1">
                    <span>{{ process.title }}</span>
                    <span>{{ getNegotiations['list-' + process.id].length }}</span>
                </header>
                <perfect-scrollbar>
                    <ul class="dragElements p-0">
                        <draggable group="negotiations" @add="onAdd($event, process.id)" :scroll-sensitivity="250">
                            <li v-for="(card, index) in getNegotiations['list-' + process.id]" :key="index" :data-neg-id="card.id" @click="showDetails(card, index)">

                                <!-- Created At -->
                                <div class="d-flex w-100 justify-content-between mb-1">
                                    <small><i v-if="card.owner.id !== getUserId" class="feather icon-users text-primary mr-1" title="Compartida"></i>{{ createdAt(card.created_at) }}</small>
                                    <div v-if="card.owner.id === getUserId">
                                        <div v-if="card.active">
                                            <a title="Editar" @click.stop="editNegotiation(card)"><i class="fa fa-pencil-square primary"></i></a>
                                            <a title="Archivar" @click.stop="confirmArchive(card)"><i class="fa fa-archive warning"></i></a>
                                        </div>
                                        <div v-else>
                                            <a title="Restaurar" @click.stop="confirmArchive(card)"><i class="feather icon-arrow-up-right success"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Title and contact -->
                                <h5 class="mb-1 text-white">{{ card.title }} - {{ showContactName(card.contact) }}</h5>

                                <!-- Amount -->
                                <h5 class="mb-1 text-white">Cantidad: {{ formatImport(card.amount) }}</h5>

                                <!-- Deadline -->
                                <h5 class="mb-1 text-white">Fecha de cierre: {{ (card.deadline !== null) ? formatDate(card.deadline) : 'N/A' }}</h5>

                                <!-- Owner -->
                                <h5 v-if="getUserId !== card.owner.id" class="text-primary">{{ showOwnerName(card.owner) }}</h5>
                                <hr class="my-1">

                                <!-- Card footer -->
                                <div class="d-flex justify-content-between" v-if="card.active">

                                    <!-- Toggle status -->
                                    <div class="float-left statusContainer">
                                        <div class="dropdown">
                                            <button v-if="card.status.id === 3" class="btn btn-flat-primary dropdown-toggle waves-effect waves-light" type="button" @click.stop.prevent="toggleStateMenu">En Proceso<i title="En proceso" class="feather icon-loader ml-1"></i></button>
                                            <button v-if="card.status.id === 1" class="btn btn-flat-success dropdown-toggle waves-effect waves-light" type="button" @click.stop.prevent="toggleStateMenu">Ganada<i class="fa fa-trophy ml-1" title="Ganada"></i></button>
                                            <button v-if="card.status.id === 2" class="btn btn-flat-danger dropdown-toggle waves-effect waves-light" type="button" @click.stop.prevent="toggleStateMenu">Perdida<i class="fa fa-thumbs-o-down ml-1" title="Perdida"></i></button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -105px, 0px);">
                                                <a @click.stop.prevent="changeState(card.id, 3)" v-if="card.status.id !== 3" class="dropdown-item text-primary" title="En proceso">Cambiar a En Proceso<i class="feather icon-loader text-primary ml-2"></i></a>
                                                <a @click.stop.prevent="changeState(card.id, 1)" v-if="card.status.id !== 1" class="dropdown-item text-success" title="Ganada">Cambiar a Ganada<i class="fa fa-trophy text-success ml-2"></i></a>
                                                <a @click.stop.prevent="changeState(card.id, 2)" v-if="card.status.id !== 2" class="dropdown-item text-danger" title="Perdida">Cambiar a Perdida<i class="fa fa-thumbs-o-down text-danger ml-2"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add extra data menu -->
                                    <div class="float-right">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-flat-dark dropdown-toggle waves-effect waves-light" @click.stop.prevent="toggleAddMenu">Agregar</button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -140px, 0px);">
                                                <a class="dropdown-item" @click.stop.prevent=""><i class="feather icon-check-square text-primary"></i> Nota</a>
                                                <a class="dropdown-item" @click.stop.prevent=""><i class="feather icon-calendar text-primary"></i> Evento</a>
                                                <a class="dropdown-item" @click.stop.prevent=""><i class="fa fa-files-o text-primary"></i> Archivo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </draggable>
                    </ul>
                </perfect-scrollbar>
                <footer class="footerList p-1 text-center"><h3>TOTAL: {{ formatImport(getTotals['list-' + process.id]) }}</h3></footer>
            </div>
        </div>
    </perfect-scrollbar>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex'
export default {
    mounted() {

        // List container
        let listsContainer = document.querySelector('#listsContainer');

        // Height of the list container
        let screenHeight = window.innerHeight;

        // Nabvar mobile height
        let navbarMobile = document.querySelector('#navbar-mobile').offsetHeight;

        // App footer height
        let footerHeight = document.querySelector('#appFooter').offsetHeight;

        let heightSize = screenHeight - (navbarMobile + footerHeight + this.getHeaderNavbarShadowHeight + this.getControlsHeight);

        listsContainer.style.height = heightSize + 'px';
        listsContainer.style.maxHeight = heightSize + 'px';

        let listHeader = document.querySelector('.headerList').offsetHeight;
        let listFooter = document.querySelector('.footerList').offsetHeight;
        
        document.querySelectorAll('.dragElements').forEach(ul => {
            ul.style.height = heightSize - (listHeader + listFooter) + 'px';
            ul.style.maxHeight = heightSize - (listHeader + listFooter) + 'px';
        });
    },
    methods: {
        ...mapActions(['changeToList', 'changeStatus']),
        ...mapMutations({
            toggleLists: 'TOGGLE_LISTS',
            toggleDetails: 'TOGGLE_DETAILS',
            toggleForm: 'TOGGLE_FORM',
            toggleConfirm: 'TOGGLE_CONFIRM',
            setNegotiation: 'SET_NEGOTIATION',
            setIndex: 'SET_DETAILED_NEG_INDEX',
            setNegotiationGroups: 'SET_NEGOTIATION_GROUPS',
        }),
        createdAt(date) {
            let created = new Date(date);
            return 'Creado el ' + created.getDate() + '/' + created.getMonth() + '/' + created.getFullYear();
        },
        formatImport(value) {
            return new Intl.NumberFormat('de-ES', { style: 'currency', currency: 'EUR' }).format(value);
        },
        showContactName(contact) {
            if(contact.last_name !== null) {
                return contact.name + ' ' + contact.last_name;
            } else {
                return contact.name;
            }
        },
        showOwnerName(owner) {
            if(owner.last_name !== null) {
                return owner.name + ' ' + owner.last_name;
            } else {
                return owner.name;
            }
        },
        formatDate(d) {
            let date = new Date(d);
            return date.getDate() + ' de ' + new Intl.DateTimeFormat('es-ES', { month: 'long'}).format(date) + ' del ' + date.getFullYear();
        },
        editNegotiation(neg) {
            this.setNegotiation(neg);
            if(neg.groups.length > 0) {
                this.setNegotiationGroups(neg.groups);
            }
            this.toggleLists();
            this.toggleForm();
        },
        confirmArchive(info) {
            this.setNegotiation(info);
            this.toggleConfirm();
        },
        async onAdd(event, id) {
            let values = {
                id: event.item.getAttribute('data-neg-id'),
                processId: id
            }
            await this.changeToList(values);
        },
        async changeState(negId, state) {
            let values = {
                id: negId,
                stateId: state
            }

            await this.changeStatus(values);
            if(values.stateId !== 1) {
                document.querySelector('.statusContainer div.dropdown.show').classList.remove('show');
                document.querySelector('.statusContainer div.dropdown-menu.show').classList.remove('show');
            }
        },
        toggleAddMenu(event) {
            let element = event.target;
            element.parentElement.classList.toggle('show');
            element.nextElementSibling.classList.toggle('show');
        },
        toggleStateMenu(event) {
            let element = event.target;
            element.parentElement.classList.toggle('show');
            element.nextElementSibling.classList.toggle('show');
        },
        showDetails(neg, index) {
            this.setNegotiation(neg);
            if(neg.groups.length > 0) {
                this.setNegotiationGroups(neg.groups);
            }
            this.setIndex(index);
            this.toggleLists();
            this.toggleDetails();
        }
    },
    computed: {
        ...mapGetters(['getHeaderNavbarShadowHeight', 'getControlsHeight', 'getProcesses', 'getNegotiations', 'getTotals', 'getUserId', 'getShowDetails']),
    }
}
</script>

<style lang="scss">
/* Some Sass variables */
// Layout
$list-width: 330px;
$gap: 10px;
// Misc
$list-border-radius: 5px;
$card-border-radius: 3px;

// Colors
$list-bg-color: #10163A;

.ps-width {
    width: max-content;
}

.lists {
    display: flex;
    // overflow-y: hidden;
    // overflow-x: hidden;
    // overflow-x: auto;
    // width: 1000px;
    // max-width: 1000px;
    > .list {
        flex: 0 0 auto; // 'rigid' lists
        margin-left: $gap;
    }
    &::after {
        content: '';
        flex: 0 0 $gap;
    }
}

.list {
    width: $list-width;

    > * {
        background-color: $list-bg-color;
        color: #C2C6DC;

        padding: 0 $gap;
    }

    .headerList {
        font-size: 16px;
        font-weight: bold;
        border-top-left-radius: $list-border-radius;
        border-top-right-radius: $list-border-radius;
    }

    .footerList {
        border-bottom-left-radius: $list-border-radius;
        border-bottom-right-radius: $list-border-radius;
        color: #888;
    }

    .dragElements {
        list-style: none;
        margin: 0;

        li {
            background-color: #262C49 !important;
            padding: $gap;
            &:not(:last-child) {
                margin-bottom: $gap;
            }

            border-radius: $card-border-radius;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
    }
}
</style>