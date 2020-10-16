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
                <q-btn color="primary" class="full-width" label="Generar grafica" @click="validateForm([idproject], generarGraficas)" />
                <div v-for="(value, key) in graphics" v-bind:key="value.id">
                  <highcharts v-if="generar" :options="getChartOptions(key)"></highcharts>
                </div>
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
import StaticsService from '../services/StatisticService'
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
      graphics: []
    }
  },
  methods: {
    async generarGraficas () {
      this.generar = true
      var params = {}
      params.idproyecto = this.idproject
      params.token = localStorage.getItem('token')
      params.from = this.from
      params.to = this.to
      this.activateLoading('Cargando')
      const p = await StaticsService.getStats(params)
      this.disableLoading()
      this.graphics = p.data.statics
      this.getVars(this.graphics)
    },
    async selectProject (id) {
      this.idproject = id
      this.dialog = false
    },

    addProject () {
      this.dialog = true
    },
    getChartOptions (params) {
      return this.getChar(params)
    }
  }
}
</script>
