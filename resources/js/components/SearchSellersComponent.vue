<template>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Filtros</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <b>Estado de conexión</b>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :value="true" v-model="status"
                                               :disabled="statusDisconnected">
                                        <label class="form-check-label">
                                            Conectado
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :value="true"
                                               v-model="statusDisconnected" :disabled="status">
                                        <label class="form-check-label">
                                            Desconectado
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-4" v-for="survey in surveys">
                            <b>{{ survey.name }}</b>
                            <div class="row" v-for="(question, index) in getOptions(survey.options)">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                               :value="{'question_id': survey.id, 'option_index': index}"
                                               v-model="filters">
                                        <label class="form-check-label">
                                            {{ question }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vendedores</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar vendedor..."
                                       v-model="searchSeller">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" @click="search()">
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-striped dt-responsive nowrap display datatable">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Última Conexión</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="seller in sellers">
                                <td>{{ seller.name }}</td>
                                <td>{{ seller.last_name }}</td>
                                <td>{{ seller.email }}</td>
                                <td>{{ seller.last_login }}</td>
                                <td>{{ getStatus(seller.status) }}</td>
                                <td>
                                    <div v-if="seller.seller_profile">
                                        <button @click="toChat(seller.seller_profile.user_id)"
                                                class="btn btn-outline-primary btn-sm"
                                                data-toggle="tooltip"
                                                :title="seller.status ? 'Contactar a este vendedor' : 'Vendedor no disponible'"
                                                :disabled="!seller.status">
                                            <i class="fas fa-comments"></i>
                                        </button>
                                        <form action="/chat" method="POST" :id="'chat_'+seller.seller_profile.user_id">
                                            <input type="hidden" name="_token" :value="token">
                                            <input type="hidden" name="user" :value="seller.seller_profile.user_id">
                                        </form>
                                    </div>
                                    <div v-else>
                                        <button class="btn btn-outline-primary btn-sm"
                                                data-toggle="tooltip"
                                                :title="seller.status ? 'Contactar a este vendedor' : 'Vendedor no disponible'"
                                                disabled>
                                            <i class="fas fa-comments"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    export default {
        data() {
            return {
                status: false,
                statusDisconnected: false,
                searchSeller: '', //Buscar vendedor
                surveys: [], //Encuesta
                filters: [],
                sellers: [],
                token   : csrf_token,
            }
        },
        watch: {
            filters: function() {
                const vm = this;
                vm.search();
            },
            status: function() {
                const vm = this;
                vm.search();
            }
        },
        methods: {
            search() {
                const vm = this;
                axios.post('/filtro', {
                    status: vm.status, statusDisconnected: vm.statusDisconnected,
                    filters: vm.filters, search: vm.searchSeller
                }).then(response => {
                    vm.sellers = response.data;
                }).catch(error => {
                    console.error(error);
                });
            },
            getOptions(options) {
                return (typeof(options) === 'string') ? JSON.parse(options) : options;
            },
            getStatus(status) {
                return (status) ? 'conectado' : 'desconectado';
            },
            toChat(user_id) {
                //location.href = `/chat/${user_id}`;
                $(`form#chat_${user_id}`).submit();
            }
        },
        mounted() {
            const vm = this;
            axios.get('/get-users').then(response => {
                vm.sellers = response.data;
            }).catch(error => {
                console.error(error);
            });
            axios.get('/get-surveys').then(response => {
                vm.surveys = response.data;
            }).catch(error => {
                console.error(error);
            });
        }
    };
</script>
