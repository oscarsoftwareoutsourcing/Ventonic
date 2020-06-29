<template>
    <!-- <div id="listsContainer" class="scrolling-wrapper row no-gutters flex-row flex-nowrap"> -->
        <div class="col-lg-4 mr-1">
            <div class="card card-block list-height">
                <div class="card-body">
                    <p>{{ processData.title }}</p>
                    
                    <draggable class="list-group" group="negotiations">
                        <a href="#" class="list-group-item list-group-item-action negotiation-card mb-1" v-for="(card, index) in negotiations" :key="index">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 text-white">{{ card.title }}</h5>
                                <small>{{ card.created_at }}</small>
                            </div>
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
    <!-- </div> -->
</template>

<script>
import draggable from 'vuedraggable';
import { mapGetters, mapMutations } from 'vuex';
export default {
    components: {
        draggable
    },
    props: ['processData'],
    // data() {
    //     return {
    //         listA: this.negotiations['list-'+this.processData[0].id],
    //         listB: this.negotiations['list-'+this.processData[1].id]
    //     }
    // },
    created() {
    },
    methods: {
    },
    computed: {
        ...mapGetters(['getProcesses', 'getNegotiations', 'getNegsLists']),
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