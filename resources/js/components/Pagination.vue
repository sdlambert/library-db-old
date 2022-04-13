<template>
    <div>
        <button :disabled="!links.prev" class="button" @click="fetchPrevious">Prev</button>
        <span>{{ meta.current_page }} of {{ meta.last_page }}</span>
        <button :disabled="!links.next" class="button" @click="fetchNext">Next</button>
    </div>
</template>

<script>
import eventHub from "./eventHub";

export default {
  props: {
    links: Object,
    meta: Object
  },
  methods: {
    fetchPrevious() {
      eventHub.$emit('paginate-previous', this.links.prev);
    },
    fetchNext() {
      eventHub.$emit('paginate-next', this.links.next);
    }
  }
}
</script>

<style scoped>

</style>