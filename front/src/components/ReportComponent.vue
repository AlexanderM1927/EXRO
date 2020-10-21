<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 container">
                <div class="text-h6">Reporte #{{id}}</div>
                <div class="text-h8">Proyecto: {{report.name}}</div>
                <div class="text-h8">Cliente: {{report.cliente_name}}</div>
                <q-separator />
                <div v-for="variable in report.variables" v-bind:key="variable.id">
                    <q-input
                      type="number"
                      color="grey-3"
                      bg-color="white"
                      label-color="primary"
                      filled
                      v-model="variable.value"
                      :label="variable.name"
                      required
                      :disable="(user.rank < 2) ? true : false"
                      :rules="[val => !!val || 'Este campo es necesario']">
                    </q-input>
                </div>
                <div class="text-h6">Observacion:</div>
                <ckeditor :editor="editor" v-model="report.observacion" :config="editorConfig"></ckeditor>
                <q-btn v-if="user.rank > 1" flat color="primary" @click="editReport">
                  Editar
                </q-btn>
                <q-btn v-if="user.rank > 1" flat color="negative" @click="deleteReport">
                  Eliminar
                </q-btn>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import ReportService from '../services/ReportService'
import { functions } from '../functions.js'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  name: 'report-component',
  mixins: [functions],
  props: ['user'],
  data () {
    return {
      id: this.$route.params.id,
      report: {},
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the editor.
      }
    }
  },

  created () {
    this.getReportInfo()
  },

  methods: {
    async getReportInfo () {
      this.activateLoading('Cargando')
      const t = await ReportService.getReportById({ id: this.id, token: localStorage.getItem('token') })
      this.report = t.data.report
      this.disableLoading()
    },
    async deleteReport () {
      try {
        this.activateLoading('Cargando')
        const p = await ReportService.deleteReport({ id: this.id, token: localStorage.getItem('token') })
        if (p.status === 200) {
          this.alert('positive', 'Eliminado correctamente')
          this.goTo('reports')
        }
      } catch (error) {
        this.alert('negative', 'Se presentó un error')
      }
      this.disableLoading()
    },
    async editReport () {
      try {
        this.activateLoading('Cargando')
        this.report.token = localStorage.getItem('token')
        const p = await ReportService.editReport(this.report)
        if (p.status === 200) {
          this.alert('positive', 'Actualizado correctamente')
          this.goTo('reports')
        }
      } catch (error) {
        this.alert('negative', 'Se presentó un error')
      }
      this.disableLoading()
    }
  }
}
</script>
