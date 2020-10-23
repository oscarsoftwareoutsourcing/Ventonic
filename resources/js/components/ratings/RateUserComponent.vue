<template>
    <div>
        <paginate name="ratings" :list="rates" :per="take" tag="div" :class="'row'">
            <div class="col-12 col-sm-4" v-for="(rate, index) in paginated('ratings')">
                <div class="card card-list">
                    <div class="card-body">
                        <div class="form-row mt-1">
                            <div class="col-12 col-sm-4"><b>Valoración:</b></div>
                            <div class="col-12 col-sm-8">
                                <star-rating :fixed-points="2" :star-size="starSize" :increment="0.01"
                                             :active-color="activeColor" :read-only="true" class="float-left"
                                             :rating="rate.score" :border-width="borderWidth" :readonly="true"
                                             :inactive-color="inactiveColor" :border-color="borderColor"></star-rating>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-12 col-sm-4"><b>Comentario:</b></div>
                            <div class="col-12 col-sm-8">{{ rate.comment }}</div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-12 col-sm-4"><b>Valorado por:</b></div>
                            <div class="col-12 col-sm-8">{{ rate.from_rate_email }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </paginate>
        <paginate-links for="ratings" :show-step-links="true" :async="true"
                        :classes="{ul: 'pagination',li: 'page-item',a: 'page-link'}"
                        :step-links="{next: '›',prev: '‹'}" :limit="3" class="d-flex justify-content-center"></paginate-links>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                rates: [],
                paginate: ['ratings']
            }
        },
        props: {
            starSize: {
                type: Number,
                required: false,
                default: 16
            },
            activeColor: {
                type: String,
                required: false,
                default: '#FF9F43'
            },
            inactiveColor: {
                type: String,
                required: false,
                default: '#878A98'
            },
            borderWidth: {
                type: Number,
                required: false,
                default: 1
            },
            borderColor: {
                type: String,
                required: false,
                default: '#d8d8d8'
            },
            user: {
                type: Object,
                required: true
            },
            take: {
                type: Number,
                required: false,
                default: 3
            }
        },
        methods: {
            getRatings() {
                const vm = this;
                axios.post('/get-ratings', {
                    user_id: vm.user.id,
                    take: vm.take
                }).then(response => {
                    if (response.data.result) {
                        vm.rates = response.data.ratings;
                    }
                }).catch(error => {
                    console.error(error);
                });
            }
        },
        created() {
            const vm = this;
            vm.getRatings();
        }
    };
</script>
