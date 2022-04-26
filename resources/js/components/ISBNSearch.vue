<template>
    <div class="isbn-search-form">
        <ValidationObserver ref="form" tag="form" @submit.prevent="submitForm" v-slot="{ invalid }">
            <ValidationProvider rules="isbn" v-slot="{ classes, errors }">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" size="13" required
                       placeholder="ISBN10 or ISBN13"

                       :class="classes" v-model.trim="isbn" @input="clearErrors">
                <p v-show="errors.length" class="text-error">{{ errors[0] }}</p>
            </ValidationProvider>
            <button type="submit" id="isbn-search" :disabled="( invalid || isLoading )">Search</button>
        </ValidationObserver>
        <error-alert v-if="apiErrors.length" id="isbn-search-errors" :errors="apiErrors"></error-alert>
    </div>
</template>

<script>
// ISBN custom validation
// Validation
import { ValidationProvider, ValidationObserver } from 'vee-validate';
import { extend, configure } from 'vee-validate';
import { isbnStringToInt, isValidIsbnRegEx } from "../utils";
import eventHub from './eventHub';


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
  },
  data() {
    return {
      isbn: null,
      apiErrors: [],
      isLoading: false,
      targetId: 'book-thumbnail-modal'
    }
  },
  methods: {
    throwError(errorMessage) {
      this.apiErrors.push(errorMessage);
      console.error(errorMessage);
    },
    clearErrors() {
      this.apiErrors = [];
    },
    launchModal() {
      this.isLoading = false;
      eventHub.$emit('show-modal', this.targetId);
    },
    resetForm() {
      this.isbn = null;
      this.isLoading = false;
      this.$nextTick(() => {
        this.$refs.form.reset();
      });
    },
    resetFormFromModal(id) {
      if(id === this.targetId) {
        this.resetForm();
      }
    },
    async submitForm() {
      if(!this.isLoading) {
        if(this.normalizedIsbn(this.isbn)) {
          this.$store.dispatch('newOpenLibraryBook/searchForISBN', this.normalizedIsbn)
            .then( this.launchModal )
            .catch( this.throwError );
        } else {
          this.throwError("Unable to normalize ISBN.");
          this.isLoading = false;
        }
      }
    },
    normalizedIsbn (isbn) {
      return isbnStringToInt(isbn);
    },
  },
  created() {
    eventHub.$on('modal-closed', this.resetFormFromModal);
  },
  beforeDestroy () {
    eventHub.$off('modal-closed',  this.resetFormFromModal);
  }
}
</script>

<style scoped lang="scss">

  span, #isbn, #isbn-search {
    display: inline-block;
  }

  #isbn-search {
    margin-top: 24px;
  }

  form {
    display: flex;
    align-items: flex-start;
    margin-bottom: 2rem;
  }

  span {
    flex-grow: 1;
    margin-right: 20px;
  }
</style>
