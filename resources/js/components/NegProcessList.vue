<template>
    <div class="col-lg-4 mr-1">
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
                        <hr class="my-2">
                        <div class="d-flex justify-content-between">
                            <small class="float-left">
                                <i class="feather icon-star text-warning mr-50"></i> 4.9
                            </small>
                            <small class="float-right">
                                <i class="feather icon-briefcase text-primary mr-50"></i> 37 Projects
                            </small>
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
        ...mapActions(['changeToList', 'toggleActivation']),
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
        }
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