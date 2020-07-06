<template>
    <div class="col-sm-5 col-md-5 col-lg-4 col-xl-3 mr-1">
        <div class="card card-block">
            <div class="card-body">
                <article class="d-flex w-100 justify-content-between mb-1">
                    <p>{{ processData.title }}</p>
                    <p>{{ listLength }}</p>
                </article>
                <draggable class="list-group" group="negotiations" @add="onAdd($event, processData.id)" @remove="onRemove()" :scroll-sensitivity="250">
                    <a href="#" class="list-group-item list-group-item-action negotiation-card mb-1" v-for="(card, index) in negotiations" :key="index" :data-neg-id="card.id" @click="editModal(card)">
                        <div class="d-flex w-100 justify-content-between mb-1">
                            <small>{{ createdAt(card.created_at) }}</small>
                            <a @click.stop.prevent="archiveModal(card)" title="Archivar"><i class="fa fa-archive warning"></i></a>
                        </div>

                        <!-- Title and contact -->
                        <h5 class="mb-1 text-white">{{ card.title }} - {{ showContactName(card.contact_id) }}</h5>

                        <!-- Amount -->
                        <h5 class="mb-1 text-white">Cantidad: {{ formatImport(card.amount) }}</h5>

                        <!-- Title and contact -->
                        <h5 class="mb-1 text-white">Fecha de cierre</h5>
                        <hr class="my-1">
                        <div class="d-flex justify-content-between">

                            <!-- Toggle status -->
                            <div class="float-left statusContainer">
                                <div class="dropdown">
                                    <button v-if="card.neg_status_id === 3" class="btn btn-flat-primary dropdown-toggle waves-effect waves-light" type="button" @click.stop.prevent="toggleStateMenu">En Proceso<i title="En proceso" class="feather icon-loader ml-1"></i></button>
                                    <button v-if="card.neg_status_id === 1" class="btn btn-flat-success dropdown-toggle waves-effect waves-light" type="button" @click.stop.prevent="toggleStateMenu">Ganada<i class="fa fa-trophy ml-1" title="Ganada"></i></button>
                                    <button v-if="card.neg_status_id === 2" class="btn btn-flat-danger dropdown-toggle waves-effect waves-light" type="button" @click.stop.prevent="toggleStateMenu">Perdida<i class="fa fa-thumbs-o-down ml-1" title="Perdida"></i></button>
                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -105px, 0px);">
                                        <a @click.stop.prevent="changeState(card.id, 3)" v-if="card.neg_status_id !== 3" class="dropdown-item text-primary" title="En proceso">Cambiar a En Proceso<i class="feather icon-loader text-primary ml-2"></i></a>
                                        <a @click.stop.prevent="changeState(card.id, 1)" v-if="card.neg_status_id !== 1" class="dropdown-item text-success" title="Ganada">Cambiar a Ganada<i class="fa fa-trophy text-success ml-2"></i></a>
                                        <a @click.stop.prevent="changeState(card.id, 2)" v-if="card.neg_status_id !== 2" class="dropdown-item text-danger" title="Perdida">Cambiar a Perdida<i class="fa fa-thumbs-o-down text-danger ml-2"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Add extra data menu -->
                            <div class="float-right">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-flat-dark dropdown-toggle waves-effect waves-light" @click.stop.prevent="toggleAddMenu">Agregar</button>
                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -140px, 0px);">
                                        <a class="dropdown-item" @click.stop.prevent="test"><i class="feather icon-check-square text-primary"></i> Nota</a>
                                        <a class="dropdown-item" @click.stop.prevent="test"><i class="feather icon-calendar text-primary"></i> Evento</a>
                                        <a class="dropdown-item" @click.stop.prevent="test"><i class="fa fa-files-o text-primary"></i> Archivo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </draggable>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';
import { mapGetters, mapMutations, mapActions } from 'vuex';
import $ from '../../../public/js/jquery/jquery-3.5.1.min.js';
require('../../../public/web/js/bootstrap/bootstrap.min.js');

export default {
    components: {
        draggable
    },
    props: ['processData'],
    data() {
        return {
            listLength: 0,
        }
    },
    methods: {
        ...mapActions(['changeToList', 'changeStatus']),
        ...mapMutations({
            toggleModal: 'TOGGLE_MODAL',
            toggleConfirm: 'TOGGLE_CONFIRM',
            setNegotiation: 'SET_NEGOTIATION'
        }),
        async onAdd(event, id) {
            let values = {
                id: event.item.getAttribute('data-neg-id'),
                processId: id
            }

            await this.changeToList(values);
            this.listLength++;
        },
        onRemove() {
            this.listLength--;
        },
        editModal(info) {
            this.setNegotiation(info);
            this.toggleModal();
        },
        archiveModal(info) {
            this.setNegotiation(info);
            this.toggleConfirm();
        },
        createdAt(date) {
            let created = new Date(date);
            return 'Creado el ' + created.getDate() + '/' + created.getMonth() + '/' + created.getFullYear();
        },
        async changeState(negId, state) {
            let values = {
                id: negId,
                stateId: state
            }

            await this.changeStatus(values);
            document.querySelector('.statusContainer div.dropdown.show').classList.remove('show');
            document.querySelector('.statusContainer div.dropdown-menu.show').classList.remove('show');
        },
        test() {
            alert();
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
        showContactName(id) {
            let contact = this.getContacts.filter(c => c.id === id);
            
            if(contact[0].last_name !== null) {
                return contact[0].name + ' ' + contact[0].last_name;
            } else {
                return contact[0].name;
            }
        },
        formatImport(value) {
            return (value.toString()).replace(".", ",");
        }
    },
    computed: {
        ...mapGetters(['getProcesses', 'getNegotiations', 'getContacts']),
        negotiations() {
            let negs = this.getNegotiations.filter(neg => neg.neg_process_id === this.processData.id);
            this.listLength = negs.length;
            return negs;
        }
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