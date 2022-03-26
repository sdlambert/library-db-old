<template>
    <div class="book text-center">
        <img :src="cover" :alt="alt">
        <p>By {{ this.fullNameList }}</p>
        <h4>{{ work.title }}</h4>
        <a :href="'/books/' + work.id" class="breakout"></a>
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
    authorFullNames() {
      let authors = this.work.authors;
      return authors.map((author) => {
        return `${author.first_name} ${author.last_name}`;
      });
    },
    fullNameList() {
      let authors = [...new Set(this.authorFullNames)];
      let last = authors.pop();

      return authors.length > 0 ? authors.join(', ') + ' and ' + last : last;
    },
    alt() {
      return 'Cover for ' + this.work.title;
    },
    cover() {
      return this.work.cover || '/images/default-book.png';
    }
  }
}
</script>

<style scoped lang="scss">
    @import '../../sass/variables';


</style>