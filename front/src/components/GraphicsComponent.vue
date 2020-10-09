<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <q-btn color="primary" class="full-width" v-if="idproject === undefined || idproject === ''" label="Seleccionar proyecto" icon="add" @click="addProject" />
                <q-btn color="primary" outline class="full-width" v-else label="Cambiar proyecto" icon="edit" @click="addProject" />
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
      chartOptions1: {
        chart: {
          type: 'area'
        },
        title: {
          text: 'Reportes por fecha'
        },
        xAxis: {
          categories: ['Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x', 'Fecha x']
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
          name: 'Gastos',
          data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
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
      this.generar = true
    },

    addProject () {
      this.dialog = true
    }
  }
}
</script>
