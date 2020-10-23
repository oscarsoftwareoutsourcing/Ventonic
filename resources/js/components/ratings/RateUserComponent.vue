<template>
    <div class="card">
        <div class="card-header">
            <h6 class="display-6">Últimas valoraciones</h6>
        </div>
        <div class="card-body">
            <div class="row" v-for="(rate, index) in rates">
                <div class="col-12">
                    <div class="form-row mt-1">
                        <div class="col-12 col-sm-2"><b>Valoración:</b></div>
                        <div class="col-12 col-sm-10">
                            <star-rating :fixed-points="2" :star-size="starSize" :increment="0.01"
                                         :active-color="activeColor" :read-only="true" class="float-left"
                                         :rating="rate.score" :border-width="borderWidth" :readonly="true"
                                         :inactive-color="inactiveColor" :border-color="borderColor"></star-rating>
                        </div>
                    </div>
                    <div class="form-row mt-1">
                        <div class="col-12 col-sm-2"><b>Comentario:</b></div>
                        <div class="col-12 col-sm-10">{{ rate.comment }}</div>
                    </div>
                    <div class="form-row mt-1">
                        <div class="col-12 col-sm-2"><b>Valorado por:</b></div>
                        <div class="col-12 col-sm-10">{{ rate.from_rate_email }}</div>
                    </div>
                    <hr v-if="typeof(rates[index+1])!=='undefined'">
                </div>
            </div>
            <div class="row mt-2" v-if="allRates.length > 3">
                <div class="col-12">
                    <button type="button" class="btn bg-gradient-primary btn-sm waves-effect waves-light"
                            data-toggle="modal" data-target="#showAllRatings">
                        Ver todas
                    </button>

                    <div class="modal fade" id="showAllRatings" tabindex="-1" role="dialog"
                         aria-labelledby="showAllRatingsTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showAllRatingsTitle">Valoraciones</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                rates: [],
                allRates: []
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
                        vm.allRates = response.data.allRatings;
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
