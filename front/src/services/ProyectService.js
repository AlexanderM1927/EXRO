import Api from '../boot/axios'

export default {
  getMyUser (params) {
    return Api().get('my-user', { headers: { Authorization: params.token } })
  },
  getProyects (params) {
    return Api().get('proyects', { headers: { Authorization: params.token } })
  },
  newProyect (params) {
    return Api().post('proyects', params, { headers: { Authorization: params.token } })
  },
  deleteProyect (params) {
    return Api().delete('proyect/' + params.id, { headers: { Authorization: params.token } })
  },
  modifyProyect (params) {
    return Api().post('proyect/' + params.id, params, { headers: { Authorization: params.token } })
  }
}
