import Vue from 'vue';
import Vuex from 'vuex';
import users from '@/api/users';

const cardsLimit = 5;
let cardsOffset = 0;

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: {},
    age: {
      min: 18,
      max: 73,
    },
    searchFilter: {
      age: [45, 59],
      // 0 - male, 1 - female, 2 - other
      gender: 1,
    },
    cards: [],
  },
  getters: {
    FILTER_GENDER: (state): number => state.searchFilter.gender,
    FILTER_AGE: (state): number[] => state.searchFilter.age,
    AGE_LIMITS: (state): { min: number; max: number } => state.age,
    PROFILE_CARDS: (state) => state.cards,
  },
  mutations: {
    ADD_CARDS: (state, cards: [] = []): number => state.cards.push(...cards),
    REMOVE_CARD: (state): void => Vue.delete(state.cards, 0),
  },
  actions: {
    GET_CARDS: (store): void => {
      users.index(cardsOffset.toString(), cardsLimit.toString()).then(({ data }): void => {
        cardsOffset += cardsLimit;
        store.commit('ADD_CARDS', data);
      });
    },
    REMOVE_CARD: (store): void => {
      store.commit('REMOVE_CARD');
      if (store.getters.PROFILE_CARDS.length <= cardsLimit) {
        store.dispatch('GET_CARDS')
          .then();
      }
    },
  },
  modules: {
  },
});
