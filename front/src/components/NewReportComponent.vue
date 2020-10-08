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
                    <q-btn class="right" round type="submit" color="primary" icon="save" />
                </q-form>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { functions } from '../functions.js'

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
        // const p = await UserService.getUser({ id: this.id, token: localStorage.getItem('token') })
        // this.vars = p.data
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    },
    save () {
      console.log('save')
    }
  }
}
</script>
