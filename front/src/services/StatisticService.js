import Api from '../boot/axios'

export default {
  getStats (params) {
    return Api().post('getstats', params, { headers: { Authorization: params.token } })
  },
  getStatsGrilla (params) {
    return Api().post('getstatsgrilla', params, { headers: { Authorization: params.token } })
  }
}
