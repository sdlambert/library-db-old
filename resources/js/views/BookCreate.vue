<template>
    <section id="book-create">
        <div class="row">
            <div class="col">
                <router-link to="/books" class="button primary">View All Books</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <header>
                    <h2>Quick Add</h2>
                </header>
                <card id="scan-card">
                    <template v-slot:header>
                        <h4 class="text-center">Scan</h4>
                    </template>
                    <isbn-scanner></isbn-scanner>
                </card>
                <p class="text-center">-OR-</p>

                <card id="search-card">
                    <template v-slot:header>
                        <h4 class="text-center">Search</h4>
                    </template>
                    <isbn-search></isbn-search>
                </card>
            </div>
        </div>
        <modal id="book-thumbnail-modal" v-cloak>
            <template v-slot:header>
                <h4>Search Results</h4>
            </template>

            <confirm-book-thumbnail></confirm-book-thumbnail>

            <template v-slot:footer>
                <confirm-book-buttons></confirm-book-buttons>
            </template>
        </modal>
    </section>
</template>

<script>
export default {
  name: "BookCreate.vue"
}
</script>

<style scoped>

</style>
