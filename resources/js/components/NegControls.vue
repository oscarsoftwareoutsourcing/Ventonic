<template>
  <div>
    <div class="row">
      <div class="new-header mb-0">
        <span class="title">Negociaciones</span>
        <button
          type="button"
          class="btn bg-gradient-primary mr-1 mb-1 waves-effect waves-light"
          @click="newNegotiation"
        >+ Nueva</button>
        <div class="mr-auto float-right bookmark-wrapper d-flex align-items-center">
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
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
export default {
  methods: {
    ...mapMutations({
      toggleForm: "TOGGLE_FORM",
      toggleLists: "TOGGLE_LISTS",
    }),
    newNegotiation() {
      this.toggleLists();
      this.toggleForm();
    },
    openFilter: function () {
      $(".customizer").toggleClass("open");
    },
  },
};
</script>

<style>
.negNavbar {
  background-color: #10163a !important;
  border-radius: 5px !important;
}

.negNavbar .navbar-brand {
  color: #0087ff !important;
}

.actionsToggler {
  padding: 0 !important;
  font-size: 1.3rem !important;
  border: 0px !important;
}
</style>