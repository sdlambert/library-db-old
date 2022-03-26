<template>
    <div id="book-container" class="row">
        <div class="col-12" v-show="bookData">
            <div class="card">
                <confirm-book-thumbnail v-bind:work="bookData"></confirm-book-thumbnail>
            </div>
        </div>
        <div class="col-12">
            <button @click="addBook" class="bg-success">Add Book</button>
        </div>
        <div class="col-12">
            <div id="alert-container" class="alert-error" v-show="errors.length">
                <p class="is-marginless" v-for="error in errors">{{ error }}</p>
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
          if(err.response) {
            this.errors.push(err.response.data.message);
            for(const key in err.response.data.errors) {
              this.errors.push(...err.response.data.errors[key]);
            }
          } else if ( err.request ) {
            this.errors.push(err.request)
          } else {
            this.errors.push(err.message);
          }
          scrollToId('alert-container');
        });
    },
    onSuccess(response) {
      location.href = `/books/${response.data.id}`
    }
  }
}
</script>

<style scoped lang="scss">
    #book-container .card {
      display: inline-block;
    }
</style>