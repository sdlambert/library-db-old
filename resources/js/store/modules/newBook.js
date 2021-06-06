import OpenLibrary from "../../open-library";

const openLib = new OpenLibrary();
const parseFullName = require('parse-full-name').parseFullName;

// STATE
// =====================================================

const state = () => ({
  book: {
    title: null,
    cover: null,
    blurb: null,
    url: null
  },
  edition: {
    isbn_10: null,
    isbn_13: null,
    goodreads: null,
    openlibrary: null,
    publish_date: null,
    pages: null,
    format: null
  },
  publishers: null,
  authors: null,
  editionKey: null,
  workKey: null
});

// GETTERS
// =====================================================

const getters = {
  editionKey: state => state.editionKey,
  workKey: state => state.workKey,
  currentBook: state => {
    return {
      book: state.book,
      edition: state.edition,
      publishers: state.publishers,
      authors: state.authors
    }
    // a getter should never just access something on the state,
    // have it return something else, like a computed value
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
  setWorkKey (state, key) {
    state.workKey = key;
  },
  setEditionKey (state, key) {
    state.editionKey = key;
  },

  // Publisher(s)
  setPublishers (state, publishers) {
    state.publishers = publishers;
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
  }
};

// ACTIONS
// =====================================================

const actions = {
  /**
   * Fetches book data from the OpenLibrary API
   * @param {function}     dispatch     VueX dispatch
   * @param {function}     commit       VueX commit
   * @param {string}       isbn         a valid ISBN string
   *
   * @returns {Promise<*|void>}
   */
  async searchForISBN({ dispatch, commit }, isbn ) {
    // catch errors in component
    return await openLib.searchByBookAPI(isbn)
      .then(async (response) => {
        // Mutations
        commit('setEditionKey', response.identifiers.openlibrary[0]);
        commit('setPublishers', response.publishers);

        // Actions
        dispatch('setAuthors', response.authors);
        await dispatch('setEdition', response);
        await dispatch('setBook', response);
      });
  },



  async searchEdition({ commit, getters }) {
    await openLib.searchByAPIType(getters.editionKey, "edition")
      .then(response => {
        commit('setWorkKey', openLib.getKeyFromURI(response.works.shift().key));
        commit('setFormat', response.physical_format);
      })
      .catch(console.error)
  },

  async searchWork({ commit, getters }) {
    await openLib.searchByAPIType(getters.workKey, "work")
      .then(response => {
        commit('setBlurb', response.description || null)
      })
      .catch(console.error)
  },

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
   * @param      { function }     dispatch     VueX dispatch
   * @param      { function }     commit       VueX commit
   * @param      { Object }       response     the API response
   */
  async setEdition({ dispatch, commit }, response) {
    for(let key in response.identifiers) {
      // only set known identifiers
      if (response.identifiers.hasOwnProperty(key)) {
        if(response.identifiers[key].length) {
          commit('setIdentifier', {
            key: key,
            identifier: response.identifiers[key][0]
          });
        }
      }
    }
    commit('setPublishDate', response.publish_date);
    commit('setPages', response.number_of_pages);
    // get edition format
    await dispatch('searchEdition');
  },

  async setBook({ commit, dispatch }, response) {
    commit('setTitle', response.title);
    commit('setCover', response.cover.medium || null);
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

// Helpers






// set authors
// set publishers

// transformBook
// setBooksKey
//      this.booksKey = res.key;

// transformEdition

// await openLib.searchEditionsByAPI(this.booksKey)
//   .then((edition) => {

// setWorksKey

//     let works = edition.works.shift();
//     this.worksKey = works.key;
//     this.edition.format = upperFirst(edition.physical_format);

//   });

// transformWork

// await openLib.searchWorksByAPI(this.worksKey)
//   .then((work) => {
//     this.book.blurb = work.description.value;
//   })

// storeData({key, title, authors, cover, url, pages, identifiers, publishers, publish_date}) {
//       this.bookData = {
//         key,
//         publisher: publishers.shift(),
//         edition: {
//           isbn10: identifiers.isbn_10[0],
//           isbn13: identifiers.isbn_13[0],
//           goodreads: identifiers.goodreads[0] || null,
//           openlibrary: identifiers.openlibrary[0],
//           publish_date,
//           pages,
//           format: this.edition.format
//         },
//         authors,
//         book: {
//           title,
//           cover: cover.medium,
//           blurb: this.book.blurb,
//           url
//         }
//       }
//     },