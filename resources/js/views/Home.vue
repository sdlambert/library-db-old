<template>
    <section id="home">
        <div class="row">
            <div class="col">
                <h2>Recent Additions</h2>
                <book-grid :books="recentBooks"></book-grid>
                <error-alert v-if="errors.length" id="pagination-errors" :errors="errors"></error-alert>
            </div>
        </div>
    </section>
</template>

<script>

import BookGrid from "../components/BookGrid";
import ErrorAlert from "../components/ErrorAlert";

export default {
  components: {
    BookGrid,
    ErrorAlert,
  },
  data() {
    return {
      recentBooks: [],
      path: '/api/books/latest',
      errors: []
    }
  },
  methods: {
    async getRecentBooks() {
      return await fetch(this.path)
        .then(response => response.json())
        .then(booksData => {
          this.recentBooks = booksData.data;
        })
    },
    handleError(errorMessage) {
      this.errors.push(errorMessage);
      console.error(errorMessage);
    }
  },
  mounted() {
    this.getRecentBooks()
      .catch(err => {
        this.errors.push(err);
      });
  }
}
</script>

<style scoped>

</style>
