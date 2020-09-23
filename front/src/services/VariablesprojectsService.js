import Api from '../boot/axios'

export default {
  getVariablesByProject (params) {
    return Api().get('variablesprojects/' + params.id, { headers: { Authorization: params.token } })
  },
  newVariablesprojects (params) {
    return Api().post('variablesprojects', params, { headers: { Authorization: params.token } })
  }
}
