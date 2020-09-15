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
    }
  }
}
