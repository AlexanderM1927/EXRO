<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 container">
                <FullCalendar ref="calendar" :events="events" :config="config" />
                <br>
                <center>
                  <q-btn label="Crear reporte" @click="newReport" color="primary"></q-btn>
                </center>
              <q-dialog
                v-model="dialogProjects"
                persistent
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
import '../css/fullcalendar.scss'
import ProjectsComponent from 'components/ProjectsComponent.vue'
import { FullCalendar } from 'vue-full-calendar'
import { functions } from '../functions.js'

export default {
  name: 'reports-component',
  mixins: [functions],
  components: {
    FullCalendar, ProjectsComponent
  },
  props: [],
  data () {
    return {
      events: [],
      config: {},
      dialogProjects: false
    }
  },
  created () {
    this.getCalendarInfo()
    this.getReports()
  },
  methods: {
    getReports () {
      this.activateLoading('Cargando')
      //   const t = await TaskService.getTasksByUser({ usuario_id: localStorage.getItem('user'), token: localStorage.getItem('token') })
      this.disableLoading()
      // const events = t.data
      // for (let i = 0; i < events.length; i++) {
      //   var event = {
      //     title: events[i].project_name,
      //     start: events[i].date,
      //     _id: events[i].id
      //   }
      //   this.events.push(event)
      // }
    },
    getCalendarInfo () {
      const _this = this
      const lang = {
        months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        daysLong: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        days: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'Día',
        list: 'Lista'
      }
      this.config = {
        defaultView: 'month',
        editable: false,
        displayEventTime: false,
        header: {
          left: 'prev,today,next',
          right: 'month,listMonth,basicWeek,basicDay'
        },
        buttonText: {
          today: lang.today,
          month: lang.month,
          week: lang.week,
          day: lang.day,
          listMonth: lang.list
        },
        allDayDefault: true,
        height: 'auto',
        monthNames: lang.months,
        monthNamesShort: lang.monthsShort,
        dayNames: lang.daysLong,
        dayNamesShort: lang.days,
        eventTextColor: 'white',
        eventClick: function (event) {
          _this.showEvent(event)
        },
        eventMouseover: function (event, jsEvent, view) {},
        eventMouseout: function (event, jsEvent, view) {}
      }
    },
    newReport () {
      this.dialogProjects = true
    },
    selectProject (idProject) {
      this.goTo('new-report/' + idProject)
    }
  }
}
</script>
<style lang="scss" scoped>
.right {
  float: right;
}
</style>
