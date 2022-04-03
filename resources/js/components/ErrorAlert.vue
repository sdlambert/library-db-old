<template>
    <div id="alert-container" class="alert-error">
        <p v-for="error in errors">
            {{ error }}
        </p>
    </div>
</template>

<script>
import { scrollToId } from "../utils";

export default {
  props: {
    errors: Array
  },
  onMounted() {
    scrollToId('#alert-container')
  }
}
</script>

<style scoped lang="scss">
  p {
    margin: 0;
  }
</style>