<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper" v-if="configured">
      <email ref="manage"></email>
    </div>
    <div class="content-wrapper" v-else>
      <div class="content-header row"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
              <div class="card-header">Configuración</div>
              <div v-if="!configStarted">
                <div
                  class="card-body"
                >Conecta tu dirección de correo electrónico para disfrutar de todo el potencial de Ventonic</div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <button
                        type="button"
                        class="btn btn-primary btn-sm float-right"
                        title="Pulse sobre el botón para iniciar el proceso de configuración"
                        data-toggle="tooltip"
                        @click="configStarted=true"
                      >Iniciar</button>
                    </div>
                  </div>
                </div>
              </div>
              <div v-else>
                <div class="card-body">
                  <div class="alert alert-danger" role="alert" v-if="settingError">
                    <h4 class="alert-heading">Error</h4>
                    <p class="mb-0">{{ settingError }}</p>
                  </div>
                  <h6 class="font-weight-bold">Información del usuario</h6>
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <label for>Su nombre</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="name"
                          :class="{'has-error': hasErrors('name')}"
                        />
                        <span class="invalid-feedback mb-3" role="alert" v-if="hasErrors('name')">
                          <strong>{{ errors.name }}</strong>
                        </span>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <label for>Dirección de correo</label>
                        <input
                          type="email"
                          class="form-control"
                          v-model="email"
                          :class="{'has-error': hasErrors('email')}"
                        />
                        <span class="invalid-feedback mb-3" role="alert" v-if="hasErrors('email')">
                          <strong>{{ errors.email }}</strong>
                        </span>
                      </div>
                    </div>
                  </div>
                  <hr />
                  <h6 class="font-weight-bold">Información del servidor</h6>
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="autoConfig"
                            v-model="autoConfig"
                          />
                          <label class="form-check-label" for="autoConfig">Configuración automática</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <label for>Tipo de cuenta</label>
                        <select
                          class="custom-select"
                          v-model="protocol"
                          :class="{'has-error': hasErrors('protocol')}"
                        >
                          <option value="imap">IMAP</option>
                          <option value="pop3">POP3</option>
                        </select>
                        <span
                          class="invalid-feedback mb-3"
                          role="alert"
                          v-if="hasErrors('protocol')"
                        >
                          <strong>{{ errors.protocol }}</strong>
                        </span>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                      <div class="form-group">
                        <label for>Servidor de correo entrante</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="incoming_server_host"
                          :class="{'has-error': hasErrors('incoming_server_host')}"
                        />
                        <span
                          class="invalid-feedback mb-3"
                          role="alert"
                          v-if="hasErrors('incoming_server_host')"
                        >
                          <strong>{{ errors.incoming_server_host }}</strong>
                        </span>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-xs-12">
                      <div class="form-group">
                        <label for>Puerto</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="incoming_server_port"
                          :class="{'has-error': hasErrors('incoming_server_port')}"
                        />
                        <span
                          class="invalid-feedback mb-3"
                          role="alert"
                          v-if="hasErrors('incoming_server_port')"
                        >
                          <strong>{{ errors.incoming_server_port }}</strong>
                        </span>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                      <div class="form-group">
                        <label for>Servidor de correo saliente (SMTP)</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="outgoing_server_host"
                          :class="{'has-error': hasErrors('outgoing_server_host')}"
                        />
                        <span
                          class="invalid-feedback mb-3"
                          role="alert"
                          v-if="hasErrors('outgoing_server_host')"
                        >
                          <strong>{{ errors.outgoing_server_host }}</strong>
                        </span>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-xs-12">
                      <div class="form-group">
                        <label for>Puerto</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="outgoing_server_port"
                          :class="{'has-error': hasErrors('outgoing_server_port')}"
                        />
                        <span
                          class="invalid-feedback mb-3"
                          role="alert"
                          v-if="hasErrors('outgoing_server_port')"
                        >
                          <strong>{{ errors.outgoing_server_port }}</strong>
                        </span>
                      </div>
                    </div>
                  </div>
                  <hr />
                  <h6 class="font-weight-bold">Información de inicio de sesión</h6>
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <label for>Nombre de usuario</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="username"
                          :class="{'has-error': hasErrors('username')}"
                        />
                        <span
                          class="invalid-feedback mb-3"
                          role="alert"
                          v-if="hasErrors('username')"
                        >
                          <strong>{{ errors.username }}</strong>
                        </span>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <label for>Contraseña</label>
                        <input
                          type="password"
                          class="form-control"
                          v-model="password"
                          :class="{'has-error': hasErrors('password')}"
                        />
                        <span
                          class="invalid-feedback mb-3"
                          role="alert"
                          v-if="hasErrors('password')"
                        >
                          <strong>{{ errors.password }}</strong>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <button
                        type="button"
                        class="btn btn-primary btn-sm float-right"
                        title="Pulse sobre el botón para establecer la configuración"
                        data-toggle="tooltip"
                        @click="setSettings"
                      >Configurar</button>
                    </div>
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
import VueLoading from "vuejs-loading-plugin";
Vue.use(VueLoading, {
  dark: true,
  text: "Verificando configuración",
  loading: false,
  //customLoader: myVueComponent, // replaces the spinner and text with your own
  background: "rgba(16, 22, 58, .5)" // set custom background
  //classes: ['myclass'] // array, object or string
});

export default {
  updated() {
    const vm = this;
    if (vm.configured) {
      vm.$refs.manage.emails = vm.emails_list;
    }
  },
  data() {
    return {
      name: "",
      email: "",
      autoConfig: false,
      protocol: "imap",
      incoming_server_host: "",
      outgoing_server_host: "",
      incoming_server_port: 993,
      outgoing_server_port: 465,
      username: "",
      password: "",
      settingError: "",
      configured: false,
      configStarted: false,
      emails_list: []
    };
  },
  watch: {
    protocol: function() {
      const vm = this;
      if (vm.protocol === "imap") {
        vm.incoming_server_port = 993;
        vm.outgoing_server_port = 465;
      } else {
        vm.incoming_server_port = 995;
        vm.outgoing_server_port = 465;
      }
    }
  },
  methods: {
    /**
     * Establece la configuración del servidor de correos del usuario
     *
     * @author     <roldandvg@gmail.com>
     */
    setSettings() {
      const vm = this;
      vm.$loading(true);
      axios
        .post("/email/settings", {
          name: vm.name,
          email: vm.email,
          autoConfig: vm.autoConfig,
          protocol: vm.protocol,
          incoming_server_host: vm.incoming_server_host,
          incoming_server_port: vm.incoming_server_port,
          outgoing_server_host: vm.outgoing_server_host,
          outgoing_server_port: vm.outgoing_server_port,
          username: vm.username,
          password: vm.password
        })
        .then(response => {
          if (response.data.result) {
            // mensaje de exito
            vm.configured = true;
            vm.emails_list = response.data.emails_list;
          } else {
            vm.settingError = response.data.message;
          }
          vm.$loading(false);
        })
        .catch(error => {
          vm.errors = {};

          if (typeof error.response != "undefined") {
            for (var index in error.response.data.errors) {
              if (error.response.data.errors[index]) {
                vm.errors[index] = error.response.data.errors[index][0];
              }
            }
          }
          vm.$loading(false);
        });
    }
  },
  mounted() {}
};
</script>
