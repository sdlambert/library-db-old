<template>
    <div class="pagination-wrap">
        <router-link :to="relativePath(links.prev)" tag="button" :disabled="!links.prev" class="button">Prev</router-link>
        <span>{{ meta.current_page }} of {{ meta.last_page }}</span>
        <router-link :to="relativePath(links.next)" tag="button" :disabled="!links.next" class="button">Next</router-link>
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
    relativePath(url) {
      if (url !== null) {
        let urlObject = new URL(url);
        return urlObject.pathname.replace('/api', '') + urlObject.search;
      } else
        return {}
    },
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
