import Vuex from 'vuex';
import Vue from 'vue';

// TODO: Use persist for storing local data.
// import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        pageState: {"startPage": 1, "mapPage": 2, "projectPage": 3, "routePage": 4},
        currentPageState: 1, //StartPage
    },
    getters: {
        pageStates: state => {
            return state.pageState;
        },
        getCurrentPageState: state => {
            return state.currentPageState;
        }
    },
    mutations: {
        setPageState(state, pageState) {
            state.currentPageState = pageState;
        }
    }
});

export default store;