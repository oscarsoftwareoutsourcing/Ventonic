<template>
  <div id="basic-examples">
    <div class="card">
      <div class="card-ventonic">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="text-ventonic">{{ callme.name }}</div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-12">
            <a
              class="btn btn-primary text-white"
              href="javascript:void(0)"
              data-toggle="modal"
              data-target="#inlineForm"
            >+ Nuevo</a>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-sm-4">
            <input type="text" placeholder="Buscar..." class="form-control" v-model="searchText" />
          </div>
        </div>
      </div>
    </div>
    <!-- Listado de Widgets -->
    <div class="widgets">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12" v-for="widget in Widgets">
              <div class="card">
                <div class="card-content">
                  <!-- <img class="card-img-top img-fluid" :src="'images/pages/content-img-1.jpg'"
                  alt="Card image cap">-->
                  <div class="accordion" id="accordionExample">
                    <div class="card">
                      <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                          <button
                            class="btn btn-link collapsed"
                            type="button"
                            data-toggle="collapse"
                            aria-expanded="false"
                            :data-target="'#collapseThree'+widget.id"
                            aria-controls="collapseThree"
                          >
                            <div>
                              <h5>{{ widget.name }}</h5>
                              <br />
                              {{ widget.url }}
                              <br />
                              {{ (typeof(widget.userReferred)!=="undefined")?widget.userReferred.name:'' }}
                            </div>
                            <span>
                              <i class="feather icon-chevron-down" aria-hidden="true"></i>
                            </span>
                          </button>
                        </h2>
                      </div>
                      <div
                        :id="'collapseThree' + widget.id"
                        class="collapse"
                        aria-labelledby="headingThree"
                        data-parent="#accordionExample"
                      >
                        <div class="card-body">
                          <div class="text-center mb-2">
                            Para instalar
                            <strong>Call Me</strong> debes introducir este código dentro de las etiquetas
                            <strong>head</strong> en tu página web
                          </div>
                          <fieldset class="form-group">
                            <textarea class="form-control" id="basicTextarea" rows="10" disabled>
                                                            <!--Start of Ventonic.com Script-->
                                                            <script type="text/javascript">
                                                            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                                                            (function(){
                                                                var
                                                                s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                                                                s1.async=true;
                                                                s1.src="https://app.ventonic.com/{{widget.token}}/default";
                                                                s1.charset="UTF-8";
                                                                s1.setAttribute("crossorigin","*");
                                                                s0.parentNode.insertBefore(s1,s0);
                                                            })();
                                                            </script>
                                                            <!--End of Ventonic.com Script-->
                                                        </textarea>
                          </fieldset>
                          <div
                            class="text-center"
                          >Como segundo paso debes insertar las siguientes etiquetas en la sección de tu web donde quieras que se muestre</div>
                          <fieldset class="form-group mb-2">
                            <textarea
                              class="form-control"
                              id="basicLabelHtml"
                              rows="3"
                              :disabled="isDisabled"
                              placeholder="Textarea"
                            >
                                                            <div class="widget-vendedores" id="widget-vendedores"></div>
                                                        </textarea>
                          </fieldset>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body us-card">
                    <div class="card-btns d-flex justify-content-between mt-2">
                      <div class="custom-control custom-switch custom-control-inline">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          v-model="widget.status"
                          :id="widget.id"
                          @change="widgetStatusUpdate($event,widget.id)"
                        />
                        <label class="custom-control-label" :for="widget.id"></label>
                        <span class="switch-label">Active</span>
                      </div>
                    </div>
                    <div class="card-btns d-flex justify-content-between mt-2">
                      <a :href="'/widget/widgetsData/'+widget.id">Ver informe</a>
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
              <h4 class="card-title">{{ callme.name }}</h4>
            </div>
            <div class="card-content p-2">
              <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
                <!-- <div v-html="callme.iframe"></div> -->
                <video id="sampleMovie" width="100%" preload controls>
                  <source src="video/widget.mp4" />
                  <source src="video/widget.mp4" />
                  <source src="video/widget.mp4" />
                </video>
              </div>
              <div class="card-body">
                <div v-html="callme.info"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade text-left"
      id="inlineForm"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel33"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Asistente de widgets</h4>
            <button
              type="button"
              id="modalWidget"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form-wizard
              title
              subtitle
              @on-complete="GenerateWidget"
              @on-error="handleErrorMessage"
              color="#7367F0"
              finish-button-text="Generar widget"
              next-button-text="Siguiente"
              back-button-text="Anterior"
            >
              <tab-content title="Obtener PIN del vendedor" icon="fa fa-user-o">
                <br class="my-2" />
                <p class="text-center">Pide el PIN a tu vendedor</p>
                <br class="my-2" />
              </tab-content>
              <tab-content
                title="Validación de PIN"
                icon="fa fa-check"
                :before-change="beforeTabSwitch"
              >
                <br class="my-2" />
                <div class="row">
                  <div class="col-12 text-center">
                    <div class="form-label-group">
                      <input
                        v-model="pin"
                        type="text"
                        class="form-control col-md-6 offset-md-3"
                        placeholder="Ingrese su PIN de vendedor aquí"
                      />
                    </div>
                  </div>
                  <br class="my-2" />
                </div>
              </tab-content>
              <tab-content
                title="Generar widget"
                :before-change="validateWidgetName"
                icon="fa fa-cloud-download"
              >
                <br class="my-2" v-if="!generated" />
                <div class="row" v-if="!generated">
                  <div class="col-12 text-center">
                    <div class="form-label-group">
                      <input
                        v-if="!generated"
                        v-model="widgetname"
                        type="text"
                        class="form-control col-md-6 offset-md-3"
                        placeholder="Ingrese un nombre para su widget"
                      />
                    </div>
                  </div>
                  <div class="col-12 text-center">
                    <div class="form-label-group">
                      <input
                        v-if="!generated"
                        v-model="url"
                        type="text"
                        class="form-control col-md-6 offset-md-3"
                        placeholder="Ingrese URL del sitio web"
                      />
                      <article class="help-block" v-if="errorUrl">
                        <i class="text-danger">{{ errorUrl }}</i>
                      </article>
                    </div>
                  </div>
                </div>
                <div class="row mt-2" v-if="generated">
                  <div class="col-12 text-center">
                    <h3>
                      <strong>Si quieres que lo instalemos por ti escríbenos a soporte@ventonic.com</strong>
                    </h3>
                    <h4>
                      Para instalar
                      <strong>Call Me</strong> debes introducir este código dentro de las etiquetas
                      <strong>body</strong> en tu página web
                    </h4>
                    <fieldset class="form-group">
                      <textarea
                        class="form-control mx-1 my-1"
                        v-model="script"
                        id="scriptText"
                        rows="7"
                        :disabled="isDisabled"
                        placeholder="Textarea"
                      ></textarea>
                    </fieldset>
                    <h4>Como segundo paso debes insertar las siguientes etiquetas en la sección de tu web donde quieras que se muestre</h4>
                    <fieldset class="form-group">
                      <textarea
                        class="form-control mx-1 my-1"
                        id="labelHtml"
                        rows="1"
                        :disabled="isDisabled"
                        placeholder="Textarea"
                      >
                      <div class="widget-vendedores" id="widget-vendedores"></div>
                      </textarea>
                    </fieldset>
                    <input type="button" value="Copiar etiqueta" @click="copyTag"
                           class="btn btn-outline-primary mr-1 mb-1 waves-effect waves-light float-right"/>
                    <input type="button" @click="copyScript" value="Copiar script"
                           class="btn btn-outline-primary mr-1 mb-1 waves-effect waves-light float-right"/>
                  </div>
                  <div class="col-12 text-center"></div>
                </div>
              </tab-content>
              <div class="row">
                <div class="col-12 text-center">
                  <div v-if="errorMsg">
                    <span style="color:rgb(255,99,71)!important;">{{ errorMsg }}</span>
                  </div>
                </div>
              </div>
            </form-wizard>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
