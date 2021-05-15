<template>
    <div class="card">
        <header>
            <h3>{{ bookData.title }}</h3>
        </header>
        <img :src="bookData.cover" alt="" height="240" width="180">
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
    img {
        background-color: $
    }
</style>