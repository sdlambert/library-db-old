<template>
    <div class="toast-wrap">
        <transition-group name="toast" tag="div" class="toast-container">
            <toast v-for="message in messages" :key="message.timestamp" :content="message.content" :cssClass="message.cssClass"></toast>
        </transition-group>
    </div>
</template>

<script>
import eventHub from "./eventHub";
import BaseToast from "./BaseToast";

export default {
  data() {
    return {
      messages: []
    }
  },
  methods: {
    addToast(content, cssClass, timestamp) {
      this.messages.unshift({
        content,
        cssClass,
        timestamp
      });
      window.setTimeout(this.removeToast, 5000);
    },
    removeToast() {
      this.messages.pop();
    }
  },
  created() {
    eventHub.$on('add-toast', this.addToast);
  },
  beforeDestroy () {
    eventHub.$off('add-toast', this.addToast);
  }
}
</script>

<style scoped lang="scss">
@import '../../sass/variables';

.toast-container {
  position: fixed;
  z-index: 10;
  top: 1.5rem;
  right: 1.5rem;
  display: flex;
  flex-direction: column;
}

.toast-enter,
.toast-leave-to {
  opacity: 0;
  transform: scaleY(0.01) translate(30px, 0);
}

.toast-enter-to,
.toast-leave {
  opacity: 1;
  transform: scaleY(1) translate(0,0);
}

.toast-enter-active, .toast-leave-active, .toast-move {
  transition: all 500ms ease-in-out;
}
</style>
