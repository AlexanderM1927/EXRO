import Api from '../boot/axios'

export default {
  getSettings (params) {
    return Api().get('settings', { headers: { Authorization: params.token } })
  },
  getSettingByMap (params) {
    return Api().get('setting/' + params.map, { headers: { Authorization: params.token } })
  },
  updateSetting (params) {
    return Api().post('setting/' + params.id, params, { headers: { Authorization: params.token } })
  }
}
