import Api from '../boot/axios'

export default {
  login (params) {
    return Api().post('login', params)
  },
  register (params) {
    return Api().post('register', params, { headers: { Authorization: params.token } })
  },
  getUser (params) {
    return Api().get('user/' + params.id, { headers: { Authorization: params.token } })
  },
  getMyUser (params) {
    return Api().get('my-user', { headers: { Authorization: params.token } })
  },
  getUsers (params) {
    return Api().get('users', { headers: { Authorization: params.token } })
  }
}
