<template>
    <div class="toast" >{{ content }}</div>
</template>

<script>

export default {
  props: {
    content: String,
  }
}
</script>

<style scoped lang="scss">
  @import '../../sass/variables';
  
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
</style>
