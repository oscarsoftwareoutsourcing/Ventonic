<template>
    <div class="modal fade text-left show" id="negForm" tabindex="-1" role="dialog" style="display: block;" v-if="getShowModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">{{ negOperation }}</h4>
                    <button type="button" class="close" @click="eraseData()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <!-- Form -->
                <form action="#" data-bitwarden-watching="1">

                    <div class="modal-body">

                        <!-- Status -->
                        <template v-if="negId !== null">
                            <label for="">Estado:</label>
                            <div class="form-group">
                                <select name="cboNegStatus" id="cboNegStatus" class="form-control" v-model="negStatusId">
                                    <option v-for="(status, index) in getStatuses" :key="index" :value="status.id">{{ status.status }}</option>
                                </select>
                            </div>
                        </template>

                        <!-- Type -->
                        <label for="">Tipo:</label>
                        <div class="form-group">
                            <select name="cboNegType" id="cboNegType" class="form-control" v-model="negTypeId">
                                <option :value="null">- Ecoger un tipo -</option>
                                <option v-for="(type, index) in getTypes" :key="index" :value="type.id">{{ type.type }}</option>
                            </select>

                            <!-- Validation messages -->
                            <article class="help-block" v-if="$v.negTypeId.$error">
                                <i class="text-danger">Dato requerido</i>
                            </article>
                        </div>

                        <!-- Process -->
                        <label for="">Proceso:</label>
                        <div class="form-group">
                            <select name="cboProcess" id="cboProcess" class="form-control" v-model="negProcessId">
                                <option :value="null">- Ecoger un proceso -</option>
                                <option v-for="(process, index) in getProcesses" :key="index" :value="process.id">{{ process.title }}</option>
                            </select>
                            
                            <!-- Validation messages -->
                            <article class="help-block" v-if="$v.negProcessId.$error">
                                <i class="text-danger">Dato requerido</i>
                            </article>
                        </div>

                        <!-- Contact -->
                        <label for="">Contacto:</label>
                        <div class="form-group">
                            <select name="cboContact" id="cboContact" class="form-control" v-model="contactId">
                                <option :value="null">- Ecoger un contacto -</option>
                                <option v-for="(contact, index) in getContacts" :key="index" :value="contact.id">{{ getName(contact) }}</option>
                            </select>
                            
                            <!-- Validation messages -->
                            <article class="help-block" v-if="$v.contactId.$error">
                                <i class="text-danger">Dato requerido</i>
                            </article>
                        </div>

                        <!-- Deadline -->
                        <label>Fecha de cierre:</label>
                        <div class="form-group">
                            <datepicker :bootstrap-styling="true" :language="es" :highlighted="highlighted" :disabled-dates="disabledDates" v-model="deadline" placeholder="Escoger una fecha" :format="format">
                            </datepicker>
                        </div>

                        <!-- Title -->
                        <label>Título:</label>
                        <div class="form-group">
                            <input type="text" name="txtTitle" id="txtTitle" placeholder="Título de la negociación" class="form-control" v-model="title">
                            
                            <!-- Validation messages -->
                            <article class="help-block" v-if="$v.title.$error">
                                <i class="text-danger">Dato requerido</i>
                            </article>
                        </div>

                        <!-- Description -->
                        <label>Descripción:</label>
                        <div class="form-group">
                            <textarea name="txaDescription" id="txaDescription" placeholder="Descripción de la negociación" class="form-control" v-model="description"></textarea>
                            
                            <!-- Validation messages -->
                            <article class="help-block" v-if="$v.description.$error">
                                <i class="text-danger">Dato requerido</i>
                            </article>
                        </div>

                        <!-- Amount -->
                        <label>Importe:</label>
                        <div class="form-group">
                            <input name="txtAmount" id="txtAmount" type="text" placeholder="Monto" class="form-control" v-model="amount">
                            
                            <!-- Validation messages -->
                            <article class="help-block" v-if="$v.amount.$error">
                                <i class="text-danger" v-if="!$v.amount.required">Dato requerido</i>
                                <i class="text-danger" v-if="!$v.amount.decimal">Importe inválido</i>
                            </article>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect waves-light" @click="check()" :disabled="isDisabled">Guardar</button>
                        <button v-if="negId !== null" type="button" class="btn btn-warning waves-effect waves-light" @click.stop="archiveModal()">Archivar</button>
                        <button type="button" class="btn btn-light waves-effect waves-light" @click="eraseData()">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {es} from 'vuejs-datepicker/dist/locale'
