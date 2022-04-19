<template>
    <div class="toast-container">
        <p class="toast" v-for="message in messages">{{ message }}</p>
    </div>
</template>

<script>
export default {
  data() {
    return {
      messages: []
    }
  },
  methods: {
    addToast(message) {
      this.messages.push(message);
    }
  },

}
</script>

<style scoped lang="scss">
@import '../../sass/variables';

  .toast-container {
    position: static;
    bottom: 1.5rem;
    left: 1.5rem;
  }

  .toast {
    line-height: 1;
    background-color: $slate-blue;
    color: $white;
    animation: toastIt 3000ms cubic-bezier(.18,.05,.35,.88) forwards;

    &.success {
      background-color: var(--color-success);
      color: $white;
    }
  }

  @keyframes toastIt {
    0%, 100% {
      transform: translateY(-150%);
      opacity: 0;
    }
    10%, 90% {
      transform: translateY(0);
      opacity: 1;
    }
  }
</style>
