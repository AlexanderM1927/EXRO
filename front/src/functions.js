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
    }
  }
}
