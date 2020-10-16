<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <q-btn color="primary" outline class="full-width" v-if="idproject === undefined || idproject === ''" label="Seleccionar proyecto" icon="add" @click="addProject" />
                <q-btn color="primary" outline class="full-width" v-else label="Cambiar proyecto" icon="edit" @click="addProject" />
                <q-input color="grey-3" bg-color="white" label-color="primary" label="Desde" required :rules="[val => !!val || 'Tienes que llenar este campo']" v-model="from">
                  <template v-slot:prepend>
                      <q-icon color="primary" name="event" class="cursor-pointer">
                        <q-popup-proxy transition-show="scale" transition-hide="scale">
                          <q-date v-model="from" mask="YYYY-MM-DD HH:mm" />
                        </q-popup-proxy>
                      </q-icon>
                    </template>

                    <template v-slot:append>
                      <q-icon color="primary" name="access_time" class="cursor-pointer">
                        <q-popup-proxy transition-show="scale" transition-hide="scale">
                          <q-time v-model="from" mask="YYYY-MM-DD HH:mm" format24h />
                        </q-popup-proxy>
                      </q-icon>
                  </template>
                </q-input>
                <q-input color="grey-3" bg-color="white" label-color="primary" label="Hasta" required :rules="[val => !!val || 'Tienes que llenar este campo']" v-model="to">
                  <template v-slot:prepend>
                      <q-icon color="primary" name="event" class="cursor-pointer">
                        <q-popup-proxy transition-show="scale" transition-hide="scale">
                          <q-date v-model="to" mask="YYYY-MM-DD HH:mm" />
                        </q-popup-proxy>
                      </q-icon>
                    </template>

                    <template v-slot:append>
                      <q-icon color="primary" name="access_time" class="cursor-pointer">
                        <q-popup-proxy transition-show="scale" transition-hide="scale">
                          <q-time v-model="to" mask="YYYY-MM-DD HH:mm" format24h />
                        </q-popup-proxy>
                      </q-icon>
                  </template>
                </q-input>
                <q-btn color="primary" class="full-width" label="Generar grafica" @click="generar = true" />
                <highcharts v-if="generar" :options="chartOptions1"></highcharts>
                <q-dialog
                    v-model="dialog"
                    transition-show="slide-up"
                    transition-hide="slide-down"
                >
                    <q-card style="width: 800px; max-width: 80vw;">
                    <q-card-section>
                        <projects-component mode='select' @selectproject="selectProject"></projects-component>
                    </q-card-section>
                    </q-card>
                </q-dialog>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { Chart } from 'highcharts-vue'
import { functions } from '../functions.js'
import ProjectsComponent from 'components/ProjectsComponent.vue'
import { date } from 'quasar'

export default {
  name: 'graphics-component',
  mixins: [functions],
  props: ['mode'],
  components: {
    highcharts: Chart, ProjectsComponent
  },
  data () {
    return {
      idproject: '',
      dialog: false,
      generar: false,
      from: date.formatDate(Date.now(), 'YYYY-MM-DD HH:mm:ss'),
      to: date.formatDate(Date.now(), 'YYYY-MM-DD HH:mm:ss'),
      chartOptions1: {
        exporting: {
          buttons: {
            contextButton: {
              menuItems: ['viewFullscreen', 'printChart', 'separator', 'downloadPNG', 'downloadJPEG', 'downloadPDF', 'downloadSVG',
                {
                  text: 'Nuevo',
                  onclick: function () {
                    console.log('hola')
                  }
                }]
            }
          }
        },
        lang: {
          downloadPDF: 'Descargar PDF',
          downloadPNG: 'Descargar PNG',
          downloadJPEG: 'Descargar JPEG',
          downloadSVG: 'Descargar SVG',
          printChart: 'Imprimir gráfica',
          viewFullscreen: 'Ver en pantalla completa',
          downloadXLS: 'Descargar Excel'
        },
        chart: {
          type: 'line'
        },
        title: {
          text: 'Variable 1'
        },
        xAxis: {
          categories: ['Fecha 02/10/2020', 'Fecha 04/10/2020', 'Fecha 08/10/2020', 'Fecha 10/10/2020', 'Fecha 13/10/2020', 'Fecha 14/10/2020', 'Fecha 15/10/2020']
        },
        yAxis: {
          title: {
            text: 'Valor'
          }
        },
        plotOptions: {
          line: {
            dataLabels: {
              enabled: true
            },
            enableMouseTracking: false
          },
          area: {
            fillColor: {
              linearGradient: {
                x1: 0,
                y1: 0,
                x2: 0,
                y2: 1
              },
              stops: [
                [0, '#E9BC36']
              ]
            },
            marker: {
              radius: 2
            },
            lineWidth: 1,
            states: {
              hover: {
                lineWidth: 1
              }
            },
            threshold: null
          }
        },
        series: [{
          name: 'Minimo',
          data: [0, 0, 0, 0, 0, 0, 0],
          color: '#21ba45'
        },
        {
          name: 'Maximo',
          data: [10, 10, 10, 10, 10, 10, 10],
          color: '#0080DD'
        },
        {
          name: 'Reportes',
          data: [-1, 4, 5, 3, 5, 7, 5],
          color: '#E9BC36'
        }]
      }
    }
  },
  mounted () {
  },
  methods: {
    selectProject (id) {
      this.idproject = id
      this.dialog = false
    },

    addProject () {
      this.dialog = true
    }
  }
}
</script>