import { required, decimal } from 'vuelidate/lib/validators';
import { mapGetters, mapMutations, mapActions } from 'vuex';
export default {
    components: {
        Datepicker
    },
    data() {
        return {
            isDisabled: false,
            es: es,
            today: new Date(),
            format: 'dd-MM-yyyy',
            highlighted: {
                dates: [new Date()]
            },
            disabledDates: {
                to: new Date()
            }
        }
    },
    validations: {
        negTypeId: {
            required
        },
        negProcessId: {
            required
        },
        contactId: {
            required
        },
        title: {
            required
        },
        description: {
            required
        },
        amount: {
            required,
            decimal
        }
    },
    methods: {
        ...mapMutations({
            resetNeg: 'RESET_NEGOTIATION',
            toggleModal: 'TOGGLE_MODAL',
            toggleConfirm: 'TOGGLE_CONFIRM',
            setNegotiation: 'SET_NEGOTIATION'
        }),
        ...mapActions(['saveNeg', 'toggleActivation']),
        async check() {
            if (!this.$v.$invalid) {

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
            if(contact.last_name !== null) {
                return contact.name + ' ' + contact.last_name;
            } else {
                return contact.name;
            }
        },
        eraseData() {
            this.toggleModal();
            this.resetNeg();
            this.$v.$reset();
        }
    },
    computed: {
        ...mapGetters(['getContacts', 'getStatuses', 'getTypes', 'getProcesses', 'getNegotiation', 'getShowModal']),
        negOperation() {
            return (this.getNegotiation.id === null) ? 'Nueva Negociación' : 'Actualizar Negociación';
        },
        negId() {
            return this.getNegotiation.id;
        },
        negActive() {
            return this.getNegotiation.active;
        },
        negTypeId: {
            get() { return this.getNegotiation.neg_type_id; },
            set(val) { this.getNegotiation.neg_type_id = val; }
        },
        negStatusId: {
            get() { return this.getNegotiation.neg_status_id; },
            set(val) { this.getNegotiation.neg_status_id = val; }
        },
        negProcessId: {
            get() { return this.getNegotiation.neg_process_id; },
            set(val) { this.getNegotiation.neg_process_id = val; }
        },
        contactId: {
            get() { return this.getNegotiation.contact_id; },
            set(val) { this.getNegotiation.contact_id = val; }
        },
        title: {
            get() { return this.getNegotiation.title; },
            set(val) { this.getNegotiation.title = val; }
        },
        description: {
            get() { return this.getNegotiation.description; },
            set(val) { this.getNegotiation.description = val; }
        },
        amount: {
            get() {
                return ((this.getNegotiation.amount).toString()).replace(".", ",");
            },
            set(val) { this.getNegotiation.amount = val; }
        },
        deadline: {
            get() {
                return this.getNegotiation.deadline;
            },
            set(val) { this.getNegotiation.deadline = val; }
        },
    }
}
</script>

<style>
    .vdp-datepicker__calendar {
        position: absolute !important;
        z-index: 100 !important;
        background: #262C49 !important;
        width: 300px !important;
        border: 1px solid #ccc !important;
    }

    .vdp-datepicker__calendar .cell.highlighted {
        background: #10163A !important;
    }

    .vdp-datepicker__calendar header .up:not(.disabled):hover {
        background: transparent !important;
    }
</style>