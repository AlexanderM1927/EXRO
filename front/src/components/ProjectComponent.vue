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
                    <q-btn round color="positive" @click="assocVar" size="sm" icon="add">
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
                        <a class="text-red" style="cursor: pointer; padding: 5px;" @click="del(props.row.id)"> <q-icon size="md" name="delete"/>
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
                    <q-btn round color="positive" @click="assocEngineer" size="sm" icon="add">
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
                        <a class="text-red" style="cursor: pointer; padding: 5px;" @click="deleteEngineer(props.row.id)"> <q-icon size="md" name="delete"/>
                          <q-tooltip :delay="1000" :offset="[0, 10]">desasociar</q-tooltip>
                        </a>
                      </q-td>
                  </q-tr>
                </template>
              </q-table>
              <q-dialog
                v-model="dialog"
                transition-show="slide-up"
                transition-hide="slide-down"
              >
                <q-card style="width: 800px; max-width: 80vw;">
                <q-card-section>
                    <vars-component mode="project" @add="add"></vars-component>
                </q-card-section>
                </q-card>
              </q-dialog>
              <q-dialog
                v-model="dialogEngineers"
                persistent
                transition-show="slide-up"
                transition-hide="slide-down"
              >
                <q-card style="width: 800px; max-width: 80vw;">
                <q-card-section>
                    <users-component mode= 'engineer' @addengineer="addengineer"></users-component>
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

export default {
  name: 'project-component',
  mixins: [functions],
  components: { VarsComponent, UsersComponent },
  props: [],
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
      data: [],
      dataEngineers: [],
      dialog: false,
      dialogEngineers: false
    }
  },
  mounted () {
    this.getVarInfo()
  },
  methods: {
    async getVarInfo () {
      try {
        this.activateLoading('Cargando')
        const p = await ProjectService.getProject({ id: this.id, token: localStorage.getItem('token') })
        this.project = p.data.project
        const q = await VariablesProjectsService.getVariablesByProject({ id: this.id, token: localStorage.getItem('token') })
        this.data = q.data.variablesprojects
        const r = await EngineersPojectsService.getEngineersByProject({ id: this.id, token: localStorage.getItem('token') })
        this.dataEngineers = r.data.engineerProject
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
