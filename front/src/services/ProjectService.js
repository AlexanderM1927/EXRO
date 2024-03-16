import Api from '../boot/axios'

export default {
  getProject (params) {
    return Api().get('project/' + params.id, { headers: { Authorization: params.token } })
  },
  getProjects (page, params) {
    let url = 'projects?page=' + page
    if (params.name) {
      url += '&name=' + params.name
    }
    return Api().get(url, { headers: { Authorization: params.token } })
  },
  getProjectsByClient (page, params) {
    let url = 'projects-client/' + params.clientId + '?page=' + page
    if (params.name) {
      url += '&name=' + params.name
    }
    return Api().get(url, { headers: { Authorization: params.token } })
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
