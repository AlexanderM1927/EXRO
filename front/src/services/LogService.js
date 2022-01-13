import Api from '../boot/axios'

export default {
  getLogs (params) {
    return Api().get('logs/' + params.rowsPerPage + '/' + params.page + '/' + params.filter, { headers: { Authorization: params.token } })
  }
}
