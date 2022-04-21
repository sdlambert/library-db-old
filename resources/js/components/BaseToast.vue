<template>
    <div class="toast-wrap">
        <button @click="addToast">Add Toast</button>
        <transition-group name="toast" tag="div" class="toast-container">
            <p class="toast" v-for="(message, index) in messages" :key="message">{{ message }} {{ index }}</p>
        </transition-group>
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
      console.log("toast!");
      this.messages.push("toast");
      window.setTimeout(this.removeToast, 3000);
    },
    removeToast() {
      this.messages.pop();
    }
  },

}
</script>

<style scoped lang="scss">
@import '../../sass/variables';


  .toast-container {
    position: fixed;
    top: 1.5rem;
    right: 1.5rem;
    display: flex;
    flex-direction: column-reverse;
  }

  .toast {
    padding: 30px;
    display: block;
    line-height: 1;
    background-color: $slate-blue;
    color: $white;
    transition: all 1.5ms ease-in-out;


    &.success {
      background-color: var(--color-success);
      color: $white;
    }
  }

  .toast-list-move {
    transition: transform 1s;
  }

  .toast-enter,
  .toast-leave-to {
    opacity: 0;
    transform: scaleY(0.01) translate(30px, 0);
  }

  /* ensure leaving items are taken out of layout flow so that moving
     animations can be calculated correctly. */
  .toast-complete-leave-active {
    position: absolute;
  }
</style>
