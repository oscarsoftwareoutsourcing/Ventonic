<template>
  <nav id="navControls" class="navbar navbar-expand-lg navbar-dark bg-primary negNavbar">
    <a class="text_ventonic-title" href="#">Negociaciones</a>

    <button
      class="navbar-toggler actionsToggler collapsed"
      type="button"
      data-toggle="collapse"
      data-target="#optionsMenu"
      aria-controls="navbarColor02"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="optionsMenu" class="navbar-collapse collapse justify-content-between">
      <ul class="navbar-nav p-1">
        <li class="nav-item">
          <button type="button" class="btn btn-primary" @click="newNegotiation">+ Nueva</button>
        </li>
      </ul>
      <ul class="navbar-nav p-1">
        <li class="nav-item">
          <button
            type="button"
            class="btn btn-dark btn btn-block waves-effect waves-light"
          >Gestionar listas</button>
        </li>
      </ul>
    </div>
  </nav>
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