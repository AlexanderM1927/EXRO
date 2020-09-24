import { QSpinnerGears, QSpinnerAudio } from 'quasar'

export const functions = {
  data () {
    return {
    }
  },
  methods: {
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
    }
  }
}
