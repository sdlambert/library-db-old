<template>
    <div class="col-12">
        <div id="book-title">
            <h2>{{ book.title }}</h2>
            <div id="icon-links" class=" text-center">
                <a :href="goodreads" class="icon" target="_blank">
                    <img src="/images/icons/goodreads_sm.png" alt="Goodreads icon">
                </a>
                <a :href="openLibrary" class="icon icon-shadow" target="_blank">
                    <img src="/images/icons/open-library-logo.png" alt="Open Libary icon">
                </a>
            </div>
        </div>
        <div id="book-detail">
            <div id="book">
                <img :src="book.cover" :alt="alt">

            </div>
            <div id="book-meta">
                <div id="authors">
                    <h3>Author<span v-if="book.authors.length > 1">s</span></h3>
                    <div class="author-details" v-for="(author, index) in book.authors" :key="author.id">
                        <hr v-if="index >= 1">
                        <dl>
                            <div>
                                <dt>Name</dt>
                                <dd>{{ author.last_name }}, {{ author.first_name }}</dd>
                            </div>
                            <div v-if="author.pseudonym">
                                <dt>Pseudonym(s):</dt>
                                <dd>{{ author.pseudonym }}</dd>
                            </div>
                            <div v-if="author.birth_date">
                                <dt>Date of birth</dt>
                                <dd>{{ author.birth_date }}</dd>
                            </div>
                            <div v-if="author.death_date">
                                <dt>Date of death</dt>
                                <dd>{{ author.death_date }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div id="editions">
                    <h3>Edition<span v-if="book.editions.length > 1">s</span></h3>
                    <div v-for="(edition, index) in book.editions">
                        <hr v-if="index > 1">
                        <dl>
                            <div>
                                <dt>Format</dt>
                                <dd>{{ edition.format_description }}</dd>
                            </div>

                            <div v-if="edition.isbn10">
                                <dt>ISBN10</dt>
                                <dd>{{ edition.isbn10 }}</dd>
                            </div>

                            <div v-if="edition.isbn13">
                                <dt>ISBN13</dt>
                                <dd>{{ edition.isbn13 }}</dd>
                            </div>

                            <div v-if="edition.publish_date">
                                <dt>Published</dt>
                                <dd>{{ edition.publish_date }}</dd>
                            </div>

                            <div v-if="edition.pages">
                                <dt>Pages</dt>
                                <dd>{{ edition.pages }}</dd>
                            </div>

                            <div v-if="edition.publisher.name">
                                <dt>Publisher</dt>
                                <dd>{{ edition.publisher.name }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <div id="book-blurb">
            <p>{{ book.blurb }}</p>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    book: Object
  },
  mounted() {
    console.log(this.book);
  },
  computed: {
    alt() {
      return `The cover image for ${this.book.title}`;
    },
    isbn() {
      return this.book.editions[0].isbn13 || this.book.editions[0].isbn10;
    },
    goodreads() {
      return `https://www.goodreads.com` + (this.book.editions[0].goodreads ? `/book/show/${this.book.editions[0].goodreads}` : `/search?q=${this.isbn}`);
    },
    openLibrary() {
      return `https://www.openlibrary.org/books/${this.book.editions[0].openlibrary}`;
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../sass/variables';
@import '../../sass/mixins/media';

h2, h3 {
  margin: 0;
}

#book, #book-title, #book-meta, #authors, #editions {
  display: flex;
  flex-direction: column;
  margin-bottom: 2rem;
}

#book-title {
  text-align: center;
  margin-bottom: 1rem;

  @include media($small-screen) {
    flex-direction: row;
    justify-content: space-between;
    text-align: left;
  }
}

#icon-links {
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon {
  margin-right: 10px;
  height: 32px;
}

.icon-shadow {
  box-shadow: 0 1px 1px rgba(0,0,0,0.3);
}

#book-detail {
  display: flex;
  flex-direction: column;

  @include media($small-screen) {
    flex-direction: row;
  }
}

#book {
  align-items: center;

  img {
    margin-bottom: 2rem;
  }

  @include media($small-screen) {
    flex: 0 0 200px;
    align-items: flex-start;
    margin-right: 2rem;
  }
}

#book-meta {
  @include media($medium-screen) {
    flex-direction: row;
    flex-basis: 100%;

    #authors, #editions {
      width: calc(50% - 2rem);
      max-width: 30rem;
    }

    #authors {
      margin-right: 4rem;
    }

  }
}

  dl {
    display: flex;
    flex-direction: column;
    margin: 0;

    > div {
      display: flex;
    }

    dt {
      flex-basis: 100px;
    }

    @include media($medium-screen) {
      > div {
        justify-content: space-between;
      }
      dd {
        margin: 0;
        text-align: right;
      }
    }
  }

  .links {
    display: flex;
    justify-content: center;
    align-items: center;

    @include media($large-screen) {
      justify-content: flex-end;
    }
  }



</style>