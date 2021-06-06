<template>
    <div id="isbn-search-container" class="col-12" v-show="isSearchFormVisible">
        <div id="search-book-by-isbn" class="card">
            <ValidationObserver tag="form" @submit.prevent="submitForm" v-slot="{ invalid }" class="row">
                <div class="col">
                    <ValidationProvider rules="isbn" v-slot="{ classes, errors }">
                        <label for="isbn">ISBN</label>
                        <input type="text" id="isbn" name="isbn" required
                               placeholder="ISBN10 or ISBN13"

                               :class="classes" v-model.trim="isbn">
                        <p v-show="errors.length" class="text-error">{{ errors[0] }}</p>
                    </ValidationProvider>
                </div>
                <div class="col">
                    <button type="submit" id="isbn-search" :disabled="( invalid || isLoading )">Search</button>
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
    ValidationObserver
  },
  data() {
    return {
      isbn: null,
      isSearchFormVisible: false,
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
  },
  beforeDestroy () {
    eventHub.$off('show-book-search',  this.toggleSearchVisibility);
  }
}
</script>

<style scoped>
    #isbn-search {
        margin-top: 25px;
    }
</style>
