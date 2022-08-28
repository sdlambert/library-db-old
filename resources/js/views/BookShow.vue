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
  beforeRouteEnter: (to, from, next) => {
    fetch(`/api/books/${to.params.id}`)
      .then(response => response.json())
      .then(bookData => {
        if(!Array.isArray(bookData.data)) { // empty array is
          next(vm => vm.setBook(bookData.data));
        } else {
          next({ name: '404', params: [ to.path ], replace: true })
        }
      })
      .catch(err => {
        console.error(err);
      });
  },
  components: {
    BookDetail,
    ErrorAlert
  },
  data() {
    return {
      previous: {},
      book: {},
      errors: [],
      hasBookData: false
    }
  },
  methods: {
    setBook(book) {
      this.book = book;
      this.hasBookData = true;
    },
    handleError(errorMessage) {
      this.errors.push(errorMessage);
      console.error(errorMessage);
    }
  },
}
</script>

<style scoped>

</style>
