<template>
    <div class="book text-center">
        <header>
            <h3>{{ work.book.title }}</h3>
        </header>
        <img :src="work.book.cover" alt="" height="240" width="180">
        <p>By {{ this.fullNames }}</p>
        <a :href="work.book.url" target="_blank">OpenLibrary link</a>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: "ConfirmBookThumbnail",
  props: {
    work: Object
  },
  data() {
    return {

    }
  },
  computed: {
    ...mapGetters('newBook', [
      "authorFullNames"
    ]),
    fullNames() {
      let authors = [...new Set(this.authorFullNames)];
      let last = authors.pop();

      return authors.length > 0 ? authors.join(', ') + ' and ' + last : last;
    },
    alt() {
      return 'Cover for ' + this.work.book.title;
    },
    cover() {
      return this.work.book.cover || '/images/default-book.png';
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