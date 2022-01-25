<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="title">
                  <div class="text-h4">
                      Auditoria
                      <!-- <div class="right">
                        <q-btn round color="primary" @click="truncateLogs" size="md" icon="delete">
                          <q-tooltip>
                              Vaciar
                          </q-tooltip>
                        </q-btn>
                      </div> -->
                  </div>
                </div>
                <br>
                <q-table
                    :dense="$q.screen.lt.md"
                    class="table"
                    :data="data"
                    :columns="columns"
                    row-key="type"
                    :filter="filter"
                    @request="onRequest"
                    :pagination="pagination"
                    :loading="loading"
                    :key="reload"
                >
                    <template v-slot:body="props">
                        <q-tr :props="props">
                            <q-td key="id" :props="props">
                                {{ props.row.id }}
                            </q-td>
                            <q-td key="created_at" :props="props">
                                {{ momentClass(props.row.created_at).format('YYYY-MM-DD') }}
                            </q-td>
                            <q-td key="type" :props="props">
                                {{ props.row.type }}
                            </q-td>
                            <q-td key="action" :props="props">
                                {{ props.row.action }}
                            </q-td>
                            <q-td key="name" :props="props">
                                {{ props.row.name }}
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
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import LogService from '../services/LogService'
import { functions } from '../functions.js'
import moment from 'moment'

export default {
  name: 'logs-component',
  mixins: [functions],
  props: ['mode'],
  data () {
    return {
      filter: '',
      columns: [
        { name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
        { name: 'created_at', align: 'center', label: 'Fecha', field: 'created_at', sortable: true },
        { name: 'type', align: 'center', label: 'Tipo', field: 'type', sortable: true },
        { name: 'action', align: 'center', label: 'Acción', field: 'action', sortable: true },
        { name: 'name', align: 'center', label: 'Usuario', field: 'name', sortable: true }
      ],
      data: [],
      pagination: {
        page: 1,
        rowsPerPage: 5,
        rowsNumber: 10
      },
      loading: false,
      reload: 0,
      momentClass: null
    }
  },
  created () {
    this.getLogs()
    this.momentClass = moment
  },
  methods: {
    async getLogs () {
      this.activateLoading('Cargando')
      const p = await LogService.getLogs({ page: 0, rowsPerPage: 5, filter: '', token: localStorage.getItem('token') })
      this.data = p.data
      if (this.data[0]) {
        this.pagination.rowsNumber = this.data[0].total
        this.reload++
      }
      this.disableLoading()
    },
    async truncateLogs () {
      console.log('truncating')
    },
    async onRequest (props) {
      const { page, rowsPerPage } = props.pagination
      const filter = props.filter
      this.loading = true
      const p = await LogService.getLogs({ page: (page - 1), rowsPerPage: rowsPerPage, filter: filter, token: localStorage.getItem('token') })
      this.data = p.data
      this.pagination.page = page
      this.reload++
      this.loading = false
    }
  }
}
</script>
