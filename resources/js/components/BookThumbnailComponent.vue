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
@import '../../sass/mixins/media';

.book {
  position: relative;
  flex: 0 0 50%;
  display: flex;
  flex-direction: column;
  margin: 0 0 4rem;
  padding: 0 2rem;

  img {
    width: 100%;
    max-width: 180px;
    height: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 1rem;
  }

  p {
    margin-top: auto;
  }

  p, h4 {
    margin-bottom: 0;
  }

  @include media($medium-screen) {
    flex: 0 0 33.33333%;
  }

  @include media($large-screen) {
    flex: 0 0 25%;
  }
}
</style>