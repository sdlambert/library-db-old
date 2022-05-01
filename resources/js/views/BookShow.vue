<template>
    <section id="book-show">
        <div class="row">
            <div class="col">
                <book-detail v-if="hasBookData" :book="book"></book-detail>
                <error-alert v-if="errors.length" id="book-detail-errors" :errors="errors"></error-alert>
            </div>
        </div>
    </section>
</template>

<script>
import BookDetail from "../components/BookDetail";
import ErrorAlert from "../components/ErrorAlert";

export default {
  name: "BookShow",
  components: {
    BookDetail,
    ErrorAlert
  },
  data() {
    return {
      book: {},
      errors: [],
      hasBookData: false
    }
  },
  methods: {
    async getBook() {
      this.hasBookData = false;
      return await fetch(`/api${this.$route.path}`)
        .then(response => response.json())
        .then(bookData => {
          this.book = bookData.data;
          this.hasBookData = true;
        })
    },
    handleError(errorMessage) {
      this.errors.push(errorMessage);
      console.error(errorMessage);
    }
  },
  mounted() {
    this.getBook(this.$route.params.id)
      .catch(err => {
        this.errors.push(err);
      });
  }
}
</script>

<style scoped>

</style>
