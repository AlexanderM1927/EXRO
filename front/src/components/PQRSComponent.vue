<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="title">
                  <div class="text-h4">
                      PQRS
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
                        :filter="filter"
                    >
                        <template v-slot:body="props">
                            <q-tr :props="props">
                                <q-td key="id" :props="props">
                                    {{ props.row.id }}
                                </q-td>
                                <q-td key="type" :props="props">
                                    {{ props.row.type }}
                                </q-td>
                                <q-td key="user" :props="props">
                                    <div class="text-pre-wrap">{{ props.row.user }}</div>
                                </q-td>
                                <q-td key="ops" :props="props">
                                  <a class="text-blue" style="cursor: pointer; padding: 5px;" @click="verMsg(props.row)"> <q-icon size="md" name="search"/>
                                    <q-tooltip :delay="1000" :offset="[0, 10]">ver</q-tooltip>
                                  </a>
                                  <a class="text-red" style="cursor: pointer; padding: 5px;" @click="del(props.row.id)"> <q-icon size="md" name="delete"/>
                                    <q-tooltip :delay="1000" :offset="[0, 10]">eliminar</q-tooltip>
                                  </a>
                                </q-td>
                            </q-tr>
                        </template>
                        <template v-slot:top-right>
                            <q-input dense color="grey-3" bg-color="white" label-color="primary" filled debounce="300" v-model="filter" placeholder="Buscar">
                            <template v-slot:append>
                                <q-icon name="search" />
                            </template>
                            </q-input>
                        </template>
                    </q-table>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { functions } from '../functions.js'
import ChatService from '../services/ChatService.js'
import ChatInformation from './Dialogs/ChatInformation.vue'

export default {
  name: 'pqrs-component',
  mixins: [functions],
  data () {
    return {
      filter: '',
      columns: [
        { name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
        { name: 'type', align: 'center', label: 'Tipo', field: 'type', sortable: true },
        { name: 'user', align: 'center', label: 'Usuario', field: 'user', sortable: true },
        { name: 'ops', align: 'center', label: 'Opciones', field: 'ops', sortable: true }
      ],
      data: []
    }
  },
  mounted () {
    this.getChats()
  },
  methods: {
    async getChats () {
      try {
        this.activateLoading('Cargando')
        const p = await ChatService.getChats({ token: localStorage.getItem('token') })
        const chats = p.data.chats
        this.data = chats
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    },
    del (id) {
      this.$q.dialog({
        title: 'Confirmar',
        message: 'Seguro que deseas eliminar este chat?',
        cancel: true,
        persistent: true
      }).onOk(async () => {
        try {
          this.activateLoading('Cargando')
          const p = await ChatService.deleteChatById({ id: id, token: localStorage.getItem('token') })
          if (p.status === 200) {
            this.getChats()
            this.alert('positive', 'Eliminado correctamente')
          }
        } catch (error) {
          this.alert('negative', 'Se presentó un error')
        }
        this.disableLoading()
      }).onOk(() => {
      }).onCancel(() => {
      }).onDismiss(() => {
      })
    },
    verMsg (msg) {
      this.$q.dialog({
        component: ChatInformation,
        parent: this,
        chatToEdit: msg
      }).onOk(async (data) => {
        if (data.answer) {
          data.token = localStorage.getItem('token')
          try {
            this.activateLoading('Cargando')
            const p = await ChatService.answerChat(data)
            if (p.status === 201) {
              this.alert('positive', 'Haz respondido al chat')
            }
          } catch (error) {
            this.alert('negative', 'Se ha presentado un error al contestar el PQRS')
          }
          this.disableLoading()
        }
      }).onCancel(() => {
        // console.log('Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
    }
  }
}
</script>
