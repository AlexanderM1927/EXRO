<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="title">
                  <div class="text-h4">
                      Settings
                      <!-- <div class="right">
                        <q-btn round color="primary" @click="truncateSettings" size="md" icon="delete">
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
                :filter="filter"
                row-key="id"
              >
                <template v-slot:body="props">
                  <q-tr :props="props">
                      <q-td key="id" :props="props">
                          {{ props.row.id }}
                      </q-td>
                      <q-td key="field" :props="props">
                          {{ props.row.field }}
                      </q-td>
                      <q-td key="value" :props="props">
                          {{ props.row.value }}
                          <q-popup-edit v-model="props.row.value" title="Actualizar value">
                            <q-input type="textarea" v-model="props.row.value" dense autofocus @keyup.enter="updateRow(props.row)" />
                          </q-popup-edit>
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
              </q-table><br>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import SettingService from '../services/SettingService'
import { functions } from '../functions.js'

export default {
  name: 'settings-component',
  mixins: [functions],
  props: ['mode'],
  data () {
    return {
      filter: '',
      columns: [
        { name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
        { name: 'field', align: 'center', label: 'Campo', field: 'field', sortable: true },
        { name: 'value', align: 'center', label: 'Valor', field: 'value', sortable: true }
      ],
      data: []
    }
  },
  mounted () {
    this.getSettings()
  },
  methods: {
    async getSettings () {
      this.activateLoading('Cargando')
      const p = await SettingService.getSettings({ token: localStorage.getItem('token') })
      this.data = p.data
      this.disableLoading()
    },
    async updateRow (row) {
      try {
        row.token = localStorage.getItem('token')
        this.activateLoading('Cargando')
        const p = await SettingService.updateSetting(row)
        if (p.status === 200) {
          this.getSettings()
          this.alert('positive', 'Configuración actualizada')
        }
      } catch (error) {
        this.alert('negative', 'Se ha presentado un error al actualizar')
      }
      this.disableLoading()
    }
  }
}
</script>
