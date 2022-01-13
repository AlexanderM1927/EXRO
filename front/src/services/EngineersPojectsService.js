import Api from '../boot/axios'

export default {
  getEngineersByProject (params) {
    return Api().get('engineersProjects/' + params.id, { headers: { Authorization: params.token } })
  },
  getTechnicalsByProject (params) {
    return Api().get('technicalsProjects/' + params.id, { headers: { Authorization: params.token } })
  },
  getManagersByProject (params) {
    return Api().get('managersProjects/' + params.id, { headers: { Authorization: params.token } })
  },
  newEngineerProject (params) {
    return Api().post('engineersProjects', params, { headers: { Authorization: params.token } })
  },
  deleteEngineerProjectById (params) {
    return Api().delete('engineersProjects/' + params.id, { headers: { Authorization: params.token } })
  }
}
