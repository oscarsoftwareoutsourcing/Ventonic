<template>
  <!-- Negociacion Nuevo contacto Modal -->
  <div
    id="archiveModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myModalLabel120"
    aria-modal="true"
    class="modal fade text-left show"
    style="display: block;"
  >
    <div
      role="document"
      class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xs"
    >
      <div class="modal-content">
        <div class="modal-header bg-gradient-primary white">
          <h5 id="myModalLabel120" class="modal-title">Nuevo Contacto</h5>
          <button
            @click.stop="cancelArchive"
            type="button"
            data-dismiss="modal"
            aria-label="Close"
            class="close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Está seguro de {{ (getNegotiation.active) ? 'archivar' : 'restaurar' }} esta negociación?</p>
        </div>
        <div class="modal-footer">
          <button
            @click.stop="toggleArchive"
            type="button"
            id="confirmDelete"
            class="btn bg-gradient-primary waves-effect waves-light"
            :disabled="isDisabled"
          >Guardar</button>
          <button
            @click.stop="cancelArchive"
            type="button"
            data-dismiss="modal"
            class="btn btn-success waves-effect waves-light"
            :disabled="isDisabled"
          >Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</template>