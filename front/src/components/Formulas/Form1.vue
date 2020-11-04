<template>
    <div>
        <div class="row">
            <div v-for="table in tables" :key="table.id" class="col-md-6 col-xs-12">
                <!------- tabla ---->
                <div class="table">
                    <div class="box" style="padding: 5px;">
                        <div class="row">
                            <div class="col-12"><b>{{table.name}}</b></div>
                        </div>
                        <div v-for="field in table.fields" :key="field.id" class="row">
                            <div class="col-6">{{field.name}}</div>
                            <div class="col-6">
                                <input type="text" v-model="field.value" class="full-width full-height" :style="field.color" style="text-align: center"
                                :readonly="field.color==='background-color:yellow'"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fin tabla ---->
            </div>
        </div>
    </div>
</template>

<script>
import { functions } from '../../functions.js'

export default {
  name: 'form-1-component',
  mixins: [functions],
  data () {
    return {
      tables: [
        {
          id: 1,
          name: 'Calidad agua de Reposicion (Ingreso a la Torre)',
          fields: [
            { id: 1, name: 'pH', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Dureza ppm CaCO3', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'Alcalinidad Total ppm CaCO3', value: '', color: 'background-color:#A2CCFA' },
            { id: 4, name: 'Silice ppm SiO2', value: '', color: 'background-color:#A2CCFA' },
            { id: 5, name: 'Solidos disueltos ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 6, name: 'conductividad uS/cm', value: '', color: 'background-color:#A2CCFA' },
            { id: 7, name: 'Hierro ppm Fe', value: '', color: 'background-color:#A2CCFA' },
            { id: 8, name: 'Cloruros ppm Cl', value: '', color: 'background-color:#A2CCFA' }
          ]
        },
        {
          id: 2,
          name: 'Calidad agua de Recirculacion',
          fields: [
            { id: 1, name: 'pH', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Dureza ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'Alcalinidad Total ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 4, name: 'Silice ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 5, name: 'Solidos disueltos ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 6, name: 'conductividad uS/cm', value: '', color: 'background-color:#A2CCFA' },
            { id: 7, name: 'Hierro ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 8, name: 'Cloruros ppm Cl', value: '', color: 'background-color:#A2CCFA' },
            { id: 9, name: 'RESIDUAL DE PRODUCTO', value: '', color: 'background-color:#A2CCFA' }
          ]
        },
        {
          id: 3,
          name: 'RYZNAR AGUA DE RECIRUCLACION TORRE',
          fields: [
            { id: 1, name: 'A', value: '', color: 'background-color:yellow' },
            { id: 2, name: 'B', value: '', color: 'background-color:yellow' },
            { id: 3, name: 'C', value: '', color: 'background-color:yellow' },
            { id: 4, name: 'D', value: '', color: 'background-color:yellow' },
            { id: 5, name: '', value: '', color: '' },
            { id: 6, name: 'TDS, ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 7, name: 'Temp, °C', value: '', color: 'background-color:#A2CCFA' },
            { id: 8, name: 'Dureza, ppm CaCO3', value: '', color: 'background-color:#A2CCFA' },
            { id: 9, name: 'Alc, ppm CaCO3', value: '', color: 'background-color:#A2CCFA' },
            { id: 10, name: '', value: '', color: '' },
            { id: 11, name: 'pHs', value: '', color: 'background-color:yellow' },
            { id: 12, name: 'pHa', value: '', color: 'background-color:#A2CCFA' },
            { id: 13, name: '', value: '', color: '' },
            { id: 14, name: 'Ryznar', value: '', color: 'background-color:#A2FAE7' }
          ]
        },
        {
          id: 4,
          name: 'BALANCES HIDRICOS ACTUALES A 2 CICLOS',
          fields: [
            { id: 1, name: 'volumen del sistema m3', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Caudal de Recirculación (m3/h)', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: '°T Agua de ingreso °F', value: '', color: 'background-color:#A2CCFA' },
            { id: 4, name: '°T Agua de salida °F', value: '', color: 'background-color:#A2CCFA' },
            { id: 5, name: 'delta °T °F', value: '', color: 'background-color:yellow' },
            { id: 6, name: '% de evaporación', value: '', color: 'background-color:yellow' },
            { id: 7, name: 'Horas de trabajo dia', value: '', color: 'background-color:#A2CCFA' },
            { id: 9, name: 'Dias de trabajo al mes', value: '', color: 'background-color:#A2CCFA' },
            { id: 10, name: 'Ciclos de concentración', value: '', color: 'background-color:yellow' },
            { id: 11, name: 'Caudal de evaporación (m3/h)', value: '', color: 'background-color:yellow' },
            { id: 12, name: 'Caudal de purga (m3/h)', value: '', color: 'background-color:yellow' },
            { id: 13, name: 'Caudal de reposición (m3/h)', value: '', color: 'background-color:yellow' },
            { id: 14, name: 'Metalografia total del sistema ', value: '', color: 'background-color:#A2CCFA' }
          ]
        },
        {
          id: 5,
          name: 'Calculos de dosificacion Ajuste en el servicio',
          fields: [
            { id: 1, name: 'ppm dosificadas Actuales', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Kg/dia Actuales', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'ppm de aporte del Producto', value: '', color: 'background-color:yellow' },
            { id: 4, name: 'ppm a incrementar en el residual', value: '', color: 'background-color:#A2CCFA' },
            { id: 5, name: 'ppm de producto a incrementar en la dosis ', value: '', color: 'background-color:yellow' },
            { id: 6, name: 'Kg de producto a incrementar/dia', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 6,
          name: 'Calculos de dosificacion Producto nuevo',
          fields: [
            { id: 1, name: 'ppm del Producto', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Cantidad Kg/dia', value: '', color: 'background-color:yellow' }
          ]
        }
      ]
    }
  },
  // operaciones
  updated () {
    this.ryznar()
    this.balances()
    this.calculosProducto()
    this.calculosAjuste()
  },
  mounted () {
    this.ryznar()
    this.balances()
    this.calculosProducto()
    this.calculosProducto()
  },
  methods: {
    ryznar () {
      this.tables[2].fields[5].value = this.tables[1].fields[4].value
      this.tables[2].fields[7].value = this.tables[1].fields[1].value
      this.tables[2].fields[8].value = this.tables[1].fields[2].value
      this.tables[2].fields[11].value = this.tables[1].fields[0].value
      this.tables[2].fields[0].value = Math.round(((Math.log10(this.tables[2].fields[5].value) - 1) / 10) * 1000) / 1000
      this.tables[2].fields[6].value = Math.round((((Number(this.tables[3].fields[2].value) - 32) * 5) / 9) * 1000) / 1000
      this.tables[2].fields[1].value = Math.round((-13.12 * Math.log10(Number(this.tables[2].fields[6].value) + 273) + 34.55) * 1000) / 1000
      this.tables[2].fields[2].value = Math.round(Math.log10(this.tables[2].fields[7].value) * 1000) / 1000
      this.tables[2].fields[3].value = Math.round(Math.log10(this.tables[2].fields[8].value) * 1000) / 1000
      this.tables[2].fields[10].value = Math.round(((9.3 + this.tables[2].fields[0].value + this.tables[2].fields[1].value) - (this.tables[2].fields[2].value + this.tables[2].fields[3].value)) * 1000) / 1000
      this.tables[2].fields[13].value = Math.round((2 * this.tables[2].fields[10].value - this.tables[2].fields[11].value) * 1000) / 1000
    },
    balances () {
      this.tables[3].fields[4].value = this.tables[3].fields[2].value - this.tables[3].fields[3].value
      this.tables[3].fields[5].value = (this.tables[3].fields[4].value * 0.01) / 10
      this.tables[3].fields[8].value = Math.round((this.tables[1].fields[3].value / this.tables[0].fields[3].value) * 100) / 100
      this.tables[3].fields[9].value = Math.round((this.tables[3].fields[1].value * this.tables[3].fields[5].value) * 1000) / 1000
      this.tables[3].fields[10].value = Math.round((this.tables[3].fields[9].value / (this.tables[3].fields[8].value - 1)) * 1000) / 1000
      this.tables[3].fields[11].value = Math.round((Number(this.tables[3].fields[9].value) + Number(this.tables[3].fields[10].value)) * 1000) / 1000
    },
    calculosProducto () {
      this.tables[5].fields[1].value = (this.tables[3].fields[11].value * this.tables[5].fields[0].value * this.tables[3].fields[6].value) / 1000000
    },
    calculosAjuste () {
      this.tables[4].fields[2].value = Math.round((this.tables[1].fields[8].value / this.tables[3].fields[8].value) * 1000) / 1000
      this.tables[4].fields[4].value = Math.round((((this.tables[4].fields[0].value * this.tables[4].fields[3].value) / this.tables[4].fields[2].value) - this.tables[4].fields[0].value) * 1000) / 1000
      this.tables[4].fields[5].value = Math.round((((this.tables[4].fields[4].value * this.tables[3].fields[11].value) / 1000) * 24) * 1000) / 1000
    }
  }
}
</script>
<style lang="scss" scoped>
.table {
    padding: 5px;
}
</style>
