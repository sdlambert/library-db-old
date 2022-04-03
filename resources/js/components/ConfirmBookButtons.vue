<template>
    <div>
        <div class="button-wrap">
            <button type="button" class="button primary" @click.stop="saveAddMore">Save and Add More</button>
            <button type="button" class="button success" @click.stop="saveView">Save and View</button>
        </div>
        <error-alert v-if="errors.length" :errors="errors"></error-alert>
    </div>
</template>

<script>
import { scrollToId } from "../utils";
import { mapGetters } from "vuex";
import eventHub from "./eventHub";

export default {
  data () {
    return {
      errors: []
    }
  },
  methods: {
    saveAddMore() {
      this.errors = [];
      axios.post('/books', this.currentBook)
        .then(this.closeModal)
        .then(() => scrollToId('scan-card'))
        .catch(this.handleErrors);
    },
    saveView() {
      this.errors = [];
      axios.post('/books', this.currentBook)
        .then(this.redirectToBookView)
        .catch(this.handleErrors);
    },
    closeModal() {
      eventHub.$emit('onCloseModalClick', 'book-thumbnail-modal');
    },
    redirectToBookView(response) {
      location.href = `/books/${response.data.id}`
    },
    handleErrors(err) {
      if (err.response) {
        this.errors.push(err.response.data.message);
        for (const key in err.response.data.errors) {
          this.errors.push(...err.response.data.errors[key]);
        }
      } else if (err.request) {
        this.errors.push(err.request)
      } else {
        this.errors.push(err.message);
      }
    },
  },
  computed: {
    ...mapGetters('newOpenLibraryBook', [
      "currentBook"
    ]),
  },
}

</script>

<style scoped lang="scss">
  .button-wrap {
    display: flex;
    margin-bottom: 2rem;
  }
</style>