<template>
    <div id="isbn-search-container" class="col-12" v-show="isSearchFormVisible">
        <div id="search-book-by-isbn" class="card">
            <isbn-scanner v-if="isScannerVisible"></isbn-scanner>
            <ValidationObserver tag="form" @submit.prevent="submitForm" v-slot="{ invalid }" class="row">
                <div class="col">
                    <div class="search-wrap">
                        <button id="scan-toggle" class="button" type="button" @click="toggleScanner" v-if="!isScannerVisible">Scan</button>
                        <button id="scan-cancel" class="button error" type="button" @click="toggleScanner" v-if="isScannerVisible">Cancel</button>
                        <ValidationProvider rules="isbn" v-slot="{ classes, errors }">
                            <label for="isbn">ISBN</label>
                            <input type="text" id="isbn" name="isbn" size="13" required
                                   placeholder="ISBN10 or ISBN13"

                                   :class="classes" v-model.trim="isbn" @input="clearErrors">
                            <p v-show="errors.length" class="text-error">{{ errors[0] }}</p>
                        </ValidationProvider>
                        <button type="submit" id="isbn-search" :disabled="( invalid || isLoading )">Search</button>
                        <button v-show="false">Scan Again</button>
                    </div>
                </div>
            </ValidationObserver>
            <div class="alert-error" v-show="errors.length" v-for="error in errors">
                <p>{{ error }}</p>
            </div>
        </div>
        <div id="confirm-book-container">
            <confirm-book-form-component v-if="isBookVisible" v-bind:bookData="this.currentBook"></confirm-book-form-component>
        </div>
    </div>

</template>

<script>
// Validation
import { ValidationProvider, ValidationObserver } from 'vee-validate';
import { extend, configure } from 'vee-validate';

// Misc.
import { scrollToId, isValidIsbnRegEx, isbnStringToInt } from "../utils";
import eventHub from './eventHub';
import { mapGetters } from 'vuex'

// Components
import ISBNScanner from "./ISBNScanner";

const upperFirst = require('lodash/upperFirst'),
      parseFullName = require('parse-full-name').parseFullName;

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
    ValidationObserver,
    ISBNScanner
  },
  data() {
    return {
      isbn: null,
      isSearchFormVisible: false,
      isScannerVisible: false,
      isBookVisible: false,
      isLoading: false,
      errors: [],
    }
  },
  methods: {
    async submitForm() {
      this.isLoading = true;
      this.errors = [];
      this.isBookVisible = false;
      this.isScannerVisible = false;

      if(this.normalizedIsbn) {
        this.$store.dispatch('newBook/searchForISBN', this.normalizedIsbn)
          .then( this.displayBook )
          .catch( this.throwError );
      } else {
        this.throwError("Unable to normalize ISBN.");
        this.isLoading = false;
      }
    },
    throwError(errorMessage) {
      this.errors.push(errorMessage);
      console.error(errorMessage);
    },
    clearErrors() {
      this.errors = [];
    },
    displayBook() {
      this.isLoading = false;
      this.isBookVisible = true;
    },
    async toggleSearchVisibility() {
      this.isSearchFormVisible = !this.isSearchFormVisible;
      if (this.isSearchFormVisible) {
        // wait until DOM is updated
        await this.$nextTick();
        scrollToId('isbn-search-container');
      }
    },
    onScan (decodedText, decodedResult) {
      this.isbn = decodedText;
      scrollToId('isbn-search-container');
    },
    toggleScanner () {
      this.isScannerVisible = !this.isScannerVisible;
      if(this.isScannerVisible) {
        scrollToId('isbn-search-container');
      }
    }
  },
  computed: {
    normalizedIsbn () {
      return isbnStringToInt(this.isbn);
    },
    ...mapGetters('newBook', [
      "currentBook"
    ])
  },
  created() {
    eventHub.$on('show-book-search', this.toggleSearchVisibility);
    eventHub.$on('result', this.onScan);
  },
  mounted() {

  },
  beforeDestroy () {
    eventHub.$off('show-book-search',  this.toggleSearchVisibility);
    eventHub.$off('result', this.onScan);
  }
}
</script>

<style lang="scss">
    #isbn-search {
      margin-top: 25px;
    }

    .search-wrap {
      display: flex;
      align-items: flex-start;
      flex-wrap: wrap;

      button, span {
        margin-right: 20px;
      }

      button {
        margin-top: 25px;
      }
    }

    #interactive {
      max-width: 100%;
      position: relative;

      video {
        width: 100% !important;
      }

      .drawingBuffer {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
      }
    }

</style>
