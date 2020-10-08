import Api from '../boot/axios'

export default {
  addVar (params) {
    return Api().post('var', params, { headers: { Authorization: params.token } })
  },
  modifyVar (params) {
    return Api().post('var/' + params.id, params, { headers: { Authorization: params.token } })
  },
  deleteVar (params) {
    return Api().delete('var/' + params.id, { headers: { Authorization: params.token } })
  },
  getVars (params) {
    return Api().get('vars', { headers: { Authorization: params.token } })
  },
  getVarsByProject (params) {
    return Api().get('vars-project/' + params.id, { headers: { Authorization: params.token } })
  },
  getVar (params) {
    return Api().get('var/' + params.id, { headers: { Authorization: params.token } })
  }
}
