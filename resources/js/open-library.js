// utils
const isEmpty = require('lodash/isEmpty');
const path = require('path');

const OpenLibrary = function() {
  // Constants
  const openLibraryTLD = "https://openlibrary.org";
  const pathMap = {
    isbn: "/isbn/",
    edition: "/books/",
    work: "/works/",
    author: "/authors/"
  }

  /**
   * General purpose API call for all Open Library endpoints
   * https://openlibrary.org/dev/docs/api/books
   * @param     url     { string }
   * @returns   {Promise<any | void>}
   */
  async function callAPI(url) {
    return await fetch(url)
      .then(response => validateResponse(response))
      .then(response => response.json());
      // .catch is in callee!!
  }

  /**
   * Search OpenLibrary using the Book API
   *
   * @param     isbn     { Number }
   * @returns   { Promise<any | void> }
   */

  function searchByBookAPI(isbn) {
    if (!isbn) {
      throwInvalidValueError("isbn", isbn);
    }
    return callAPI(`${openLibraryTLD}/api/books?bibkeys=ISBN:${isbn}&jscmd=data&format=json`)
      .then(res => res[`ISBN:${isbn}`]);
  }


  /**
   * Search Open Library by type
   * https://openlibrary.org/dev/docs/api/books
   *
   * @param     identifier     { string }     i.e. "/works/OL53908W"
   * @param     type           { string }     i.e. "works"
   * @returns   { Promise<any | void> }
   */
  function searchByAPIType(identifier, type) {
    if (!identifier) {
      throwInvalidValueError(type, identifier);
    }
    return callAPI(`${openLibraryTLD}${pathMap[type]}${identifier}.json`);
  }

  /**
   * Returns a key given a fully qualified OpenLibrary URL
   * ex: "https://openlibrary.org/authors/OL34184A/Roald_Dahl",
   *     "https://openlibrary.org/books/OL27912393M/A_Game_of_Thrones"
   *
   * @param     url     { string }     URL string
   * @returns   { string }             i.e. "OL27912393M"
   */
  function getKeyFromURL(url) {
    return path.dirname(url).split('/').pop();
  }


  /**
   * Returns a key given an OpenLibrary URI
   * ex: "/works/OL22562623W"
   *
   * @param     uri     { string }     URI string
   * @returns   { string }             i.e. "OL22562623W"
   */
  function getKeyFromURI(uri) {
    return uri.split('/').pop();
  }

  /**
   * Confirms we have status ok
   *
   * @param     res     { Object }     JSON response
   * @returns   { Promise<{ok}|*> }
   */
  async function validateResponse(res) {
    if (!res.ok) {
      throw new Error(res.statusText);
    } else return res;
  }

  /**
   * Throws a special TypeError when an invalid value is provided to the function.
   * @param     apiMethod     { string }
   * @param     identifier    { string }
   */
  function throwInvalidValueError(apiMethod, identifier) {
    throw new TypeError(`Invalid value provided. Unable to perform ${apiMethod} API search using ${identifier}`);
  }

  return {
    searchByAPIType,
    searchByBookAPI,
    getKeyFromURL,
    getKeyFromURI
  };
};

export default OpenLibrary;
