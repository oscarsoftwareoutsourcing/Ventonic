<template>
    <div class="sidebar">
        <div class="sidebar-content todo-sidebar d-flex">

            <!-- Close icon for mobile -->
            <span class="sidebar-close-icon">
                <i class="feather icon-x"></i>
            </span>

            <!-- Notes menu -->
            <div class="todo-app-menu">

                <!-- Add task button -->
                <div class="form-group text-center add-task">
                    <button type="button" class="btn btn-primary btn-block my-1 waves-effect waves-light" data-toggle="modal" data-target="#taskModal">Nueva Nota</button>
                </div>

                <!-- Task filters -->
                <perfect-scrollbar class="sidebar-menu-list" ref="scrollbar">

                    <!-- All-filter -->
                    <div class="list-group list-group-filters font-medium-1">
                        <a href="#" class="list-group-item list-group-item-action border-0 pt-0" :class="{'active':getFilters.all}" @click.stop="toggleFilter('all')">
                            <i class="font-medium-5 feather icon-mail mr-50"></i> Todas
                        </a>
                    </div>
                    <hr>

                    <!-- Other-filters (module_labels) -->
                    <h5 class="mt-2 mb-1 pt-25">Filtros</h5>
                    <div class="list-group list-group-filters font-medium-1">
                        <a href="#" class="list-group-item list-group-item-action border-0" :class="{'active':getFilters.starred}" @click.stop="toggleFilter('starred')"><i class="font-medium-5 feather icon-star mr-50"></i> Principal</a>
                        <a href="#" class="list-group-item list-group-item-action border-0" :class="{'active':getFilters.important}" @click.stop="toggleFilter('important')"><i class="font-medium-5 feather icon-info mr-50"></i> Importantes</a>
                        <a href="#" class="list-group-item list-group-item-action border-0" :class="{'active':getFilters.completed}" @click.stop="toggleFilter('completed')"><i class="font-medium-5 feather icon-check mr-50"></i> Completadas</a>
                        <a href="#" id="todoDescartadas" class="list-group-item list-group-item-action border-0" :class="{'active':getFilters.trashed}" @click.stop="toggleFilter('trashed')"><i class="font-medium-5 feather icon-trash mr-50"></i> Descartadas</a>
                    </div>
                    <hr>

                    <!-- Labels (custom labels) -->
                    <h5 class="mt-2 mb-1 pt-25">Etiquetas</h5>
                    <div class="list-group list-group-labels font-medium-1">
                        <a href="#" class="list-group-item list-group-item-action border-0 d-flex align-items-center" v-for="(label) in getLabels" :key="label.id"><span class="bullet bullet-primary mr-1"></span> {{ label.label }}</a>
                    </div>
                </perfect-scrollbar>
            </div>
        </div>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex';
export default {
    methods: {
        ...mapMutations(['TOGGLE_FILTER', 'FILTER_COPY']),
        toggleFilter(filter) {
            this.TOGGLE_FILTER(filter);
            this.FILTER_COPY();
        }
    },
    computed: {
        ...mapGetters(['getLabels', 'getFilters'])
    }
}
</script>

<style>

</style>
