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
      </div>
    </div>

    <div class="widgets">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12" v-for="widget in widgets">
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
                            :data-target="
                                                            '#collapseThree' +
                                                                widget.id
                                                        "
                            aria-expanded="false"
                            aria-controls="collapseThree"
                          >
                            <div>
                              <h5>{{ widget.name }}</h5>
                              <br />
                              {{ widget.url }}
                            </div>

                            <span>
                              <i class="feather icon-chevron-down" aria-hidden="true"></i>
                            </span>
                          </button>
                        </h2>
                      </div>
                      <div
                        :id="
                        'collapseThree' + widget.id
                        "
                        class="collapse"
                        aria-labelledby="headingThree"
                        data-parent="#accordionExample"
                      >
                        <div class="card-body">
                          <fieldset class="form-group">
                            <textarea class="form-control" id="basicTextarea" rows="10" disabled>
                        <!--Start of Ventonic.com Script-->
                                        <script type="text/javascript">
                                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                                        (function(){
                                        var
                                        s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                                        s1.async=true;
                                        s1.src="https://app.ventonic.com/{{
                                                                widget.token
                                                            }}/default";
                                        s1.charset="UTF-8";
                                        s1.setAttribute("crossorigin","*");
                                        s0.parentNode.insertBefore(s1,s0);
                                        })();
                                        </script>
                                        <!--End of Ventonic.com Script-->
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
                          @change="
                              widgetStatusUpdate(
                                            $event,
                                            widget.id
                                )
                              "
                        />
                        <label class="custom-control-label" :for="widget.id"></label>
                        <span class="switch-label">Active</span>
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
              <h4 class="card-title">{{ callme.name }}</h4>
            </div>
            <div class="card-content p-2">
              <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
                <div v-html="callme.iframe"></div>
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                <br class="my-2" />
                <div class="row">
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
                    </div>
                  </div>
                </div>

                <div class="row mt-2" v-if="generated">
                  <div class="col-12 text-center">
                    <fieldset class="form-group">
                      <textarea
                        class="form-control mx-1 my-1"
                        v-model="script"
                        id="basicTextarea"
                        rows="10"
                        :disabled="isDisabled"
                        placeholder="Textarea"
                      ></textarea>
                    </fieldset>
                  </div>
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
    };
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
        })
        .catch((error) => {
          console.error(error);
        });
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
