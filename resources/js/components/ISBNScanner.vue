<template>
    <div class="isbn-scanner">
        <div id="qr-code-full-region"></div>
        <error-alert v-if="errors.length" id="isbn-scanner-errors" :errors="errors"></error-alert>
    </div>
</template>

<script>
import eventHub from './eventHub';
import { Html5QrcodeScanner } from "html5-qrcode";
import { isValidIsbnRegEx, scrollToId } from "../utils";

export default {
  props: {
    qrbox: {
      type: Number,
      default: 250
    },
    fps: {
      type: Number,
      default: 10
    }
  },
  data() {
    return {
      html5QrcodeScanner: {},
      errors: [],
      isbn: null,
      isLoading: false,
    }
  },
  mounted () {
    return this.initScanner();
  },
  methods: {
    initScanner() {
      const config = {
        fps: this.fps,
        qrbox: this.qrbox,
      };
      this.html5QrcodeScanner = new Html5QrcodeScanner('qr-code-full-region', config);
      this.html5QrcodeScanner.render(this.onScanSuccess);
    },
    throwError(errorMessage) {
      console.error(errorMessage)
      this.errors.push(errorMessage);
      this.$nextTick(() => {
        scrollToId('isbn-scanner-errors');
      })
    },
    clearErrors() {
      this.errors = [];
    },
    launchModal() {
      this.isLoading = false;
      eventHub.$emit('show-modal', 'book-thumbnail-modal');
    },
    onScanSuccess (decodedText, decodedResult) {
      if(!this.loading) {
        this.isLoading = true;
        if(isValidIsbnRegEx(decodedText)) {
          this.searchForISBN(decodedText);
        } else {
          this.isLoading = false;
          this.throwError(`Unable to validate ISBN: ${this.isbn}`);
        }
      }
    },
    searchForISBN(isbn) {
      this.clearErrors();
      console.info(`Detected valid ISBN: ${isbn}`);
      this.isbn = isbn;
      this.$store.dispatch('newOpenLibraryBook/searchForISBN', this.isbn)
        .then(this.launchModal)
        .catch(this.throwError);
    },
    scrollToScanner(elementId) {
      scrollToId('scan-card');
      this.isLoading = false;
      this.isbn = null;
    },
  },
  created() {
    eventHub.$on('modal-closed', this.scrollToScanner);
  },
  beforeDestroy () {
    eventHub.$off('modal-closed',  this.scrollToScanner);
  }
}
</script>

<style scoped lang="scss">
  .isbn-scanner {
    margin-bottom: 2rem;
  }
</style>
