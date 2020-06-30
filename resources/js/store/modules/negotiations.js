import axios from 'axios';

/* Negotiations */

// Constant to reset this state information.
const initialState = () => ({
    contacts: [], // User contacts
    types: [], // Negotiations types.
    statuses: [], // Negotiation statuses.
    processes: [], // Negotiation processes.
    negotiations: [], // Negotiations.
    negLists: [],
    negotiation: {
        id: null,
        userId: null,
        contactId: null,
        negTypeId: null,
        negStatusId: null,
        negProcessId: null,
        title: '',
        description: '',
        amount: '',
        active: true,
    },
});

// State object.
const state = initialState;

export const getters = {
    getContacts: state => { return state.contacts },
    getTypes: state => { return state.types },
    getStatuses: state => { return state.statuses },
    getProcesses: state => { return state.processes },
    getNegotiation: state => { return state.negotiation },
    getNegotiations: state => { return state.negotiations },
    getNegsLists: state => { return state.negLists },
};

export const actions = {
    async saveNeg({ state, commit }) {

        try {

            // Send data
            const response = await axios.post(`${window.api_url}/api/negotiations/save-negotiation`, state.negotiation);

            if(response.data.result) {
                
                // Change store todos
                commit('ADD_NEGOTIATION', response.data.saved_neg);
                
                // Reset todo
                commit('RESET_NEGOTIATION');
            }
        } catch (error) {
            // Render error message
            console.log(error);
        } finally {
        }
    },
    /* async updateFilter({ state, commit }, filter) {
        try {

            // Copy of todos
            let copy = _.cloneDeep(state.todos);

            // Find todo index
            let index = copy.findIndex(tc => tc.id === state.id);
            
            // Update filter in todo
            switch (filter) {
                case 'starred': copy[index].filters.starred = !copy[index].filters.starred; break;
                case 'important': copy[index].filters.important = !copy[index].filters.important; break;
                case 'completed': copy[index].filters.completed = !copy[index].filters.completed; break;
                case 'trashed': copy[index].filters.trashed = !copy[index].filters.trashed; break;
            }

            // Data to send
            let todos = JSON.stringify(copy);

            // We send the todos copied array, with the todo that were added or updated.
            const response = await axios.post(`${URL}/api/todos/update-todos`, {uid: state.user, todos:todos});

            // We change the todos array if true is returned.
            if(response.data.result) {
                commit('SET_TODOS', JSON.parse(response.data.updatedTodos));
            }
        } catch (error) {
            console.log(error);
        } finally {

            commit('SET_COPY', state.todos);
            if (!state.filters.all) { commit('FILTER_COPY'); }
        }
    } */
};

export const mutations = {
    SET_USER_ID: (state, i) => state.negotiation.userId = i,
    SET_CONTACTS: (state, c) => state.contacts = c,
    SET_TYPES: (state, t) => state.types = t,
    SET_STATUSES: (state, s) => state.statuses = s,
    SET_PROCESSES: (state, p) => state.processes = p,
    SET_NEGOTIATIONS: (state, ns) => {
        state.negotiations = ns;

        // Create a copy for every process of this user.
        state.processes.forEach(process => {
            state.negLists['list-' + process.id] = state.negotiations.filter(neg => neg.neg_process_id === process.id);
        });
    },
    SET_NEGOTIATION: (state, n) => state.negotiation = n,
    RESET_NEGOTIATION: (state) => {

        /* Reset todo */
        state.negotiation = {
            id: null,
            contactId: null,
            negTypeId: null,
            negStatusId: null,
            negProcessId: null,
            title: '',
            description: '',
            amount: '',
            active: true,
        };
    },
    ADD_NEGOTIATION: (state, n) => {
        state.negotiations.push(n);
    },
    // UPDATE_NEG_LIST: (state, val) => {
    //     state.negLists['list-1'] = val;
    // }
    /* TOGGLE_STARRED: (state) => state.todo.filters.starred = !state.todo.filters.starred,
    TOGGLE_IMPORTANT: (state) => state.todo.filters.important = !state.todo.filters.important,
    TOGGLE_FILTER: (state, f) => {

        // Sett al filters as false
        Object.keys(state.filters).forEach(function(key) {
            state.filters[key] = false;
          });

        // Set selected filter as active
        state.filters[f] = true;
    },
    SET_USER: (state, u) => state.user = u,
    SET_LABELS: (state, ls) => state.labels = ls,
    SET_TODOS: (state, ts) => state.todos = ts,
    SET_TODO_ID: (state, id) => state.id = id ,
    SET_TODO: (state, id) => {

        // Set the index to update the array
        const index = state.todosCopy.findIndex(tc => tc.id === id);

        if(index !== -1) {

            // Set the selected todo
            Object.keys(state.todo).forEach(key => {
                state.todo[key] = state.todosCopy[index][key];
            });
        }
    },
    SET_COPY: (state) => {
        state.todosCopy = state.todos.filter(todo => {
            return todo.filters.trashed !== true;
        });
    },
    FILTER_COPY: (state) => {
        state.todosCopy = state.todos.filter(todo => {

            switch (true) {
                case state.filters.all: return (todo.filters.trashed === false && todo.filters.trashed === false); break; // All
                case state.filters.starred: return (todo.filters.starred === true && todo.filters.trashed === false); break; // Starred
                case state.filters.important: return (todo.filters.important === true && todo.filters.trashed === false); break; // Important
                case state.filters.completed: return (todo.filters.completed === true && todo.filters.trashed === false); break; // Completed
                case state.filters.trashed: return (todo.filters.trashed === true); break; // Trashed
                default: return (todo.filters.trashed === false && todo.filters.trashed === false); break; // All
            }
        });
    },
    RESET_TODO: (state) => {

        // Reset todo
        state.todo = {
            id: null,
            title: '',
            description: '',
            filters: {
                starred: false,
                important: false,
                completed: false,
                trashed: false,
            },
            labels: []
        };
    } */
}

export default {
    state,
    getters,
    actions,
    mutations
}