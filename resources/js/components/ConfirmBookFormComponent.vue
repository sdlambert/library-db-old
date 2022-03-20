<template>
    <div id="book-container" class="row">
        <div class="col-12" v-show="bookData">
            <div class="card">
                <book v-bind:work="bookData"></book>
            </div>
            <br>
            <button @click="addBook" class="bg-success">Add Book</button>
            <div class="alert-error" v-show="errors.length">
                <p>{{ error }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import {scrollToId} from "../utils";

export default {
  name: "ConfirmBookComponent",
  props: {
    bookData: Object
  },
  data() {
    return {
      errors: []
    }
  },
  async mounted() {
    // wait until DOM is updated
    await this.$nextTick();
    scrollToId('book-container');
  },
  methods: {
    addBook() {
      this.errors = [];
      axios.post('/books', this.bookData)
        .then(this.onSuccess)
        .catch(err => {
          this.errors.push(err.message);
        });
    },
    onSuccess(book) {
      console.log(book);
      //window.href.location = `/books/${book.id}`
    }
  }
}
</script>

<style scoped lang="scss">
    #book-container .card {
      display: inline-block;
    }
</style>