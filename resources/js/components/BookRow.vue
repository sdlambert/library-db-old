<template>
    <tr @click="nagivateToBook(work.id)">
        <td class="cover">
            <img :src="cover" :alt="alt">
            <div class="view-icon">
                <svg class="icon white"><use xlink:href="#icon-search"></use></svg>
                <a :href="'/books/' + work.id" class="breakout"></a>
            </div>
        </td>
        <td class="title">
            {{ work.title }}
        </td>
        <td class="author">
            <span v-for="(name, index) in fullNames">
                {{ name }}<br v-if="index < fullNames.length">
            </span>
        </td>
        <td>
            <span v-for="(format, index) in formatDescriptions">
                {{ format }}<br v-if="index < formatDescriptions.length">
            </span>
        </td>
        <td>
            <span v-for="(name, index) in publisherNames">
                {{ name }}<br v-if="index < publisherNames.length">
            </span>
        </td>
    </tr>
</template>

<script>
export default {
  props: {
    work: Object
  },
  methods: {
    nagivateToBook() {

    }
  },
  computed: {
    fullNames() {
      let authors = this.work.authors.map(author => {
        return `${author.first_name} ${author.last_name}`;
      });

      return [...new Set(authors)];
    },
    alt() {
      return 'Cover for ' + this.work.title;
    },
    cover() {
      return this.work.cover || '/images/default-book.png';
    },
    formatDescriptions() {
      return this.work.editions.map(edition => {
        return `${edition.format_description}`
      })
    },
    publisherNames() {
      return this.work.editions.map(edition => {
        return `${edition.publisher.name}`
      })
    }
  },
}
</script>

<style scoped lang="scss">
@import 'resources/sass/variables';
@import 'resources/sass/mixins/media';

tr {
  &:hover, &:focus {
    background-color: $almost-white;
  }
}

td {
  padding: 1rem 0;
  vertical-align: top;

  &:nth-child(n+2) {
    padding: 1rem 2rem;
  }

  &:nth-child(n+4) {
    display: none;

    @include media($medium-screen) {
      display: table-cell;
    }
  }
}

.button-row {
  display: flex;
  flex-direction: column;

  button {
    margin: 0;
    padding: .5rem 1rem;
  }

  @include media($small-screen) {
    flex-direction: row;

  }
}
.author {
  max-width: 200px;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.cover {
  position: relative;
  min-width: 40px;
  max-width: 60px;

  .view-icon {
    position: absolute;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.4;
    height: 100%;
    width: 100%;
    top: 0;

    svg {
      flex: 0 0 50%;
    }
  }
}
</style>
