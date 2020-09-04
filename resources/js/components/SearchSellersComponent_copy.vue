<template>
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card">
        <div class="bg-gradient-primary">
          <div class="card_vetonic-description">
            <div class="text_vetonic-description1">Filtros</div>
          </div>
        </div>
        <div class="card-body">
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
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-3">
          <div class="title-sales my-1">Vendedores</div>
        </div>
        <div class="col-9 header-ventonic">
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
      </div>

      <div class="row">
        <div v-for="seller in sellers">
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
                <div class="col-lg-7 col-md-7 col-sm-7">
                  <h3>{{ seller.name }} {{ seller.last_name }}</h3>
                  <div>{{ seller.email }}</div>
                  <p class="card-text mb-0">Última Conexión {{ seller.last_login }}</p>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <!--
          <div class="row">
            <div class="col-12">
              <div class="input-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Buscar vendedor..."
                  v-model="searchSeller"
                />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button" @click="search()">Buscar</button>
                </div>
              </div>
            </div>
          </div>
          -->
          <div class="table-responsive">
            <table
              class="table table-hover table-striped dt-responsive nowrap display datatable"
              style="font-size:.758rem"
            >
              <thead>
                <tr>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Correo</th>
                  <th>Perfil</th>
                  <th>Última Conexión</th>

                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="seller in sellers">
                  <td>
                    <div class="avatar">
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
                  </td>
                  <td>{{ seller.name }}</td>
                  <td>{{ seller.last_name }}</td>
                  <td>{{ seller.email }}</td>
                  <td style="text-align:center;">
                    <div v-if="seller.seller_profile">
                      <a
                        class="btn btn-primary btn-md text-white"
                        :href="'profile/aplicant/'+ seller.id "
                      >Ver</a>
                    </div>
                    <div v-else>No Disponible</div>
                  </td>

                  <td>{{ seller.last_login }}</td>

                  <td>
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
                  </td>
                </tr>
              </tbody>
            </table>
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
