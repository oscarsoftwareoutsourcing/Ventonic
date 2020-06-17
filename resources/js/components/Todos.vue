<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper">
            <!-- Left sidebar -->
            <div class="sidebar-left">
                <todo-sidebar />
            </div>

            <!-- Right container -->
            <div class="content-right">
                <todo-list />
            </div>

            <!-- Todo Modal -->
            <todo-form />
            
        </div>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex';
import 'es6-promise/auto';

export default {
    props: {
        uid: {
            type: Number
        },
        todos: {
            type: Array,
            default: []
        },
        labels: {
            type: Array,
            default: []
        },
    },
    data() {
        return {
        }
    },
    created() {

        // Set data into the store.
        this.SET_LABELS(this.labels);
        this.SET_UID(this.uid);
        if(this.todos.length > 0) {
            this.SET_TODOS(this.todos);
            this.SET_COPY();
        }
    },
    methods: {
        ...mapMutations(['SET_LABELS', 'SET_TODOS', 'SET_UID', 'SET_COPY']),
    },
    computed: {
        ...mapGetters(['getTodos']),
    }
}
</script>

<style>

</style>