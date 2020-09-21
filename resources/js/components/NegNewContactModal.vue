<template>
  <!-- Negociacion Nuevo contacto Modal -->
  <!-- Modal -->
  <div
    class="modal fade"
    id="newContactModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="newContactModalTitle"
    aria-hidden="true"
    data-backdrop="static"
  >
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newContactModalTitle">Nuevo contacto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label for="contactType">Tipo</label>
                <select
                  class="form-control"
                  id="contactType"
                  v-model="type"
                  :class="{'is-invalid': errors.contactType}"
                >
                  <option value selected>- Ecoger un tipo -</option>
                  <option value="E">Empresa</option>
                  <option value="P">Persona</option>
                </select>
                <div class="alert alert-danger" v-if="errors.contactType">{{ errors.contactType }}</div>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-xs-12 col-sm-6">
              <div class="form-label-group">
                <input
                  type="text"
                  class="form-control"
                  id="contactName"
                  v-model="name"
                  :class="{'is-invalid': errors.name}"
                />
                <label for="contactName">Nombre</label>
                <div class="alert alert-danger" v-if="errors.name">{{ errors.name }}</div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="form-label-group">
                <input
                  type="text"
                  class="form-control"
                  id="contactLastName"
                  v-model="lastName"
                  :class="{'is-invalid': errors.lastName}"
                />
                <label for="contactLastName">Apellido</label>
                <div class="alert alert-danger" v-if="errors.lastName">{{ errors.lastName }}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light btn-close" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" @click="createContact">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      type: "",
      name: "",
      lastName: "",
      errors: {
        contactType: "",
        name: "",
        lastName: "",
      },
    };
  },
  methods: {
    resetForm: function () {
      const vm = this;
      vm.type = "";
      vm.name = "";
      vm.lastName = "";
      vm.errors.contactType = "";
      vm.errors.name = "";
      vm.errors.lastName = "";
    },
    /**
     * Crea un nuevo contacto
     *
     * @method    createContact
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     */
    createContact: function () {
      const vm = this;
      axios
        .post("/contacto/simple-save", {
          type: vm.type,
          name: vm.name,
          lastName: vm.lastName,
        })
        .then((response) => {
          if (response.data.result) {
            let contact = response.data.contact;
            $("#cboContact").append(
              `<option value="${contact.id}" selected>
                                ${contact.name} ${
                contact.last_name ? contact.last_name : ""
              }
                            </option>`
            );
            /** cierra la ventana modal */
            $("#newContactModal").find(".close").click();
          }
        })
        .catch((error) => {
          vm.errors.contactType = "";
          vm.errors.name = "";
          vm.errors.lastName = "";

          if (typeof error.response != "undefined") {
            for (var index in error.response.data.errors) {
              if (error.response.data.errors[index]) {
                vm.errors[index] = error.response.data.errors[index][0];
              }
            }
          }
        });
    },
  },
  mounted() {
    const vm = this;
    $(".close, .btn-close").on("click", function () {
      vm.resetForm();
    });
  },
};
</script>
