import Api from '../boot/axios'

export default {
  addChat (params) {
    return Api().post('chat', params, { headers: { Authorization: params.token } })
  },
  getChats (params) {
    return Api().get('chats', { headers: { Authorization: params.token } })
  },
  getChatById (params) {
    return Api().get('chat/' + params.id, { headers: { Authorization: params.token } })
  },
  deleteChatById (params) {
    return Api().delete('chat/' + params.id, { headers: { Authorization: params.token } })
  }
}
