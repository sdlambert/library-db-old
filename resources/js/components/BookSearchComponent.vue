<template>
    <div id="isbn-search-container" class="card col-12" v-show="visible">
        <div id="search-book-by-isbn" class="row">
            <header class="col-12">
                <h4>Search by ISBN</h4>
            </header>
            <div class="col-8">
                <input class="no-increment" type="number" id="isbn-query" name="isbn-search" v-model="isbn"
                       placeholder="ISBN10 or ISBN13, no spaces or dashes"
                       pattern="\d{10}|\d{13}"
                       data-bouncer-message="The ISBN must contain exactly 10 or 13 digits.">
            </div>
            <div class="col-4">
                <button id="search-button" @click="searchBook">Search</button>
            </div>
            <div class="col-3" v-show="bookVisible">
                <book v-bind:book-data="bookData"></book>
            </div>
        </div>
    </div>
</template>

<script>
import {scrollToId} from "../utils";
import { OpenLibrary } from "../open-library";
import eventHub from './eventHub';

export default {
  methods: {
    searchBook() {
      OpenLibrary.searchBookByISBN(this.isbn)
        .then(this.displayBook, this.handleSearchError);
    },
    displayBook({title, by_statement, cover, url}) {
      this.bookData = {
        title,
        by: by_statement,
        cover: cover.medium,
        url
      }
      this.bookVisible = true;
    },
    handleSearchError(err) {
      console.error(err);
    },
    toggleVisibility() {
      this.visible = !this.visible;
      if(this.visible) {
        // wait until DOM is updated
        this.$nextTick(function() {
          scrollToId('isbn-search-container')
        });
      }
    }
  },
  data() {
    return {
      isbn: null,
      visible: false,
      bookData: {},
      bookVisible: false
    }
  },
  created: function() {
    eventHub.$on('show-book-search', this.toggleVisibility)
  },
  beforeDestroy: function () {
    eventHub.$off('show-book-search',  this.toggleVisibility)
  },
}
</script>
