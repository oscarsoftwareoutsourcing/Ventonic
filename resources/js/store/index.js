import Vuex from 'vuex';
import Vue from 'vue';
import todos from './modules/todos.js';
import negotiations from './modules/negotiations.js';

// Load Vuex
Vue.use(Vuex);

// create store
export default new Vuex.Store({
    modules: {
        todos,
        negotiations
    }
});