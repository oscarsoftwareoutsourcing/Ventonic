<template>
    <!-- <div class="custom-modal show" :class="modal ? 'hidden-custom': ''"> -->
    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
            <div class="modal-content">
                <section class="todo-form">
                    <form id="form-edit-todo" class="todo-input" v-on:submit.prevent="check" novalidate>
                        
                        <!-- Modal header -->
                        <div class="modal-header">

                            <!-- Title -->
                            <h5 class="modal-title" id="opTodoTask">Tarea</h5>
                            <button :disabled="isDisabled" type="button" class="close" data-dismiss="modal" aria-label="Close" @click="eraseData()">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <!-- Filters & labels select row -->
                            <div class="todo-item-action ml-auto">
                                <a @click="toggleImportant()" class="todo-item-info"><i class="feather icon-info" v-bind:class="{'success':important}"></i></a>
                                <a @click="toggleStarred()" class="todo-item-favorite"><i class="feather icon-star" v-bind:class="{'warning':starred}"></i></a>
                                
                                <!-- Labels dropdown -->
                                <div class="dropdown todo-item-label">
                                    <i class="dropdown-toggle mr-0 mb-1 feather icon-tag" id="todoEditLabel" data-toggle="dropdown">
                                    </i>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="todoEditLabel">
                                        <div class="dropdown-item" v-for="(label, index) in getLabels" :key="index">
                                            <div class="vs-checkbox-con">
                                                <input type="checkbox" data-color="primary" v-model="getTodo.labels" :value="label.id">
                                                <span class="vs-checkbox">
                                                    <span class="vs-checkbox--check">
                                                        <i class="vs-icon feather icon-check mr-0"></i>
                                                    </span>
                                                </span>
                                                <span>{{ label.label }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Todo title -->
                            <fieldset class="form-group error">
                                <input type="text" class="edit-todo-item-title form-control" v-model="title" placeholder="Título">
                                
                                <!-- Validation messages -->
                                <article class="help-block" v-if="$v.title.$error">
                                    <i class="text-danger">Dato requerido</i>
                                </article>
                            </fieldset>

                            <!-- Description title -->
                            <fieldset class="form-group">
                                <textarea class="edit-todo-item-desc form-control" rows="3" v-model="description" placeholder="Descripción"></textarea>

                                <!-- Validation messages -->
                                <article class="help-block" v-if="$v.description.$error">
                                    <i class="text-danger">Dato requerido</i>
                                </article>
                            </fieldset>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">

                            <!-- Submit -->
                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <button :disabled="isDisabled" type="submit" class="btn btn-primary update-todo-item waves-effect waves-light"><i class="feather icon-edit d-block d-lg-none"></i>
                                    <span class="d-none d-lg-block">{{ (isDisabled) ? 'Guardando...' : 'Guardar'}}</span>
                                </button>
                            </fieldset>

                            <!-- Cancel -->
                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <button :disabled="isDisabled" type="button" class="btn btn-outline-light waves-effect waves-light" data-toggle="modal" data-target="#taskModal" @click="eraseData()">
                                    <i class="feather icon-x d-block d-lg-none"></i>
                                    <span class="d-none d-lg-block">Cancelar</span>
                                </button>
                            </fieldset>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
import { mapGetters, mapActions, mapMutations } from 'vuex';
import axios from 'axios';

export default {
    data() {
        return {
            isDisabled: false,
            modal: true
        }
    },
    validations: {
        title: {
            required
        },
        description: {
            required
        }
    },
    methods: {
        ...mapActions(['saveTodo']),
        ...mapMutations({
            resetTodo: 'RESET_TODO',
            setTodo:'SET_TODO_INDEX',
            toggleStarred:'TOGGLE_STARRED',
            toggleImportant:'TOGGLE_IMPORTANT',
        }),
        async check() {
            if (!this.$v.$invalid) {

                this.isDisabled = !this.isDisabled;

                // Send data
                await this.saveTodo();
                this.isDisabled = !this.isDisabled;
                this.eraseData();
            } else {
                this.$v.$touch();
            }
        },
        eraseData() {
            this.title = '';
            this.description = '';
            this.$v.$reset();
        }
    },
    computed: {
        ...mapGetters(['getLabels', 'getTodo']),
        important() { return this.getTodo.filters.important; },
        starred() { return this.getTodo.filters.starred; },
        title: {
            get() { return this.getTodo.title; },
            set(val) { this.getTodo.title = val; }
        },
        description: {
            get() { return this.getTodo.description; },
            set(val) { this.getTodo.description = val; }
        }
    }
}
</script>

<style lang="scss">
    // .custom-modal {
    //     position: fixed;
    //     top: 50%;
    //     left: 50%;
    //     z-index: 1050;
    //     display: block;
    //     width: 100vh;
    //     height: 500px;
    //     overflow: hidden;
    //     outline: 0;
    //     transition: transform .5s ease;
    //     // z-index: 99999;
    //     transform: translate(-50%,-50%);
    //     .hidden-custom{
    //         transform: translate(-200vh, -50%);
    //     }
    // }

    // .custom-backdrop {
    //     position: fixed;
    //     top: 50%;
    //     left: 50%;
    //     z-index: 1050;
    //     display: block;
    //     width: 100vw;
    //     height: 100vh;
    //     overflow: hidden;
    //     outline: 0;
    //     transition: transform .5s ease;
    //     z-index: 99999;
    //     transform: translate(-50%,-50%);
    //     background-color: rgba(black, .5);
    //     .hidden-custom{
    //         transform: translate(-200vh, -50%);
    //     }
    // }
</style>