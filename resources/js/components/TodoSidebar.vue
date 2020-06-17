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
                    <button type="button" class="btn btn-primary btn-block my-1 waves-effect waves-light" data-toggle="modal" data-target="#taskModal">Nueva tarea</button>
                </div>

                <!-- Task filters -->
                <div class="sidebar-menu-list ps ps--active-y">

                    <!-- All-filter -->
                    <div class="list-group list-group-filters font-medium-1">
                        <a href="#" class="list-group-item list-group-item-action border-0 pt-0">
                            <i class="font-medium-5 feather icon-mail mr-50"></i> Todas
                        </a>
                    </div>
                    <hr>

                    <!-- Other-filters (module_labels) -->
                    <h5 class="mt-2 mb-1 pt-25">Filtros</h5>
                    <div class="list-group list-group-filters font-medium-1">
                        <a href="#" class="list-group-item list-group-item-action border-0"><i class="font-medium-5 feather icon-star mr-50"></i> Principal</a>
                        <a href="#" class="list-group-item list-group-item-action border-0"><i class="font-medium-5 feather icon-info mr-50"></i> Importantes</a>
                        <a href="#" class="list-group-item list-group-item-action border-0"><i class="font-medium-5 feather icon-check mr-50"></i> Completadas</a>
                        <a href="#" class="list-group-item list-group-item-action border-0"><i class="font-medium-5 feather icon-trash mr-50"></i> Descartadas</a>
                    </div>
                    <hr>

                    <!-- Labels (custom labels) -->
                    <h5 class="mt-2 mb-1 pt-25">Etiquetas <a href="#" class="pt-2"><i class="font-medium-5 feather icon-plus success"></i></a></h5>
                    <div class="list-group list-group-labels font-medium-1">
                        <a href="#" class="list-group-item list-group-item-action border-0 d-flex align-items-center" v-for="(label) in getLabels" :key="label.id"><span class="bullet bullet-primary mr-1"></span> {{ label.label }}</a>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 342px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 221px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex';
export default {
    methods: {
        ...mapMutations({
            toggleForm: 'TOGGLE_SHOW_FORM'
        }),
    },
    computed: {
        ...mapGetters(['getLabels'])
    }
}
</script>

<style>

</style>