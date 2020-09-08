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
    </div>

    <div class="float-right neg_status">
      <div class="avatar bg-danger mr-1" v-if="negotiation.status.id === 2">
        <div class="avatar-content">
          <i class="fa fa-thumbs-o-down" title="Perdida"></i>
        </div>
      </div>

      <div class="avatar bg-warning mr-1" v-if="negotiation.status.id === 3">
        <div class="avatar-content">
          <i title="En proceso" class="fa fa-history"></i>
        </div>
      </div>

      <div class="avatar bg-success mr-1" v-if="negotiation.status.id === 1">
        <div class="avatar-content">
          <i class="fa fa-trophy" title="Exitosa"></i>
        </div>
      </div>
    </div>
    <div class="neg_foot bg-gradient-warning" v-if="negotiation.status.id === 3"></div>
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
