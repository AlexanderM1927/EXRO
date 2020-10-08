<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="text-h6">
                    Crear informe
                </div>
                <q-form @submit="save">
                    <div v-for="variable in vars" v-bind:key="variable.id">
                        <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="variable.valor" type="number" :label="variable.name" required :rules="[val => !!val || 'Este campo es necesario']"></q-input>
                    </div>
                    <q-btn class="right" round type="submit" color="primary" icon="save" />
                </q-form>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { functions } from '../functions.js'
import VariablesprojectsService from '../services/VariablesprojectsService'
import ReportService from '../services/ReportService'

export default {
  name: 'user-component',
  mixins: [functions],
  props: [],
  data () {
    return {
      id: this.$route.params.id,
      vars: []
    }
  },
  mounted () {
    this.getVarsByProject()
  },
  methods: {
    async getVarsByProject () {
      try {
        this.activateLoading('Cargando')
        const p = await VariablesprojectsService.getVariablesByProject({ id: this.id, token: localStorage.getItem('token') })
        this.vars = p.data.variablesprojects
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    },
    async save () {
      const data = {
        variables: this.vars,
        token: localStorage.getItem('token'),
        idproyecto: this.id,
        idingeniero: localStorage.getItem('user')
      }
      try {
        this.activateLoading('Cargando')
        const p = await ReportService.createReport(data)
        this.vars = p.data.variablesprojects
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    }
  }
}
</script>
