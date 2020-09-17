import Api from '../boot/axios'

export default {
  login (params) {
    return Api().post('login', params)
  },
  getUser (params) {
    return Api().get('user', { headers: { Authorization: params.token } })
  }
}
