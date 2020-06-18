import axios from 'axios';

const URL = process.env.MIX_API_URL;

/*
  Products
  For the auth user data in the platform.
*/

// Constant to reset this state information.
const initialState = () => ({
    // UI
    userId: null,

    // DB data.
    labels: [],
    userLabels: [],
    todos: [],
    todosCopy: [],
    todo: null
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
    async saveTodo({ state, commit }, t) {

        // Array to send
        let data = {
            uid: state.userId,
            todos: state.todosCopy
        };

        // We push or replace the note into the todos copied array.
        if(state.todo != null) {

            // We modify the todo.
            data.todos[state.getTodo] = t;
        } else {
            (data.todos.length > 0) ? data.todos.unshift(t) : data.todos.push(t);
        }

        // We stringify the todos object.
        data.todos = JSON.stringify(data.todos);

        try {

            // We send the todos copied array, with the todo that were added or updated.
            const response = await axios.post(`${URL}/api/todos/save-todo`, data);

            // We change the todos array if true is returned.
            if(response.data.result) {
                commit('SET_TODOS', JSON.parse(response.data.updatedTodos));
            }
        } catch (error) {
            // if(error.response.status === 401) {
            // }
        } finally {
            commit('SET_COPY', state.todos);
        }
    },
    async updateTodos({ state, commit }, todos) {
        try {

            // Data to send
            let data = {
                uid: state.userId,
                todos: JSON.stringify(todos)
            };

            // We send the todos copied array, with the todo that were added or updated.
            const response = await axios.post(`${URL}/api/todos/update-todos`, data);

            // We change the todos array if true is returned.
            if(response.data.result) {
                commit('SET_TODOS', JSON.parse(response.data.updatedTodos));
            }
        } catch (error) {
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
    SET_UID: (state, uid) => state.userId = uid,
    SET_LABELS: (state, ls) => state.labels = ls,
    SET_TODOS: (state, ts) => state.todos = ts,
    SET_COPY: (state) => state.todosCopy = _.cloneDeep(state.todos),
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
