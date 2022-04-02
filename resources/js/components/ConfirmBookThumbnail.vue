<template>
    <div class="book text-center">
        <header>
            <h3>{{ currentBook.book.title }}</h3>
        </header>
        <img :src="cover" :alt="alt">
        <p>By {{ this.fullNames }}</p>
        <a :href="currentBook.book.url" target="_blank">OpenLibrary link</a>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: "ConfirmBookThumbnail",
  data() {
    return {
    }
  },
  computed: {
    ...mapGetters('newOpenLibraryBook', [
      "authorFullNames",
      "currentBook"
    ]),
    fullNames() {
      let authors = [...new Set(this.authorFullNames)];
      let last = authors.pop();

      return authors.length > 0 ? authors.join(', ') + ' and ' + last : last;
    },
    alt() {
      return 'Cover for ' + this.currentBook.book.title;
    },
    cover() {
      return this.currentBook.book.cover || '/images/default-book.png';
    }
  }
}
</script>

<style scoped lang="scss">
    @import '../../sass/variables';
    img {
        background-color: $lighter-gray;
    }
    .book img {
      width: 180px;
      height: 240px;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
    }
</style>