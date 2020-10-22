<template>
    <div class="form-row">
        <div class="col-12" :class="{'col-sm-3 offset-sm-9 col-md-3 offset-md-9': !isDetail}" v-if="!toRate">
            <star-rating :increment="0.01" :fixed-points="2" :star-size="starSize" :active-color="activeColor"
                         :read-only="true" class="float-left" v-model="ratingScore"
                         :border-width="borderWidth" :inactive-color="inactiveColor"
                         :border-color="borderColor"></star-rating>
        </div>
        <div v-else>
            <div v-if="!hasRated">
                <div class="col-4 offset-4 mt-2">
                    <div class="form-group">
                        <!--<label for="">Valoración</label>-->
                        <star-rating :increment="0.01" :fixed-points="2" :star-size="starSize"
                                     :active-color="activeColor" v-model="ratingScore"
                                     :border-width="borderWidth" :border-color="borderColor"
                                     :inactive-color="inactiveColor" class="align-self-center"></star-rating>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <h4>Deja un comentario de tu experiencia. Valora la profesionalidad, amabilidad, disponibilidad del vendedor con el que has trabajado, así como cualquier otro aspecto que quieras compartir para que el resto de Empresas que accedan a su perfil puedan conocer. </h4>
                    <div class="form-group">
                        <!--<label for="">Comentario</label>-->
                        <div class="comment-area">
                            <textarea class="form-control assessment" placeholder="Comentario" rows="4" v-model="comment"></textarea>
                        </div>
                        <!--<ckeditor :editor="ckeditor.editor" v-model="comment" :config="ckeditor.editorConfig"></ckeditor>-->
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block" @click="setRate">Valorar</button>
                    </div>
                </div>
            </div>
            <h4 v-else>
                gracias pero ya fue realizada la valoración
            </h4>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ratingScore: 0,
                comment: '',
                hasRated: false
            }
        },
        props: {
            isDetail: {
                type: Boolean,
                required: false,
                default: false
            },
            starSize: {
                type: Number,
                required: false,
                default: 28
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
            toRate: {
                type: Boolean,
                required: false
            },
            user: {
                type: Object,
                required: true
            },
            fromEmail: {
                type: String,
                required: false
            }
        },
        methods: {
            alreadyRate() {
                const vm = this;
                axios.post('/already-rate', {
                    from_rate_email: vm.fromEmail,
                    user_id: vm.user.id
                }).then(response => {
                    vm.hasRated = response.data.rating
                }).catch(error => {
                    console.error(error);
                });
            },
            getRate() {
                const vm = this;
                if (vm.toRate) {
                    return false;
                }
                axios.get(`/get-seller-rating/${vm.user.id}`).then(response => {
                    if (response.data.result) {
                        vm.ratingScore = response.data.score;
                    }
                }).catch(error => {
                    console.error(error);
                })
            },
            setRate() {
                const vm = this;
                if (!vm.toRate) {
                    return false;
                }
                axios.post('/valorar', {
                    from_rate_email: vm.fromEmail,
                    user_id: vm.user.id,
                    rating_score: vm.ratingScore,
                    comment: vm.comment
                }).then(response => {
                    if (response.data.result) {
                        $(".alert-rate").html(
                            `<p>
                                Gracias, hemos enviado su valoración.
                                <a href="${response.data.redirectUrl}" title="Ir a la aplicación ventonic">
                                    Ir a Ventonic
                                </a>
                            </p>`
                        );
                        $(".alert-rate").show();
                    }
                });
            }
        },
        created() {
            const vm = this;
            if (!vm.toRate) {
                vm.getRate();
            }
            else {
                vm.alreadyRate();
            }
        }
    };
</script>
