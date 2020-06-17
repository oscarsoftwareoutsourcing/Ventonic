<template>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="app-content-overlay"></div>
            <div class="todo-app-area">
                <div class="todo-app-list-wrapper">
                    <div class="todo-app-list">

                        <!-- search input -->
                        <div class="app-fixed-search">
                            <div class="sidebar-toggle d-block d-lg-none"><i class="feather icon-menu"></i></div>
                            <fieldset class="form-group position-relative has-icon-left m-0">
                                <input type="text" class="form-control" id="todo-search" placeholder="Buscar...">
                                <div class="form-control-position">
                                    <i class="feather icon-search"></i>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Notes list -->
                        <div class="todo-task-list list-group ps ps--active-y">
                            <ul class="todo-task-list-wrapper media-list" v-if="getTodos.length > 0">

                                <!-- Note -->
                                <li v-for="(todo, index) in getTodos" :key="index" class="todo-item" data-toggle="modal" data-target="#todoForm">
                                    <div class="todo-title-wrapper d-flex justify-content-between mb-50">
                                        <div class="todo-title-area d-flex align-items-center">

                                            <!-- Todo title -->
                                            <div class="title-wrapper d-flex">
                                                <div class="vs-checkbox-con">
                                                    <input type="checkbox">
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <h6 class="todo-title mt-50 mx-50">{{ todo.title }}</h6>
                                            </div>

                                            <!-- Todo labels -->
                                            <div class="chip-wrapper">
                                                <div class="chip mb-0">
                                                    <div class="chip-body">
                                                        <span class="chip-text" data-value="Frontend"><span class="bullet bullet-primary bullet-xs"></span> Frontend</span>
                                                    </div>
                                                </div>
                                                <div class="chip mb-0">
                                                    <div class="chip-body">
                                                        <span class="chip-text" data-value="Backend"><span class="bullet bullet-warning bullet-xs"></span> Backend</span>
                                                    </div>
                                                </div>
                                                <div class="chip mb-0">
                                                    <div class="chip-body">
                                                        <span class="chip-text" data-value="Doc"><span class="bullet bullet-success bullet-xs"></span> Doc</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="float-right todo-item-action d-flex">
                                            <a class="todo-item-info success"><i class="feather icon-info"></i></a>
                                            <a class="todo-item-favorite warning"><i class="feather icon-star"></i></a>
                                            <a class="todo-item-delete"><i class="feather icon-trash"></i></a>
                                        </div>
                                    </div>

                                    <!-- Todo description -->
                                    <p class="todo-desc truncate mb-0">{{ todo.description }}</p>
                                </li>
                            </ul>
                            <div v-else class="no-results">
                                <h5>No hay tareas</h5>
                            </div>

                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; height: 385px; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 231px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    data() {
        return {

        }
    },
    computed: {
        ...mapGetters(['getTodos', 'getLabels']),
        todoLabels(todo) {
            let todosLbs = []; // To return.
            
            // filter the labels store object to get the ones setted to this note.
            // todosLbs = this.getLabels.filter((lb) => {
            //     return lb.id === todo.
            // });

            // Devolvemos un arreglo con las
        }
    }
}
</script>

<style>

</style>