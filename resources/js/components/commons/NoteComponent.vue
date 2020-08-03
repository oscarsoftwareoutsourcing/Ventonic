<template>
    <div>
        <div class="form-group">
            <label for="note">Nota</label>
            <textarea rows="4" class="form-control" id="note"
                      placeholder="Agregar una nota" v-model="note"></textarea>
            <!-- Validation messages -->
            <article class="help-block" v-if="noteError">
                <i class="text-danger">{{ noteError }}</i>
            </article>
        </div>
        <div class="form-group" v-if="showButtonSave">
            <button type="button" class="btn btn-primary" @click="setNote">
                Guardar
            </button>
        </div>
        <div class="form-group" v-if="showList">
            <hr>
            <div id="accordionNote" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingAccordionNote">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="panel-title text-left">
                                    <a data-toggle="collapse" data-parent="#accordionNote" href="#collapseAccordionNote" aria-expanded="true" aria-controls="collapseAccordionNote">
                                        Vista detallada
                                    </a>
                                </h6>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="panel-title text-right">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-cogs"></i> Más opciones
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div id="collapseAccordionNote"
                         class="panel-collapse collapse in float-none collapse show"
                         role="tabpanel" aria-labelledby="headingAccordionNote">
                        <div class="media-list media-bordered">
                            <div class="media" v-for="n in notes">
                                <a class="align-self-start media-left" href="#">
                                    <img :src="(n.user.photo)?n.user.photo:'/images/anonymous-user.png'" alt="user avatar" width="64" height="64">
                                </a>
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        {{ n.user.name }} {{ n.user.last_name }} -
                                        {{ n.created_at }}
                                    </h5>
                                    <p class="mb-0">
                                        {{ n.description }}
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
    export default {
        data() {
            return {
                note: '',
                noteError: '',
                notes: [],
            }
        },
        props: {
            modelRelationId: {
                type: Number,
                required: true
            },
            modelRelationClass: {
                type: String,
                required: true
            },
            showButtonSave: {
                type: Boolean,
                required: false,
                default: true
            },
            showList: {
                type: Boolean,
                required: false,
                default: true
            }
        },
        methods: {
            setNote() {
                const vm = this;

                axios.post('/components/set-note', {
                    description: vm.note,
                    modelRelationId: vm.modelRelationId,
                    modelRelationClass: vm.modelRelationClass
                }).then(response => {
                    if (response.data.result) {
                        vm.note = '';
                        vm.noteError = '';
                        vm.getNotes();
                    }
                    vm.success = response.data.result;
                }).catch(error => {
                    vm.success = false;
                    if (typeof(error.response) !="undefined") {
                        for (var index in error.response.data.errors) {
                            if (error.response.data.errors[index]) {
                                vm.noteError = error.response.data.errors[index][0];
                            }
                        }
                    }
                });
            },
            getNotes() {
                const vm = this;
                axios.get(`/components/get-notes/${vm.modelRelationClass}/${vm.modelRelationId}`).then(response => {
                    if (response.data.result) {
                        vm.notes = response.data.notes;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
        },
        mounted() {
            this.getNotes();
        }
    };
</script>

