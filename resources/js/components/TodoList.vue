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
                        <perfect-scrollbar class="todo-task-list list-group" ref="scrollbar">
                            <ul class="todo-task-list-wrapper media-list" v-if="getTodosCopy.length > 0">

                                <!-- Note -->
                                <li v-for="(todo, i) in getTodosCopy" :key="i" class="todo-item" v-bind:class="{'completed':todo.filters.completed}" data-toggle="modal" data-target="#todoForm">
                                    <div class="todo-title-wrapper d-flex justify-content-between mb-50">
                                        <div class="todo-title-area d-flex align-items-center">

                                            <!-- Todo title -->
                                            <div class="title-wrapper d-flex">
                                                <div class="vs-checkbox-con">
                                                    <input @click="toggleCompleted(i)" type="checkbox" v-model="todo.filters.completed">
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
                                                <div class="chip mb-0" v-for="(label, j) in todo.labels" :key="j">
                                                    <div class="chip-body">
                                                        <span class="chip-text" data-value="Frontend"><span class="bullet bullet-primary bullet-xs"></span> {{ printLabel(label) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="float-right todo-item-action d-flex">
                                            <a class="todo-item-info" @click="toggleImportant(i)"><i class="feather icon-info" :class="todo.filters.important ? 'success' : ''"></i></a>
                                            <a class="todo-item-favorite" @click="toggleStarred(i)"><i class="feather icon-star" :class="todo.filters.starred ? 'warning' : ''"></i></a>
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
                        </perfect-scrollbar>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    data() {
        return {
        }
    },
    methods: {
        ...mapActions(['updateTodos']),
        async toggleCompleted(index) {
            this.getTodosCopy[index].filters.completed = !this.getTodosCopy[index].filters.completed;
            await this.updateTodos(this.getTodosCopy);
        },
        async toggleImportant(index) {
            this.getTodosCopy[index].filters.important = !this.getTodosCopy[index].filters.important;
            await this.updateTodos(this.getTodosCopy);
        },
        async toggleStarred(index) {
            this.getTodosCopy[index].filters.starred = !this.getTodosCopy[index].filters.starred;
            await this.updateTodos(this.getTodosCopy);
        },
        printLabel(label) {
            let data = this.getLabels.filter( l => l.id === label );
            return data[0].label;
        }
    },
    computed: {
        ...mapGetters(['getTodosCopy', 'getLabels']),
    }
}
</script>

<style>

</style>