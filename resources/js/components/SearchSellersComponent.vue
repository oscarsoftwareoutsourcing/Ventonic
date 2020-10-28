<template>
    <div>
        <div class="customizer d-none d-md-block">
            <a class="customizer-close" href="#" @click="closeFilter">
                <i class="feather icon-x"></i>
            </a>
            <!--
    <a class="customizer-toggle" href="#">
      <i class="feather icon-settings fa fa-spin fa-fw white"></i>
    </a>
      -->
            <div class="p-2 customizer-content ps ps--active-y">
                <h4 class="mb-0 text-uppercase">Filtros</h4>
                <small>Negociaciones</small>
                <hr />
                <div id="lgFiltersBar" class="col-lg-auto d-none d-lg-block filtros">
                    <!-- Filters -->
                    <perfect-scrollbar>
                        <div class="row">
                            <div class="mb-4 col-12">
                                <h4>Estado de conexión</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" :value="true" v-model="status" :disabled="statusDisconnected" />
                                            <label class="form-check-label">Conectado</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" :value="true" v-model="statusDisconnected" :disabled="status" />
                                            <label class="form-check-label">Desconectado</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-4 col-12">
                                <h4>Valoración</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="5" v-model="rating"  />
                                            <label class="form-check-label">5 estrellas</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="4" v-model="rating" />
                                            <label class="form-check-label">4 o más de 4 estrellas</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="3" v-model="rating" />
                                            <label class="form-check-label">3 o más de 3 estrellas</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="2" v-model="rating" />
                                            <label class="form-check-label">Menos de 2 estrellas</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-4 col-12" v-for="survey in surveys">
                                <h4>{{ survey.name }}</h4>
                                <div class="row" v-for="(question, index) in getOptions(survey.options)">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" :value="{'question_id': survey.id, 'option_index': index}" v-model="filters" />
                                            <label class="form-check-label">{{ question }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </perfect-scrollbar>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mb-2 row bg-gradient-primary">
                    <div class="col-3">
                        <div class="my-1 title-sales">
                            <div class="mr-1 avatar">
                                <div class="avatar-content">{{ sellers.length }}</div>
                            </div>Vendedores
                        </div>
                    </div>
                    <div class="col-7">
                        <fieldset class="my-1 form-group position-relative has-icon-left">
                            <input type="text" class="form-control" id="iconLeft1" placeholder="Buscar por Nombre, Apellido" v-model="searchSeller" />
                            <div class="form-control-position">
                                <i class="ficon feather icon-search"></i>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-2">
                        <div class="float-right my-1 mr-auto bookmark-wrapper d-flex align-items-center">
                            <button type="button" class="btn btn-dark btn-block waves-effect waves-light" @click="openFilter">
                                <i class="feather icon-settings fa fa-spin fa-fw white"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!--<div class="row">-->
                    <paginate name="sellersList" :list="sellers" :per="20" tag="div" class="row">
                    <div v-for="seller in paginated('sellersList')" class="col-lg-4 col-md-4 col-sm-16 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="avatar avatar-xl">
                                            <img :src="seller.photo" :alt="seller.name" class="img-fluid" v-if="seller.photo" height="40" width="40" :title="seller.status ? 'Conectado' : 'Desconectado'" />
                                            <img src="/images/anonymous-user.png" class="media-object rounded-circle" :alt="seller.name" height="40" width="40" :title="seller.status ? 'Conectado' : 'Desconectado'" v-else />
                                            <div v-if="seller.seller_profile">
                                                <span :class="seller.status ? 'avatar-status-online' :'avatar-status-busy'" :title="seller.status ? 'Conectado' : 'Desconectado'"></span>
                                            </div>
                                            <div v-else>
                                                <span :class="seller.status ? 'avatar-status-online' :'avatar-status-busy'" :title="seller.status ? 'Conectado' : 'Desconectado'"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <span class="float-right">
                                            <div v-if="seller.seller_profile">
                                                <button @click="contactSeller(seller.id)" :class="seller.status ? 'btn btn-icon btn-icon rounded-circle btn-success mr-1 mb-1 waves-effect waves-light' : 'btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light'" data-toggle="tooltip" :title="seller.status ? 'Contactar a este vendedor' : 'Dejar un mensaje al vendedor'">
                                                    <i :class="seller.status ? 'ficon feather icon-message-square' : 'ficon feather icon-message-square'"></i>
                                                </button>
                                                <form action="/chat" method="POST" :id="'chat_'+seller.seller_profile.user_id">
                                                    <input type="hidden" name="_token" :value="token" />
                                                    <input type="hidden" name="user" :value="seller.seller_profile.user_id" />
                                                </form>
                                            </div>
                                            <div v-else>
                                                <button type="button" :class="seller.status ? 'btn btn-icon btn-icon rounded-circle btn-success mr-1 mb-1 waves-effect waves-light' : 'btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light'" data-toggle="tooltip" :title="seller.status ? 'Contactar a este vendedor' : 'Dejar un mensaje al vendedor'" @click="contactSeller(seller.id)">
                                                    <i :class="seller.status ? 'ficon feather icon-message-square' : 'ficon feather  icon-message-square'"></i>
                                                </button>
                                            </div>
                                        </span>
                                        <h3>{{ seller.name }} {{ seller.last_name }} </h3>
                                        <div class="email-sales">{{ seller.email }}</div>
                                        <p class="mb-1 card-text">Última Conexión {{ seller.last_login }}</p>
                                        <div v-if="seller.seller_profile">
                                            <a class="text-white byn bg-gradient-primary waves-effect waves-light btn-sm" :href="'profile/aplicant/'+ seller.id ">Ver perfil</a>
                                        </div>
                                        <div v-else>Perfil No Disponible</div>
                                        <div class="float-right my-1 mr-auto">
                                        <rating-score :to-rate="false" :user="seller" :is-detail="true"
                                              :inactive-color="'#10163A'" :active-color="'#0086FA'" :star-size="16"
                                              :border-width="2" :border-color="'#0086FA'"></rating-score>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </paginate>
                <!--</div>-->
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 offset-sm-3 offset-md-4 offset-lg-4">
                        <nav class="mt-3" style="margin:0 auto;">
                            <paginate-links for="sellersList" :show-step-links="true" :async="true"
                                            :classes="{ul: 'pagination',li: 'page-item',a: 'page-link'}"
                                            :step-links="{next: '›',prev: '‹'}" :limit="3"></paginate-links>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
var csrf_token = $('meta[name="csrf-token"]').attr("content");

export default {
    data() {
        return {
            status: false,
            statusDisconnected: false,
            searchSeller: "", //Buscar vendedor
            surveys: [], //Encuesta
            filters: [],
            sellers: [],
            token: csrf_token,
            paginate: ['sellersList']
        };
    },
    watch: {
        filters: function() {
            const vm = this;
            vm.getUsers();
        },
        status: function() {
            const vm = this;
            vm.getUsers();
        },
        statusDisconnected: function() {
            const vm = this;
            vm.getUsers();
        },
        searchSeller: function() {
            const vm = this;
            if (vm.searchSeller) {
                vm.getUsers();
            }
        }
    },
    methods: {
        async search(data) {
            const vm = this;
            if (vm.filters.length > 0 || vm.searchSeller || vm.status || vm.statusDisconnected) {
                if (vm.filters.length > 0) {
                    /** Si se ha filtrado por respuestas en encuesta */
                    var filteredSellers = await axios.post("/filtro", {
                        filters: vm.filters,
                    }).then((response) => {
                        vm.sellers = response.data;
                    }).catch((error) => {
                        console.error(error);
                    });
                }
                if (vm.searchSeller) {
                    let text = vm.searchSeller.toUpperCase();
                    let dataSeller = (vm.sellers.length > 0) ? vm.sellers : data;
                    vm.sellers = dataSeller.filter(function(seller) {
                        let name = seller.name.toUpperCase();
                        let lastName = (seller.last_name !== null) ? seller.last_name.toUpperCase() : '';
                        let fullName = name + ((lastName) ? ' ' + lastName : '');
                        let email = seller.email.toUpperCase();
                        /** Solo filtro de texto */
                        return (fullName.includes(text) || email.includes(text));
                    });
                }
                if (vm.status) {
                    /** Si se ha filtrado por estatus conectado */
                    let dataSeller = (vm.sellers.length > 0) ? vm.sellers : data;
                    vm.sellers = dataSeller.filter(function(seller) {
                        return (seller.status === true || seller.status === 1);
                    });
                }
                if (vm.statusDisconnected) {
                    /** Si se ha filtrado por status desconectado */
                    let dataSeller = (vm.sellers.length > 0) ? vm.sellers : data;
                    vm.sellers = dataSeller.filter(function(seller) {
                        return (seller.status === false || seller.status === 0);
                    });
                }
            }
            else {
                vm.sellers = data;
            }
        },
        getOptions(options) {
            return typeof options === "string" ? JSON.parse(options) : options;
        },
        getStatus(status) {
            return status ? "conectado" : "desconectado";
        },
        toChat(user_id) {
            //location.href = `/chat/${user_id}`;
            $(`form#chat_${user_id}`).submit();
        },
        contactSeller(id) {
            axios
                .get("/contact-seller/" + id)
                .then((response) => {
                    if (response.data.result) {
                        location.href = "/chat";
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        },

        profileSeller(id) {
            axios
                .get("/profile/aplicant/" + id)
                .then((response) => {
                    if (response.data.result) {
                        location.href = "/chat";
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        getUsers() {
            const vm = this;
            axios
                .get("/get-users")
                .then((response) => {
                    vm.search(response.data);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        getSurveys() {
            const vm = this;
            axios
                .get("/get-surveys")
                .then((response) => {
                    vm.surveys = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        openFilter: function() {
            $(".customizer").toggleClass("open");
        },
        closeFilter: function() {
            $(".customizer").removeClass("open");
        },
    },
    mounted() {
        const vm = this;
        vm.getUsers();
        vm.getSurveys();

        setInterval(() => {
            vm.getUsers();
        }, 5000);
    },
};

</script>
