<template>
  <!--<div class="app-content content" style="overflow:auto;">-->
  <div>
    <div class="content-overlay">
      <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
        <!-- <div v-html="callme.iframe"></div> -->
      </div>
    </div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper" v-if="configured">
      <email ref="manage"></email>
    </div>
    <div class v-else>
      <div class="row"></div>
      <div class="content-header row">
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="card">
                <div class="bg-gradient-primary">
                  <div class="card_vetonic-description">
                    <div class="text_vetonic-description1">Configuración</div>
                  </div>
                </div>

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
                          <span
                            class="invalid-feedback mb-3"
                            role="alert"
                            v-if="hasErrors('email')"
                          >
                            <strong>{{ errors.email }}</strong>
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
                            <label
                              class="form-check-label"
                              for="autoConfig"
                            >Configuración automática</label>
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
                            :disabled="autoConfig"
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
                            :readonly="autoConfig"
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
                            :readonly="autoConfig"
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
                            :readonly="autoConfig"
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
                            :readonly="autoConfig"
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
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <button
                          type="button"
                          class="btn btn-primary btn-sm float-left"
                          title="Pulse sobre el botón para desvincular la cuenta configurada"
                          data-toggle="tooltip"
                          @click="removeSettings"
                          v-if="update"
                        >Eliminar</button>
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
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="card">
            <div class="card-header mb-1">
              <h4 class="card-title">Información</h4>
            </div>
            <div class="card-content p-2">
              <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
                <!-- <div v-html="callme.iframe"></div> -->
                <video id="sampleMovie" width="100%" preload controls>
                  <source src="video/email.mp4" />
                  <source src="video/email.mp4" />
                  <source src="video/email.mp4" />
                </video>
              </div>
              <div class="card-body">
                <div>Información general de como configurar tu correo para poder gestionarlo desde Ventonic</div>
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
  background: "rgba(16, 22, 58, .5)", // set custom background
  //classes: ['myclass'] // array, object or string
});

