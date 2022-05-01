<template>
    <section>
        <header>
            <!-- TODO title/author search -->
            <!-- TODO grid/table toggle search -->
        </header>
        <table id="book-index" v-if="showTable">
            <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Author</th>
                <th>Format</th>
                <th>Publisher</th>
            </tr>
            </thead>
            <tbody>
                <book-row v-for="book in books" :work="book" :key="book.id"></book-row>
            </tbody>
        </table>
        <book-grid v-if="showGrid" :books="books"></book-grid>
        <footer>
            <pagination v-if="hasFetchedBooks" :links="links" :meta="meta"></pagination>
            <error-alert v-if="errors.length" id="pagination-errors" :errors="errors"></error-alert>
        </footer>
    </section>
</template>

<script>

import eventHub from "./eventHub";

const booksIndexUrl = '/api/books';

export default {
  props: {
  },
  data() {
    return {
      perPage: null,
      errors: [],
      books: [],
      links: {},
      meta: {},
      showGrid: false,
      showTable: true,
      hasFetchedBooks: false
    }
  },
  methods: {
    throwError(errorMessage) {
      this.errors.push(errorMessage);
      console.error(errorMessage);
    },
    async fetchBooks() {
      this.hasFetchedBooks = false;
      return await fetch('/api/books' + window.location.search)
        .then(response => response.json())
        .then(booksData => {
          this.books = booksData.data;
          this.links = booksData.links;
          this.meta = booksData.meta;
          this.hasFetchedBooks = true;
        });
    },

  },
  mounted() {
    this.fetchBooks()
      .catch(err => {
        this.errors.push(err);
      });
  }
}
</script>

<style scoped lang="scss">
@import 'resources/sass/variables';
@import 'resources/sass/mixins/media';

table {
  margin-bottom: 2.5rem;
}

th {
  padding: 0 10px 20px;

  &:nth-child(n+2) {
    padding: 1rem 2rem;
  }

  &:nth-child(n+4) {
    display: none;
    @include media($medium-screen) {
      display: table-cell;
    }
  }
}
</style>
