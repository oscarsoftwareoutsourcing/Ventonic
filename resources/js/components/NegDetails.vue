<template>
  <div class="row">
    <div class="col-sm-12 col-lg-8">
      <div class="card overflow-hidden">
        <!--<div class="header_ventonic-description">
                    <div class="card_vetonic-description">
                        <div class="text_vetonic-description">
                            Gestión de Negociación
                        </div>
                    </div>
        </div>-->
        <!-- Negotiation title with contact -->
        <div class="card-header header-ventonic-blue mb-2">
          <h4>{{ title }} con {{ contact }}</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="alert alert-success alert-dismissible" role="alert" v-if="success">
              <p class="mb-0">Registro almacenado correctamente</p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <!-- Responsable -->
            <p>
              <b>Responsable:</b>
              {{ owner }}
            </p>

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
            <div class="tab-content pt-1">
              <div
                class="tab-pane pb-3 active"
                id="profile-just"
                role="tabpanel"
                aria-labelledby="profile-tab-justified"
              >
                <!-- Notas -->
                <note
                  ref="negotiationNote"
                  :model-relation-id="getDetailedNeg.id"
                  model-relation-class="negotiation"
                ></note>
              </div>
              <div
                class="tab-pane pb-3"
                id="messages-just"
                aria-labelledby="messages-tab-justified"
                role="tabpanel"
              >
                <!-- Evento -->
                <event
                  ref="negotiationEvent"
                  :model-relation-id="getDetailedNeg.id"
                  model-relation-class="negotiation"
                ></event>
              </div>
              <div
                class="tab-pane pb-3"
                id="settings-just"
                aria-labelledby="settings-tab-justified"
                role="tabpanel"
              >
                <!-- Documentos -->
                <media-file
                  ref="negotiationDocument"
                  :model-relation-id="getDetailedNeg.id"
                  model-relation-class="negotiation"
                ></media-file>
              </div>
              <div
                class="tab-pane pb-3"
                id="home-just"
                aria-labelledby="home-tab-justified"
                role="tabpanel"
              >
                <!-- Correos -->
                <email-app
                  ref="negotiationEmail"
                  :model-relation-id="getDetailedNeg.id"
                  model-relation-class="negotiation"
                ></email-app>
              </div>
              <div
                class="tab-pane pb-3"
                id="calls-just"
                aria-labelledby="calls-tab-justified"
                role="tabpanel"
              >
                <!-- Llamadas -->
                <call-event
                  ref="negotiationCalls"
                  :model-relation-id="getDetailedNeg.id"
                  model-relation-class="negotiation"
                ></call-event>
              </div>
              <div
                class="tab-pane pb-3"
                id="tasks-just"
                aria-labelledby="tasks-tab-justified"
                role="tabpanel"
              >
                <!-- Llamadas -->
                <task
                  ref="negotiationTasks"
                  :model-relation-id="getDetailedNeg.id"
                  model-relation-class="negotiation"
                ></task>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Information -->
    <div class="col-sm-12 col-lg-4">
      <div class="card">
        <div class="card-header header-ventonic-blue mb-2">
          <h4>Acerca de la negociación</h4>
          <!-- <i class="feather icon-more-horizontal cursor-pointer"></i> -->
        </div>
        <div class="card-body">
          <!-- Description -->
          <p>{{ description }}</p>
          <hr />
          <!-- Status -->
          <div class="mt-1">
            <strong>Estado:</strong>
            <span v-if="status.id === 3" class="text-primary">
              En Proceso
              <i title="En proceso" class="feather icon-loader ml-1"></i>
            </span>
            <span v-if="status.id === 1" class="text-success">
              Ganada
              <i class="fa fa-trophy ml-1" title="Ganada"></i>
            </span>
            <span v-if="status.id === 2" class="text-danger">
              Perdida
              <i class="fa fa-thumbs-o-down ml-1" title="Perdida"></i>
            </span>
            <hr />
          </div>

          <!-- Shared with -->
          <div class="mt-1" v-if="isShared">
            <h6 class="mb-0">Compartida con:</h6>
            <ul>
              <li v-for="(group, index) in negGroups" :key="index">{{ group.name }}</li>
            </ul>
            <hr />
          </div>

          <!-- Amount -->
          <div class="mt-1">
            <strong>Importe:</strong>
            <span>{{ amount }}</span>
            <hr />
          </div>

          <!-- Deadline -->
          <div class="mt-1">
            <strong>Fecha de cierre:</strong>
            <span>{{ deadline }}</span>
            <hr />
          </div>

          <!-- Created at -->
          <div class="mt-1">
            <strong>Creada el:</strong>
            <span>{{ createdAt }}</span>
            <hr />
          </div>

          <!-- Last update -->
          <div class="mt-1">
            <strong>Actualizado el:</strong>
            <span>{{ updatedAt }}</span>
          </div>
        </div>
        <div class="card-footer">
          <button
            type="button"
            class="btn btn-primary btn btn-block waves-effect waves-light"
            @click="returnList"
          >Volver</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";

