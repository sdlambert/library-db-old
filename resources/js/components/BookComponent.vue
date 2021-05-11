<template>
    <div class="card">
        <header>{{ bookData.title }}</header>
        <img :src="bookData.cover" alt="">
        <p>{{ bookData.by }}</p>
        <a :href="bookData.url">OpenLibrary link</a>
    </div>
</template>

<script>
export default {
  name: "Book",
  props: {
    bookData: Object
  },
  data() {
    return {

    }
  }
}
</script>

<style scoped>

</style>