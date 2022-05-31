import { QSpinnerGears, QSpinnerAudio } from 'quasar'
export const functions = {
  data () {
    return {
      graphics: {}
    }
  },
  methods: {
    getVars (params) {
      this.graphics = params
    },
    validateForm (array, fun) {
      let isComplete = true
      for (let i = 0; i < array.length; i++) {
        if (array[i] === undefined || array[i] === null || array[i] === '') isComplete = false
      }
      if (!isComplete) {
        this.alert('warning', 'Faltan campos por rellenar')
      } else {
        fun()
      }
      return isComplete
    },
    getImgUrl (imgurl) {
      return process.env.API_URL + imgurl
    },
    goTo (location) {
      this.$router.push('/' + location).catch(err => {
        if (err._name === 'NavigationDuplicated') {
          // console.log('it is in page')
        }
      })
    },
    alert (type, msg) {
      this.$q.notify({
        position: 'top',
        message: msg,
        color: type
      })
    },
    getToken (user) {
      const token = user.token_type + ' ' + user.token
      return token
    },
    getRankById (id) {
      let r = 'Usuario'
      if (id === 1) {
        r = 'Cliente'
      } else if (id === 2) {
        r = 'Ingeniero'
      } else if (id === 3) {
        r = 'Administrador'
      } else if (id === 4) {
        r = 'Supervisor'
      } else if (id === 5) {
        r = 'Tecnico'
      } else if (id === 6) {
        r = 'Gerente'
      } else if (id === 7) {
        r = 'Cliente hijo'
      }
      return r
    },
    getRankByName (name) {
      let r = 0
      if (name === 'Cliente') {
        r = 1
      } else if (name === 'Ingeniero') {
        r = 2
      } else if (name === 'Administrador') {
        r = 3
      } else if (name === 'Supervisor') {
        r = 4
      } else if (name === 'Tecnico') {
        r = 5
      } else if (name === 'Gerente') {
        r = 6
      } else if (name === 'Cliente hijo') {
        r = 7
      }
      return r
    },
    activateLoading (message, spinner = 0) {
      var show = {
        message: message
      }

      if (spinner === 1) {
        show.spinner = QSpinnerGears
      } else if (spinner === 2) {
        show.spinner = QSpinnerAudio
      }
      this.$q.loading.show(show)
    },
    disableLoading () {
      this.$q.loading.hide()
    },
    hasAccess (ranks, user) {
      return ranks.includes(user.rank)
    },
    getChar (params, value) {
      var chartOptions1 = {
        exporting: {
          buttons: {
            contextButton: {
              menuItems: ['viewFullscreen', 'printChart', 'separator', 'downloadPNG', 'downloadJPEG', 'downloadPDF', 'downloadSVG', 'downloadCSV']
            }
          }
        },
        lang: {
          downloadPDF: 'Descargar PDF',
          downloadPNG: 'Descargar PNG',
          downloadJPEG: 'Descargar JPEG',
          downloadSVG: 'Descargar SVG',
          downloadCSV: 'Descargar EXCEL',
          printChart: 'Imprimir gráfica',
          viewFullscreen: 'Ver en pantalla completa',
          categories: 'Fechas',
          category: 'Fecha'
        },
        chart: {
          type: 'line'
        },
        title: {
          text: value[0].var_name
        },
        xAxis: {
          categories: this.getFechas(params)
        },
        yAxis: {
          title: {
            text: 'Valor'
          }
        },
        plotOptions: {
          line: {
            // dataLabels: {
            //   enabled: true
            // },
            // enableMouseTracking: false
          },
          area: {
            fillColor: {
              linearGradient: {
                x1: 0,
                y1: 0,
                x2: 0,
                y2: 1
              },
              stops: [
                [0, '#E9BC36']
              ]
            },
            marker: {
              radius: 2
            },
            lineWidth: 1,
            states: {
              hover: {
                lineWidth: 1
              }
            },
            threshold: null
          }
        },
        series: [{
          name: 'Minimo',
          data: this.getMins(params),
          color: '#DE0100'
        },
        {
          name: 'Maximo',
          data: this.getMaxs(params),
          color: '#DE0100'
        },
        {
          name: 'Reportes',
          data: this.getValues(params),
          color: '#0080DD'
        }]
      }
      return chartOptions1
    },
    getFechas (params) {
      var fechas = []
      for (let index = 0; index < this.graphics[params].length; index++) {
        fechas.push(this.graphics[params][index].fecha)
      }
      return fechas
    },
    getValues (params) {
      var fechas = []
      for (let index = 0; index < this.graphics[params].length; index++) {
        fechas.push(this.graphics[params][index].value)
      }
      return fechas
    },
    getMins (params) {
      var fechas = []
      for (let index = 0; index < this.graphics[params].length; index++) {
        fechas.push(this.graphics[params][index].min)
      }
      return fechas
    },
    getMaxs (params) {
      var fechas = []
      for (let index = 0; index < this.graphics[params].length; index++) {
        fechas.push(this.graphics[params][index].max)
      }
      return fechas
    }
  }
}