export default {
  data() {
    return {
      negGroups: [],
      success: false,
    };
  },
  mounted() {
    if (this.getDetailedNeg.groups.length > 0) {
      this.getDetailedNeg.groups.forEach((g) => {
        this.getUserGroups.forEach((ug) => {
          if (g === ug.id) {
            this.negGroups.push(ug);
          }
        });
      });
    }
  },
  methods: {
    ...mapMutations({
      setNegotiationGroups: "SET_NEGOTIATION_GROUPS",
      setDetailedNeg: "SET_DETAILED_NEG",
      toggleLists: "TOGGLE_LISTS",
      toggleDetails: "TOGGLE_DETAILS",
    }),
    formatImp(i) {
      return new Intl.NumberFormat("de-ES", {
        style: "currency",
        currency: "EUR",
      }).format(i);
    },
    formatDate(d) {
      return (
        d.getDate() +
        " de " +
        new Intl.DateTimeFormat("es-ES", { month: "long" }).format(d) +
        " del " +
        d.getFullYear()
      );
    },
    returnList() {
      this.setNegotiationGroups(null);
      this.setDetailedNeg(null);
      this.toggleLists();
      this.toggleDetails();
    },
  },
  computed: {
    ...mapGetters([
      "getNegotiation",
      "getNegotiations",
      "getDetailedNeg",
      "getUserGroups",
    ]),
    title() {
      return this.getDetailedNeg.title;
    },
    contact() {
      if (this.getDetailedNeg.contact.last_name !== null) {
        return (
          this.getDetailedNeg.contact.name +
          " " +
          this.getDetailedNeg.contact.last_name
        );
      } else {
        return this.getDetailedNeg.contact.name;
      }
    },
    owner() {
      if (this.getDetailedNeg.owner.last_name !== null) {
        return (
          this.getDetailedNeg.owner.name +
          " " +
          this.getDetailedNeg.owner.last_name
        );
      } else {
        return this.getDetailedNeg.owner.name;
      }
    },
    status() {
      return this.getDetailedNeg.status;
    },
    description() {
      return this.getDetailedNeg.description;
    },
    isShared() {
      return this.getDetailedNeg.extras.sharedWith.length > 0 ? true : false;
    },
    amount() {
      return this.formatImp(this.getDetailedNeg.amount);
    },
    deadline() {
      return this.getDetailedNeg.deadline !== null
        ? this.formatDate(this.getDetailedNeg.deadline)
        : "N/A";
    },
    createdAt() {
      return this.formatDate(this.getDetailedNeg.created_at);
    },
    updatedAt() {
      return this.getDetailedNeg.updated_at !== null
        ? this.formatDate(this.getDetailedNeg.updated_at)
        : "No se ha actualizado";
    },
  },
};
</script>
