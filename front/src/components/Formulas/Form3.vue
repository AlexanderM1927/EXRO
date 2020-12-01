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
                                <select class="full-width full-height" :style="`${field.color}; text-align: center`" v-model="field.value" v-if="field.name === 'Nombre del producto'">
                                  <option value="EXRO 614">EXRO 614</option>
                                  <option value="EXRO 633">EXRO 633</option>
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
          name: 'Coagulantes u otros Productos liquidos',
          fields: [
            { id: 1, name: 'Nombre del producto', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Densidad Producto Puro gr/ml', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'Concentracion Deseada', value: '', color: 'background-color:#A2CCFA' },
            { id: 4, name: 'Cantidad Sln Requerida x litro', value: '', color: 'background-color:#A2CCFA' },
            { id: 5, name: 'Volumen producto puro', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 2,
          name: 'Floculantes u otros productos granulares',
          fields: [
            { id: 1, name: 'Nombre del producto', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Concentracion Deseada', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'Cantidad Sln Requerida x litro', value: '', color: 'background-color:#A2CCFA' },
            { id: 4, name: 'Peso de Producto Puro', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 3,
          name: 'Coagulantes u otros Productos liquidos',
          fields: [
            { id: 1, name: 'Concentracion Sln mg P Puro / ml Sln', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Dosis deseada mg P / Litro AT', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'Caudal de Agua a Tratar Litro AT / Seg', value: '', color: 'background-color:#A2CCFA' },
            { id: 4, name: 'Aforo de la Sln a dosificar (Caudal bomba)', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 4,
          name: 'Floculantes u otros productos granulares',
          fields: [
            { id: 1, name: 'Concentracion Sln mg P Puro / ml Sln', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Dosis deseada mg P / Litro AT', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'Caudal de Agua a Tratar Litro AT / Seg', value: '', color: 'background-color:#A2CCFA' },
            { id: 4, name: 'Aforo de la Sln a dosificar (Caudal bomba)', value: '', color: 'background-color:yellow' }
          ]
        }
      ]
    }
  },
  // operaciones
  updated () {
    this.volumenProductoPuro()
    this.pesoProductoPuro()
    this.caudalBomba1()
    this.caudalBomba2()
  },
  mounted () {
    this.volumenProductoPuro()
    this.pesoProductoPuro()
    this.caudalBomba1()
    this.caudalBomba2()
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
    volumenProductoPuro () {
      this.tables[0].fields[4].value = Math.round((this.tables[0].fields[3].value * (this.tables[0].fields[2].value * 10) / (this.tables[0].fields[1].value * 1000)) * 100) / 100
    },
    pesoProductoPuro () {
      this.tables[1].fields[3].value = this.tables[1].fields[2].value * (this.tables[1].fields[1].value * 10)
    },
    caudalBomba1 () {
      this.tables[2].fields[3].value = (this.tables[2].fields[1].value * this.tables[2].fields[2].value) / (this.tables[2].fields[0].value * 10)
    },
    caudalBomba2 () {
      this.tables[3].fields[3].value = (this.tables[3].fields[2].value * this.tables[3].fields[1].value) / (this.tables[3].fields[0].value * 10)
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
      if (this.tables[2].fields[13].value < 4) this.products = [{ id: 1, name: 'EXRO 774' }, { id: 2, name: 'EXRO 764' }]
      if (this.tables[2].fields[13].value >= 4 && this.tables[2].fields[13].value < 5) this.products = [{ id: 1, name: 'EXRO 724' }, { id: 2, name: 'EXRO 760' }]
      if (this.tables[2].fields[13].value >= 5 && this.tables[2].fields[13].value < 6) this.products = [{ id: 1, name: 'EXRO 760' }, { id: 2, name: 'EXRO 771' }, { id: 3, name: 'EXRO 770' }]
      if (this.tables[2].fields[13].value >= 6 && this.tables[2].fields[13].value < 7) this.products = [{ id: 1, name: 'Inhibidor de corrosion + dispersante' }, { id: 2, name: 'EXRO  726' }, { id: 3, name: 'EXRO  717' }]
      if (this.tables[2].fields[13].value >= 7 && this.tables[3].fields[12].value === 'Anodica') this.products = [{ id: 1, name: 'EXRO  718' }, { id: 2, name: 'EXRO  721' }, { id: 3, name: 'EXRO  725' }, { id: 4, name: 'EXRO  725L' }]
      if (this.tables[2].fields[13].value >= 7 && this.tables[3].fields[12].value === 'Catodica') this.products = [{ id: 3, name: 'EXRO  725' }, { id: 4, name: 'EXRO  725L' }]
      if (this.tables[2].fields[13].value >= 7 && this.tables[3].fields[12].value === 'Mixta') this.products = [{ id: 1, name: 'EXRO  726' }, { id: 2, name: 'EXRO  717' }, { id: 3, name: 'EXRO  725' }, { id: 4, name: 'EXRO  725L' }]
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
