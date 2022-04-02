<template>
    <div class="modal-backdrop" v-if="isModalVisible" @click="close">
        <div class="modal" :id="id">
            <header>
                <slot name="header"></slot>
                <button type="button" class="btn-close" @click="close">
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
    close() {
      eventHub.$emit('close-modal', this.id);
      this.isModalVisible = false;
    },
    show(id) {
      if(this.id === id) {
        this.isModalVisible = true;
      }
    }
  },
  created() {
    eventHub.$on('show-modal', this.show);
  },
  beforeDestroy () {
    eventHub.$off('show-modal',  this.show);
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
    z-index: 10;
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
  }

  .btn-close {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    font-size: 20px;
    padding: 10px;
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