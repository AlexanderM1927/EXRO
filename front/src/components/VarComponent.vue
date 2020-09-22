<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="variable.name" label="Nombre" required :rules="[val => !!val || 'Este campo es necesario']">
                    <template v-slot:append>
                        <q-icon name="account_circle" color="primary" />
                    </template>
                </q-input>
                <center>
                    <q-btn label="Guardar" @click="save" color="primary"></q-btn>
                </center>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import VarService from '../services/VarService'
import { functions } from '../functions.js'

export default {
  name: 'var-component',
  mixins: [functions],
  props: [],
  data () {
    return {
      id: this.$route.params.id,
      variable: {}
    }
  },
  mounted () {
    this.getVarInfo()
  },
  methods: {
    async getVarInfo () {
      try {
        this.activateLoading('Cargando')
        const p = await VarService.getVar({ id: this.id, token: localStorage.getItem('token') })
        this.variable = p.data.var
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    },
    async save () {
      try {
        const data = this.variable
        data.token = localStorage.getItem('token')
        this.activateLoading('Cargando')
        const p = await VarService.modifyVar(data)
        if (p.status === 200) {
          this.alert('positive', 'Guardado correctamente')
        }
      } catch (error) {
        this.alert('negative', 'Se registro un fallo al guardar')
      }
      this.disableLoading()
    }
  }
}
</script>
