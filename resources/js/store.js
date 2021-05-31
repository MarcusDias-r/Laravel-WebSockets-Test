import axios from 'axios';
import {createStore} from 'vuex';
import createPersistedState from 'vuex-persistedstate';

export const store = createStore({

    state(){
        return{

        }
    },

    mutations:{



    },

    actions:{



    },

    plugins: [createPersistedState()],

});