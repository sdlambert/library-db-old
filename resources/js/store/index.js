import Vue from 'vue';
import Vuex from 'vuex';
import { createLogger } from 'vuex'
import newOpenLibraryBook from './modules/newOpenLibraryBook';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    newOpenLibraryBook
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
});