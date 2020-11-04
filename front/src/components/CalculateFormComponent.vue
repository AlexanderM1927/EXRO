<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
              <formula></formula>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { functions } from '../functions.js'

export default {
  name: 'calculate-form-component',
  mixins: [functions],
  data () {
    return {
      id: this.$route.params.id
    }
  },
  created () {
    this.$options.components.formula = require('./Formulas/Form' + this.id).default
  },
  methods: {
  }
}
</script>
