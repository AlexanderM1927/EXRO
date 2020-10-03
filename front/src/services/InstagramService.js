import Api from '../boot/axios'

export default {
  getPosts (params) {
    return Api().get('instagram')
  }
}
