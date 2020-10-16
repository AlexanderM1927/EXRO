import Api from '../boot/axios'

export default {
  getStats (params) {
    return Api().post('getstats', params, { headers: { Authorization: params.token } })
  }
}
