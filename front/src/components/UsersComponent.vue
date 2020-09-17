<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="title">
                    <div class="text-h6">
                        Usuarios
                        <q-btn round color="positive" @click="createUser" size="sm" icon="add">
                            <q-tooltip>
                                Agregar
                            </q-tooltip>
                        </q-btn>
                    </div>
                </div>
                <q-separator />
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
                                <q-td key="ops" :props="props">
                                    <q-btn >
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
  props: [],
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
        const us = await UserService.getUsers({ token: localStorage.getItem('token') })
        const users = us.data.users
        this.data = users
      } catch (error) {
        console.log(error)
      }
    },
    createUser () {
      this.$q.dialog({
        component: AddUser,
        parent: this,
        text: 'Hola'
      }).onOk(async (data) => {
        // console.log(data)
      }).onCancel(() => {
        console.log('Cancel')
      }).onDismiss(() => {
        console.log('Called on OK or Cancel')
      })
    }
  }
}
</script>
