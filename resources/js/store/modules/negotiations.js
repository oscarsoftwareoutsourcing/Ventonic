import axios from 'axios';
import { forEach, findIndex } from 'lodash';

/* Negotiations */

// Constant to reset this state information.
const initialState = () => ({

    search: '',
    filters: {
        see: true,
        owner: null,
        contact: null,
        won: 1,
        lost: 2,
        inProcess: 3,
        createdAt: null,
        deadline: null,
        from: new Date(),
        to: new Date(),
        equals: false,
        bigger: false,
        lower: false,
        range: false,
        fromAmount: 0,
        toAmount: 0
    },

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
        actives: true,
        detailedNeg: null
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
        owners: []
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

    // Filters
    getSearch: state => { return state.search },
    getNegFilters: state => { return state.filters },

    // UI elements to manipulayte in the dom.
    getShowLists: state => { return state.ui.showLists },
    getShowForm: state => { return state.ui.showForm },
    getShowDetails: state => { return state.ui.showDetails },
    getShowNoteForm: state => { return state.ui.showNoteForm },
    getShowEventForm: state => { return state.ui.showEventForm },
    getShowFileForm: state => { return state.ui.showFileForm },
    getShowConfirm: state => { return state.ui.showConfirm },
    getActives: state => { return state.ui.actives },
    getDetailedNeg: state => { return state.ui.detailedNeg },

    // Data elements to render
    getUserId: state => { return state.data.userId },
    getProcesses: state => { return state.data.processes },
    getNegotiations: state => { return state.data.negotiations },
    getTypes: state => { return state.data.types },
    getStatuses: state => { return state.data.statuses },
    getContacts: state => { return state.data.contacts },
    getUserGroups: state => { return state.data.userGroups },
    getNegotiation: state => { return state.negotiation },
    getOwners: state => { return state.data.owners },

    // getNegGroups: state => { return state.negotiation.groups },
};

export const actions = {
    async saveNeg({ state, commit }) {

        try {

            state.negotiation.user_id = state.data.userId;

            // Send data
            const response = await axios.post(`${window.api_url}/api/negotiations/save-negotiation`, state.negotiation);

            if(response.data.result) {
                location.reload();
                // Add or update negotiation into arrays.
                //await commit('HANDLE_CHANGE', response.data.negotiation);

                // Reset Negotiation in state
                //commit('RESET_NEGOTIATION');

                // Toggle form (hide it)
                //commit('TOGGLE_FORM');
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
                await commit('UPDATE_NEGOTIATION', response.data.updated_neg);

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
                commit('UPDATE_NEGOTIATION', response.data.archivedNeg);
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
                commit('UPDATE_NEGOTIATION', response.data.updated_neg);

                // Reset todo
                commit('RESET_NEGOTIATION');
            }

        } catch (error) {
            console.log(error);
        }
    },
};

export const mutations = {
    SET_SEARCH: (state, val) => state.search = val,
    SET_FROM_AMOUNT: (state, val) => state.filters.fromAmount = val,
    SET_TO_AMOUNT: (state, val) => state.filters.toAmount = val,
    TOGGLE_FILTER_STATUS: (state, val) => {
        switch (val) {
            case 'Exitosa': state.filters.won = (state.filters.won === null) ? 1 : null; break;
            case 'Perdida': state.filters.lost = (state.filters.lost === null) ? 2 : null; break;
            case 'En proceso': state.filters.inProcess = (state.filters.inProcess === null) ? 3 : null; break;
        }
    },
    TOGGLE_FILTER_IMPORT: (state, val) => {
        state.filters.equals = false;
        state.filters.bigger = false;
        state.filters.lower = false;
        state.filters.range = false;

        if(val !== null) {
            state.filters[val] = true;
        }
    },
    SET_CREATED_AT_FILTER: (state, val) => state.filters.createdAt = val,
    SET_DEADLINE_FILTER: (state, val) => state.filters.deadline = val,
    TOGGLE_LISTS: (state) => state.ui.showLists = !state.ui.showLists,
    TOGGLE_FORM: (state) => state.ui.showForm = !state.ui.showForm,
    TOGGLE_DETAILS: (state) => state.ui.showDetails = !state.ui.showDetails,
    TOGGLE_CONFIRM: (state) => state.ui.showConfirm = !state.ui.showConfirm,
    TOGGLE_ACTIVES: (state) => state.ui.actives = !state.ui.actives,
    SET_DETAILED_NEG: (state, dn) => {
        state.ui.detailedNeg = dn;
        // state.ui.detailedNeg.created_at = new Date(state.ui.detailedNeg.created_at);
        // state.ui.detailedNeg.deadline = new Date(state.ui.detailedNeg.deadline);
        // if(state.ui.detailedNeg.updated_at !== null) {
        //     state.ui.detailedNeg.created_at = new Date(state.ui.detailedNeg.updated_at);
        // }
    },
    SET_USER_ID: (state, i) => state.data.userId = i,
    SET_TYPES: (state, t) => state.data.types = t,
    SET_STATUSES: (state, s) => state.data.statuses = s,
    SET_PROCESSES: (state, p) => { state.data.processes = p; },
    SET_CONTACTS: (state, c) => state.data.contacts = c,
    SET_USER_GROUPS: (state, g) => state.data.userGroups = g,
    SET_NEGOTIATION_GROUPS: (state, ng) => state.negotiation.groups = ng,
    SET_NEGOTIATIONS: (state, ns) => {
        ns.forEach(neg => {

            // Convert all date data to date JS type.
            neg.created_at = new Date(neg.created_at);
            neg.deadline = new Date(neg.deadline);
            if(neg.updated_at !== null) {
                neg.updated_at = new Date(neg.updated_at);
            }

            // Fill owners array.
            if(neg.owner.id !== state.data.userId) {
                state.data.owners.push(neg.owner);
            }
        });
        state.data.negotiations = ns;
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
    UPDATE_NEGOTIATION: (state, un) => {

        // Convert date in Date object format.
        un.created_at = new Date(un.created_at);
        un.deadline = new Date(un.deadline);
        const index = state.data.negotiations.findIndex(neg => neg.id === un.id);

        if(index !== -1) {
            state.data.negotiations.splice(index, 1, un);
        }
    },
    HANDLE_CHANGE: (state, nn) => {

        // Convert date in Date object format.
        nn.created_at = new Date(nn.created_at);
        nn.deadline = new Date(nn.deadline);

        const index = state.data.negotiations.findIndex(neg => neg.id === nn.id);

        if(index !== -1) {
            state.data.negotiations.splice(index, 1, nn);
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
