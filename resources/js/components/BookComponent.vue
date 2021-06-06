<template>
    <div class="book text-center">
        <header>
            <h3>{{ work.book.title }}</h3>
        </header>
        <img :src="work.book.cover" alt="" height="240" width="180">
        <p>By {{ fullNames() }}</p>
        <a :href="work.book.url">OpenLibrary link</a>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: "Book",
  props: {
    work: Object
  },
  data() {
    return {

    }
  },
  methods: {
    fullNames() {
      let authors = this.authorFullNames;
      let last = authors.pop();

      return authors.length > 0 ? authors.join(',') + ' and ' + last : last;
    }
  },
  computed: {
    ...mapGetters('newBook', [
      "authorFullNames"
    ])
  }
}
</script>

<style scoped lang="scss">
    @import '../../sass/variables';
    img {
        background-color: $lighter-gray;
    }
</style>