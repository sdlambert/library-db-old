<template>
    <div id="book-container" class="row">
        <div class="col-12" v-show="bookData">
            <div class="card">
                <book v-bind:work="bookData"></book>
            </div>
            <br>
            <button @click="addBook" class="bg-success">Add Book</button>
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
  async mounted() {
    // wait until DOM is updated
    await this.$nextTick();
    scrollToId('book-container');
  },
  methods: {
    addBook() {
      axios.post('/books', this.bookData);
    }
  }
}
</script>

<style scoped lang="scss">
    #book-container .card {
      display: inline-block;
    }
</style>