<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 container">
                <div class="text-h6">Reporte</div>
                <div class="text-h8">Tratamiento: {{report.name}}</div>
                <div class="text-h8">Cliente: {{report.cliente_name}}</div>
                <q-separator />
                <div v-for="variable in report.variables" v-bind:key="variable.id">
                    <q-input
                      color="grey-3"
                      bg-color="white"
                      label-color="primary"
                      filled
                      v-model="variable.value"
                      :label="variable.name"
                      :disable="(user.rank < 2) ? true : false">
                    </q-input>
                </div>
                <div class="text-h6">Observacion:</div>
                <ckeditor :editor="editor" v-model="report.observacion" :config="editorConfig"></ckeditor>
                <q-btn v-if="[3, 2, 4, 5, 6].includes(user.rank)" flat color="primary" @click="editReport">
                  Editar
                </q-btn>
                <q-btn v-if="[3, 2, 4, 5, 6].includes(user.rank)" flat color="negative" @click="deleteReport">
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
    deleteReport () {
      this.$q.dialog({
        title: 'Confirmar',
        message: 'Seguro que deseas eliminar este reporte?',
        cancel: true,
        persistent: true
      }).onOk(async () => {
        try {
          this.activateLoading('Cargando')
          localStorage.setItem('report-deleted-date', this.report.fecha)
          const p = await ReportService.deleteReport({ id: this.id, token: localStorage.getItem('token') })
          if (p.status === 200) {
            this.alert('positive', 'Eliminado correctamente')
            this.goTo('reports')
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
