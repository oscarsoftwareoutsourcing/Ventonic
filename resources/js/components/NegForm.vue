<template>
  <div>
    <div class="card">
      <div class="bg-gradient-primary">
        <div class="card_vetonic-description">
          <div class="text_vetonic-description1">{{ negId ? 'Actualizar' : 'Nueva'}} Negociación</div>
        </div>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form class="form form-horizontal" data-bitwarden-watching="1">
            <div class="form-body">
              <div class="row">
                <!-- Status -->
                <template v-if="negId !== null">
                  <div class="col-lg-6">
                    <div class="form-group row">
                      <div class="col-md-3">
                        <span>Estado:</span>
                      </div>
                      <div class="col-md-9">
                        <select
                          name="cboNegStatus"
                          id="cboNegStatus"
                          class="form-control"
                          v-model="negStatusId"
                        >
                          <option
                            v-for="(status, index) in getStatuses"
                            :key="index"
                            :value="status.id"
                          >{{ status.status }}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </template>

                <!-- Type -->
                <div class="col-lg-6">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <span>Tipo</span>
                    </div>
                    <div class="col-md-9">
                      <select
                        name="cboNegType"
                        id="cboNegType"
                        class="form-control"
                        v-model="negTypeId"
                      >
                        <option :value="null">- Ecoger un tipo -</option>
                        <option
                          v-for="(type, index) in getTypes"
                          :key="index"
                          :value="type.id"
                        >{{ type.type }}</option>
                      </select>

                      <!-- Validation messages -->
                      <article class="help-block" v-if="$v.negTypeId.$error">
                        <i class="text-danger">Dato requerido</i>
                      </article>
                    </div>
                  </div>
                </div>

                <!-- Process -->
                <div class="col-lg-6">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <span>Proceso:</span>
                    </div>
                    <div class="col-md-9">
                      <select
                        name="cboProcess"
                        id="cboProcess"
                        class="form-control"
                        v-model="negProcessId"
                      >
                        <option :value="null">- Ecoger un proceso -</option>
                        <option
                          v-for="(process, index) in getProcesses"
                          :key="index"
                          :value="process.id"
                        >{{ process.title }}</option>
                      </select>

                      <!-- Validation messages -->
                      <article class="help-block" v-if="$v.negProcessId.$error">
                        <i class="text-danger">Dato requerido</i>
                      </article>
                    </div>
                  </div>
                </div>

                <!-- Contact -->
                <div class="col-lg-6">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <span>Contacto:</span>
                    </div>
                    <div class="col-md-9">
                      <select
                        name="cboContact"
                        id="cboContact"
                        class="form-control"
                        v-model="contactId"
                      >
                        <option value="null">- Ecoger un contacto -</option>
                        <option value="new">- Crear nuevo contacto -</option>
                        <option
                          v-for="(contact, index) in getContacts"
                          :key="index"
                          :value="contact.id"
                        >{{ getName(contact) }}</option>
                      </select>
                      <button type="button" class="btn btn-primary btn-new-contact" data-toggle="modal"
                              data-target="#newContactModal" style="display:none">nuevo contacto</button>
                      <negotiation-new-contact-modal></negotiation-new-contact-modal>
                      <!-- Validation messages -->
                      <article class="help-block" v-if="$v.contactId.$error">
                        <i class="text-danger">Dato requerido</i>
                      </article>
                    </div>
                  </div>
                </div>

                <!-- Deadline -->
                <div class="col-lg-6">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <span>Fecha de cierre:</span>
                    </div>
                    <div class="col-md-9">
                      <datepicker
                        :bootstrap-styling="true"
                        :language="es"
                        :highlighted="highlighted"
                        :disabled-dates="disabledDates"
                        v-model="deadline"
                        placeholder="Escoger una fecha"
                        :format="format"
                      ></datepicker>
                    </div>
                  </div>
                </div>

                <!-- Title -->
                <div class="col-lg-6">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <span>Título:</span>
                    </div>
                    <div class="col-md-9">
                      <input
                        type="text"
                        name="txtTitle"
                        id="txtTitle"
                        placeholder="Título de la negociación"
                        class="form-control"
                        v-model="title"
                      />

                      <!-- Validation messages -->
                      <article class="help-block" v-if="$v.title.$error">
                        <i class="text-danger">Dato requerido</i>
                      </article>
                    </div>
                  </div>
                </div>

                <!-- Description -->
                <div class="col-lg-6">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <span>Descripción:</span>
                    </div>
                    <div class="col-md-9">
                      <textarea
                        name="txaDescription"
                        id="txaDescription"
                        placeholder="Descripción de la negociación"
                        class="form-control"
                        v-model="description"
                      ></textarea>

                      <!-- Validation messages -->
                      <article class="help-block" v-if="$v.description.$error">
                        <i class="text-danger">Dato requerido</i>
                      </article>
                    </div>
                  </div>
                </div>

                <!-- Amount -->
                <div class="col-lg-6">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <span>Importe:</span>
                    </div>
                    <div class="col-md-9">
                      <input
                        name="txtAmount"
                        id="txtAmount"
                        type="text"
                        placeholder="Importe"
                        class="form-control"
                        v-model="amount"
                      />

                      <!-- Validation messages -->
                      <article class="help-block" v-if="$v.amount.$error">
                        <i class="text-danger" v-if="!$v.amount.required">Dato requerido</i>
                        <i class="text-danger" v-if="!$v.amount.decimal">Importe inválido</i>
                      </article>
                    </div>
                  </div>
                </div>

                <!-- Groups -->
                <div class="col-lg-6">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <span>Grupos:</span>
                    </div>
                    <div class="col-md-9">
                      <ul class="list-unstyled mb-1">
                        <li class="d-inline-block mr-2">
                          <fieldset>
                            <div class="custom-control custom-radio">
                              <input
                                type="radio"
                                class="custom-control-input"
                                name="rdoSharedNeg"
                                id="rdoNotShared"
                                v-model="isShared"
                                :value="false"
                                @click="resetGroupIds"
                              />
                              <label class="custom-control-label" for="rdoNotShared">Sólo para mí</label>
                            </div>
                          </fieldset>
                        </li>
                        <li class="d-inline-block mr-2">
                          <fieldset>
                            <div class="custom-control custom-radio">
                              <input
                                type="radio"
                                class="custom-control-input"
                                name="rdoSharedNeg"
                                id="rdoShared"
                                v-model="isShared"
                                :value="true"
                              />
                              <label class="custom-control-label" for="rdoShared">Compartida</label>
                            </div>
                          </fieldset>
                        </li>
                        <li
                          class="d-inline-block mr-2"
                          v-if="isShared && groupIds.length < getUserGroups.length"
                        >
                          <button
                            type="button"
                            class="btn btn-icon btn-success waves-effect waves-light"
                            @click="addGroup"
                          >
                            <i class="fa fa-plus mr-1"></i>Agregar
                          </button>
                        </li>
                      </ul>

                      <div v-if="isShared">
                        <div
                          class="form-group row mb-1"
                          v-for="(gi, index) in groupIds"
                          :key="index"
                        >
                          <select
                            name="cboGroups"
                            class="form-control col-10"
                            v-model="groupIds[index].id"
                          >
                            <option :value="null">- Ecoger un contacto -</option>
                            <option
                              v-for="(group, index) in getUserGroups"
                              :key="index"
                              :value="group.id"
                            >{{ group.name }}</option>
                          </select>
                          <button
                            v-if="groupIds.length > 1"
                            type="button"
                            class="btn btn-danger ml-1 col-1"
                            @click="removeGroup(index)"
                          >
                            <i class="fa fa-minus" style="margin: 0px -5px;"></i>
                          </button>

                          <!-- Validation messages -->
                          <article
                            class="help-block row no-gutters"
                            v-if="$v.groupIds.$each[index].$error"
                          >
                            <i
                              class="text-danger col-12"
                              v-if="!$v.groupIds.$each[index].id.required"
                            >Dato requerido</i>
                            <i
                              class="text-danger col-12"
                              v-if="!$v.groupIds.$each[index].id.isDuplicate"
                            >Valor duplicado</i>
                          </article>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Commissions -->
                <div class="col-lg-6">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <span>Comisión:</span>
                    </div>
                    <div class="col-md-5">
                      <input
                        name="txtCommission"
                        id="txtCommission"
                        type="number" step="0.01"
                        placeholder="Comisión"
                        class="form-control"
                        v-model="commission_amount"
                      />

                      <!-- Validation messages -->
                      <article class="help-block" v-if="$v.commission_amount.$error">
                        <i class="text-danger" v-if="!$v.commission_amount.required">Dato requerido</i>
                        <i class="text-danger" v-if="!$v.commission_amount.decimal">Comisión inválida</i>
                      </article>
                    </div>
                    <div class="col-md-4">
                        <select id="cboNegCommissionType" name="cboNegCommissionType" class="form-control"
                                v-model="commission_type">
                          <option value="">- Tipo comisión -</option>
                          <option value="P">Porcentaje</option>
                          <option value="M">Monto</option>
                        </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Buttons -->
    <div class="card-footer text-center">
      <button
        type="button"
        class="btn bg-gradient-primary waves-effect waves-light mr-1 btn-lg"
        @click="check()"
        :disabled="isDisabled"
      >Guardar</button>
      <button
        v-if="negId !== null"
        type="button"
        class="btn bg-gradient-warning waves-effect waves-light mr-1 btn-lg"
        @click.stop="archiveModal()"
      >Archivar</button>
      <button
        type="button"
        class="btn bg-gradient-dark waves-effect waves-light btn-lg"
        @click="eraseData()"
        :disabled="isDisabled"
      >Cancelar</button>
    </div>
  </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import { es } from "vuejs-datepicker/dist/locale";
