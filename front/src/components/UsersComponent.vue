<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="title">
                    <div class="text-h6">
                        Usuarios
                        <div class="right">
                          <q-btn round color="positive" @click="createUser" size="sm" icon="add">
                            <q-tooltip>
                                Agregar
                            </q-tooltip>
                          </q-btn>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
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
                                    {{ props.row.id }}
                                </q-td>
                                <q-td key="name" :props="props">
                                    {{ props.row.name }}
                                </q-td>
                                <q-td key="email" :props="props">
                                    <div class="text-pre-wrap">{{ props.row.email }}</div>
                                </q-td>
                                <q-td key="rank" :props="props">
                                    {{ getRankById(props.row.rank) }}
                                </q-td>
                                <q-td key="ops" v-if="mode === 'project'" :props="props">
                                  <a class="text-blue" style="cursor: pointer; padding: 5px;" @click="$emit('add', props.row)"> <q-icon size="md" name="add"/>
                                    <q-tooltip :delay="1000" :offset="[0, 10]">agregar</q-tooltip>
                                  </a>
                                </q-td>
                                <q-td key="ops" v-else-if="mode === 'engineer'" :props="props">
                                  <a class="text-blue" style="cursor: pointer; padding: 5px;" @click="$emit('addengineer', props.row)"> <q-icon size="md" name="add"/>
                                    <q-tooltip :delay="1000" :offset="[0, 10]">agregar</q-tooltip>
                                  </a>
                                </q-td>
                                <q-td key="ops" v-else :props="props">
                                  <a class="text-blue" style="cursor: pointer; padding: 5px;" @click="goTo('user/' + props.row.id)"> <q-icon size="md" name="edit"/>
                                    <q-tooltip :delay="1000" :offset="[0, 10]">editar</q-tooltip>
                                  </a>
                                  <a class="text-red" style="cursor: pointer; padding: 5px;" @click="del(props.row.id)"> <q-icon size="md" name="delete"/>
                                    <q-tooltip :delay="1000" :offset="[0, 10]">eliminar</q-tooltip>
                                  </a>
                                </q-td>
                            </q-tr>
                        </template>
                    </q-table>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import UserService from '../services/UserService'
import AddUser from './Dialogs/AddUser.vue'
import { functions } from '../functions.js'

export default {
  name: 'users-component',
  mixins: [functions],
  props: ['mode'],
  data () {
    return {
      columns: [
        { name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
        { name: 'name', align: 'center', label: 'Nombre', field: 'name', sortable: true },
        { name: 'email', align: 'center', label: 'Email', field: 'email', sortable: true },
        { name: 'rank', align: 'center', label: 'Tipo', field: 'rank', sortable: true },
        { name: 'ops', align: 'center', label: 'Opciones', field: 'ops', sortable: true }
      ],
      data: []
    }
  },
  mounted () {
    this.getUsers()
  },
  methods: {
    async getUsers () {
      try {
        this.activateLoading('Cargando')
        let us = {}
        if (this.mode === 'project') us = await UserService.getClients({ token: localStorage.getItem('token') })
        else {
          if (this.mode === 'engineer') us = await UserService.getEngineers({ token: localStorage.getItem('token') })
          else us = await UserService.getUsers({ token: localStorage.getItem('token') })
        }
        const users = us.data.users
        this.data = users
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    },
    createUser () {
      this.$q.dialog({
        component: AddUser,
        parent: this,
        text: 'Hola'
      }).onOk(async (data) => {
        data.token = localStorage.getItem('token')
        try {
          this.activateLoading('Cargando')
          const p = await UserService.register(data)
          this.getUsers()
          if (p.status === 201) {
            this.alert('positive', 'Usuario agregado correctamente')
          }
        } catch (error) {
          this.alert('negative', 'Se ha presentado un error al crear el usuario')
        }
        this.disableLoading()
      }).onCancel(() => {
        // console.log('Cancel')
      }).onDismiss(() => {
        // console.log('Called on OK or Cancel')
      })
    },
    async del (id) {
      try {
        this.activateLoading('Cargando')
        const p = await UserService.deleteUser({ id: id, token: localStorage.getItem('token') })
        if (p.status === 200) {
          this.getUsers()
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
