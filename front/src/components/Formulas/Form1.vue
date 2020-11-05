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
                                <select class="full-width full-height" :style="`${field.color}; text-align: center`" v-model="field.value" v-if="field.name === 'Metalografia total del sistema'">
                                  <option value="Anodica">Anodica</option>
                                  <option value="Catodica">Catodica</option>
                                  <option value="Mixta">Mixta</option>
                                </select>
                                <input v-else-if="field.name !== ''" type="text" v-model="field.value" class="full-width full-height" :style="`${field.color}; text-align: center`"
                                :readonly="field.color==='background-color:yellow'"/>
                                <br v-else>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fin tabla ---->
            </div>
        </div>
        <div class="row">
          <div class="col-12">
            <br>
            <center>
              <q-btn color="primary" label="Ver interpretacion y productos sugeridos" @click="getInterpretacion"></q-btn>
            </center>
            <br>
            <div v-if="showInterpretacion" class="container">
              <div class="text-h6">Interpretación del RYZNAR</div>
              {{interpretacion}}
            </div><br>
            <div v-if="showInterpretacion" class="container">
              <div class="text-h6">Productos sugeridos</div>
              <ul v-for="product in products" :key="product.id">
                <li>{{product.name}}</li>
              </ul>
              <b>NOTA:</b> Acorde a la caracterizacion fisicoquimica del agua, se pueden encontrar situaciones donde se requieran 2 productos ( Inhibidor de corrosion y dispersante) o un producto multifuncional  independientemente del indice de Ryznar
            </div>
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
      interpretacion: '',
      showInterpretacion: false,
      products: [],
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
            { id: 14, name: 'Metalografia total del sistema', value: '', color: 'background-color:#A2CCFA' }
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
      let porcentaje = (this.tables[3].fields[4].value * 0.01) / 10
      this.tables[3].fields[5].value = this.tables[3].fields[4].value / 10 + " %"
      this.tables[3].fields[8].value = this.tables[1].fields[3].value / this.tables[0].fields[3].value
      this.tables[3].fields[9].value = this.tables[3].fields[1].value * porcentaje
      this.tables[3].fields[10].value = this.tables[3].fields[9].value / (this.tables[3].fields[8].value - 1)
      this.tables[3].fields[11].value = Number(this.tables[3].fields[9].value) + Number(this.tables[3].fields[10].value)
    },
    calculosProducto () {
      this.tables[5].fields[1].value = (this.tables[3].fields[11].value * this.tables[5].fields[0].value * this.tables[3].fields[6].value) / 1000000
    },
    calculosAjuste () {
      this.tables[4].fields[2].value = Math.round((this.tables[1].fields[8].value / this.tables[3].fields[8].value) * 1000) / 1000
      this.tables[4].fields[4].value = Math.round((((this.tables[4].fields[0].value * this.tables[4].fields[3].value) / this.tables[4].fields[2].value) - this.tables[4].fields[0].value) * 1000) / 1000
      this.tables[4].fields[5].value = Math.round((((this.tables[4].fields[4].value * this.tables[3].fields[11].value) / 1000) * 24) * 1000) / 1000
    },
    getInterpretacion () {
      this.showInterpretacion = true
      let interpretacion = ''
      if (this.tables[2].fields[13].value >= 4 && this.tables[2].fields[13].value < 5) interpretacion = 'Fuertemente incrustante'
      if (this.tables[2].fields[13].value >= 5 && this.tables[2].fields[13].value < 6) interpretacion = 'Ligeramente Incrustante'
      if (this.tables[2].fields[13].value >= 6 && this.tables[2].fields[13].value < 7) interpretacion = 'Ligeramente incriustante o corrosiva'
      if (this.tables[2].fields[13].value >= 7 && this.tables[2].fields[13].value < 7.5) interpretacion = 'Ligeramente corrosiva'
      if (this.tables[2].fields[13].value >= 7.5 && this.tables[2].fields[13].value <= 9) interpretacion = 'Fuertetemente corrosiva'
      if (this.tables[2].fields[13].value > 9) interpretacion = 'Intolerable corrosion'
      this.interpretacion = interpretacion
      this.getProducts()
    },
    getProducts () {
      if (this.tables[2].fields[13].value < 4) this.products = [{ id: 1, name: 'E-774' }, { id: 2, name: 'E-764' }]
      if (this.tables[2].fields[13].value >= 4 && this.tables[2].fields[13].value < 5) this.products = [{ id: 1, name: 'E-724' }, { id: 2, name: 'E-760' }]
      if (this.tables[2].fields[13].value >= 5 && this.tables[2].fields[13].value < 6) this.products = [{ id: 1, name: 'E-760' }, { id: 2, name: 'E-771' }, { id: 3, name: 'E-770' }]
      if (this.tables[2].fields[13].value >= 6 && this.tables[2].fields[13].value < 7) this.products = [{ id: 1, name: 'Inhibidor de corrosion + dispersante' }, { id: 2, name: 'E- 726' }, { id: 3, name: 'E- 717' }]
      if (this.tables[2].fields[13].value >= 7 && this.tables[3].fields[12].value === 'Anodica') this.products = [{ id: 1, name: 'E- 718' }, { id: 2, name: 'E- 721' }, { id: 3, name: 'E- 725' }, { id: 4, name: 'E- 725L' }]
      if (this.tables[2].fields[13].value >= 7 && this.tables[3].fields[12].value === 'Catodica') this.products = [{ id: 3, name: 'E- 725' }, { id: 4, name: 'E- 725L' }]
      if (this.tables[2].fields[13].value >= 7 && this.tables[3].fields[12].value === 'Mixta') this.products = [{ id: 1, name: 'E- 726' }, { id: 2, name: 'E- 717' }, { id: 3, name: 'E- 725' }, { id: 4, name: 'E- 725L' }]
    }
  }
}
</script>
<style lang="scss" scoped>
.table {
    padding: 5px;
}
</style>
