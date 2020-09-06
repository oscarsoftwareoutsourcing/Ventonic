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
      <div class="customizer-content p-2 ps ps--active-y">
        <h4 class="text-uppercase mb-0">Filtros</h4>
        <small>Negociaciones</small>
        <hr />

        <div id="lgFiltersBar" class="col-lg-auto d-none d-lg-block filtros">
          <!-- Filters -->

          <perfect-scrollbar>
            <div class="row">
              <div class="col-12 mb-4">
                <b>Estado de conexión</b>
                <div class="row">
                  <div class="col-12">
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        :value="true"
                        v-model="status"
                        :disabled="statusDisconnected"
                      />
                      <label class="form-check-label">Conectado</label>
                    </div>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        :value="true"
                        v-model="statusDisconnected"
                        :disabled="status"
                      />
                      <label class="form-check-label">Desconectado</label>
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
                      <input
                        class="form-check-input"
                        type="checkbox"
                        :value="{'question_id': survey.id, 'option_index': index}"
                        v-model="filters"
                      />
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
        <div class="row header-ventonic">
          <div class="col-3">
            <div class="title-sales my-1">Vendedores</div>
          </div>
          <div class="col-7">
            <fieldset class="form-group position-relative has-icon-left my-1">
              <input
                type="text"
                class="form-control"
                id="iconLeft1"
                placeholder="Buscar por Nombre, Apellido"
                v-model="searchSeller"
              />
              <div class="form-control-position">
                <i class="ficon feather icon-search"></i>
              </div>
            </fieldset>
          </div>
          <div class="col-2">
            <div class="mr-auto float-right bookmark-wrapper d-flex align-items-center my-1">
              <button
                type="button"
                class="btn btn-dark btn btn-block waves-effect waves-light"
                @click="openFilter"
              >
                <i class="feather icon-settings fa fa-spin fa-fw white"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="row">
          <div v-for="seller in sellers" class="col-lg-4 col-md-4 col-sm-16 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="avatar avatar-xl">
                      <img
                        :src="seller.photo"
                        :alt="seller.name"
                        class="img-fluid"
                        v-if="seller.photo"
                        height="40"
                        width="40"
                      />
                      <img
                        src="/images/anonymous-user.png"
                        class="media-object rounded-circle"
                        :alt="seller.name"
                        height="40"
                        width="40"
                        v-else
                      />
                      <div v-if="seller.seller_profile">
                        <span :class="seller.status ? 'avatar-status-online' :'avatar-status-busy'"></span>
                      </div>
                      <div v-else>
                        <span :class="seller.status ? 'avatar-status-online' :'avatar-status-busy'"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <span class="float-right">
                      <div v-if="seller.seller_profile">
                        <button
                          @click="contactSeller(seller.id)"
                          :class="seller.status ? 'btn btn-icon btn-icon rounded-circle btn-success mr-1 mb-1 waves-effect waves-light' : 'btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light'"
                          data-toggle="tooltip"
                          :title="seller.status ? 'Contactar a este vendedor' : 'Dejar un mensaje al vendedor'"
                        >
                          <i
                            :class="seller.status ? 'ficon feather icon-message-square' : 'ficon feather icon-mail'"
                          ></i>
                        </button>
                        <form
                          action="/chat"
                          method="POST"
                          :id="'chat_'+seller.seller_profile.user_id"
                        >
                          <input type="hidden" name="_token" :value="token" />
                          <input type="hidden" name="user" :value="seller.seller_profile.user_id" />
                        </form>
                      </div>
                      <div v-else>
                        <button
                          type="button"
                          :class="seller.status ? 'btn btn-icon btn-icon rounded-circle btn-success mr-1 mb-1 waves-effect waves-light' : 'btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light'"
                          data-toggle="tooltip"
                          :title="seller.status ? 'Contactar a este vendedor' : 'Dejar un mensaje al vendedor'"
                          @click="contactSeller(seller.id)"
                        >
                          <i
                            :class="seller.status ? 'ficon feather icon-message-square' : 'ficon feather icon-mail'"
                          ></i>
                        </button>
                      </div>
                    </span>

                    <h3>{{ seller.name }} {{ seller.last_name }}</h3>
                    <div class="email-sales">{{ seller.email }}</div>
                    <p class="card-text mb-1">Última Conexión {{ seller.last_login }}</p>

                    <div v-if="seller.seller_profile">
                      <a
                        class="byn bg-gradient-primary waves-effect waves-light text-white btn-sm"
                        :href="'profile/aplicant/'+ seller.id "
                      >Ver perfil</a>
                    </div>
                    <div v-else>Perfil No Disponible</div>
                  </div>
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
    };
  },
  watch: {
    filters: function () {
      const vm = this;
      vm.search();
    },
    status: function () {
      const vm = this;
      vm.search();
    },
    statusDisconnected: function () {
      const vm = this;
      vm.search();
    },
  },
  methods: {
    search() {
      const vm = this;
      axios
        .post("/filtro", {
          status: vm.status,
          statusDisconnected: vm.statusDisconnected,
          filters: vm.filters,
          search: vm.searchSeller,
        })
        .then((response) => {
          vm.sellers = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
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
          //vm.sellers = response.data;
          vm.search();
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
    openFilter: function () {
      $(".customizer").toggleClass("open");
    },
    closeFilter: function () {
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
