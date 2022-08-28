import OpenLibrary from "../../open-library";

const openLib = new OpenLibrary();
const parseFullName = require('parse-full-name').parseFullName;
const getDefaultState = () => {
  return     {
    book: {
      title: null,
      cover: null,
      blurb: null,
      url: null,
      ol_work_key: null,
    },
    edition: {
      isbn_10: null,
      isbn_13: null,
      goodreads: null,
      ol_edition_key: null,
      publish_date: null,
      pages: null,
      format: null
    },
    publisher: null,
    authors: null,
  }
}

// STATE
// =====================================================

const state = getDefaultState();

// GETTERS
// =====================================================

const getters = {
  editionKey: state => state.edition.ol_edition_key,
  workKey: state => state.book.ol_work_key,
  currentBook: state => {
    return {
      book: state.book,
      edition: state.edition,
      publisher: state.publisher,
      authors: state.authors
    }
  },
  authorFullNames: (state) => {
    let authors = state.authors;
    return authors.map((author) => {
      return `${author.first_name} ${author.last_name}`;
    });
  }
};

// MUTATIONS
// =====================================================

const mutations = {
  // Reset
  resetState (state) {
    Object.assign(state, getDefaultState());
  },

  // Publisher (get 1st publisher, TODO more than one publisher?)
  setPublishers (state, publishers) {
    state.publisher = publishers;
  },

  // Author(s)
  setAuthors (state, authors) {
    state.authors = authors;
  },

  // Edition
  setIdentifier (state, {key, identifier}) {
    state.edition[key] = identifier;
  },
  setPublishDate (state, publish_date) {
    state.edition.publish_date = publish_date;
  },
  setPages (state, pages) {
    state.edition.pages = pages;
  },
  setFormat (state, format) {
    state.edition.format = format;
  },
  setEditionKey(state, editionKey) {
    state.edition.ol_edition_key = editionKey
  },

  // Book
  setTitle (state, title) {
    state.book.title = title;
  },
  setCover (state, cover) {
    state.book.cover = cover;
  },
  setUrl (state, url) {
    state.book.url = url;
  },
  setBlurb (state, blurb) {
    state.book.blurb = blurb;
  },
  setWorkKey (state, workKey) {
    state.book.ol_work_key = workKey;
  }
};

// ACTIONS
// =====================================================

const actions = {
  /**
   * Reset book to initial state
   *
   * @param { function }     commit       VueX commit
   */
  resetBookState ({ commit }) {
    commit('resetState')
  },

  /**
   * Fetches book data from the OpenLibrary API
   *
   * @param { function }     commit       VueX commit
   * @param { function }     dispatch     VueX dispatch
   * @param { string }       isbn         a valid ISBN string
   *
   * @returns { Promise<*|void> }
   */
  async searchForISBN({ commit, dispatch }, isbn ) {
    // catch errors in component
    return await openLib.searchByBookAPI(isbn)
      .then(async (response) => {
        // Mutations
        commit('setEditionKey', response.identifiers.openlibrary[0]);
        commit('setPublishers', response.publishers?.shift() || "Unknown");

        // Actions
        dispatch('setAuthors', response.authors);
        await dispatch('setEdition', response);
        await dispatch('setBook', response);
      });
  },

  /**
   * Retrieve an edition and store relevant data
   *
   * @param { function }     commit      VueX commit
   * @param { function }     getters     VueX getters
   *
   * @returns { Promise<void> }
   */
  async searchEdition({ commit, getters }) {
    await openLib.searchByAPIType(getters.editionKey, "edition")
      .then(response => {
        commit('setWorkKey', openLib.getKeyFromURI(response.works.shift().key));
        commit('setFormat', response.physical_format || "Unknown");
      })
      .catch(console.error)
  },

  /**
   * Retrieve a work and store relevant data
   *
   * @param { function }     commit      VueX commit
   * @param { function }     getters     VueX getters
   *
   * @returns { Promise<void> }
   */
  async searchWork({ commit, getters }) {
    await openLib.searchByAPIType(getters.workKey, "work")
      .then(response => {
        commit('setBlurb', response.description?.value || response.description || null)
      })
      .catch(console.error)
  },

  /**
   * Mutate all authors, configure names and store data
   *
   * @param { function }     commit      VueX commit
   * @param { Array }        authors     an array of authors
   *
   * @returns { Promise<void> }
   */
  async setAuthors({ commit }, authors) {
    // Mutate all authors in the array
    let authorArray = await Promise.all(
      authors.map(async author => {
        let ol_author_key = openLib.getKeyFromURL(author.url);

        return openLib.searchByAPIType(ol_author_key, "author")
          .then((ol_author) => {
            // normalize name
            let nameObj = parseFullName(ol_author.personal_name || ol_author.name);
            let firstCombined = nameObj.middle ? `${nameObj.first} ${nameObj.middle}` : nameObj.first;
            firstCombined = (nameObj.suffix) ? `${firstCombined}, ${nameObj.suffix}` : firstCombined;

            return {
              last_name: nameObj.last,
              first_name: firstCombined,
              birth_date: ol_author.birth_date || null,
              death_date: ol_author.death_date || null,
              ol_author_key
            };
          })
          .catch(console.error);
      })
    );
    // Commit mutation
    commit('setAuthors', authorArray);
  },

  /**
   * Iterate over identifiers and commit each one, then set the remaining
   * available edition data
   *
   * @param { function }     commit       VueX commit
   * @param { function }     dispatch     VueX dispatch
   * @param { function }     state        VueX state
   * @param { Object }       response     the API response
   */
  async setEdition({ commit, dispatch, state }, response) {
    for(let key in response.identifiers) {
      // only set known identifiers
      if (response.identifiers.hasOwnProperty(key) && state.edition.hasOwnProperty(key)) {
        if(response.identifiers[key].length) {
          commit('setIdentifier', {
            key: key,
            identifier: response.identifiers[key][0]
          });
        }
      }
    }
    commit('setPublishDate', response.publish_date);
    commit('setPages', response.number_of_pages || null);
    // get edition format
    await dispatch('searchEdition');
  },


  /**
   * Store book data and retrieve work data
   *
   * @param  { function }     dispatch     VueX dispatch
   * @param  { function }     commit       VueX commit
   * @param  { Object }       response     API response
   * @returns { Promise<void> }
   */
  async setBook({ commit, dispatch }, response) {
    commit('setTitle', response.title);
    commit('setCover', response.cover?.medium || null);
    commit('setUrl', response.url);
    await dispatch('searchWork');
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
}
