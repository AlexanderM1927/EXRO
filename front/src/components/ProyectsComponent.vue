<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
             <div class="text-h6">hola mundo</div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { functions } from '../functions.js'

export default {
  name: 'proyects-component',
  mixins: [functions],
  props: [],
  data () {
    return {

    }
  },
  mounted () {
    this.organizarCards()
  },
  methods: {
    async organizarCards () {
      const cards = await document.getElementsByClassName('cards')
      let widthSize = 0
      let heightSize = 0

      for (let i = 0; i < cards.length; i++) {
        if (widthSize <= cards[i].clientHeight) widthSize = cards[i].clientWidth
        if (heightSize <= cards[i].clientWidth) heightSize = cards[i].clientHeight
      }
      for (let i = 0; i < cards.length; i++) {
        document.getElementsByClassName('cards')[i].style.minHeight = heightSize + 'px'
        document.getElementsByClassName('cards')[i].style.minWidth = widthSize + 'px'
      }
    }
  }
}
</script>
