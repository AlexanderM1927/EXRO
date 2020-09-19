<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="user.name" label="Nombre" required :rules="[val => !!val || 'Este campo es necesario']">
                    <template v-slot:append>
                        <q-icon name="account_circle" color="primary" />
                    </template>
                </q-input>
                <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="user.email" label="Email" required :rules="[val => !!val || 'Este campo es necesario']">
                    <template v-slot:append>
                        <q-icon name="mail" color="primary" />
                    </template>
                </q-input>
                <q-select color="grey-3" bg-color="white" label-color="primary" filled v-model="user.rank" :options="options" label="Tipo" required :rules="[val => !!val || 'Este campo es necesario']">
                    <template v-slot:append>
                        <q-icon name="check" color="primary" />
                    </template>
                </q-select>
                <center>
                    <q-btn label="Guardar" @click="save" color="primary"></q-btn>
                </center>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import UserService from '../services/UserService'
import { functions } from '../functions.js'

export default {
  name: 'user-component',
  mixins: [functions],
  props: [],
  data () {
    return {
      id: this.$route.params.id,
      user: {},
      options: [
        'Cliente', 'Ingeniero', 'Administrador'
      ]
    }
  },
  mounted () {
    this.getUserInfo()
  },
  methods: {
    async getUserInfo () {
      try {
        this.activateLoading('Cargando')
        const p = await UserService.getUser({ id: this.id, token: localStorage.getItem('token') })
        this.user = p.data.user
        this.user.rank = this.getRankById(p.data.user.rank)
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    },
    async save () {
      try {
        const data = this.user
        data.token = localStorage.getItem('token')
        this.activateLoading('Cargando')
        const p = await UserService.modifyUser(data)
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