import { mapGetters, mapMutations, mapActions } from "vuex";
import { required, decimal, not, sameAs } from "vuelidate/lib/validators";

export default {
  components: {
    Datepicker,
  },
  data() {
    return {
      isDisabled: false,
      isShared: false,
      groupIds: [{ id: null }],
      es: es,
      format: "dd-MM-yyyy",
      highlighted: {
        dates: [new Date()],
      },
      disabledDates: {
        to: new Date(),
      },
    };
  },
  mounted() {
    if (this.getNegotiation.groups.length > 0) {
      this.isShared = true;
      this.groupIds = [];
      this.getNegotiation.groups.forEach((g) => {
        this.getUserGroups.forEach((ug) => {
          if (g === ug.id) {
            this.groupIds.push({ id: g });
          }
        });
      });
    }
  },
  validations() {
    let rules = {
      negTypeId: {
        required,
      },
      negProcessId: {
        required,
      },
      contactId: {
        required,
      },
      title: {
        required,
      },
      description: {
        required,
      },
      amount: {
        required,
        decimal,
      },
      commission_amount: {
        decimal,
      },
    };

    if (this.isShared) {
      rules.groupIds = {
        $each: {
          id: {
            required,
            isDuplicate: (value) => {
              let passed = true;

              let seen = this.groupIds.filter((gi) => gi.id === value);

              if (seen.length > 1) {
                passed = false;
              }
              return passed;
            },
          },
        },
      };
    }

    return rules;
  },
  watch: {
    contactId: function() {
        if (this.contactId === 'new') {
             $('.btn-new-contact').click();
        }
    }
  },
  methods: {
    ...mapMutations({
      resetNeg: "RESET_NEGOTIATION",
      toggleForm: "TOGGLE_FORM",
      toggleLists: "TOGGLE_LISTS",
      toggleConfirm: "TOGGLE_CONFIRM",
      setNegotiation: "SET_NEGOTIATION",
      setNegotiationGroups: "SET_NEGOTIATION_GROUPS",
    }),
    ...mapActions(["saveNeg", "toggleActivation"]),
    addGroup() {
      this.groupIds.push({ id: null });
    },
    removeGroup(index) {
      this.groupIds.splice(index, 1);
    },
    setGroup(index, value) {
      this.groupIds[index].id = value;
    },
    resetGroupIds() {
      this.groupIds = [{ id: null }];
      this.setNegotiationGroups([]);
    },
    async check() {
      if (!this.$v.$invalid) {
        if (this.isShared) {
          this.setNegotiationGroups(this.groupIds);
        } else {
          this.resetGroupIds();
        }

        this.isDisabled = !this.isDisabled;

        // Send data
        await this.saveNeg();
        this.isDisabled = !this.isDisabled;
        this.eraseData();
      } else {
        this.$v.$touch();
      }
    },
    archiveModal() {
      this.toggleConfirm();
    },
    getName(contact) {
      if (contact.last_name !== null) {
        return contact.name + " " + contact.last_name;
      } else {
        return contact.name;
      }
    },
    eraseData() {
      this.toggleForm();
      this.toggleLists();
      this.resetNeg();
      this.$v.$reset();
    }
  },
  computed: {
    ...mapGetters([
      "getContacts",
      "getStatuses",
      "getTypes",
      "getProcesses",
      "getNegotiation",
      "getShowModal",
      "getUserGroups",
    ]),
    negOperation() {
      return this.getNegotiation.id === null
        ? "Nueva Negociación"
        : "Actualizar Negociación";
    },
    negId() {
      return this.getNegotiation.id;
    },
    negActive() {
      return this.getNegotiation.active;
    },
    negTypeId: {
      get() {
        return this.getNegotiation.neg_type_id;
      },
      set(val) {
        this.getNegotiation.neg_type_id = val;
      },
    },
    negStatusId: {
      get() {
        return this.getNegotiation.neg_status_id;
      },
      set(val) {
        this.getNegotiation.neg_status_id = val;
      },
    },
    negProcessId: {
      get() {
        return this.getNegotiation.neg_process_id;
      },
      set(val) {
        this.getNegotiation.neg_process_id = val;
      },
    },
    contactId: {
      get() {
        return this.getNegotiation.contact_id;
      },
      set(val) {
        this.getNegotiation.contact_id = val;
      },
    },
    title: {
      get() {
        return this.getNegotiation.title;
      },
      set(val) {
        this.getNegotiation.title = val;
      },
    },
    description: {
      get() {
        return this.getNegotiation.description;
      },
      set(val) {
        this.getNegotiation.description = val;
      },
    },
    amount: {
      get() {
        return this.getNegotiation.amount.toString().replace(".", ",");
      },
      set(val) {
        this.getNegotiation.amount = val;
      },
    },
    commission_type: {
      get() {
        return this.getNegotiation.commission_type;
      },
      set(val) {
        this.getNegotiation.commission_type = val;
      },
    },
    commission_amount: {
      get() {
        return (typeof(this.getNegotiation.commission_amount) !== "undefined")
               ? this.getNegotiation.commission_amount.toString().replace(".", ",") : 0;
      },
      set(val) {
        this.getNegotiation.commission_amount = val;
      },
    },
    deadline: {
      get() {
        return this.getNegotiation.deadline;
      },
      set(val) {
        this.getNegotiation.deadline = val;
      },
    },
    negGroups: {
      get() {
        return this.getNegotiation.groups;
      },
      set(val) {
        this.getNegotiation.groups = val;
      },
    },
  },
};
</script>
