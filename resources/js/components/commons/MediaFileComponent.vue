<template>
  <div>
    <div class="form-group">
        <div class="alert alert-success alert-dismissible" role="alert" v-if="success">
            <p class="mb-0">Registro almacenado correctamente</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </div>
    <div class="form-group" v-if="showNote">
      <label for="documentNote">Nota</label>
      <textarea
        rows="4"
        class="form-control"
        id="documentNote"
        placeholder="Agregar una nota"
        v-model="documentNote"
      ></textarea>
      <!-- Validation messages -->
      <article class="help-block" v-if="documentNoteError">
        <i class="text-danger">{{ documentNoteError }}</i>
      </article>
    </div>
    <div class="form-group">
      <vue-dropzone
        ref="documentDropzone"
        id="dropzoneDocuments"
        :options="dropzoneOptions"
        @vdropzone-sending="dropzoneSendingEvent"
        @vdropzone-success="dropzoneSuccessEvent"
        @vdropzone-removed-file="dropzoneRemovedEvent"
      ></vue-dropzone>
      <!-- Validation messages -->
      <article class="help-block" v-if="documentError">
        <i class="text-danger">{{ documentError }}</i>
      </article>
    </div>
    <div class="form-group" v-if="showButtonSave">
      <button type="button" class="btn btn-primary" @click="setFile">Guardar</button>
    </div>
    <div class="form-group" v-if="showList">
      <hr />
      <div id="accordionDocument" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingAccordionDocument">
            <div class="row">
              <div class="col-sm-6">
                <h6 class="panel-title text-left">
                  <a
                    data-toggle="collapse"
                    data-parent="#accordionDocument"
                    href="#collapseAccordionDocument"
                    aria-expanded="true"
                    aria-controls="collapseAccordionDocument"
                  >Vista detallada</a>
                </h6>
              </div>
              <!--<div class="col-sm-6">
                <h6 class="panel-title text-right">
                  <a href="javascript:void(0)">
                    <i class="fa fa-cogs"></i> Más opciones
                  </a>
                </h6>
              </div>-->
            </div>
          </div>
          <div
            id="collapseAccordionDocument"
            class="panel-collapse collapse in float-none collapse show"
            role="tabpanel"
            aria-labelledby="headingAccordionDocument"
          >
            <div class="media-list media-bordered">
              <div class="media" v-for="d in documents">
                <div class="media-body">
                  <!--<h5 class="media-heading">
                                        {{ n.user.name }} {{ n.user.last_name }} -
                                        {{ n.created_at }}
                  </h5>-->
                  <p class="mb-0">{{ d.note }}</p>
                  <p class="mb-0">
                    <a :href="d.url">{{ getFileName(d.file) }}</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
  components: {
    vueDropzone: vue2Dropzone,
  },
  data() {
    return {
        success: false,
      documentNote: "",
      documentFiles: [],
      documents: [],
      documentNoteError: "",
      documentError: "",
      dropzoneOptions: {
        url: "/components/upload-documents",
        //thumbnailWidth: 100,
        addRemoveLinks: true,
        maxFilesize: 10,
        dictDefaultMessage: "Arrastra tus archivos aquí",
        //dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>UPLOAD ME",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      },
    };
  },
  props: {
    modelRelationId: {
      type: Number,
      required: true,
    },
    modelRelationClass: {
      type: String,
      required: true,
    },
    disk: {
      type: String,
      required: false,
      default: "documents",
    },
    showNote: {
      type: Boolean,
      required: false,
      default: true,
    },
    showButtonSave: {
      type: Boolean,
      required: false,
      default: true,
    },
    showList: {
      type: Boolean,
      required: false,
      default: true,
    },
  },
  methods: {
    setFile() {
      const vm = this;
      vm.documentNoteError = "";
      vm.documentError = "";

      axios
        .post("/components/set-document", {
          note: vm.documentNote,
          documents: vm.documentFiles,
          modelRelationId: vm.modelRelationId,
          modelRelationClass: vm.modelRelationClass,
        })
        .then((response) => {
          if (response.data.result) {
            vm.documentNote = "";
            vm.documentFiles = [];
            vm.$refs.documentDropzone.removeAllFiles();
            vm.getFiles();
          }
          vm.success = response.data.result;
        })
        .catch((error) => {
          vm.success = false;
          if (typeof error.response != "undefined") {
            if (typeof error.response.data.errors.note !== "undefined") {
              vm.documentNoteError = error.response.data.errors.note[0];
            }
            if (typeof error.response.data.errors.documents !== "undefined") {
              vm.documentError = error.response.data.errors.documents[0];
            }
          }
        });
    },
    getFiles() {
      const vm = this;
      axios
        .get(
          `/components/get-documents/${vm.modelRelationClass}/${vm.modelRelationId}`
        )
        .then((response) => {
          if (response.data.result) {
            vm.documents = response.data.documents;
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
    dropzoneSendingEvent(file, xhr, formData) {
      //Instruccioines a ejecutar para cuando se estan enviando los archivos
    },
    /**
     * Evento que se genera después de una carga correcta de documentos
     *
     *
     * @param     {object}                file        Objeto con información del archivo
     * @param     {object}                response    Objeto con información de respuesta
     */
    dropzoneSuccessEvent(file, response) {
      const vm = this;
      if (response.result) {
        vm.documentFiles.push({
            name: file.name,
            path: response.document_path,
            url: response.document_url,
        });
      }
    },
    /**
     * Evento que se ejecuta cuando un archivo es eliminado
     *
     *
     * @param     {string}                file     Nombre del archivo a eliminar
     * @param     {string}                error    Mensaje de error
     * @param     {object}                xhr      Objeto con información de la petición
     */
    dropzoneRemovedEvent(file, error, xhr) {
        const vm = this;
        axios.post('/components/delete-document', {
            file: file.name
        }).then(response => {
            if (response.data.result) {
                vm.documentFiles = JSON.parse(JSON.stringify(vm.documentFiles.filter(function(f) {
                    return f.name !== file.name;
                })));
            }
        }).catch(error => {
            console.error(error);
        })
    }
  },
  mounted() {
    this.getFiles();
  },
};
</script>
