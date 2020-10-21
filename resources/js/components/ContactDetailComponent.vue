<template>
  <div>
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <!--<span class="float-left">
                <h5 class="mb-2 card-title">Datos Generales</h5>
              </span>-->
              <div class="float-right mr-auto bookmark-wrapper d-flex align-items-center">
                <ul class="m-0 list-inline">
                  <!--<li class="list-inline-item">
                                    <a @click="editContact()">
                                        <i class="feather icon-edit controls"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item controls">
                                    <a @click="deleteContact">
                                        <i class="feather icon-trash-2 controls"></i>
                                    </a>
                  </li>-->
                  <li class="list-inline-item controls">
                    <a @click="goBack()">
                      <i class="feather icon-arrow-left controls"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-2">
              <div class="mr-1 avatar avatar-xxl">
                <img :src="picture" alt="imagen de perfil" class="img-fluid" />
                <span class="avatar-status-info" v-if="contact.allow_change_image">
                  <input type="file" id="contactPicture" class="d-none" @change="setPicture" />
                  <a href="javascript:void(0)" @click="selectPicture">
                    <i class="feather icon-search"></i>
                  </a>
                  <!--<div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-warning btn-sm dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            id="btnManagePhoto">
                                        <i class="feather icon-search"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnManagePhoto">
                                        <a class="dropdown-item" href="javascript:void(0)" @click="selectPicture">Cambiar imagen</a>
                                        <a class="dropdown-item" href="javascript:void(0)" @click="removePicture">Eliminar imagen</a>
                                    </div>
                  </div>-->
                </span>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="mb-1 form-row">
                <div class="col-12">
                  <span
                    class="capitalize font-weight-bold text-display-5"
                  >{{ contact.name }} {{ contact.last_name }}</span>
                  <a
                    href="javascript:void(0)"
                    @click="editContact()"
                    data-toggle="tooltip"
                    title="Modificar contacto"
                  >
                    <i class="ml-2 feather icon-edit-2 font-medium-4"></i>
                  </a>
                </div>
              </div>
              <!--<div class="mb-1 form-row">
                            <div class="col-12">{{ contact.address }}</div>
              </div>-->
              <div class="mb-1 form-row">
                <div class="col-12">
                  <a :href="'mailto:'+contact.user.email">{{ contact.user.email }}</a>
                </div>
              </div>
              <!--
                        <div class="mb-1 form-row">
                            <div class="col-sm-4">
                                <label for="" class="label-font">Chat</label>
                            </div>
                            <div class="col-sm-8">
                                <button type="button"
                                        class="mb-1 mr-1 btn btn-icon rounded-circle btn-warning waves-effect waves-light">
                                    <i class="feather icon-mail"></i>
                                </button>
                            </div>
                        </div>
              -->
            </div>
            <div class="col-sm-5">
              <div class="mb-1 form-row">
                <div class="col-12">
                  <label class="label-font" for>Fecha de Registro:</label>
                  <span>{{ getCreatedAt() }}</span>
                </div>
              </div>
              <div class="mb-1 form-row">
                <div class="col-12">
                  <label class="label-font" for>Dirección:</label>
                  <span>{{ contact.address }}</span>
                </div>
              </div>
              <div class="mb-1 form-row">
                <div class="col-12">
                  <a
                    href="javascript:void(0)"
                    @click="viewMap()"
                    data-toggle="modal"
                    data-target="#modalMap"
                  >Ver mapa</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
      <li class="nav-item">
        <a
          class="nav-link active nav-component"
          id="profile-tab-justified"
          data-toggle="tab"
          href="#profile-just"
          role="tab"
          aria-controls="profile-just"
          aria-selected="false"
        >Actividades</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link nav-component"
          id="messages-tab-justified"
          data-toggle="tab"
          href="#messages-just"
          role="tab"
          aria-controls="messages-just"
          aria-selected="false"
        >Eventos</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link nav-component"
          id="settings-tab-justified"
          data-toggle="tab"
          href="#settings-just"
          role="tab"
          aria-controls="settings-just"
          aria-selected="false"
        >Documentos</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link nav-component"
          id="home-tab-justified"
          data-toggle="tab"
          href="#home-just"
          role="tab"
          aria-controls="home-just"
          aria-selected="true"
        >Correos</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link nav-component"
          id="calls-tab-justified"
          data-toggle="tab"
          href="#calls-just"
          role="tab"
          aria-controls="calls-just"
          aria-selected="true"
        >Llamadas</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link nav-component"
          id="tasks-tab-justified"
          data-toggle="tab"
          href="#tasks-just"
          role="tab"
          aria-controls="tasks-just"
          aria-selected="true"
        >Tareas</a>
      </li>
    </ul>
    <!-- Tab panes -->

    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <div class="pt-1 tab-content">
            <div
              class="pb-3 tab-pane active"
              id="profile-just"
              role="tabpanel"
              aria-labelledby="profile-tab-justified"
            >
              <!-- Notas -->
              <note
                ref="contactNote"
                :model-relation-id="contact.id"
                model-relation-class="contact"
              ></note>
            </div>
            <div
              class="pb-3 tab-pane"
              id="messages-just"
              aria-labelledby="messages-tab-justified"
              role="tabpanel"
            >
              <!-- Evento -->
              <event
                ref="contactEvent"
                :model-relation-id="contact.id"
                model-relation-class="contact"
              ></event>
            </div>
            <div
              class="pb-3 tab-pane"
              id="settings-just"
              aria-labelledby="settings-tab-justified"
              role="tabpanel"
            >
              <!-- Documentos -->
              <media-file
                ref="contactDocument"
                :model-relation-id="contact.id"
                model-relation-class="contact"
              ></media-file>
            </div>
            <div
              class="pb-3 tab-pane"
              id="home-just"
              aria-labelledby="home-tab-justified"
              role="tabpanel"
            >
              <!-- Correos -->
              <email-app
                ref="contactEmail"
                :default-email="contact.email"
                :model-relation-id="contact.id"
                model-relation-class="contact"
              ></email-app>
            </div>
            <div
              class="pb-3 tab-pane"
              id="calls-just"
              aria-labelledby="calls-tab-justified"
              role="tabpanel"
            >
              <!-- Llamadas -->
              <call-event
                ref="contactCalls"
                :model-relation-id="contact.id"
                model-relation-class="contact"
              ></call-event>
            </div>
            <div
              class="pb-3 tab-pane"
              id="tasks-just"
              aria-labelledby="tasks-tab-justified"
              role="tabpanel"
            >
              <!-- Llamadas -->
              <task
                ref="contactTasks"
                :model-relation-id="contact.id"
                model-relation-class="contact"
              ></task>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalMap">
          <div class="modal-dialog modal-lg" role="dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Mapa</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <span>{{ contact.address }}</span>
                </div>
                <div id="address-map-container" style="width:100%;height:400px; ">
                  <div style="width: 100%; height: 100%" id="address-map"></div>
                </div>
                <div
                  class="mt-2 form-group font-weight-bold"
                  v-if="distance"
                  style="font-size:1.8rem"
                >
                  <span class="mr-2">{{ distance.toFixed(2) }} Km</span>
                  <a :href="linkGmap" style="font-size:1rem" target="_blank">Ver en GoogleMaps</a>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      picture: "",
    };
  },
  props: {
    contact: {
      type: Object,
      required: true,
    },
    urlList: {
      type: String,
      required: false,
      default: "",
    },
  },
  methods: {
    showImage() {
      const vm = this;
      return vm.contact.image
        ? `${vm.contact.image.indexOf("http") < 0 ? "/" : ""}${
            vm.contact.image
          }`
        : "/images/anonymous-user.png";
    },
    getStatus() {
      return this.contact.favorite === 1
        ? '<i class="ficon feather icon-star warning"></i>'
        : "";
    },
    getRol() {
      return this.contact.type_contact === "empresa"
        ? ' <i class="fa fa-building-o text-primary"></i> Empresa'
        : '<i class="fa fa-male text-primary"></i> Vendedor';
    },
    getCreatedAt() {
      return this.shortDateFormat(this.contact.created_at);
    },
    goBack() {
      if (!this.urlList) {
        return history.go(-1);
      }
      location.href = this.urlList;
    },
    viewMap() {
      const vm = this;
      //popup con  las coredenadas del mapa
      vm.initializeMap(
        "address-map-container",
        vm.contact.address,
        vm.contact.address_latitude,
        vm.contact.address_longitude,
        true
      );
    },

    editContact() {
      //window.location.href = "contacto/editar/" + this.contact.id;
      window.location = "/contacto/editar/" + this.contact.id;
    },
    /**
     * Elimina el contacto
     *
     */
    deleteContact() {
      const vm = this;
      bootbox.confirm({
        size: "small",
        title: "Eliminar contacto",
        message:
          "Está a punto de eliminar este contacto ¿Esta seguro de continuar?",
        callback: function (result) {
          if (result) {
            axios
              .delete(`/contacto/${vm.contact.id}/delete`)
              .then((response) => {
                if (response.data.result) {
                  window.location = response.data.route;
                } else {
                  toastr.warning(response.data.message, "Error!");
                }
              })
              .catch((error) => {
                console.errro(error);
              });
          }
        },
      });
    },
    /**
     * Muestra la ventana de dialogo para seleccionar la imagen
     *
     */
    selectPicture() {
      $("#contactPicture").click();
    },
    /**
     * Establece la imagen seleccionada
     *
     */
    setPicture() {
      const vm = this;
      var formData = new FormData();
      var picture = document.querySelector(`#contactPicture`);
      formData.append("picture", picture.files[0]);
      formData.append("contact_id", vm.contact.id);
      axios
        .post("/contacto/change-picture", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          if (response.data.result) {
            vm.picture = `${
              response.data.picture.indexOf("http") < 0 ? "/" : ""
            }${response.data.picture}`;
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
    /**
     * Elimina la imagen actual
     *
     */
    removePicture() {
      const vm = this;
      axios
        .post("/contacto/remove-picture", {
          contact_id: vm.contact.id,
        })
        .then((response) => {
          if (response.data.result) {
            vm.picture = `/${response.data.picture}`;
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
  created() {
    this.picture = this.showImage();
  },
};
</script>
