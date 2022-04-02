<template>
    <div class="backdrop">
        <div class="loader"></div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      isLoading: false
    }
  }
}
</script>

<style scoped lang="scss">
  .backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10;
  }
</style>