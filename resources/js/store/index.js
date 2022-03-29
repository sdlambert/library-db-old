import Vue from 'vue';
import Vuex from 'vuex';
import { createLogger } from 'vuex'
import newBook from './modules/newOpenLibraryBook';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    newBook
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
});