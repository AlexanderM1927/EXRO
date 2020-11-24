<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="title">
                  <div class="text-h4">
                      Variables
                      <div class="right">
                        <q-btn round color="positive" @click="createVar" size="sm" icon="add">
                          <q-tooltip>
                              Agregar
                          </q-tooltip>
                        </q-btn>
                      </div>
                  </div>
                </div>
                <br>
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
                            <q-td key="name" :props="props">
                                {{ props.row.name }}
                            </q-td>
                            <q-td key="ops" v-if="mode === 'project'" :props="props">
                                <a class="text-blue" style="cursor: pointer; padding: 5px;" @click="$emit('add', props.row)"> <q-icon size="md" name="add"/>
                                <q-tooltip :delay="1000" :offset="[0, 10]">asociar</q-tooltip>
                                </a>
                            </q-td>
                            <q-td key="ops" v-else :props="props">
                                <a class="text-blue" style="cursor: pointer; padding: 5px;" @click="goTo('var/' + props.row.id)"> <q-icon size="md" name="edit"/>
                                <q-tooltip :delay="1000" :offset="[0, 10]">editar</q-tooltip>
                                </a>
                                <a class="text-red" style="cursor: pointer; padding: 5px;" @click="del(props.row.id)"> <q-icon size="md" name="delete"/>
                                <q-tooltip :delay="1000" :offset="[0, 10]">eliminar</q-tooltip>
                                </a>
                            </q-td>
                        </q-tr>
                    </template>
                    <template v-slot:top-right>
                        <q-input borderless dense debounce="300" v-model="filter" placeholder="Buscar">
                        <template v-slot:append>
                            <q-icon name="search" />
                        </template>
                        </q-input>
                    </template>
                </q-table>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import VarService from '../services/VarService'
import AddVar from './Dialogs/AddVar.vue'
import { functions } from '../functions.js'

export default {
  name: 'vars-component',
  mixins: [functions],
  props: ['mode'],
  data () {
    return {
      filter: '',
      columns: [
        { name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
        { name: 'name', align: 'center', label: 'Nombre', field: 'name', sortable: true },
        { name: 'ops', align: 'center', label: 'Opciones', field: 'ops', sortable: true }
      ],
      data: []
    }
  },
  mounted () {
    this.getVars()
  },
  methods: {
    createVar () {
      this.$q.dialog({
        component: AddVar,
        parent: this,
        text: 'Hola'
      }).onOk(async (data) => {
        data.token = localStorage.getItem('token')
        this.save(data)
      }).onCancel(() => {
        // console.log('Cancel')
      }).onDismiss(() => {
        // console.log('Called on OK or Cancel')
      })
    },
    async save (data) {
      try {
        this.activateLoading('Cargando')
        const p = await VarService.addVar(data)
        if (p.status === 201) {
          this.alert('positive', 'Variable agregada correctamente')
          this.getVars()
        }
      } catch (error) {
        if (error.status === 422) {
          this.alert('negative', 'Ya existe una variable con ese nombre')
        } else {
          this.alert('negative', 'Error al agregar una variable')
        }
      }
      this.disableLoading()
    },
    async getVars () {
      this.activateLoading('Cargando')
      const p = await VarService.getVars({ token: localStorage.getItem('token') })
      this.data = p.data.vars
      this.disableLoading()
    },
    async del (id) {
      if (this.confirmAction('eliminar', 'variable')) {
        try {
          this.activateLoading('Cargando')
          const p = await VarService.deleteVar({ id: id, token: localStorage.getItem('token') })
          if (p.status === 200) {
            this.getVars()
            this.alert('positive', 'Eliminado correctamente')
          }
        } catch (error) {
          this.alert('negative', 'Se presentó un error')
        }
        this.disableLoading()
      }
    }
  }
}
</script>
