import Api from '../boot/axios'

export default {
  getProject (params) {
    return Api().get('project/' + params.id, { headers: { Authorization: params.token } })
  },
  getProjects (params) {
    return Api().get('projects', { headers: { Authorization: params.token } })
  },
  newProject (params) {
    return Api().post('projects', params, { headers: { Authorization: params.token } })
  },
  deleteProject (params) {
    return Api().delete('project/' + params.id, { headers: { Authorization: params.token } })
  },
  modifyProject (params) {
    return Api().post('project/' + params.id, params, { headers: { Authorization: params.token } })
  }
}
