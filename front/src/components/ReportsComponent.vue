<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 container">
                <FullCalendar ref="calendar" :events="events" :config="config" />
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import 'fullcalendar/dist/fullcalendar.css'
import { FullCalendar } from 'vue-full-calendar'
import { functions } from '../functions.js'

export default {
  name: 'reports-component',
  mixins: [functions],
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  props: [],
  data () {
    return {
      events: [],
      config: {}
    }
  },
  created () {
    this.getCalendarInfo()
    // exampleUssageEvents()
  },
  methods: {
    getReports () {
      this.activateLoading('Cargando')
      //   const t = await TaskService.getTasksByUser({ usuario_id: localStorage.getItem('user'), token: localStorage.getItem('token') })
      this.disableLoading()
      // const events = t.data
      // for (let i = 0; i < events.length; i++) {
      //   var event = {
      //     title: events[i].task_name,
      //     start: events[i].date,
      //     description: events[i].task_commentary,
      //     fase: events[i].fase_name,
      //     proyecto: events[i].proyecto_name,
      //     cliente: events[i].cliente_name,
      //     _id: events[i].task_id
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
    }
  }
}
</script>
<style lang="scss" scoped>
.right {
  float: right;
}
</style>
