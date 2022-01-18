<template>
    <div ref="content">
        <center>
          <div class="text-h4">
            {{ formName }}
          </div>
        </center>
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
                                  <option value="EXRO 633">EXRO 663</option>
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
            <div class="form__buttons">
              <!-- <q-btn color="primary" label="Ver interpretacion y productos sugeridos" @click="getInterpretacion"></q-btn> -->
              <q-btn color="black" label="Exportar PDF" @click="printPDF"></q-btn>
            </div>
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
        <div class="row">
          <div class="col-12">
            <div style="text-align: justify;" v-html="configuration.messageCalculate"></div>
          </div>
        </div>
    </div>
</template>

<script>
import { functions } from '../../functions.js'
import JSPDF from 'jspdf'
import domtoimage from 'dom-to-image'

export default {
  props: ['configuration'],
  name: 'form-6-component',
  mixins: [functions],
  data () {
    return {
      formName: 'Filtración - Rata de Flujo',
      interpretacion: '',
      showInterpretacion: false,
      products: [],
      tables: [
        {
          id: 1,
          name: 'Rata de Filtracion',
          fields: [
            { id: 1, name: 'Q a trabajar (m^3/hora)', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Q a trabajar (m^3/seg)', value: '', color: 'background-color:yellow' },
            { id: 3, name: 'Q a trabajar (gpm)', value: '', color: 'background-color:yellow' },
            { id: 4, name: 'Diámetro Filtro (metros)', value: '', color: 'background-color:#A2CCFA' },
            { id: 5, name: 'Diámetro Filtro (in)', value: '', color: 'background-color:yellow' },
            { id: 6, name: 'Diámetro Filtro (ft)', value: '', color: 'background-color:yellow' },
            { id: 7, name: 'Area (m2)', value: '', color: 'background-color:yellow' },
            { id: 8, name: 'Area (ft^2)', value: '', color: 'background-color:yellow' },
            { id: 9, name: 'Rata de Flujo (gpm/ft2)', value: '', color: 'background-color:yellow' },
            { id: 10, name: 'Rata de Flujo (m3/(m2/día))', value: '', color: 'background-color:yellow' },
            { id: 11, name: 'RF (gpm/ft2)', value: '', color: 'background-color:#A2CCFA' },
            { id: 12, name: 'RF (m3/m2*día)', value: '', color: 'background-color:yellow' },
            { id: 13, name: 'RF (m3/m2*día)', value: '', color: 'background-color:#A2CCFA' },
            { id: 14, name: 'RF (gpm/ft2)', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 2,
          name: 'Volumen de llenado filtro',
          fields: [
            { id: 1, name: 'Altura Recta Filtro (metros)', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Altura Recta Filtro (in)', value: '', color: 'background-color:yellow' },
            { id: 3, name: 'V 100% (mts3)', value: '', color: 'background-color:yellow' },
            { id: 4, name: 'V 60% (mts3)', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 3,
          name: 'Velocidad lineal del fluido',
          fields: [
            { id: 1, name: 'Ø Tubería (in)', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'Ø Tubería (metros)', value: '', color: 'background-color:yellow' },
            { id: 3, name: 'A (m^2)', value: '', color: 'background-color:yellow' },
            { id: 4, name: 'V (m/seg)', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 4,
          name: 'Densidad de Lechos',
          fields: [
            { id: 1, name: 'ɗ Gravas (kg/m3)', value: '', color: 'background-color:#A2CCFA' },
            { id: 2, name: 'ɗ Carbón (kg/m3)', value: '', color: 'background-color:#A2CCFA' },
            { id: 3, name: 'ɗ Turbidex (Kg/ft3)', value: '', color: 'background-color:#A2CCFA' }
          ]
        },
        {
          id: 5,
          name: 'Estratificacion del lecho - OPCIÓN 1  Gravas y Arenas',
          fields: [
            { id: 1, name: 'Grava # 6-8 (Kg)', value: '', color: 'background-color:yellow' },
            { id: 2, name: 'Gravilla # 8-14 (Kg)', value: '', color: 'background-color:yellow' },
            { id: 3, name: 'Arena # 14-20 (Kg)', value: '', color: 'background-color:yellow' },
            { id: 4, name: 'Arena 20-40 (Kg)', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 6,
          name: 'Estratificacion del lecho - OPCIÓN 2 Grava, Arena y Turbidex',
          fields: [
            { id: 1, name: 'Grava # 6-8 (Kg)', value: '', color: 'background-color:yellow' },
            { id: 2, name: 'Gravilla # 8-14 (Kg)', value: '', color: 'background-color:yellow' },
            { id: 3, name: 'Arena # 14-20 (Kg)', value: '', color: 'background-color:yellow' },
            { id: 4, name: 'Turbidex (ft3)', value: '', color: 'background-color:yellow' }
          ]
        },
        {
          id: 7,
          name: 'Estratificacion del lecho - OPCIÓN 3 Grava, Gravilla y Carbon Activado',
          fields: [
            { id: 1, name: 'Grava # 6-8 (Kg)', value: '', color: 'background-color:yellow' },
            { id: 2, name: 'Gravilla # 8-14 (Kg)', value: '', color: 'background-color:yellow' },
            { id: 3, name: 'Carbon Activado (Kg)', value: '', color: 'background-color:yellow' }
          ]
        }
      ]
    }
  },
  // operaciones
  updated () {
    this.qATrabajarUno()
    this.qATrabajarDos()
    this.diametroFiltroUno()
    this.diametroFiltroDos()
    this.areaUno()
    this.areaDos()
    this.rataFlujoUno()
    this.rataFlujoDos()
    this.rfUno()
    this.rfDos()
    this.alturaRectoFiltro()
    this.vUno()
    this.vDos()
    this.tuberia()
    this.aUno()
    this.vTres()
    this.gravaUno()
    this.gravillaUno()
    this.arenaUno()
    this.arenaDos()
    this.gravaDos()
    this.gravillaDos()
    this.arenaTres()
    this.turbidexUno()
    this.gravaTres()
    this.gravillaTres()
    this.carbonActivadoUno()
  },
  mounted () {
    this.qATrabajarUno()
    this.qATrabajarDos()
    this.diametroFiltroUno()
    this.diametroFiltroDos()
    this.areaUno()
    this.areaDos()
    this.rataFlujoUno()
    this.rataFlujoDos()
    this.rfUno()
    this.rfDos()
    this.alturaRectoFiltro()
    this.vUno()
    this.vDos()
    this.tuberia()
    this.aUno()
    this.vTres()
    this.gravaUno()
    this.gravillaUno()
    this.arenaUno()
    this.arenaDos()
    this.gravaDos()
    this.gravillaDos()
    this.arenaTres()
    this.turbidexUno()
    this.gravaTres()
    this.gravillaTres()
    this.carbonActivadoUno()
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
    qATrabajarUno () {
      this.tables[0].fields[1].value = Math.round((this.tables[0].fields[0].value / 3600) * 100000000) / 100000000
    },
    qATrabajarDos () {
      this.tables[0].fields[2].value = Math.round(((this.tables[0].fields[0].value * 1000) / (3.785 * 60)) * 1000) / 1000
    },
    diametroFiltroUno () {
      this.tables[0].fields[4].value = Math.round(((this.tables[0].fields[3].value / 2.54) * 100) * 1000) / 1000
    },
    diametroFiltroDos () {
      this.tables[0].fields[5].value = Math.round((this.tables[0].fields[3].value * 3.28084) * 1000) / 1000
    },
    areaUno () {
      this.tables[0].fields[6].value = Math.round((this.tables[0].fields[7].value * 0.092903) * 1000) / 1000
    },
    areaDos () {
      this.tables[0].fields[7].value = Math.round(((3.1416 * Math.pow((this.tables[0].fields[5].value), 2)) / 4) * 1000) / 1000
    },
    rataFlujoUno () {
      this.tables[0].fields[8].value = Math.round((this.tables[0].fields[2].value / this.tables[0].fields[7].value) * 1000) / 1000
    },
    rataFlujoDos () {
      this.tables[0].fields[9].value = Math.round(((this.tables[0].fields[8].value * 3.7851 * 1440) / (1000 * 0.092903)) * 1000) / 1000
    },
    rfUno () {
      this.tables[0].fields[11].value = Math.round(((this.tables[0].fields[10].value * 3.785 * 1440) / (1000 * 0.0929)) * 1000) / 1000
    },
    rfDos () {
      this.tables[0].fields[13].value = Math.round(((this.tables[0].fields[12].value * 1000) / (3.785 * 10.7639 * 1440)) * 1000) / 1000
    },
    alturaRectoFiltro () {
      this.tables[1].fields[1].value = Math.round((this.tables[1].fields[0].value * 100 / 2.54) * 1000) / 1000
    },
    vUno () {
      this.tables[1].fields[2].value = Math.round((((3.14116 * Math.pow((this.tables[0].fields[3].value), 2)) * this.tables[1].fields[0].value) / 4) * 1000) / 1000
    },
    vDos () {
      this.tables[1].fields[3].value = Math.round((this.tables[1].fields[2].value * 0.6) * 1000) / 1000
    },
    tuberia () {
      this.tables[2].fields[1].value = Math.round((this.tables[2].fields[0].value * 0.0254) * 1000000) / 1000000
    },
    aUno () {
      this.tables[2].fields[2].value = Math.round(((3.1416 * Math.pow((this.tables[2].fields[1].value), 2)) / 4) * 10000000) / 10000000
    },
    vTres () {
      this.tables[2].fields[3].value = Math.round((this.tables[0].fields[1].value / this.tables[2].fields[2].value) * 1000000) / 1000000
    },
    gravaUno () {
      this.tables[4].fields[0].value = Math.round((this.tables[1].fields[3].value * 1500 * 0.25) * 1000) / 1000
    },
    gravillaUno () {
      this.tables[4].fields[1].value = Math.round((this.tables[1].fields[3].value * 1500 * 0.15) * 1000) / 1000
    },
    arenaUno () {
      this.tables[4].fields[2].value = Math.round((this.tables[1].fields[3].value * 1500 * 0.1) * 1000) / 1000
    },
    arenaDos () {
      this.tables[4].fields[3].value = Math.round((this.tables[1].fields[3].value * 1500 * 0.5) * 1000) / 1000
    },
    gravaDos () {
      this.tables[5].fields[0].value = Math.round((this.tables[1].fields[3].value * 1500 * 0.25) * 1000) / 1000
    },
    gravillaDos () {
      this.tables[5].fields[1].value = Math.round((this.tables[1].fields[3].value * 1500 * 0.15) * 1000) / 1000
    },
    arenaTres () {
      this.tables[5].fields[2].value = Math.round((this.tables[1].fields[3].value * 1500 * 0.1) * 1000) / 1000
    },
    turbidexUno () {
      this.tables[5].fields[3].value = Math.round(((this.tables[1].fields[3].value * 802.5 * 0.6) / this.tables[3].fields[2].value) * 1000) / 1000
    },
    gravaTres () {
      this.tables[6].fields[0].value = Math.round((this.tables[1].fields[3].value * 1500 * 0.25) * 1000) / 1000
    },
    gravillaTres () {
      this.tables[6].fields[1].value = Math.round((this.tables[1].fields[3].value * 1500 * 0.1) * 1000) / 1000
    },
    carbonActivadoUno () {
      this.tables[6].fields[2].value = Math.round((this.tables[1].fields[3].value * this.tables[3].fields[1].value * 0.65) * 1000) / 1000
    },
    printPDF () {
      /** WITH CSS */
      document.getElementsByClassName('form__buttons')[0].style.display = 'none'
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
        document.getElementsByClassName('form__buttons')[0].style.display = 'block'
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
