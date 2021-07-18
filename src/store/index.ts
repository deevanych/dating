import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    age: {
      min: 18,
      max: 73,
    },
    searchFilter: {
      age: [45, 59],
      // 0 - male, 1 - female, 2 - other
      gender: 1,
    },
  },
  getters: {
    FILTER_GENDER: (state): number => state.searchFilter.gender,
    FILTER_AGE: (state): number[] => state.searchFilter.age,
    AGE_LIMITS: (state): { min: number; max: number } => state.age,
  },
  mutations: {
  },
  actions: {
  },
  modules: {
  },
});
