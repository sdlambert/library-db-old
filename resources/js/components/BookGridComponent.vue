<template>
    <div class="book-grid" >
        <BookThumbnailComponent :work="book" v-for="book in books" :key="book.id"></BookThumbnailComponent>
    </div>
</template>

<script>
import BookThumbnailComponent from "./BookThumbnailComponent";

export default {
  components: {
    BookThumbnailComponent
  },
  props: {
    books: Array
  },
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
