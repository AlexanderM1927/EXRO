<template>
  <q-item
    clickable
    tag="a"
    target="_blank"
    @click="goTo(link)"
    :class="`${view === link ? 'marked' : ''}`"
    v-if="ranks.includes(rank)"
  >
    <q-item-section
      v-if="icon"
      avatar
    >
      <q-icon :name="icon" />
    </q-item-section>

    <q-item-section :id="link">
      <q-item-label>{{ title }}</q-item-label>
      <q-item-label caption>
        {{ caption }}
      </q-item-label>
    </q-item-section>
  </q-item>
</template>

<script>
import { functions } from '../functions.js'

export default {
  name: 'EssentialLink',
  mixins: [functions],
  props: {
    title: {
      type: String,
      required: true
    },

    caption: {
      type: String,
      default: ''
    },

    link: {
      type: String,
      default: '#'
    },

    icon: {
      type: String,
      default: ''
    },

    view: {
      type: String,
      default: ''
    },

    rank: {},
    ranks: {}
  }
}
</script>
<style lang="scss" scoped>
.marked {
  background: $primary;
  color: white;
}
</style>
