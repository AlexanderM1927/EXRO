<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 container">
              <template  v-if="lastProjectSelected">
                <q-btn color="primary" label="< Volver al último tratamiento" @click="goBackLastReport" />
                <hr>
              </template>
              <FullCalendar
                ref="fullCalendar"
                :options="config"
                :header="header"
                :events="events"
                :plugins="calendarPlugins"
                :buttonText="{
                  today: 'Hoy',
                  month: 'Mes',
                  week: 'Semana',
                  day: 'Dia'
                }"
                @eventClick="eventClick"
              />
              <br>
              <center>
                <q-btn v-if="hasAccess([2, 3, 4, 5, 6], user)" label="Crear reporte" @click="newReport" color="primary"></q-btn>
              </center>
              <q-dialog
                v-model="dialogProjects"
                transition-show="slide-up"
                transition-hide="slide-down"
              >
                <q-card style="width: 800px; max-width: 80vw;">
                <q-card-section>
                    <projects-component mode='select' @selectproject="selectProject"></projects-component>
                </q-card-section>
                </q-card>
              </q-dialog>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import ReportService from '../services/ReportService'
import '../css/fullcalendar.scss'
import '../css/fcmain.css'
import ProjectsComponent from 'components/ProjectsComponent.vue'
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import esLocale from '@fullcalendar/core/locales/es'
import { functions } from '../functions.js'

export default {
  name: 'reports-component',
  mixins: [functions],
  components: {
    FullCalendar, ProjectsComponent
  },
  props: ['user'],
  data () {
    return {
      events: [],
      config: {},
      header: {},
      dialogProjects: false,
      lastProjectSelected: 0,
      calendarPlugins: [dayGridPlugin, interactionPlugin]
    }
  },
  created () {
    this.lastProjectSelected = parseInt(localStorage.getItem('last-project'))
    this.getCalendarInfo()
    this.getReports()
  },
  mounted () {
    const fullcalendar = this.$refs.fullCalendar
    const fcApi = fullcalendar.getApi()
    if (localStorage.getItem('report-deleted-date')) {
      fcApi.gotoDate(localStorage.getItem('report-deleted-date'))
      localStorage.removeItem('report-deleted-date')
    }
    fcApi.setOption('locale', 'es')
  },
  methods: {
    async getReports () {
      this.activateLoading('Cargando')
      const t = await ReportService.getReports({ token: localStorage.getItem('token') })
      this.disableLoading()
      const events = t.data.reports
      for (let i = 0; i < events.length; i++) {
        var event = {
          title: events[i].name,
          start: events[i].fecha,
          _id: events[i].id
        }
        this.events.push(event)
      }
    },
    getCalendarInfo () {
      this.header = {
        left: 'prev,today,next',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      }
      this.config = {
        locales: [esLocale],
        initialView: 'listWeek',
        eventTextColor: 'white'
      }
    },
    eventClick (info) {
      this.goTo('report/' + info.event.extendedProps._id)
    },
    newReport () {
      this.dialogProjects = true
    },
    selectProject (idProject) {
      this.goTo('new-report/' + idProject)
    },
    goBackLastReport () {
      this.goTo('project/' + parseInt(this.lastProjectSelected))
    }
  }
}
</script>
<style lang="scss" scoped>
.right {
  float: right;
}
</style>
