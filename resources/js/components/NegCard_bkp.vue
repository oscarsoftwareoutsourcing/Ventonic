<template>
  <li @click="showDetails(negotiation)">
    <div class="neg_content">
      <!-- Card Header -->
      <div class="d-flex w-100 justify-content-between mb-1">
        <!-- Created At -->
        <div class="neg_create">
          <i v-if="isShared" class="feather icon-users text-primary mr-1" title="Compartida"></i>
          Creado el {{ createdAt }}
        </div>
        <div v-if="!isShared">
          <!-- Active negotiation actions -->
          <div v-if="isActive">
            <a title="Editar" @click.stop="editNegotiation(negotiation)">
              <i class="feather icon-edit-2 primary"></i>
            </a>
            <a title="Archivar" @click.stop="confirmArchive(negotiation)">
              <i class="fa fa-archive neg_archive"></i>
            </a>
          </div>
          <div v-else>
            <a title="Restaurar" @click.stop="confirmArchive(negotiation)">
              <i class="feather icon-arrow-up-right success"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="card_info">
        <!-- Title and contact -->
        <h5 class="mb-1 text-black">
          <strong>{{ title }} - {{ contact }}</strong>
        </h5>

        <!-- Amount -->
        <h5 class="mb-1 text-black">
          Cantidad:
          <strong>{{ importVal }}</strong>
        </h5>

        <!-- Deadline -->
        <h5 class="mb-1 text-black">
          Fecha de cierre:
          <strong>{{ deadline }}</strong>
        </h5>

        <!-- Owner -->
        <h5 v-if="isShared" class="text-primary">{{ owner }}</h5>
      </div>

      <div class="mr-auto float-right bookmark-wrapper d-flex align-items-center">
        <div class="avatar bg-danger mr-1" v-if="negotiation.status.id === 2">
          <div class="avatar-content">
            <i class="fa fa-thumbs-o-down" title="Perdida"></i>
          </div>
        </div>

        <div class="avatar bg-primary mr-1" v-if="negotiation.status.id === 3">
          <div class="avatar-content">
            <i title="En proceso" class="feather icon-loader"></i>
          </div>
        </div>

        <div class="avatar bg-success mr-1" v-if="negotiation.status.id === 1">
          <div class="avatar-content">
            <i class="fa fa-trophy" title="Ganada"></i>
          </div>
        </div>
      </div>

      <!-- Card footer -->
      <div class="d-flex justify-content-between" v-if="isActive">
        <!-- Toggle status -->
        <div class="float-left statusContainer">
          <div class="dropdown">
            <button
              v-if="negotiation.status.id === 3"
              class="btn btn-flat-primary dropdown-toggle waves-effect waves-light"
              type="button"
              @click.stop.prevent="toggleStateMenu"
            >
              En Proceso
              <i title="En proceso" class="feather icon-loader ml-1"></i>
            </button>
            <button
              v-if="negotiation.status.id === 1"
              class="btn btn-flat-success dropdown-toggle waves-effect waves-light"
              type="button"
              @click.stop.prevent="toggleStateMenu"
            >
              Ganada
              <i class="fa fa-trophy ml-1" title="Ganada"></i>
            </button>
            <button
              v-if="negotiation.status.id === 2"
              class="btn btn-flat-danger dropdown-toggle waves-effect waves-light"
              type="button"
              @click.stop.prevent="toggleStateMenu"
            >
              Perdida
              <i class="fa fa-thumbs-o-down ml-1" title="Perdida"></i>
            </button>
            <div
              class="dropdown-menu"
              x-placement="bottom-start"
              style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -105px, 0px);"
            >
              <a
                @click.stop.prevent="changeState(negotiation.id, 3)"
                v-if="negotiation.status.id !== 3"
                class="dropdown-item text-primary"
                title="En proceso"
              >
                Cambiar a En Proceso
                <i class="feather icon-loader text-primary ml-2"></i>
              </a>
              <a
                @click.stop.prevent="changeState(negotiation.id, 1)"
                v-if="negotiation.status.id !== 1"
                class="dropdown-item text-success"
                title="Ganada"
              >
                Cambiar a Ganada
                <i class="fa fa-trophy text-success ml-2"></i>
              </a>
              <a
                @click.stop.prevent="changeState(negotiation.id, 2)"
                v-if="negotiation.status.id !== 2"
                class="dropdown-item text-danger"
                title="Perdida"
              >
                Cambiar a Perdida
                <i class="fa fa-thumbs-o-down text-danger ml-2"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Add extra data menu -->
        <!--<div class="float-right">
        <div class="dropdown">
          <button
            type="button"
            class="btn btn-flat-dark dropdown-toggle waves-effect waves-light"
            @click.stop.prevent="toggleAddMenu"
          >Agregar</button>
          <div
            class="dropdown-menu"
            x-placement="bottom-start"
            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -140px, 0px);"
          >
            <a class="dropdown-item" @click.stop.prevent>
              <i class="feather icon-check-square text-primary"></i> Nota
            </a>
            <a class="dropdown-item" @click.stop.prevent>
              <i class="feather icon-calendar text-primary"></i> Evento
            </a>
            <a class="dropdown-item" @click.stop.prevent>
              <i class="fa fa-files-o text-primary"></i> Archivo
            </a>
          </div>
        </div>
        </div>-->
      </div>
    </div>
    <div class="neg_foot bg-gradient-primary" v-if="negotiation.status.id === 3"></div>
    <div class="neg_foot bg-gradient-danger" v-if="negotiation.status.id === 2"></div>
    <div class="neg_foot bg-gradient-success" v-if="negotiation.status.id === 1"></div>
  </li>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from "vuex";
