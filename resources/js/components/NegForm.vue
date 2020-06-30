<template>
    <div class="modal fade text-left" id="negForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">{{ negOperation }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="eraseData()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <!-- Form -->
                <form action="#" data-bitwarden-watching="1">

                    <div class="modal-body">

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
                        <label>Monto:</label>
                        <div class="form-group">
                            <input name="txtAmount" id="txtAmount" type="text" placeholder="Monto" class="form-control" v-model="amount">
                            
                            <!-- Validation messages -->
                            <article class="help-block" v-if="$v.amount.$error">
                                <i class="text-danger">Dato requerido</i>
                            </article>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect waves-light" @click="check()">Guardar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-danger waves-effect waves-light" @click="eraseData()">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { required } from 'vuelidate/lib/validators';
import { mapGetters, mapMutations, mapActions } from 'vuex';
export default {
    data() {
        return {
            isDisabled: false,
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
            required
        }
    },
    methods: {
        ...mapMutations({
            resetNeg: 'RESET_NEGOTIATION'
        }),
        ...mapActions(['saveNeg']),
        async check() {
            if (!this.$v.$invalid) {

                this.isDisabled = !this.isDisabled;

                // Send data
                await this.saveNeg();
                // this.isDisabled = !this.isDisabled;
                this.eraseData();
            } else {
                this.$v.$touch();
            }
        },
        getName(contact) {
            if(contact.last_name !== null) {
                return contact.name + ' ' + contact.last_name;
            } else {
                return contact.name;
            }
        },
        eraseData() {
            this.resetNeg();
            this.$v.$reset();
        }
    },
    computed: {
        ...mapGetters(['getContacts', 'getTypes', 'getProcesses', 'getNegotiation']),
        negOperation() {
            return (this.getNegotiation.id === null) ? 'Nueva Negociación' : 'Actualizar Negociación';
        },
        negTypeId: {
            get() { return this.getNegotiation.negTypeId; },
            set(val) { this.getNegotiation.negTypeId = val; }
        },
        negProcessId: {
            get() { return this.getNegotiation.negProcessId; },
            set(val) { this.getNegotiation.negProcessId = val; }
        },
        contactId: {
            get() { return this.getNegotiation.contactId; },
            set(val) { this.getNegotiation.contactId = val; }
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
            get() { return this.getNegotiation.amount; },
            set(val) { this.getNegotiation.amount = val; }
        },
    }
}
</script>

<style>

</style>