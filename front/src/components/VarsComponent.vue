<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="text-h6">Variables</div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 container col-xs-12">
                        <center>
                        <q-form @submit="save">
                            <q-input v-model="variable.name" label="Nombre de la variable" color="grey-3" bg-color="white" label-color="primary">
                                <template v-slot:append>
                                    <q-icon name="title" color="primary" />
                                </template>
                            </q-input><br>
                            <q-btn type="submit" color="positive" label="Agregar"></q-btn>
                        </q-form>
                        </center>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <br>
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
                </q-table>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import VarService from '../services/VarService'
import { functions } from '../functions.js'

export default {
  name: 'vars-component',
  mixins: [functions],
  props: ['mode'],
  data () {
    return {
      variable: {},
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
    async save () {
      try {
        this.variable.token = localStorage.getItem('token')
        this.activateLoading('Cargando')
        const p = await VarService.addVar(this.variable)
        if (p.status === 201) {
          this.variable = {}
          this.alert('positive', 'Variable agregada correctamente')
          this.getVars()
        }
      } catch (error) {
        this.alert('negative', 'Error al agregar una variable')
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
</script>
