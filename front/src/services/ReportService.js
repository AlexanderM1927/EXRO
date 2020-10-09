import Api from '../boot/axios'

export default {
  createReport (params) {
    return Api().post('report', params, { headers: { Authorization: params.token } })
  },
  getReportById (params) {
    return Api().get('report/' + params.id, { headers: { Authorization: params.token } })
  },
  getReports (params) {
    return Api().get('reports', { headers: { Authorization: params.token } })
  },
  deleteReport (params) {
    return Api().delete('report/' + params.id, { headers: { Authorization: params.token } })
  },
  editReport (params) {
    return Api().post('modify_report/', params, { headers: { Authorization: params.token } })
  }
}
