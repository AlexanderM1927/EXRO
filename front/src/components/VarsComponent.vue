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
                            <q-td key="email" :props="props">
                                <div class="text-pre-wrap">{{ props.row.email }}</div>
                            </q-td>
                            <q-td key="rank" :props="props">
                                {{ getRankById(props.row.rank) }}
                            </q-td>
                            <q-td key="ops" :props="props">
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
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { functions } from '../functions.js'

export default {
  name: 'vars-component',
  mixins: [functions],
  props: [],
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
  },
  methods: {
  }
}
</script>
