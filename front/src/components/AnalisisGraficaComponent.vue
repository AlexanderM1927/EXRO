<template>
    <div class="q-pa-md box">
        <div class="text-h5">Analisis de gráfica</div>
        <div class="text-h6">Fechas dónde la variable estuvo fuera de rango:</div>
        <ul v-for="(report, key) in reportsOutRange" v-bind:key="key">
          <li>Fecha: {{report.fecha}}</li>
        </ul>
        <b>Razon:</b><div v-html="razon_outrange"></div>
        <q-separator />
        <div class="text-h6">Observaciones en los reportes:</div>
        <q-timeline color="orange" v-for="(message, key) in values" v-bind:key="key">
            <q-timeline-entry
                v-if="message.observacion"
                :subtitle="message.fecha + ', ' + message.ingeniero"
                side="left"
            >
                <div v-html="message.observacion"></div>
            </q-timeline-entry>
        </q-timeline>
    </div>
</template>

<script>
import { functions } from '../functions.js'

export default {
  name: 'analisis-graficas-component',
  mixins: [functions],
  props: ['values'],
  data () {
    return {
      reportsOutRange: [],
      razon_outrange: ''
    }
  },
  mounted () {
    this.getReportsOutRange()
  },
  methods: {
    getReportsOutRange () {
      for (let i = 0; i < this.values.length; i++) {
        if (this.values[i].value > this.values[i].max) {
          this.reportsOutRange.push(this.values[i])
          this.razon_outrange = this.values[i].razon_outrange
        } else if (this.values[i].value < this.values[i].min) {
          this.reportsOutRange.push(this.values[i])
          this.razon_outrange = this.values[i].razon_outrange
        }
      }
    }
  }
}
</script>
