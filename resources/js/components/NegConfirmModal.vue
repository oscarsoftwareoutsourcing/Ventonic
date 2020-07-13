<template>
    <!-- Archive Confirm Modal -->
    <div id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-modal="true" class="modal fade text-left show" style="display: block;">
        <div role="document" class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xs">
            <div class="modal-content">
                <div class="modal-header bg-danger white">
                    <h5 id="myModalLabel120" class="modal-title">¡Alerta!</h5>
                    <button @click.stop="cancelArchive" type="button" data-dismiss="modal" aria-label="Close" class="close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de {{ (getNegotiation.active) ? 'archivar' : 'restaurar' }} esta negociación?</p>
                </div>
                <div class="modal-footer">
                    <button @click.stop="toggleArchive" type="button" id="confirmDelete" class="btn btn-danger waves-effect waves-light" :disabled="isDisabled">Sí</button>
                    <button @click.stop="cancelArchive" type="button" data-dismiss="modal" class="btn btn-success waves-effect waves-light" :disabled="isDisabled">No</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapMutations, mapActions, mapGetters } from 'vuex';
export default {
    data() {
        return {
            isDisabled: false,
        }
    },
    methods: {
        ...mapMutations({
            resetNeg: 'RESET_NEGOTIATION',
            toggleLists: 'TOGGLE_LISTS',
            toggleForm: 'TOGGLE_FORM',
            toggleConfirm: 'TOGGLE_CONFIRM'
        }),
        ...mapActions(['toggleActivation']),
        async toggleArchive() {
            this.isDisabled = true;
            await this.toggleActivation();
            this.cancelArchive();
        },
        cancelArchive() {
            if(!this.getShowForm) {
                this.toggleConfirm();
                this.resetNeg();
            } else if(this.getShowDetails) {
                console.log('ENTRÉ!');
                this.toggleConfirm();
            } else {
                this.toggleForm();
                this.toggleLists();
                this.resetNeg();
            }
        }
    },
    computed: {
        ...mapGetters(['getShowForm', 'getShowConfirm', 'getShowDetails', 'getNegotiation']),
    }
}
</script>

<style>

</style>