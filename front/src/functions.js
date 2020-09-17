export const functions = {
  data () {
    return {
    }
  },
  methods: {
    goTo (location) {
      this.$router.push('/' + location).catch(err => {
        if (err._name === 'NavigationDuplicated') {
          // console.log('it is in page')
        }
      })
    },
    alert (type, msg) {
      this.$q.notify({
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
    }
  }
}
