<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <!-- Aqui llamamos al component correspondiente a la id -->
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { functions } from '../functions.js'
// incluimos todas los componentes de la carpeta formulas

export default {
  name: 'calculate-form-component',
  mixins: [functions],
  data () {
    return {
    }
  },
  mounted () {
  },
  methods: {
  }
}
</script>
