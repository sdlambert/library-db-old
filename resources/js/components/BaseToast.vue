<template>
    <div class="toast-wrap">
        <transition-group name="toast" tag="div" class="toast-container">
            <div class="toast" v-for="(message, index) in messages" :key="message.timestamp">{{ message.content }}</div>
        </transition-group>
    </div>
</template>

<script>
import eventHub from "./eventHub";

export default {
  data() {
    return {
      messages: []
    }
  },
  methods: {
    addToast(message) {
      this.messages.unshift({
        content: `${message}`,
        timestamp: Date.now()
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
    top: 1.5rem;
    right: 1.5rem;
    display: flex;
    flex-direction: column;
  }

  .toast {
    padding: .5rem 1rem;
    display: block;
    line-height: 1;
    background-color: $slate-blue;
    color: $white;
    margin-bottom: 1rem;

    &.success {
      background-color: var(--color-success);
      color: $white;
    }
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
