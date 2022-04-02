<template>
    <div class="card" :id="id">
        <header>
            <slot name="header"></slot>
        </header>

        <slot></slot>

        <footer>
            <slot name="footer"></slot>
        </footer>
    </div>
</template>

<script>
export default {
  props: {
    id: String
  }
}
</script>

<style scoped>

</style>