export default {
  updated() {
    const vm = this;
    if (vm.configured) {
      vm.$refs.manage.emails = vm.emails_list;
    }
  },
  props: {
    update: {
      type: Boolean,
      required: false,
      default: false,
    },
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
      emails_list: [],
    };
  },
  watch: {
    protocol: function () {
      const vm = this;
      if (vm.protocol === "imap") {
        vm.incoming_server_port = 993;
        vm.outgoing_server_port = 465;
      } else {
        vm.incoming_server_port = 995;
        vm.outgoing_server_port = 465;
      }
    },
    autoConfig: function () {
      const vm = this;
      if (vm.autoConfig) {
        if (
          vm.name === "" ||
          !vm.email === "" ||
          vm.username === "" ||
          vm.password === ""
        ) {
          bootbox.alert({
            title: "Alerta!",
            message:
              "Debe indicar la información del usuario y del inicio de sesión antes de continuar",
            callback: function () {
              $("#autoConfig").click();
            },
          });
          return true;
        }
        bootbox.confirm({
          title: "Configuración automática",
          message: `Esta opción permite establecer la configuración más adecuada para su cuenta de correo. 
                                El proceso puede tardar algunos minutos. ¿Quiere continuar?
                                  ${vm.layerSecurityMsg()}`,
          buttons: {
            cancel: {
              label: "cancelar",
            },
            confirm: {
              label: "continuar",
            },
          },
          callback: function (result) {
            if (result) {
              vm.$loading(true);
              axios
                .post("/email/check-auto-config", {
                  email: vm.email,
                  username: vm.username,
                  pass: vm.password,
                })
                .then((response) => {
                  if (!response.data.result) {
                    $("#autoConfig").click();
                    bootbox.alert({
                      title: "Alerta!",
                      message:
                        response.data.message ||
                        `No se ha podido obtener datos del servidor.
                                                      Debe agregar manualmente la información`,
                    });
                    vm.$loading(false);
                    return true;
                  }
                  vm.incoming_server_host = response.data.serverInfo.host;
                  vm.outgoing_server_host = response.data.serverInfo.out_host;
                  vm.incoming_server_port = response.data.serverInfo.port;
                  vm.outgoing_server_port = response.data.serverInfo.out_port;
                  vm.protocol = response.data.serverInfo.protocol;
                  vm.$loading(false);
                })
                .catch((error) => {
                  console.error(error);
                  vm.$loading(false);
                });
              return true;
            }
            vm.autoConfig = false;
          },
        });
      }
    },
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
          password: vm.password,
        })
        .then((response) => {
          if (response.data.result) {
            // mensaje de exito
            vm.configured = true;
            vm.emails_list = response.data.emails_list;
            if (vm.update) {
              location.reload();
            }
          } else {
            vm.settingError = response.data.message;
          }
          vm.$loading(false);
        })
        .catch((error) => {
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
    },
    /**
     * Remueve y desvincula la cuenta de correo electrónico
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     */
    removeSettings() {
      const vm = this;
      bootbox.confirm({
        title: "¿Desvincular cuenta?",
        message: `Esta a punto de desvincular la cuenta de correo configurada, esto eliminará toda la
                              información de correos gestionados a través de la plataforma.
                              ¿Está totalmente seguro de continuar?`,
        buttons: {
          cancel: {
            label: "Cancelar",
            className: "btn-light float-left",
          },
          confirm: {
            label: "Eliminar",
            className: "btn-primary float-right",
          },
        },
        callback: function (result) {
          if (result) {
            vm.$loading(true);
            axios
              .post("/email/remove-settings")
              .then((response) => {
                if (response.data.result) {
                  vm.configStarted = false;
                }
                vm.$loading(false);
              })
              .catch((error) => {
                console.error(error);
                vm.$loading(false);
              });
          }
        },
      });
    },
    /**
     * Mensajes sobre consideraciones a tomar en cuenta para algunas cuentas de correo
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @return    {string}            Mensaje al usuario con las consideraciones a realizar en la respectiva
     *                                cuenta de correo
     */
    layerSecurityMsg: function () {
      const vm = this;
      var msg = "";

      if (vm.email !== "") {
        if (vm.email.includes("@gmail")) {
          msg = `<hr><p>Gmail cuenta con una capa de seguridad extra por lo que es necesario realizar algunos ajustes desde su cuenta de    correo antes de proceder a la configuración automática. Para esto acceda a su cuenta de correo y siga los siguientes pasos:</p>
                               <ul>
                                    <li>Haga clic en el icono del perfil de la cuenta ubicado en la parte superior derecha
                                    Presione sobre el botón <strong>"Gestionar tu cuenta de Google"</strong></li>
                                    <li>En la siguiente página, presionar sobre la opción <strong>"Seguridad"</strong> del menú lateral izquierdo/li>
                                    <li>En el listado de opciones presentado, hacer clic en la opción <strong>"Acceso de apps menos segura"</strong> y darle a la opción de habilitar</li>
                                    
                               </ul>`;
        } else if (vm.email.includes("@yahoo") || vm.email.includes("@aol")) {
          msg = `<hr><p>Yahoo / Aol, cuentan con una capa de seguridad extra por lo que es necesario realizar algunos
                               ajustes desde su cuenta de correo antes de proceder a la configuración automática.
                               Para esto acceda a su cuenta de correo y siga los siguientes pasos:</p>
                               <ul>
                                    <li>Haga clic en el ícono del perfil de la cuenta ubicado en la parte superior derecha</li>
                                    <li>Presione sobre el botón "Información de la cuenta"</li>
                                    <li>En la siguiente página, presionar sobre la opción "Seguridad de la cuenta" del menú lateral izquierdo</li>
                                    <li>En el listado de opciones presentado, hacer clic en la opción "Administrar contraseñas de aplicaciones"</li>
                                    <li>Posteriormente se debe seleccionar el tipo de aplicación, en cuyo caso se selecciona la opción "otras aplicaciones"</li>
                                    <li>Presionar sobre el botón "generar contraseña"</li>
                                    <li>Copiar la contraseña generada ya que esta será la que se utilizará en el proceso de configuración de correo en Ventonic en lugar de la contraseña normal del usuario</li>
                               </ul>`;
        }
      }

      if (msg !== "") {
        msg += `<p>
                                Una vez realizada esta configuración en su cuenta de correo, regrese a esta página y presione el botón continuar.
                            </p>
                            <p>
                                Si no se puede determinar la configuración del servidor de correo, por favor revise en su cuenta la existencia de un correo de alerta enviado por su proveedor indicando el bloqueo de acceso y permita el mismo, luego intente de nuevo la configuración automática.
                            </p>`;
      }

      return msg;
    },
  },
  mounted() {
    const vm = this;
    if (vm.update) {
      vm.configStarted = vm.update;
      axios
        .get("/email/settings")
        .then((response) => {
          if (response.data.result) {
            vm.name = response.data.name;
            vm.email = response.data.email;
            vm.protocol = response.data.protocol;
            vm.incoming_server_host = response.data.incoming_server_host;
            vm.outgoing_server_host = response.data.outgoing_server_host;
            vm.incoming_server_port = response.data.incoming_server_port;
            vm.outgoing_server_port = response.data.outgoing_server_port;
            vm.username = response.data.username;
          }
        })
        .catch((error) => {
          console.error(error);
        });
    }
  },
};
</script>
