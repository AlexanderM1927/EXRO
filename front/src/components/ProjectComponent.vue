<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
              <div class="text-h4">{{project.name}}</div>
              <br>
              <q-separator />
              <br>
              <b>Descripción</b><br>
              <pre>{{project.descripcion}}</pre>
              <br><br>
              <q-separator />
              <div class="title">
                <div class="text-h6">
                  Variables asociadas
                  <div class="right">
                    <q-btn v-if="[3, 2, 4, 5, 6].includes(user.rank)" round color="primary" @click="goTo('new-report/' + id)" size="md" icon="assignment">
                      <q-tooltip>
                        Generar reporte
                      </q-tooltip>
                    </q-btn>
                    <q-btn v-if="[3].includes(user.rank)" round color="positive" @click="assocVar" size="md" icon="add">
                      <q-tooltip>
                        Asociar
                      </q-tooltip>
                    </q-btn>
                  </div>
                </div>
              </div>
              <q-table
                :dense="$q.screen.lt.md"
                class="table"
                :data="data"
                :columns="columns"
                row-key="name"
              >
                <template v-slot:body="props">
                  <q-tr :props="props">
                      <q-td key="id" :props="props">
                          {{ props.row.idvariable }}
                      </q-td>
                      <q-td key="name" :props="props">
                          {{ props.row.name }}
                      </q-td>
                      <q-td key="max" :props="props">
                          {{ props.row.max }}
                      </q-td>
                      <q-td key="min" :props="props">
                          {{ props.row.min }}
                      </q-td>
                      <q-td key="ops" :props="props">
                        <a v-if="[3].includes(user.rank)" class="text-red" style="cursor: pointer; padding: 5px;" @click="del(props.row.id)"> <q-icon size="md" name="delete"/>
                          <q-tooltip :delay="1000" :offset="[0, 10]">desasociar</q-tooltip>
                        </a>
                      </q-td>
                  </q-tr>
                </template>
              </q-table><br>
              <q-separator /><br>
              <div class="title">
                <div class="text-h6">
                  Ingenieros asociados
                  <div class="right">
                    <q-btn v-if="[3].includes(user.rank)" round color="positive" @click="assocEngineer" size="md" icon="add">
                      <q-tooltip>
                        Asociar
                      </q-tooltip>
                    </q-btn>
                  </div>
                </div>
              </div>
              <q-table
                :dense="$q.screen.lt.md"
                class="table"
                :data="dataEngineers"
                :columns="columnsEngineers"
                row-key="name"
              >
                <template v-slot:body="props">
                  <q-tr :props="props">
                      <q-td key="id" :props="props">
                          {{ props.row.idingeniero }}
                      </q-td>
                      <q-td key="name" :props="props">
                          {{ props.row.name }}
                      </q-td>
                      <q-td key="ops" :props="props">
                        <a v-if="[3].includes(user.rank)" class="text-red" style="cursor: pointer; padding: 5px;" @click="deleteEngineer(props.row.id)"> <q-icon size="md" name="delete"/>
                          <q-tooltip :delay="1000" :offset="[0, 10]">desasociar</q-tooltip>
                        </a>
                      </q-td>
                  </q-tr>
                </template>
              </q-table>
              <q-separator /><br>
              <div class="title">
                <div class="text-h6">
                  Técnicos asociados
                  <div class="right">
                    <q-btn v-if="[3].includes(user.rank)" round color="positive" @click="assocTechnical" size="md" icon="add">
                      <q-tooltip>
                        Asociar
                      </q-tooltip>
                    </q-btn>
                  </div>
                </div>
              </div>
              <q-table
                :dense="$q.screen.lt.md"
                class="table"
                :data="dataTechnicals"
                :columns="columnsTechnicals"
                row-key="name"
              >
                <template v-slot:body="props">
                  <q-tr :props="props">
                      <q-td key="id" :props="props">
                          {{ props.row.idingeniero }}
                      </q-td>
                      <q-td key="name" :props="props">
                          {{ props.row.name }}
                      </q-td>
                      <q-td key="ops" :props="props">
                        <a v-if="[3].includes(user.rank)" class="text-red" style="cursor: pointer; padding: 5px;" @click="deleteEngineer(props.row.id)"> <q-icon size="md" name="delete"/>
                          <q-tooltip :delay="1000" :offset="[0, 10]">desasociar</q-tooltip>
                        </a>
                      </q-td>
                  </q-tr>
                </template>
              </q-table>
              <q-separator /><br>
              <div class="title">
                <div class="text-h6">
                  Consultar reportes por fechas
                </div>
              </div>
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
              <div class="row">
                <div class="col-md-6">
                  <q-btn color="black" class="full-width" label="Generar reporte" @click="generarGrilla" />
                </div>
                <div class="col-md-6">
                  <q-btn color="primary" class="full-width" label="Generar grafica" @click="generarGraficas" />
                </div>
              </div>
              <div v-for="(value, key) in graphics" v-bind:key="value.id">
                <highcharts :options="getChartOptions(key)"></highcharts><br>
                <analisis-grafica-component :values="value"></analisis-grafica-component>
                <br>
                <q-separator />
              </div>
              <q-dialog
                v-model="dialog"
                transition-show="slide-up"
                transition-hide="slide-down"
              >
                <q-card style="width: 800px; max-width: 80vw;">
                <q-card-section>
                    <vars-component mode="project" @add="add" :project="id"></vars-component>
                </q-card-section>
                </q-card>
              </q-dialog>
              <q-dialog
                v-model="dialogEngineers"
                transition-show="slide-up"
                transition-hide="slide-down"
              >
                <q-card style="width: 800px; max-width: 80vw;">
                <q-card-section>
                    <users-component mode='engineer' @addengineer="addengineer"></users-component>
                </q-card-section>
                </q-card>
              </q-dialog>
              <q-dialog
                v-model="dialogTechnicals"
                transition-show="slide-up"
                transition-hide="slide-down"
              >
                <q-card style="width: 800px; max-width: 80vw;">
                <q-card-section>
                    <users-component mode='technical' @addtechnical="addtechnical"></users-component>
                </q-card-section>
                </q-card>
              </q-dialog>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
