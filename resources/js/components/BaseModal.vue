<template>
    <div class="modal-backdrop" v-if="isModalVisible" @click.self="close">
        <div class="modal" :id="id">
            <header>
                <slot name="header"></slot>
                <button type="button" id="modal-close-button" class="btn-close" @click.stop="close">
                    &times;
                </button>
            </header>

            <slot></slot>

            <footer>
                <slot name="footer"></slot>
            </footer>
        </div>
    </div>
</template>

<script>
import eventHub from './eventHub';

export default {
  props: {
    id: String
  },
  data() {
    return {
      isModalVisible: false
    }
  },
  methods: {
    closeModalById(modalId) {
      // if we have an id string, it's from outside the modal, otherwise close this modal
      if(this.id === modalId) {
        this.isModalVisible = false;
        eventHub.$emit('modal-closed', this.id);
      }
    },
    close() {
      this.isModalVisible = false;
      eventHub.$emit('modal-closed', this.id);
    },
    show(id) {
      if(this.id === id) {
        this.isModalVisible = true;
      }
    }
  },
  created() {
    eventHub.$on('show-modal', this.show);
    eventHub.$on('close-modal-click', this.closeModalById);
  },
  beforeDestroy () {
    eventHub.$off('show-modal',  this.close);
    eventHub.$off('close-modal-click', this.closeModalById);
  }
}
</script>

<style scoped lang="scss">
  @import '../../sass/variables';
  @import '../../sass/mixins/media';

  .modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9;
  }

  .modal {
    position: relative;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
    margin: 2rem;
    padding: 2rem;
    background-color: $white;
    box-shadow: 2px 2px 20px 1px;
    z-index: 10;
  }

  .btn-close {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    font-size: 2rem;
    padding: 2rem;
    cursor: pointer;
    font-weight: bold;
    color: $gray;
    background: transparent;
  }

  header, footer {
    display: flex;
  }

  header {
    margin-right: 2rem;
  }

  footer {
    margin-top: 2rem;
  }
</style>
