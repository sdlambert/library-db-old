<template>
    <div class="pagination-wrap">
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

<style scoped lang="scss">
  .pagination-wrap {
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    max-width: 60rem;
    margin: 0 auto;
  }
</style>
