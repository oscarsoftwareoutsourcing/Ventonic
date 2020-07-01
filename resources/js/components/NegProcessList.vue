<template>
    <div class="col-sm-5 col-md-5 col-lg-4 col-xl-3 mr-1">
        <div class="card card-block list-height">
            <div class="card-body">
                <p>{{ processData.title }}</p>
                
                <draggable class="list-group" group="negotiations" @add="onAdd($event, processData.id)" :scroll-sensitivity="250">
                    <a href="#" data-toggle="modal" data-target="#negForm" class="list-group-item list-group-item-action negotiation-card mb-1" v-for="(card, index) in negotiations" :key="index" :data-neg-id="card.id" @click="setNegotiation(card)">
                        <div class="d-flex w-100 justify-content-between mb-1">
                            <small>{{ createdAt(card.created_at) }}</small>
                            <a @click.stop="archiveNegotiation(card.id, card.active)" title="Archivar"><i class="fa fa-archive warning"></i></a>
                        </div>
                        <h5 class="mb-1 text-white">{{ card.title }}</h5>
                        <p class="mb-1">{{ card.description }}</p>
                        <hr class="my-1">
                        <div class="d-flex justify-content-between">

                            <!-- Toggle status -->
                            <div class="float-left statusContainer">
                                <div class="dropdown">
                                    <button v-if="card.neg_status_id === 3" class="btn btn-flat-primary dropdown-toggle waves-effect waves-light" type="button" @click.stop="toggleStateMenu"><i title="En proceso" class="feather icon-loader"></i></button>
                                    <button v-if="card.neg_status_id === 1" class="btn btn-flat-success dropdown-toggle waves-effect waves-light" type="button" @click.stop="toggleStateMenu"><i class="fa fa-trophy" title="Ganada"></i></button>
                                    <button v-if="card.neg_status_id === 2" class="btn btn-flat-danger dropdown-toggle waves-effect waves-light" type="button" @click.stop="toggleStateMenu"><i class="fa fa-thumbs-o-down" title="Perdida"></i></button>
                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -105px, 0px);">
                                        <a @click.stop="changeState(card.id, 3)" v-if="card.neg_status_id !== 3" class="dropdown-item" title="En proceso">Cambiar a<i class="feather icon-loader text-primary ml-2"></i></a>
                                        <a @click.stop="changeState(card.id, 1)" v-if="card.neg_status_id !== 1" class="dropdown-item" title="Ganada">Cambiar a<i class="fa fa-trophy text-success ml-2"></i></a>
                                        <a @click.stop="changeState(card.id, 2)" v-if="card.neg_status_id !== 2" class="dropdown-item" title="Perdida">Cambiar a<i class="fa fa-thumbs-o-down text-danger ml-2"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Add extra data menu -->
                            <div class="float-right">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-flat-dark dropdown-toggle waves-effect waves-light" @click.stop="toggleAddMenu">Agregar</button>
                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -140px, 0px);">
                                        <a class="dropdown-item" href="#" @click.stop="test"><i class="feather icon-check-square text-primary"></i> Nota</a>
                                        <a class="dropdown-item" href="#" @click.stop="test"><i class="feather icon-calendar text-primary"></i> Evento</a>
                                        <a class="dropdown-item" href="#" @click.stop="test"><i class="fa fa-files-o text-primary"></i> Archivo</a>
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
    methods: {
        ...mapActions(['changeToList', 'toggleActivation', 'changeStatus']),
        ...mapMutations({
            setNegotiation: 'SET_NEGOTIATION'
        }),
        async onAdd(event, id) {
            let values = {
                id: event.item.getAttribute('data-neg-id'),
                processId: id
            }

            await this.changeToList(values);
        },
        createdAt(date) {
            let created = new Date(date);
            return 'Creado el ' + created.getDate() + '/' + created.getMonth() + '/' + created.getFullYear();
        },
        archiveNegotiation(negId, activeState) {
            let values = {
                id: negId,
                active: activeState
            }
            this.toggleActivation(values);
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
    },
    computed: {
        ...mapGetters(['getProcesses', 'getNegotiations']),
        negotiations() {
            return this.getNegotiations.filter(neg => neg.neg_process_id === this.processData.id);
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