<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="project.name" label="Nombre" required :rules="[val => !!val || 'Este campo es necesario']">
                    <template v-slot:append>
                        <q-icon name="account_circle" color="primary" />
                    </template>
                </q-input>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
// import VarService from '../services/VarService'
import ProjectService from '../services/ProjectService'
import { functions } from '../functions.js'

export default {
  name: 'project-component',
  mixins: [functions],
  props: [],
  data () {
    return {
      id: this.$route.params.id,
      project: {}
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
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    }
  }
}
</script>
