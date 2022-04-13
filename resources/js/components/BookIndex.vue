<template>
    <section>
        <header>
            <!-- TODO title/author search -->
            <!-- TODO grid/table toggle search -->
        </header>
        <table id="book-index">
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
        <footer>
            <pagination></pagination>
            <error-alert v-if="errors.length" :errors="errors"></error-alert>
        </footer>
    </section>
</template>

<script>

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
      meta: {}
    }
  },
  methods: {
    throwError(errorMessage) {
      this.errors.push(errorMessage);
      console.error(errorMessage);
    },
    async fetchBooks() {
      return await fetch(booksIndexUrl)
        .then(response => response.json())
        .then(booksData => {
          this.books = booksData.data;
          this.links = booksData.links;
          this.meta = booksData.meta;
        });
    },

  },
  mounted() {
    this.fetchBooks()
      .catch(err => {
        this.errors.push(err);
      })
    ;
  }
}
</script>

<style scoped lang="scss">
@import 'resources/sass/variables';
@import 'resources/sass/mixins/media';

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