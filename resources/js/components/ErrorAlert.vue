<template>
    <div class="alert-error">
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
  }
}
</script>

<style scoped lang="scss">
  p {
    margin: 0;
  }
</style>
