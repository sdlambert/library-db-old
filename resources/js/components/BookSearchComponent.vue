<template>
    <div id="isbn-search-container" class="card col-12" v-show="visible">
        <div id="search-book-by-isbn" class="row">
            <div class="col-12">
                <ValidationObserver v-slot="{ invalid }">
                    <form class="row" @submit.prevent="submitForm">
                        <div class="col-8">
                            <ValidationProvider rules="isbn" v-slot="{ classes, errors }">
                                <label for="isbn">ISBN</label>
                                <input type="text" id="isbn" name="isbn" required
                                       placeholder="ISBN10 or ISBN13"
                                       :class="classes" v-model="isbn">
                                <p class="text-error">{{ errors[0] }}</p>
                            </ValidationProvider>
                        </div>
                        <div class="col-4">
                            <button type="submit" id="isbn-search" :disabled="invalid">Search</button>
                        </div>
                    </form>
                </ValidationObserver>
            </div>
            <div class="col-12" v-if="alertErrorMessage">
                <div class="alert-error">
                    <p>{{ alertErrorMessage }}</p>
                </div>
            </div>
            <div class="col-3" v-show="bookVisible">
                <book v-bind:book-data="bookData"></book>
            </div>
        </div>
    </div>
</template>

<script>
const isEmpty = require('lodash/isEmpty');

// Validation
import { ValidationProvider, ValidationObserver } from 'vee-validate';
import { extend, configure } from 'vee-validate';

// Misc.
import { scrollToId, isValidIsbnRegEx } from "../utils";
import { OpenLibrary } from "../open-library";
import eventHub from './eventHub';


// ISBN custom validation
extend('isbn', {
  validate: value => {
    return isValidIsbnRegEx(value)
  },
  message: "The value must be a valid ISBN10 or ISBN13."
});

// Required validation
extend('required', {
  validate(value) {
    return {
      required: true,
      valid: ['', null, undefined].indexOf(value) === -1
    };
  },
  computesRequired: true,
  message: "You must enter a value for the ISBN."
});


// Class bindings for validation states
configure({
  classes: {
    passed: 'success',
    failed: 'error',
  }
})


export default {
  components: {
    ValidationProvider,
    ValidationObserver
  },
  methods: {
    submitForm() {
      OpenLibrary.searchBookByISBN(this.isbn)
        .then(res => {
          if(!isEmpty(res))
            return res
          else
            throw new Error(`Unable to retrieve data for the ISBN ${this.isbn} from the OpenLibrary API.`);
        })
        .then(this.displayBook)
        .catch(this.handleSearchError);
    },
    displayBook({title, authors, cover, url}) {
      this.bookData = {
        title,
        by: authors[0].name,
        cover: cover.medium,
        url
      }
      this.bookVisible = true;
    },
    handleSearchError(err) {
      this.alertErrorMessage = err;
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
      bookVisible: false,
      alertErrorMessage: null
    }
  },
  created: function() {
    eventHub.$on('show-book-search', this.toggleVisibility)
  },
  beforeDestroy: function () {
    eventHub.$off('show-book-search',  this.toggleVisibility)
  }
}
</script>

<style scoped>
    #isbn-search {
        margin-top: 25px;
    }
</style>
