<template>
    <div id="qr-code-full-region"></div>
</template>

<script>
import eventHub from './eventHub';
import { Html5QrcodeScanner } from "html5-qrcode";

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
      html5QrcodeScanner: {}
    }
  },
  mounted () {
    return this.initScanner();
  },
  methods: {
    onScanSuccess (decodedText, decodedResult) {
      eventHub.$emit('result', decodedText, decodedResult);
      this.html5QrcodeScanner.clear();
    },
    initScanner() {
      const config = {
        fps: this.fps,
        qrbox: this.qrbox,
      };
      this.html5QrcodeScanner = new Html5QrcodeScanner('qr-code-full-region', config);
      this.html5QrcodeScanner.render(this.onScanSuccess);
    }
  }
}
</script>

<style scoped>

</style>