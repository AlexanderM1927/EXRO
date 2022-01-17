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
                :data="dataVars"
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
                          <q-popup-edit v-model="props.row.max" title="Actualizar max">
                            <q-input type="number" v-model="props.row.max" dense autofocus @keyup.enter="updateRow(props.row)" />
                          </q-popup-edit>
                      </q-td>
                      <q-td key="min" :props="props">
                          {{ props.row.min }}
                          <q-popup-edit v-model="props.row.min" title="Actualizar min">
                            <q-input type="number" v-model="props.row.min" dense autofocus @keyup.enter="updateRow(props.row)" />
                          </q-popup-edit>
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
                  Gerentes asociados
                  <div class="right">
                    <q-btn v-if="[3].includes(user.rank)" round color="positive" @click="assocManager" size="md" icon="add">
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
                :data="dataManagers"
                :columns="columnsManagers"
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
                  Supervisores asociados
                  <div class="right">
                    <q-btn v-if="[3].includes(user.rank)" round color="positive" @click="assocSupervisor" size="md" icon="add">
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
                :data="dataSupervisors"
                :columns="columnsSupervisors"
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
              <div v-for="(value, key) in graphics" v-bind:key="key">
                <highcharts :options="getChartOptions(key, value)"></highcharts><br>
                <analisis-grafica-component :values="value"></analisis-grafica-component>
                <br>
                <q-separator />
              </div>
              <div v-if="verGrilla">
                <br>
                <q-table
                  :dense="$q.screen.lt.md"
                  class="table"
                  :data="dataGrilla"
                  :columns="columnsGrilla"
                  row-key="date"
                  title="Reportes"
                >
                  <template v-slot:top-right>
                    <q-btn
                      color="primary"
                      icon-right="archive"
                      label="Export to csv"
                      no-caps
                      @click="exportTable"
                    />
                  </template>
                </q-table>
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
              <q-dialog
                v-model="dialogManagers"
                transition-show="slide-up"
                transition-hide="slide-down"
              >
                <q-card style="width: 800px; max-width: 80vw;">
                <q-card-section>
                    <users-component mode='manager' @addmanager="addmanager"></users-component>
                </q-card-section>
                </q-card>
              </q-dialog>
              <q-dialog
                v-model="dialogSupervisors"
                transition-show="slide-up"
                transition-hide="slide-down"
              >
                <q-card style="width: 800px; max-width: 80vw;">
                <q-card-section>
                    <users-component mode='supervisor' @addsupervisor="addsupervisor"></users-component>
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
import { date, exportFile } from 'quasar'
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
      columnsManagers: [
        { name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
        { name: 'name', align: 'center', label: 'Nombre', field: 'name', sortable: true },
        { name: 'ops', align: 'center', label: 'Opciones', field: 'ops', sortable: true }
      ],
      columnsSupervisors: [
        { name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
        { name: 'name', align: 'center', label: 'Nombre', field: 'name', sortable: true },
        { name: 'ops', align: 'center', label: 'Opciones', field: 'ops', sortable: true }
      ],
      dataVars: [],
      dataEngineers: [],
      dataTechnicals: [],
      dataManagers: [],
      dataSupervisors: [],
      dialog: false,
      dialogEngineers: false,
      dialogTechnicals: false,
      dialogManagers: false,
      dialogSupervisors: false,
      from: date.formatDate(Date.now(), 'YYYY-MM-DD HH:mm:ss'),
      to: date.formatDate(Date.now(), 'YYYY-MM-DD HH:mm:ss'),
      graphics: [],
      verGrilla: false,
      dataGrilla: [],
      columnsGrilla: []
    }
  },
  mounted () {
    this.getVarInfo()
  },
  methods: {
    async updateRow (row) {
      try {
        row.token = localStorage.getItem('token')
        this.activateLoading('Cargando')
        const p = await VariablesProjectsService.updateVariablesProjects(row)
        if (p.status === 200) {
          this.getVarInfo()
          this.alert('positive', 'Variable actualizada')
        }
      } catch (error) {
        this.alert('negative', 'Se ha presentado un error al actualizar')
      }
      this.disableLoading()
    },
    getChartOptions (params, value) {
      return this.getChar(params, value)
    },
    async generarGraficas () {
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
      this.verGrilla = true
      const params = {}
      params.idproyecto = this.id
      params.token = localStorage.getItem('token')
      params.from = this.from
      params.to = this.to
      this.activateLoading('Cargando')
      const p = await StaticsService.getStatsGrilla(params)
      this.disableLoading()
      const statistics = p.data.statics
      this.columnsGrilla = [
        { name: 'date', align: 'center', label: 'Fecha', field: 'date', sortable: true }
      ]
      for (let i = 0; i < this.dataVars.length; i++) {
        this.columnsGrilla.push({
          name: i,
          align: 'center',
          label: this.dataVars[i].name,
          field: i,
          sortable: true
        })
      }
      console.log('this.columnsGrilla')
      console.log(this.columnsGrilla)
      const statisticsArray = Object.values(statistics)
      for (let i = 0; i < statisticsArray.length; i++) {
        this.dataGrilla[i] = {
          date: statisticsArray[i][0].date
        }
        for (let y = 0; y < this.dataVars.length; y++) {
          for (let j = 0; j < statisticsArray[i].length; j++) {
            if (this.dataVars[y].id === statisticsArray[i][j].var_id) {
              this.dataGrilla[i][y] = statisticsArray[i][j].value
            }
          }
        }
      }
      this.dataGrilla = Object.values(this.dataGrilla)
      console.log('this.dataGrilla')
      console.log(this.dataGrilla)
    },
    exportTable () {
      // naive encoding to csv format
      const content = [this.columnsGrilla.map(col => this.wrapCsvValue(col.label))].concat(
        this.dataGrilla.map(row => this.columnsGrilla.map(col => this.wrapCsvValue(
          typeof col.field === 'function'
            ? col.field(row)
            : row[col.field === undefined ? col.name : col.field],
          col.format
        )).join(','))
      ).join('\r\n')

      const status = exportFile(
        'table-export.csv',
        content,
        'text/csv'
      )

      if (status !== true) {
        this.alert('negative', 'Browser denied file download...')
      }
    },
    wrapCsvValue (val, formatFn) {
      let formatted = formatFn !== undefined
        ? formatFn(val)
        : val

      formatted = formatted === undefined || formatted === null
        ? ''
        : String(formatted)

      formatted = formatted.split('"').join('""')
      /**
       * Excel accepts \n and \r in strings, but some other CSV parsers do not
       * Uncomment the next two lines to escape new lines
       */
      // .split('\n').join('\\n')
      // .split('\r').join('\\r')

      return `"${formatted}"`
    },
    async getVarInfo () {
      try {
        this.activateLoading('Cargando')
        const p = await ProjectService.getProject({ id: this.id, token: localStorage.getItem('token') })
        this.project = p.data.project
        const q = await VariablesProjectsService.getVariablesByProject({ id: this.id, token: localStorage.getItem('token') })
        this.dataVars = q.data.variablesprojects
        const r = await EngineersPojectsService.getEngineersByProject({ id: this.id, token: localStorage.getItem('token') })
        this.dataEngineers = r.data.engineerProject
        const s = await EngineersPojectsService.getTechnicalsByProject({ id: this.id, token: localStorage.getItem('token') })
        this.dataTechnicals = s.data.engineerProject
        const t = await EngineersPojectsService.getManagersByProject({ id: this.id, token: localStorage.getItem('token') })
        this.dataManagers = t.data.engineerProject
        const x = await EngineersPojectsService.getSupervisorsByProject({ id: this.id, token: localStorage.getItem('token') })
        this.dataSupervisors = x.data.engineerProject
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
    assocManager () {
      this.dialogManagers = true
    },
    assocSupervisor () {
      this.dialogSupervisors = true
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
    async addmanager (params) {
      this.dialogManagers = false
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
    async addsupervisor (params) {
      this.dialogSupervisors = false
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
