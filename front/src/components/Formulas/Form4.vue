<template>
    <div ref="content">
        <h6>3. APLICACIONES INDUSTRIALES</h6>
        <div class="row">
            <div v-for="table in tables" :key="table.id" class="col-md-6 col-xs-12">
                <!------- tabla ---->
                <div class="table">
                    <div class="box" style="padding: 5px;">
                        <div class="row">
                            <div v-if="table.name === '3.3 Relaciones de Reemplazo'" class="col-12">
                                <b>{{table.name}}</b>
                                Cuantas ppm de ayudante de coagulancion reemplazan cuantas ppm de coagulante principal.
                            </div>
                             <div v-else-if="table.name === '3.2 Porcentajes de Sustitucion'" class="col-12">
                                <b>{{table.name}}</b>
                                Para uso de ayudante de coagulacion.
                            </div>
                            <div v-else class="col-12"><b>{{table.name}}</b></div>
                        </div>
                        <div v-for="field in table.fields" :key="field.id" class="row">
                            <div v-if="field.value === 'titulo'" class="col-6"><b>{{field.name}}</b></div>
                            <div v-if="field.value === 'titulo'" class="col-6"></div>
                            <div v-else class="col-6">{{field.name}}</div>
                            <div v-if="field.name === 'Nombre'" class="col-6">
                                <input type="text" v-model="field.value"  class="full-width full-height" :style="`${field.color}; text-align: center`"/>
                            </div>
                            <div v-else class="col-3">
                                <input v-if="field.value !== 'titulo'" type="text" v-model="field.value" class="full-width full-height" :style="`${field.color}; text-align: right`"
                                :readonly="field.color==='background-color:yellow'" @keypress="validar(field.value, field.conditions, $event)" />
                            </div>
                            <div v-if="field.unidad !== ''" class="col-3">{{field.unidad}}</div>
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
              <q-btn color="black" label="Exportar PDF" @click="printPDF"></q-btn>
            </center>
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
          name: '3.1 Comparacion Tecnica',
          fields: [
            { id: 1, name: 'Coagulante Principal', value: 'titulo', color: '', unidad: '' },
            { id: 2, name: 'Nombre', value: '', color: 'background-color:#A2CCFA', unidad: '' },
            { id: 3, name: 'Docis Actual', value: '', color: 'background-color:#A2CCFA', unidad: 'ppm' }
          ]
        },
        {
          id: 2,
          name: '3.2 Porcentajes de Sustitucion',
          fields: [
            { id: 1, name: 'Sustitucion Deseada', value: '', color: 'background-color:#A2CCFA', unidad: '%' },
            { id: 2, name: 'Nueva Dosis Coagulante Principal', value: '', color: 'background-color:yellow', unidad: 'ppm' },
            { id: 3, name: 'Dosis Pendiente a reemplazar', value: '', color: 'background-color:yellow', unidad: 'ppm' }
          ]
        },
        {
          id: 3,
          name: '3.3 Relaciones de Reemplazo',
          fields: [
            { id: 1, name: 'Relacion de Reemplazo 1 a', value: '', color: 'background-color:#A2CCFA', unidad: 'ppm' },
            { id: 2, name: 'Dosis de Ayudante de Coagulacion', value: '', color: 'background-color:yellow', unidad: 'ppm' }
          ]
        },
        {
          id: 4,
          name: '3.4 Comparacion Economica',
          fields: [
            { id: 1, name: '3.4.1 Tratamiento Actual', value: 'titulo', color: '' },
            { id: 2, name: 'Precio de Coagulante Principal', value: '', color: 'background-color:#A2CCFA', unidad: '$ / m3' },
            { id: 3, name: 'Dosis de Coagulante Principal', value: '', color: 'background-color:#A2CCFA', unidad: 'ppm' },
            { id: 4, name: '$ /m3 de Tratamiento Actual', value: '', color: 'background-color:yellow', unidad: '$ / m3' }
          ]
        },
        {
          id: 5,
          name: '3.4.2 Tratamiento con sustitucion parcial',
          fields: [
            { id: 1, name: 'Precio de Coagulante Principal', value: '', color: 'background-color:#A2CCFA', unidad: '$ / m3' },
            { id: 2, name: 'Dosis de Coagulante Principal', value: '', color: 'background-color:#A2CCFA', unidad: 'ppm' },
            { id: 3, name: '$ /m3 de Tratamiento', value: '', color: 'background-color:yellow', unidad: '$ / m3' },
            { id: 4, name: '.', value: 'titulo', color: '', unidad: '' },
            { id: 5, name: 'Precio de Ayudante de Coagulacion', value: '', color: 'background-color:#A2CCFA', unidad: '$ / m3' },
            { id: 6, name: 'Dosis de Ayudante de Coagulancion', value: '', color: 'background-color:#A2CCFA', unidad: 'ppm' },
            { id: 7, name: '$ /m3 de Tratamiento', value: '', color: 'background-color:yellow', unidad: '$ / m3' },
            { id: 8, name: '.', value: 'titulo', color: '' },
            { id: 9, name: 'Nuevo Costo del Tratamiento', value: '', color: 'background-color:yellow', unidad: '$ / m3' }
          ]
        }
      ]
    }
  },
  // operaciones
  updated () {
    this.porcentajesSustitucion()
    this.relacionesReemplazo()
    this.tratamientoActual()
    this.tratamientoSustitucionParcial()
  },
  mounted () {
    this.porcentajesSustitucion()
    this.relacionesReemplazo()
    this.tratamientoActual()
    this.tratamientoSustitucionParcial()
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
    porcentajesSustitucion () {
      this.tables[1].fields[1].value = this.tables[0].fields[2].value * (1 - (this.tables[1].fields[0].value / 100))
      this.tables[1].fields[2].value = this.tables[0].fields[2].value - this.tables[1].fields[1].value
    },
    relacionesReemplazo () {
      this.tables[2].fields[1].value = this.tables[1].fields[2].value / this.tables[2].fields[0].value
    },
    tratamientoActual () {
      this.tables[3].fields[2].value = this.tables[0].fields[2].value
      this.tables[3].fields[3].value = (this.tables[3].fields[1].value * this.tables[3].fields[2].value) / 1000
    },
    tratamientoSustitucionParcial () {
      this.tables[4].fields[0].value = this.tables[3].fields[1].value
      this.tables[4].fields[1].value = this.tables[1].fields[1].value
      this.tables[4].fields[5].value = this.tables[2].fields[1].value
      this.tables[4].fields[2].value = (this.tables[4].fields[0].value * this.tables[4].fields[1].value) / 1000
      this.tables[4].fields[6].value = (this.tables[4].fields[4].value * this.tables[4].fields[5].value) / 1000
      this.tables[4].fields[8].value = this.tables[4].fields[2].value + this.tables[4].fields[6].value
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
