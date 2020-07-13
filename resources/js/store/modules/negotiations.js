import axios from 'axios';

/* Negotiations */

// Constant to reset this state information.
const initialState = () => ({

    // UI elements to manipulayte in the dom.
    ui: {
        headerNavbarShadowHeight: null,
        controlsHeight: null,
        showLists: true,
        showForm: false,
        showDetails: false,
        showNoteForm: false,
        showEventForm: false,
        showFileForm: false,
        showConfirm: false,
        actives: true
    },

    // Data to render in the UI
    data: {
        userId: null, // ID of the user,
        contacts: [], // User contacts.
        userGroups: [], // User contacts.
        types: [], // Negotiations types.
        statuses: [], // Negotiation statuses.
        processes: [], // Negotiation processes.
        negotiations: [], // Negotiations.
        renderedNegotiations: [], // Negotiations related to the user.
        totals: [], // Negotiations related to the user.
    },

    // Data to manage
    negotiation: {
        id: null,
        user_id: null,
        contact_id: null,
        groups: [],
        neg_type_id: null,
        neg_status_id: null,
        neg_process_id: null,
        deadline: null,
        title: '',
        description: '',
        amount: '',
        active: true,
    }
});

// State object.
const state = initialState;

export const getters = {

    // UI elements to manipulayte in the dom.
    getHeaderNavbarShadowHeight: state => { return state.ui.headerNavbarShadowHeight },
    getControlsHeight: state => { return state.ui.controlsHeight },
    getShowLists: state => { return state.ui.showLists },
    getShowForm: state => { return state.ui.showForm },
    getShowDetails: state => { return state.ui.showDetails },
    getShowNoteForm: state => { return state.ui.showNoteForm },
    getShowEventForm: state => { return state.ui.showEventForm },
    getShowFileForm: state => { return state.ui.showFileForm },
    getShowConfirm: state => { return state.ui.showConfirm },
    getActives: state => { return state.ui.actives },


    // Data elements to render
    getUserId: state => { return state.data.userId },
    getProcesses: state => { return state.data.processes },
    getNegotiations: state => { return state.data.renderedNegotiations },
    getTotals: state => { return state.data.totals },

    getTypes: state => { return state.data.types },
    getStatuses: state => { return state.data.statuses },
    getContacts: state => { return state.data.contacts },
    getUserGroups: state => { return state.data.userGroups },
    getNegotiation: state => { return state.negotiation },
    
    // getNegGroups: state => { return state.negotiation.groups },
};

export const actions = {
    async saveNeg({ state, commit }) {

        try {

            state.negotiation.user_id = state.data.userId;

            // Send data
            const response = await axios.post(`${window.api_url}/api/negotiations/save-negotiation`, state.negotiation);

            if(response.data.result) {
                
                // Add or update negotiation into arrays.
                await commit('HANDLE_CHANGE', response.data.negotiation);
                commit('SEPARATE_NEGOTIATIONS');
                
                /* // Reset Negotiation in state
                commit('RESET_NEGOTIATION');

                // Toggle form (hide it)
                commit('TOGGLE_FORM'); */
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
                await commit('HANDLE_CHANGE', response.data.updated_neg);
                commit('SEPARATE_NEGOTIATIONS');

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
                commit('HANDLE_CHANGE', response.data.archivedNeg);

                if(state.active) {
                    commit('SEPARATE_NEGOTIATIONS');
                } else {
                    commit('SEPARATE_ARCHIVED_NEGOTIATIONS');
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
                commit('HANDLE_CHANGE', response.data.updated_neg);
                commit('SEPARATE_NEGOTIATIONS');

                // Reset todo
                commit('RESET_NEGOTIATION');
            }
            
        } catch (error) {
            console.log(error);
        }
    },
};

export const mutations = {
    SET_HEADER_NAVBAR_SHADOW_HEIGHT: (state, hh) => state.ui.headerNavbarShadowHeight = hh,
    SET_CONTROLS_HEIGHT: (state, ch) => state.ui.controlsHeight = ch,
    TOGGLE_LISTS: (state) => state.ui.showLists = !state.ui.showLists,
    TOGGLE_FORM: (state) => state.ui.showForm = !state.ui.showForm,
    TOGGLE_DETAILS: (state) => state.ui.showDetails = !state.ui.showDetails,
    TOGGLE_CONFIRM: (state) => state.ui.showConfirm = !state.ui.showConfirm,
    TOGGLE_ACTIVES: (state) => state.ui.actives = !state.ui.actives,
    SET_USER_ID: (state, i) => state.data.userId = i,
    SET_TYPES: (state, t) => state.data.types = t,
    SET_STATUSES: (state, s) => state.data.statuses = s,
    SET_PROCESSES: (state, p) => state.data.processes = p,
    SET_CONTACTS: (state, c) => state.data.contacts = c,
    SET_USER_GROUPS: (state, g) => state.data.userGroups = g,
    SET_NEGOTIATION_GROUPS: (state, ng) => state.negotiation.groups = ng,
    SET_NEGOTIATIONS: (state, ns) => { state.data.negotiations = ns; },
    SEPARATE_NEGOTIATIONS: (state) => {

        state.data.renderedNegotiations = [];
        state.data.totals = [];
        
        // Iterate over the processes array to create negotiations processes keys.
        state.data.processes.forEach(process => {
            let total = 0;
            state.data.renderedNegotiations['list-' + process.id] = state.data.negotiations.filter(neg => {
                if(neg.neg_process_id === process.id && neg.active) {
                    total += parseFloat(neg.amount);
                    return neg.neg_process_id === process.id && neg.active
                }
            });

            state.data.totals['list-' + process.id] = total;
        });
    },
    SEPARATE_ARCHIVED_NEGOTIATIONS: (state) => {

        state.data.renderedNegotiations = [];
        state.data.totals = [];
        
        // Iterate over the processes array to create negotiations processes keys.
        state.data.processes.forEach(process => {
            let total = 0;
            state.data.renderedNegotiations['list-' + process.id] = state.data.negotiations.filter(neg => {
                if(neg.neg_process_id === process.id && !neg.active) {
                    total += parseFloat(neg.amount);
                    return neg.neg_process_id === process.id && !neg.active
                }
            });

            state.data.totals['list-' + process.id] = total;
        });
    },
    SET_NEGOTIATION: (state, n) => {
        state.negotiation.id = n.id;
        state.negotiation.contact_id = n.contact.id;
        state.negotiation.neg_type_id = n.type.id;
        state.negotiation.neg_status_id = n.status.id;
        state.negotiation.neg_process_id = n.neg_process_id;
        state.negotiation.deadline = n.deadline;
        state.negotiation.title = n.title;
        state.negotiation.description = n.description;
        state.negotiation.amount = n.amount;
        state.negotiation.active = n.active;
    },
    HANDLE_CHANGE: (state, nn) => {
        
        const index = state.data.negotiations.findIndex(neg => neg.id === nn.id);

        if(index !== -1) {
            state.data.negotiations[index] = nn;
        } else {
            // Add negotiation in the base array.
            state.data.negotiations.push(nn);
        }
    },
    RESET_NEGOTIATION: (state) => {

        /* Reset todo */
        state.negotiation = {
            id: null,
            contact_id: null,
            groups: [],
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