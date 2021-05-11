<template>
    <button @click="showHide">
        <slot></slot>
    </button>
</template>

<script>
import eventHub from '../eventHub';

export default {
  props: {
    toggleEvent: String
  },
  methods: {
    showHide() {
      eventHub.$emit(this.toggleEvent);
    }
  }
}
</script>

<style scoped>

</style>