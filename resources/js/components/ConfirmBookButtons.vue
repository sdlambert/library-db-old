<template>
    <div>
        <div class="button-wrap">
            <button type="button" class="button primary" @click.stop="saveAddMore">Save and Add More</button>
            <button type="button" class="button success" @click.stop="saveView">Save and View</button>
        </div>
        <error-alert v-if="errors.length" id="save-book-errors" :errors="errors"></error-alert>
    </div>
</template>

<script>
import { scrollToId } from "../utils";
import { mapGetters } from "vuex";
import eventHub from "./eventHub";
import upperFirst from 'lodash/upperFirst'

export default {
  data () {
    return {
      errors: []
    }
  },
  methods: {
    saveAddMore() {
      this.errors = [];
      axios.post('/api/books', this.currentBook)
        .then(this.confirmAdditions)
        .then(this.closeModal)
        .then(() => scrollToId('scan-card'))
        .catch(this.handleErrors);
    },
    saveView() {
      this.errors = [];
      axios.post('/api/books', this.currentBook)
        .then(this.redirectToBookView)
        .catch(this.handleErrors);
    },
    closeModal() {
      eventHub.$emit('close-modal-click', 'book-thumbnail-modal');
    },
    redirectToBookView(response) {
      location.href = `/books/${response.data.book.id}`
    },
    addNewRecordToast (recordType, cssClass = 'success') {
      eventHub.$emit('add-toast', `New ${recordType} added.`, cssClass, Date.now());
    },
    confirmAdditions(response) {
      let noNewAdditions;
      const recordTypes = ['book', 'edition', 'author', 'publisher'];

      recordTypes.forEach(recordType => {
        console.log(`isNew${upperFirst(recordType)}`, response.data[`isNew${upperFirst(recordType)}`]);
        if(response.data[`isNew${upperFirst(recordType)}`])
          this.addNewRecordToast(recordType);
      });

      noNewAdditions = recordTypes.every(recordType => {
        return response.data[`isNew${upperFirst(recordType)}`] === false;
      });

      if(noNewAdditions) {
        eventHub.$emit('add-toast', 'This volume already exists in the database.', 'error', Date.now());
      }
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
    ...mapGetters('openLibraryBook', [
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
