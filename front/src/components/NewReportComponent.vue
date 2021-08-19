<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="text-h6">
                    Crear informe
                </div>
                <q-form @submit="save">
                    <q-input color="grey-3" bg-color="white" label-color="primary" label="Desde" required :rules="[val => !!val || 'Tienes que llenar este campo']" v-model="date">
                      <template v-slot:prepend>
                          <q-icon color="primary" name="event" class="cursor-pointer">
                            <q-popup-proxy transition-show="scale" transition-hide="scale">
                              <q-date v-model="date" mask="YYYY-MM-DD HH:mm" />
                            </q-popup-proxy>
                          </q-icon>
                        </template>

                        <template v-slot:append>
                          <q-icon color="primary" name="access_time" class="cursor-pointer">
                            <q-popup-proxy transition-show="scale" transition-hide="scale">
                              <q-time v-model="date" mask="YYYY-MM-DD HH:mm" format24h />
                            </q-popup-proxy>
                          </q-icon>
                      </template>
                    </q-input>
                    <q-separator />
                    <div v-for="variable in vars" v-bind:key="variable.id">
                        <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="variable.value" :label="variable.name"></q-input>
                    </div>
                    <q-separator />
                    <div class="text-h6">Observacion:</div>
                    <ckeditor :editor="editor" v-model="observacion" :config="editorConfig"></ckeditor>
                    <q-btn v-if="user.rank > 1" class="right" round type="submit" color="primary" icon="save" />
                </q-form>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { functions } from '../functions.js'
import VariablesProjectsService from '../services/VariablesProjectsService'
import ReportService from '../services/ReportService'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { date } from 'quasar'

export default {
  name: 'user-component',
  mixins: [functions],
  props: ['user'],
  data () {
    return {
      id: this.$route.params.id,
      vars: [],
      editor: ClassicEditor,
      observacion: '',
      date: date.formatDate(Date.now(), 'YYYY-MM-DD HH:mm:ss'),
      editorConfig: {
        // The configuration of the editor.
      }
    }
  },
  mounted () {
    this.getVarsByProject()
  },
  methods: {
    async getVarsByProject () {
      try {
        this.activateLoading('Cargando')
        const p = await VariablesProjectsService.getVariablesByProject({ id: this.id, token: localStorage.getItem('token') })
        this.vars = p.data.variablesprojects
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    },
    async save () {
      const data = {
        variables: this.vars,
        token: localStorage.getItem('token'),
        observacion: this.observacion,
        idproyecto: this.id,
        fecha: this.date
      }
      try {
        this.activateLoading('Cargando')
        const p = await ReportService.createReport(data)
        if (p.status === 201) {
          this.alert('positive', 'Reporte generado exitosamente')
          this.goTo('reports')
        } else {
          this.alert('warning', 'Reporte creado, correo no enviado.')
        }
      } catch (error) {
        this.alert('negative', 'Ha ocurrido un error')
      }
      this.disableLoading()
    }
  }
}
</script>
