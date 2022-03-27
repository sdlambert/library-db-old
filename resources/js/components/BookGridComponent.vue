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

<style lang="scss">
@import '../../sass/variables';
@import '../../sass/mixins/media';

.book-grid {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  margin: 0 -20px;

  @include media($small-screen) {
    justify-content: flex-start;
  }
}
</style>
