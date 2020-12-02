<template>
    <div ref="content">
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
                                :readonly="field.color==='background-color:yellow'" @keypress="validar(field.value, field.conditions, $event)" />
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
              <q-btn color="black" label="Exportar PDF" @click="printPDF"></q-btn>
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
import JSPDF from 'jspdf'
import domtoimage from 'dom-to-image'

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
          name: 'Calidad agua de Alimentacion',
          fields: [
            { id: 1, name: 'pH', value: '', color: 'background-color:#A2CCFA', conditions: { min: 0, max: 14 } },
            { id: 2, name: 'Dureza ppm CaCO3', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'Alcalinidad Total ppm CaCO3', value: '', color: 'background-color:#A2CCFA' },
            { id: 4, name: 'Silice ppm SiO2', value: '', color: 'background-color:#A2CCFA' },
            { id: 5, name: 'Solidos disueltos ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 6, name: 'conductividad uS/cm', value: '', color: 'background-color:#A2CCFA' },
            { id: 7, name: 'Hierro ppm Fe', value: '', color: 'background-color:#A2CCFA' },
            { id: 8, name: 'Oxigeno disuelto ppm O2', value: '', color: 'background-color:#A2CCFA', conditions: { min: 0, max: 20 } }
          ]
        },
        {
          id: 2,
          name: 'Calidad agua de purga ',
          fields: [
            { id: 1, name: 'pH', value: '', color: 'background-color:#A2CCFA', conditions: { min: 0, max: 14 } },
            { id: 2, name: 'Dureza ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'Alcalinidad P ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 4, name: 'Alcalinidad M ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 5, name: 'Silice ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 6, name: 'Solidos disueltos ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 7, name: 'conductividad uS/cm', value: '', color: 'background-color:#A2CCFA' },
            { id: 8, name: 'Hierro ppm', value: '', color: 'background-color:#A2CCFA' }
          ]
        },
        {
          id: 3,
          name: 'Calidad agua de Reposicion',
          fields: [
            { id: 1, name: 'pH', value: '', color: 'background-color:#A2CCFA', conditions: { min: 0, max: 14 } },
            { id: 2, name: 'Dureza ppm CaCo3', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'Alcalinidad Total ppm CaCo3', value: '', color: 'background-color:#A2CCFA' }
          ]
        },
        {
          id: 4,
          name: 'Calidad agua de condensado',
          fields: [
            { id: 1, name: 'pH', value: '', color: 'background-color:#A2CCFA', conditions: { min: 0, max: 14 } },
            { id: 2, name: 'Dureza ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'Alcalinidad Total ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 4, name: 'Silice ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 5, name: 'Solidos disueltos ppm', value: '', color: 'background-color:#A2CCFA' },
            { id: 6, name: 'conductividad uS/cm', value: '', color: 'background-color:#A2CCFA' },
            { id: 7, name: 'Hierro ppm', value: '', color: 'background-color:#A2CCFA' }
          ]
        },
        {
          id: 5,
          name: 'BALANCES HIDRICOS Y CONDICIONES OPERATIVAS',
          fields: [
            { id: 1, name: 'BHP Caldera', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: '% eficiencia produccion de vapor', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: '% Retorno de condensado', value: '', color: 'background-color:#A2CCFA' },
            { id: 4, name: '°T Agua de alimentacion °C', value: '', color: 'background-color:#A2CCFA', conditions: { min: 0, max: 100 } },
            { id: 5, name: 'Presion operación del sistema (PSI)', value: '', color: 'background-color:#A2CCFA', conditions: { min: 0, max: 2000 } },
            { id: 6, name: 'Ciclos de concentracion ', value: '', color: 'background-color:yellow' },
            { id: 7, name: 'Caudal de vapor (TonV/hora)', value: '', color: 'background-color:yellow' },
            { id: 8, name: 'Caudal retorno de condensado ', value: '', color: 'background-color:yellow' },
            { id: 9, name: 'Horas de trabajo dia', value: '', color: 'background-color:#A2CCFA' },
            { id: 10, name: 'Dias de trabajo al mes', value: '', color: 'background-color:#A2CCFA' },
            { id: 11, name: 'Suavizador', value: '', color: 'background-color:#A2CCFA' },
            { id: 12, name: 'Caudal de purga (m3/h)', value: '', color: 'background-color:yellow' },
            { id: 13, name: 'Caudal de Alimentacion  (m3/h)', value: '', color: 'background-color:yellow' },
            { id: 14, name: 'Caudal de reposición (m3/h)', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 6,
          name: 'Calculos de dosificacion Secuestrante de oxigeno',
          fields: [
            { id: 1, name: 'ppm del Producto', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Cantidad Kg/dia', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 7,
          name: 'Calculos de dosificacion Acondicionador de dureza o inhibidor de incrustacion',
          fields: [
            { id: 1, name: 'ppm del Producto', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Cantidad Kg/dia', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 8,
          name: 'Calculos dosificacion Amina neutralizante',
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
    this.BHCO()
    this.CDSO()
    this.CDAD()
    this.CDAN()
  },
  mounted () {
    this.BHCO()
    this.CDSO()
    this.CDAD()
    this.CDAN()
  },
  methods: {
    isNumber (n) {
      return !isNaN(parseFloat(n)) && isFinite(n)
    },
    validar (valor, conditions, e) {
      const val = e.target.value + e.key
      if (e.key !== '-' && !this.isNumber(val)) {
        e.preventDefault()
      }
      if (conditions) {
        if (conditions.min && val < conditions.min) {
          this.alert('negative', 'No puedes colocar un valor menor que ' + conditions.min)
          e.preventDefault()
        } else if (conditions.max && val > conditions.max) {
          this.alert('negative', 'No puedes colocar un valor mayor que ' + conditions.max)
          e.preventDefault()
        }
      }
    },
    BHCO () {
      this.tables[4].fields[5].value = Math.round((this.tables[1].fields[3].value / this.tables[0].fields[3].value) * 1000000000) / 1000000000
      this.tables[4].fields[6].value = Math.round(((((this.tables[4].fields[1].value / 100) * 34.5 * (this.tables[4].fields[2].value) / 100) / 2.2) / 1000) * 1000000000) / 1000000000
      this.tables[4].fields[7].value = Math.round((this.tables[4].fields[6].value * (this.tables[4].fields[2].value / 100)) * 1000000000) / 1000000000
      this.tables[4].fields[11].value = Math.round((this.tables[4].fields[6].value / (this.tables[4].fields[5].value - 1)) * 1000000000) / 1000000000
      this.tables[4].fields[12].value = Math.round((this.tables[4].fields[6].value + this.tables[4].fields[11].value) * 1000000000) / 1000000000
      this.tables[4].fields[13].value = Math.round((this.tables[4].fields[12].value - this.tables[4].fields[7].value) * 1000000000) / 1000000000
    },
    CDSO () {
      this.tables[5].fields[1].value = ((this.tables[4].fields[12].value * this.tables[5].fields[0].value) / 1000000) * this.tables[4].fields[8].value
    },
    CDAD () {
      this.tables[6].fields[1].value = ((this.tables[4].fields[12].value * this.tables[6].fields[0].value) / 1000000) * this.tables[4].fields[8].value
    },
    CDAN () {
      this.tables[7].fields[1].value = ((this.tables[4].fields[12].value * this.tables[7].fields[0].value) / 1000000) * this.tables[4].fields[8].value
    },
    getInterpretacion () {
      // this.showInterpretacion = true
      // let interpretacion = ''
      // if (this.tables[2].fields[13].value >= 4 && this.tables[2].fields[13].value < 5) interpretacion = 'Fuertemente incrustante'
      // if (this.tables[2].fields[13].value >= 5 && this.tables[2].fields[13].value < 6) interpretacion = 'Ligeramente Incrustante'
      // if (this.tables[2].fields[13].value >= 6 && this.tables[2].fields[13].value < 7) interpretacion = 'Ligeramente incriustante o corrosiva'
      // if (this.tables[2].fields[13].value >= 7 && this.tables[2].fields[13].value < 7.5) interpretacion = 'Ligeramente corrosiva'
      // if (this.tables[2].fields[13].value >= 7.5 && this.tables[2].fields[13].value <= 9) interpretacion = 'Fuertetemente corrosiva'
      // if (this.tables[2].fields[13].value > 9) interpretacion = 'Intolerable corrosion'
      // this.interpretacion = interpretacion
      // this.getProducts()
    },
    getProducts () {
      // if (this.tables[2].fields[13].value < 4) this.products = [{ id: 1, name: 'EXRO 774' }, { id: 2, name: 'EXRO 764' }]
      // if (this.tables[2].fields[13].value >= 4 && this.tables[2].fields[13].value < 5) this.products = [{ id: 1, name: 'EXRO 724' }, { id: 2, name: 'EXRO 760' }]
      // if (this.tables[2].fields[13].value >= 5 && this.tables[2].fields[13].value < 6) this.products = [{ id: 1, name: 'EXRO 760' }, { id: 2, name: 'EXRO 771' }, { id: 3, name: 'EXRO 770' }]
      // if (this.tables[2].fields[13].value >= 6 && this.tables[2].fields[13].value < 7) this.products = [{ id: 1, name: 'Inhibidor de corrosion + dispersante' }, { id: 2, name: 'EXRO  726' }, { id: 3, name: 'EXRO  717' }]
      // if (this.tables[2].fields[13].value >= 7 && this.tables[3].fields[12].value === 'Anodica') this.products = [{ id: 1, name: 'EXRO  718' }, { id: 2, name: 'EXRO  721' }, { id: 3, name: 'EXRO  725' }, { id: 4, name: 'EXRO  725L' }]
      // if (this.tables[2].fields[13].value >= 7 && this.tables[3].fields[12].value === 'Catodica') this.products = [{ id: 3, name: 'EXRO  725' }, { id: 4, name: 'EXRO  725L' }]
      // if (this.tables[2].fields[13].value >= 7 && this.tables[3].fields[12].value === 'Mixta') this.products = [{ id: 1, name: 'EXRO  726' }, { id: 2, name: 'EXRO  717' }, { id: 3, name: 'EXRO  725' }, { id: 4, name: 'EXRO  725L' }]
    },
    printPDF () {
      /** WITH CSS */
      domtoimage.toPng(this.$refs.content).then(function (dataUrl) {
        var img = new Image()
        img.src = dataUrl
        const doc = new JSPDF({
          // unit: "pt"
        })
        const width = doc.internal.pageSize.getWidth()
        const height = doc.internal.pageSize.getHeight()
        doc.addImage(img, 'JPEG', 0, 0, width, height)
        const filename = 'form.pdf'
        doc.save(filename)
      }).catch(function (error) {
        console.error('oops, something went wrong!', error)
      })
    }
  }
}
</script>
<style lang="scss" scoped>
.table {
    padding: 5px;
}
</style>
