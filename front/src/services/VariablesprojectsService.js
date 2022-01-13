import Api from '../boot/axios'

export default {
  getVariablesByProject (params) {
    return Api().get('variablesprojects/' + params.id, { headers: { Authorization: params.token } })
  },
  newVariablesProjects (params) {
    return Api().post('variablesprojects', params, { headers: { Authorization: params.token } })
  },
  updateVariablesProjects (params) {
    return Api().post('variablesprojects/' + params.id, params, { headers: { Authorization: params.token } })
  },
  deleteVarProject (params) {
    return Api().delete('variablesprojects/' + params.id, { headers: { Authorization: params.token } })
  }
}
