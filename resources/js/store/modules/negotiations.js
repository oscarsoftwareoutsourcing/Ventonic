import axios from 'axios';

/* Negotiations */

// Constant to reset this state information.
const initialState = () => ({
    showModal: false,
    showConfirm: false,
    contacts: [], // User contacts
    types: [], // Negotiations types.
    statuses: [], // Negotiation statuses.
    processes: [], // Negotiation processes.
    negotiations: [], // Negotiations.
    userId: null,
    negotiation: {
        id: null,
        user_id: null,
        contact_id: null,
        neg_type_id: null,
        neg_status_id: null,
        neg_process_id: null,
        deadline: null,
        title: '',
        description: '',
        amount: '',
        active: true,
    },
});

// State object.
const state = initialState;

export const getters = {
    getShowModal: state => { return state.showModal },
    getShowConfirm: state => { return state.showConfirm },
    getContacts: state => { return state.contacts },
    getTypes: state => { return state.types },
    getStatuses: state => { return state.statuses },
    getProcesses: state => { return state.processes },
    getNegotiation: state => { return state.negotiation },
    getNegotiations: state => { return state.negotiations.filter(n => n.active) }
};

export const actions = {
    async saveNeg({ state, commit }) {

        try {

            state.negotiation.user_id = state.userId;

            // Send data
            const response = await axios.post(`${window.api_url}/api/negotiations/save-negotiation`, state.negotiation);

            if(response.data.result) {
                
                // Change store todos
                commit('SET_NEGOTIATIONS', response.data.newNegotiations);
                
                // Reset todo
                commit('RESET_NEGOTIATION');
            }
        } catch (error) {
            // Render error message
            console.log(error);
        } finally {
        }
    },
    async changeToList({ commit }, value) {
        try {

            // Send data
            const response = await axios.put(`${window.api_url}/api/negotiations/change-negotiation-list/${value.id}`, {processId: value.processId});

            if(response.data.result) {
                
                // Change store todos
                commit('UPDATE_NEGOTIATIONS', response.data.updated_neg);

                // Reset todo
                commit('RESET_NEGOTIATION');
            }
            
        } catch (error) {
            console.log(error);
        }
    },
    async toggleActivation({state, commit}) {
        try {

            // Send data
            const response = await axios.post(`${window.api_url}/api/negotiations/toggle-active-negotiation`, {id: state.negotiation.id, active: state.negotiation.active});

            if(response.data.result) {
                
                // Change store todos
                commit('SET_NEGOTIATIONS', response.data.newNegotiations);
                commit('RESET_NEGOTIATION');
                commit('TOGGLE_CONFIRM');

                if(state.showModal) {
                    commit('TOGGLE_MODAL');
                }
            }
            
        } catch (error) {
            console.log(error);
        }
    },
    async changeStatus({commit}, value) {
        try {

            // Send data
            const response = await axios.put(`${window.api_url}/api/negotiations/change-negotiation-status/${value.id}`, {statusId: value.stateId});

            if(response.data.result) {
                
                // Change store todos
                commit('SET_NEGOTIATIONS', response.data.newNegotiations);

                // Reset todo
                commit('RESET_NEGOTIATION');
            }
            
        } catch (error) {
            console.log(error);
        }
    },
};

export const mutations = {
    TOGGLE_MODAL: (state) => state.showModal = !state.showModal,
    TOGGLE_CONFIRM: (state) => state.showConfirm = !state.showConfirm,
    SET_USER_ID: (state, i) => state.userId = i,
    SET_CONTACTS: (state, c) => state.contacts = c,
    SET_TYPES: (state, t) => state.types = t,
    SET_STATUSES: (state, s) => state.statuses = s,
    SET_PROCESSES: (state, p) => state.processes = p,
    SET_NEGOTIATIONS: (state, ns) => { state.negotiations = ns; },
    SET_ACTIVES: (state, ns) => { state.negotiations = ns; },
    SET_INACTIVES: (state, ns) => { state.negotiations = ns; },
    SET_NEGOTIATION: (state, n) => { state.negotiation = n },
    UPDATE_NEGOTIATIONS: (state, val) => {
        const index = state.negotiations.findIndex(n => n.id === val.id);
        
        if(index !== -1) {
            state.negotiations[index] = val;
        }
    },
    RESET_NEGOTIATION: (state) => {

        /* Reset todo */
        state.negotiation = {
            id: null,
            contact_id: null,
            neg_type_id: null,
            neg_status_id: null,
            neg_process_id: null,
            title: '',
            description: '',
            amount: '',
            active: true,
        };
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}