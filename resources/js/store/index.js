import Vue from 'vue';
import Vuex from 'vuex';
import { createLogger } from 'vuex'
import openLibraryBook from './modules/openLibraryBook';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    openLibraryBook
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
});