//const widgetWizard = () =>
//  import(/* webpackChunkName: "widget-wizard" */ "./WidgetWizard.vue");
import VueFormWizard from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import Axios from "axios";
Vue.use(VueFormWizard);

export default {
  name: "FreeApp",
  components: {
    //"widget-wizard": widgetWizard,
  },
  props: ["widgets", "callme"],
  data() {
    return {
      pin: "",
      widgetname: "",
      url: "",
      script: "",
      isDisabled: true,
      errorMsg: null,
      generated: false,
      Widgets: this.widgets,
      widgetStatus: false,
      errorUrl: "",
      searchText: "",
    };
  },
  watch: {
    script: function () {
      if (this.script) {
        $(".wizard-footer-right").find(".wizard-btn").text("Cerrar");
        $(".wizard-footer-right")
          .find(".wizard-btn")
          .on("click", function (event) {
            event.preventDefault();
            $("#modalWidget").click();
            location.reload();
          });
      }
    },
    searchText: function () {
      const vm = this;
      vm.Widgets =
        vm.searchText === ""
          ? vm.widgets
          : JSON.parse(
              JSON.stringify(
                vm.widgets.filter(function (widget) {
                  return (
                    widget.name.search(vm.searchText) >= 0 ||
                    widget.url.search(vm.searchText) >= 0 ||
                    (widget.user_referred !== null &&
                      widget.user_referred.name.search(vm.searchText) >= 0)
                  );
                })
              )
            );
    },
  },
  methods: {
    widgetStatusUpdate(event, widgetID) {
      console.log(event.target.checked, widgetID);
      if (event.target.checked == true) {
        this.widgetStatus = 1;
      } else {
        this.widgetStatus = 0;
      }

      axios
        .get("updateWidgetStatus/" + widgetID + "/" + this.widgetStatus)
        .then((response) => {
          console.log(response);
        });
    },
    ShowWizard() {
      console.log("Hello World");
    },
    onComplete() {
      alert("Yay. Done!");
    },
    handleErrorMessage: function (errorMsg) {
      this.errorMsg = errorMsg;
    },
    beforeTabSwitch() {
      return new Promise((resolve, reject) => {
        const vm = this;

        if (vm.pin != "") {
          axios.get("/validate-pin/" + vm.pin).then((response) => {
            console.log(response);
            if (response.data.found == 1) {
              resolve(true);
            } else {
              reject(
                "EL PIN introducido no se corresponde con ningún vendorde de Ventonic"
              );
            }
          });
        } else {
          reject("Ingresa el PIN para continuar");
        }
      });
    },
    validateWidgetName() {
      return new Promise((resolve, reject) => {
        let op = false;
        let error = "";
        if (this.widgetname != "") {
          op = true;
        } else {
          reject("Nombre del widget requerido");
        }
        if (this.url != "") {
          op = true;
        } else {
          reject("Ingrese URL del sitio web");
        }

        if (op) {
          resolve(true);
        }
        /*
                if (this.url != "") {
                  resolve(true);
                } else {
                  if (this.widgetname != "") {

                  }
                  if (this.url != "") {
                    reject("Ingrese URL del sitio web");
                  }
                }
                */
      });
    },
    GenerateWidget() {
      const vm = this;

      axios
        .post(`/widget/generateWidget`, {
          uuid: vm.pin,
          widgetName: vm.widgetname,
          url: vm.url,
        })
        .then((response) => {
          // vm.script = JSON.stringify(response.data.script, undefined, 4);
          vm.script = response.data.script;
          vm.generated = true;
          vm.isDisabled = false;
          vm.errorUrl = "";
        })
        .catch((error) => {
          if (typeof error.response !== "undefined") {
            if (
              error.response.data.message.search(
                "Integrity constraint violation"
              ) >= 0
            ) {
              vm.errorUrl = "Ya ha registrado esta url para el mismo vendedor";
            }
          }
          //console.error(error);
        });
    },
    copyScript() {
      var copyPinText = document.getElementById("scriptText").select();
      document.execCommand("copy");
      bootbox.confirm(
        `El script ha sido copiado al portapapeles.
            Guardelo en un lugar seguro y presione el botón aceptar`,
        function (result) {
          if (result) {
            $("#modalWidget").click();
            location.reload();
          }
        }
      );
    },
    copyTag() {
      var copyTagText = document.getElementById("labelHtml").select();
      document.execCommand("copy");
      bootbox.confirm(
        `La etiqueta ha sido copiada al portapapeles. Guardela en un lugar seguro y presione el botón aceptar`,
        function (result) {
          if (result) {
            $("#modalWidget").click();
            location.reload();
          }
        }
      );
    },
  },
};
</script>
<style>
.cardModal {
  background-color: #262c49;
}

/* .wizard-icon-container{
        background-color: #7367F0;
    } */

.wizard-tab-container {
  color: whitesmoke;
}

.wizard-icon {
  color: white;
}

body .vue-form-wizard .wizard-icon-circle {
  background-color: #262c49 !important;
}

.accordion .card .card-header {
  padding: 0;
}

.accordion .card .card-header h2 button {
  color: #fff;
  width: 100%;
  display: block;
  max-width: 100%;
  padding: 15px 10px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.accordion .card .card-header h2 {
  width: 100%;
  display: block;
}

.accordion .card .card-header h2 button i {
  color: #fff;
}

.accordion > .card {
  margin: 0;
}

.card-body.us-card {
  padding: 0px 20px 20px;
}
</style>
