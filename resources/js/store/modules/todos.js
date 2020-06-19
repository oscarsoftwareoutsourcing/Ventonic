import axios from 'axios';

const URL = window.api_url;

/*
  Products
  For the auth user data in the platform.
*/

// Constant to reset this state information.
const initialState = () => ({
    filters: {
        all: true,
        starred: false,
        important: false,
        completed: false,
        trashed: false
    },
    id: null, // Todo ID.
    user: null, // User ID.
    labels: [], // Labels from DB.
    userLabels: [], // User labels for this module.
    todos: [], // User's todos.
    todosCopy: [], // Copy of user's todos
    todo: { // Todo structure for modal form.
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
    }
});

// State object.
const state = initialState;

export const getters = {
    getLabels: state => { return state.labels },
    getTodosCopy: state => { return state.todosCopy },
    getTodo: state => { return state.todo },
    getFilters: state => { return state.filters }
};

export const actions = {
    async saveTodo({ state, commit }) {

        try {

            /* Copy of todos */
            let copy = _.cloneDeep(state.todos);

            /* New todo */
            if(state.todo.id === null) {

                let key = null;

                /* Create id for note */
                do {
                    key = Math.random().toString(20).substr(2, 5);
                } while (state.todos.findIndex(todo => todo.id === key) !== -1);

                state.todo.id = key;

                /* Verify if it doesn't exist */
                (copy.length > 0) ? copy.unshift(state.todo) : copy.push(state.todo);
            
            /* Update todo */
            } else {
                let index = state.todos.findIndex(todo => todo.id === state.todo.id);
                copy[index] = state.todo;
            }

            /* We stringify the todos object */
            copy = JSON.stringify(copy);

            /* Send data */
            const response = await axios.post(`${URL}/api/todos/save-todo`, {uid: state.user, todos:copy});

            if(response.data.result) {
                
                /* Change store todos */
                commit('SET_TODOS', JSON.parse(response.data.updatedTodos));
                
                /* Reset todo */
                commit('RESET_TODO');
            }
        } catch (error) {
            /* Render error message */
            console.log(error);
        } finally {

            /* Copy todos to render */
            commit('SET_COPY', state.todos);
            if (!state.filters.all) { commit('FILTER_COPY'); }
        }
    },
    async updateFilter({ state, commit }, filter) {
        try {

            /* Copy of todos */
            let copy = _.cloneDeep(state.todos);

            /* Find todo index */
            let index = copy.findIndex(tc => tc.id === state.id);
            
            /* Update filter in todo */
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
    }
};

export const mutations = {
    TOGGLE_STARRED: (state) => state.todo.filters.starred = !state.todo.filters.starred,
    TOGGLE_IMPORTANT: (state) => state.todo.filters.important = !state.todo.filters.important,
    TOGGLE_FILTER: (state, f) => {

        /* Sett al filters as false */
        Object.keys(state.filters).forEach(function(key) {
            state.filters[key] = false;
          });

        /* Set selected filter as active */
        state.filters[f] = true;
    },
    SET_USER: (state, u) => state.user = u,
    SET_LABELS: (state, ls) => state.labels = ls,
    SET_TODOS: (state, ts) => state.todos = ts,
    SET_TODO_ID: (state, id) => state.id = id ,
    SET_TODO: (state, id) => {

        /* Set the index to update the array */
        const index = state.todosCopy.findIndex(tc => tc.id === id);

        if(index !== -1) {

            /* Set the selected todo */
            Object.keys(state.todo).forEach(key => {
                // console.log(key);
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

        /* Reset todo */
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
    },
    
    // RESET: (state) => {
    //     const newState = initialState();
    //     Object.keys(newState).forEach(key => {
    //       state[key] = newState[key]
    //     });
    // },
}

export default {
    state,
    getters,
    actions,
    mutations
}