// import VarService from '../services/VarService'
import ProjectService from '../services/ProjectService'
import VariablesProjectsService from '../services/VariablesProjectsService'
import EngineersPojectsService from '../services/EngineersPojectsService'
import VarsComponent from 'components/VarsComponent.vue'
import UsersComponent from 'components/UsersComponent.vue'
import MaxMinVar from './Dialogs/MaxMinVar.vue'
import { functions } from '../functions.js'
import { date } from 'quasar'
import AnalisisGraficaComponent from 'components/AnalisisGraficaComponent.vue'
import StaticsService from '../services/StatisticService'
import { Chart } from 'highcharts-vue'

export default {
  name: 'project-component',
  mixins: [functions],
  components: {
    highcharts: Chart, VarsComponent, UsersComponent, AnalisisGraficaComponent
  },
  props: ['user'],
  data () {
    return {
      id: this.$route.params.id,
      project: {},
      columns: [
        { name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
        { name: 'name', align: 'center', label: 'Nombre', field: 'name', sortable: true },
        { name: 'max', align: 'center', label: 'Maximo', field: 'max', sortable: true },
        { name: 'min', align: 'center', label: 'Minimo', field: 'min', sortable: true },
        { name: 'ops', align: 'center', label: 'Opciones', field: 'ops', sortable: true }
      ],
      columnsEngineers: [
        { name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
        { name: 'name', align: 'center', label: 'Nombre', field: 'name', sortable: true },
        { name: 'ops', align: 'center', label: 'Opciones', field: 'ops', sortable: true }
      ],
      columnsTechnicals: [
        { name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
        { name: 'name', align: 'center', label: 'Nombre', field: 'name', sortable: true },
        { name: 'ops', align: 'center', label: 'Opciones', field: 'ops', sortable: true }
      ],
      data: [],
      dataEngineers: [],
      dataTechnicals: [],
      dialog: false,
      dialogEngineers: false,
      dialogTechnicals: false,
      from: date.formatDate(Date.now(), 'YYYY-MM-DD HH:mm:ss'),
      to: date.formatDate(Date.now(), 'YYYY-MM-DD HH:mm:ss'),
      graphics: []
    }
  },
  mounted () {
    this.getVarInfo()
  },
  methods: {
    getChartOptions (params) {
      return this.getChar(params)
    },
    async generarGraficas () {
      this.generar = true
      const params = {}
      params.idproyecto = this.id
      params.token = localStorage.getItem('token')
      params.from = this.from
      params.to = this.to
      this.activateLoading('Cargando')
      const p = await StaticsService.getStats(params)
      this.disableLoading()
      this.graphics = p.data.statics
      this.getVars(this.graphics)
    },
    async generarGrilla () {
      this.generar = true
      const params = {}
      params.idproyecto = this.id
      params.token = localStorage.getItem('token')
      params.from = this.from
      params.to = this.to
      this.activateLoading('Cargando')
      const p = await StaticsService.getStats(params)
      this.disableLoading()
      this.graphics = p.data.statics
      this.getVars(this.graphics)
    },
    async getVarInfo () {
      try {
        this.activateLoading('Cargando')
        const p = await ProjectService.getProject({ id: this.id, token: localStorage.getItem('token') })
        this.project = p.data.project
        const q = await VariablesProjectsService.getVariablesByProject({ id: this.id, token: localStorage.getItem('token') })
        this.data = q.data.variablesprojects
        const r = await EngineersPojectsService.getEngineersByProject({ id: this.id, token: localStorage.getItem('token') })
        this.dataEngineers = r.data.engineerProject
        const s = await EngineersPojectsService.getTechnicalsByProject({ id: this.id, token: localStorage.getItem('token') })
        this.dataTechnicals = s.data.engineerProject
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    },
    assocVar () {
      this.dialog = true
    },
    assocEngineer () {
      this.dialogEngineers = true
    },
    assocTechnical () {
      this.dialogTechnicals = true
    },
    async add (params) {
      this.dialog = false
      this.$q.dialog({
        component: MaxMinVar,
        parent: this
      }).onOk(async (data) => {
        data.token = localStorage.getItem('token')
        data.idproyecto = this.id
        data.idvariable = params.id
        try {
          this.activateLoading('Cargando')
          const p = await VariablesProjectsService.newVariablesProjects(data)
          if (p.status === 201) {
            this.getVarInfo()
            this.alert('positive', 'Variables agregadas exitosamente')
          }
        } catch (error) {
          this.alert('negative', 'Se ha presentado un error al agregar las variables')
        }
        this.disableLoading()
      }).onCancel(() => {
        // console.log('Cancel')
      }).onDismiss(() => {
        // console.log('Called on OK or Cancel')
      })
    },
    async addengineer (params) {
      this.dialogEngineers = false
      const data = {}
      data.token = localStorage.getItem('token')
      data.idproyecto = this.id
      data.idingeniero = params.id
      try {
        this.activateLoading('Cargando')
        const p = await EngineersPojectsService.newEngineerProject(data)
        if (p.status === 201) {
          this.getVarInfo()
          this.alert('positive', 'Ingeniero agregado exitosamente')
        }
      } catch (error) {
        this.alert('negative', 'Se ha presentado un error al agregar el ingeniero')
      }
      this.disableLoading()
    },
    async addtechnical (params) {
      this.dialogTechnicals = false
      const data = {}
      data.token = localStorage.getItem('token')
      data.idproyecto = this.id
      data.idingeniero = params.id
      try {
        this.activateLoading('Cargando')
        const p = await EngineersPojectsService.newEngineerProject(data)
        if (p.status === 201) {
          this.getVarInfo()
          this.alert('positive', 'Técnico agregado exitosamente')
        }
      } catch (error) {
        this.alert('negative', 'Se ha presentado un error al agregar el técnico')
      }
      this.disableLoading()
    },
    async del (id) {
      try {
        this.activateLoading('Cargando')
        const p = await VariablesProjectsService.deleteVarProject({ id: id, token: localStorage.getItem('token') })
        if (p.status === 200) {
          this.getVarInfo()
          this.alert('positive', 'Eliminado correctamente')
        }
      } catch (error) {
        this.alert('negative', 'Se presentó un error')
      }
      this.disableLoading()
    },
    async deleteEngineer (id) {
      try {
        this.activateLoading('Cargando')
        const p = await EngineersPojectsService.deleteEngineerProjectById({ id: id, token: localStorage.getItem('token') })
        if (p.status === 200) {
          this.getVarInfo()
          this.alert('positive', 'Eliminado correctamente')
        }
      } catch (error) {
        this.alert('negative', 'Se presentó un error')
      }
      this.disableLoading()
    }
  }
}
</script>
<style lang="scss" scoped>
.right {
  float: right;
}
</style>