export default {
  props: ["negotiation"],
  methods: {
    ...mapActions(["changeToList", "changeStatus"]),
    ...mapMutations({
      toggleForm: "TOGGLE_FORM",
      toggleLists: "TOGGLE_LISTS",
      toggleConfirm: "TOGGLE_CONFIRM",
      setNegotiation: "SET_NEGOTIATION",
      setNegotiationGroups: "SET_NEGOTIATION_GROUPS",
      toggleDetails: "TOGGLE_DETAILS",
      setDetailedNeg: "SET_DETAILED_NEG",
    }),
    formatDate(d) {
      return d.getDate() + "/" + d.getMonth() + "/" + d.getFullYear();
    },
    showDetails(negotiation) {
      // Set negotiation object to render on the view.
      this.setDetailedNeg(negotiation);
      if (negotiation.groups.length > 0) {
        this.setNegotiationGroups(negotiation.groups);
      }
      this.toggleLists();
      this.toggleDetails();
    },
    editNegotiation(neg) {
      this.setNegotiation(neg);
      if (neg.groups.length > 0) {
        this.setNegotiationGroups(neg.groups);
      }
      this.toggleLists();
      this.toggleForm();
    },
    confirmArchive(neg) {
      this.setNegotiation(neg);
      this.toggleConfirm();
    },
    toggleAddMenu(event) {
      let element = event.target;
      element.parentElement.classList.toggle("show");
      element.nextElementSibling.classList.toggle("show");
    },
    toggleStateMenu(event) {
      let element = event.target;
      element.parentElement.classList.toggle("show");
      element.nextElementSibling.classList.toggle("show");
    },
    async changeState(negId, state) {
      let values = {
        id: negId,
        stateId: state,
      };
      await this.changeStatus(values);
      document
        .querySelector(".statusContainer div.dropdown.show")
        .classList.remove("show");
      document
        .querySelector(".statusContainer div.dropdown-menu.show")
        .classList.remove("show");
    },
  },
  computed: {
    ...mapGetters(["getUserId"]),
    isShared() {
      return this.negotiation.owner.id !== this.getUserId ? true : false;
    },
    createdAt() {
      //return this.formatDate(this.negotiation.created_at);
      return this.shortDateFormat(this.negotiation.created_at, "/");
    },
    isActive() {
      return this.negotiation.active;
    },
    title() {
      return this.negotiation.title;
    },
    contact() {
      if (this.negotiation.contact.last_name !== null) {
        return (
          this.negotiation.contact.name +
          " " +
          this.negotiation.contact.last_name
        );
      } else {
        return this.negotiation.contact.name;
      }
    },
    importVal() {
      return new Intl.NumberFormat("de-ES", {
        style: "currency",
        currency: "EUR",
      }).format(this.negotiation.amount);
    },
    deadline() {
      return this.negotiation.deadline !== null
        ? this.shortDateFormat(this.negotiation.deadline, "/")
        : "N/A";
    },
    owner() {
      if (this.negotiation.owner.last_name !== null) {
        return (
          this.negotiation.owner.name + " " + this.negotiation.owner.last_name
        );
      } else {
        return this.negotiation.owner.name;
      }
    },
  },
};
</script>

<style>
</style>
