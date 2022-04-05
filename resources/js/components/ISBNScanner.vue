<template>
    <div class="isbn-scanner">
        <div id="qr-code-full-region"></div>
        <error-alert v-if="errors.length" errors="errors"></error-alert>
    </div>
</template>

<script>
import eventHub from './eventHub';
import { Html5QrcodeScanner } from "html5-qrcode";
import {isbnStringToInt, scrollToId} from "../utils";

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
      this.errors.push(errorMessage);
      console.error(errorMessage);
      scrollToId('alert-container');
    },
    clearErrors() {
      this.errors = [];
    },
    launchModal() {
      eventHub.$emit('show-modal', 'book-thumbnail-modal');
    },
    onScanSuccess (decodedText, decodedResult) {
      this.isbn = decodedText;
      if(this.normalizedIsbn) {
        this.$store.dispatch('newOpenLibraryBook/searchForISBN', this.normalizedIsbn)
          .then( this.launchModal )
          .catch( this.throwError );
      } else {
        this.throwError(`Unable to normalize ISBN: ${this.isbn} -> ${this.normalizedIsbn}`);
      }
    },
    scrollToScanner() {
      scrollToId('scan-card');
    }
  },
  computed: {
    normalizedIsbn () {
      return isbnStringToInt(this.isbn);
    },
  },
  created() {
    eventHub.$on('onCloseModalClick', this.scrollToScanner);
  },
  beforeDestroy () {
    eventHub.$off('onCloseModalClick',  this.scrollToScanner);
  }
}
</script>

<style scoped lang="scss">
  .isbn-scanner {
    margin-bottom: 2rem;
  }
</style>