import axios from 'axios';

/*
  Products
  For the auth user data in the platform.
*/

// Constant to reset this state information.
const initialState = () => ({
    id: null,
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
    getTodo: state => { return state.todo }
};

export const actions = {
    // async queryProducts({ commit }) {

    //     let config = {
    //         headers: {
    //             Authorization: `bearer ${localStorage.getItem('user_token')}`
    //         }
    //     }
    //     try {
    //         const response = await this.$axios.$get(`${this.$axios.defaults.baseURL}products/all`, config);

    //         commit('SET_PRODUCTS', response.products);
    //     } catch (error) {

    //         if(error.response.status === 401) {
    //             console.log('Mostrar mensaje de sesión expirada');
    //             commit('SET_CODE', '401');
    //             if(process.browser) localStorage.removeItem('user_token');
    //         } else console.log('Redirigir a pantalla de error');
    //     }
    // },
    async saveTodo({ state, commit }) {

        try {

            /* Copy the copy of todos */
            let copy = _.cloneDeep(state.todosCopy);

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
            const response = await axios.post(`${process.env.MIX_API_URL}/api/todos/save-todo`, {uid: state.user, todos:copy});

            if(response.data.result) {
                
                /* Change store todos */
                commit('SET_TODOS', JSON.parse(response.data.updatedTodos));
                
                /* Reset todo */
                commit('RESET_TODO', state.todos);
            }
        } catch (error) {
            /* Render error message */
            console.log(error);
        } finally {

            /* Copy todos to render */
            commit('SET_COPY', state.todos);
        }
    },
    async updateFilter({ state, commit }, filter) {
        try {

            /* Find todo index */
            let index = state.todosCopy.findIndex(tc => tc.id === state.id);
            
            /* Update filter in todo */
            switch (filter) {
                case 'starred': state.todosCopy[index].filters.starred = !state.todosCopy[index].filters.starred; break;
                case 'important': state.todosCopy[index].filters.important = !state.todosCopy[index].filters.important; break;
                case 'completed': state.todosCopy[index].filters.completed = !state.todosCopy[index].filters.completed; break;
                case 'trashed': state.todosCopy[index].filters.trashed = !state.todosCopy[index].filters.trashed; break;
            }

            // Data to send
            let todos = JSON.stringify(state.todosCopy);

            // We send the todos copied array, with the todo that were added or updated.
            const response = await axios.post(`${process.env.MIX_API_URL}/api/todos/update-todos`, {uid: state.user, todos:todos});

            // We change the todos array if true is returned.
            if(response.data.result) {
                commit('SET_TODOS', JSON.parse(response.data.updatedTodos));
            }
        } catch (error) {
            console.log(error);
        } finally {
            commit('SET_COPY', state.todos);
        }
    },
    async delete({ commit }, id) {
        let config = {
            headers: {
                Authorization: `bearer ${localStorage.getItem('user_token')}`
            }
        }

        try {
            const response = await this.$axios.$put(`${this.$axios.defaults.baseURL}products/delete/${data.id}`, {}, config);

            commit('SET_CODE', response.code);
            commit('REMOVE_PRODUCT', response.product);
        } catch (error) {
            if(error.response.status === 401) {
                console.log('Mostrar mensaje de sesión expirada');
                commit('SET_CODE', '401');
                if(process.browser) localStorage.removeItem('user_token');
            } else {
                commit('SET_CODE', '003');
            }
        }
    }
};

export const mutations = {
    TOGGLE_STARRED: (state) => state.todo.filters.starred = !state.todo.filters.starred,
    TOGGLE_IMPORTANT: (state) => state.todo.filters.important = !state.todo.filters.important,
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
    SET_COPY: (state) => state.todosCopy = _.cloneDeep(state.todos),
    RESET_TODO: (state) => {
        
        /* Reset index */
        state.index = null;

        /* Reset todo */
        state.todo = {
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
    // SET_CODE: (state, c) => state.code = c,
    // RESET: (state) => {
    //     const newState = initialState();
    //     Object.keys(newState).forEach(key => {
    //       state[key] = newState[key]
    //     });
    // },
    // SET_PRODUCTS: (state, ps) => { state.products = ps },
    // SET_PRODUCT: (state, p) => {

    //     if(p !== null) {
    //         const index = state.products.findIndex(product => product.id === p.id);
    
    //         if(index !== -1) state.product = p;
    //     } else state.product = null;
    // },
    // UPDATE_PRODUCT: (state, up) => {
    //     const index = state.products.findIndex(product => product.id === up.id);

    //     if(index !== -1) state.products.splice(index, 1, up);
    // },
    // REMOVE_PRODUCT: (state, value) => state.products = state.products.filter(product => product.id !== value)
}

export default {
    state,
    getters,
    actions,
    mutations
}
