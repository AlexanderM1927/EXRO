import Api from '../boot/axios'

export default {
  login (params) {
    return Api().post('login', params)
  },
  recovery (params) {
    return Api().post('recovery', params)
  },
  changePassword (params) {
    return Api().post('changepassword', params)
  },
  register (params) {
    return Api().post('register', params, { headers: { Authorization: params.token } })
  },
  registerChildren (params) {
    return Api().post('register-children', params, { headers: { Authorization: params.token } })
  },
  getUser (params) {
    return Api().get('user/' + params.id, { headers: { Authorization: params.token } })
  },
  modifyUser (params) {
    return Api().post('user/' + params.id, params, { headers: { Authorization: params.token } })
  },
  deleteUser (params) {
    return Api().delete('user/' + params.id, { headers: { Authorization: params.token } })
  },
  getMyUser (params) {
    return Api().get('my-user', { headers: { Authorization: params.token } })
  },
  getUsers (params) {
    return Api().get('users', { headers: { Authorization: params.token } })
  },
  getChildrens (params) {
    return Api().get('users-childrens', { headers: { Authorization: params.token } })
  },
  getClients (params) {
    return Api().get('clients', { headers: { Authorization: params.token } })
  },
  getEngineers (params) {
    return Api().get('engineers', { headers: { Authorization: params.token } })
  },
  getTechnicals (params) {
    return Api().get('technicals', { headers: { Authorization: params.token } })
  },
  getManagers (params) {
    return Api().get('managers', { headers: { Authorization: params.token } })
  }
}
