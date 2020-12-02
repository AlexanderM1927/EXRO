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
    getChar (params) {
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
          text: params
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
            dataLabels: {
              enabled: true
            },
            enableMouseTracking: false
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
          color: '#21ba45'
        },
        {
          name: 'Maximo',
          data: this.getMaxs(params),
          color: '#0080DD'
        },
        {
          name: 'Reportes',
          data: this.getValues(params),
          color: '#E9BC36'
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
