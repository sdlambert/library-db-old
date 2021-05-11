const booksUrl = "https://openlibrary.org/api/books";

export class OpenLibrary {

  constructor() {
    //
  }

  /**
   * Fetches JSON from the Open Library API using the isbn
   * @param isbn { Number }
   * @returns {Promise<any | void>}
   */
  static searchBookByISBN(isbn) {
    return fetch(`${booksUrl}?bibkeys=ISBN:${isbn}&jscmd=data&format=json`)
      .then( response => response.json() )
      .then ( obj => obj[`ISBN:${isbn}`] )
      .catch( err => console.error(err) );
  }
}