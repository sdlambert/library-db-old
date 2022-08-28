<template>
    <section id="book-index">
        <div class="row">
            <div class="col">
                <router-link to="/books/create" class="button primary">Add a Book</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>All Books</h3>
                <book-index></book-index>
            </div>
        </div>
    </section>
</template>

<script>
export default {
  name: "Books",
}
</script>

<style scoped>

</style>
