<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
              <div v-for="post in posts" v-bind:key="post.id">
                <q-img :src="post.media_url"></q-img>
              </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { functions } from '../functions.js'
import InstagramService from '../services/InstagramService'

export default {
  name: 'instagram-component',
  mixins: [functions],
  data () {
    return {
      posts: []
    }
  },
  mounted () {
    this.getPosts()
  },
  methods: {
    async getPosts () {
      const p = await InstagramService.getPosts()
      this.posts = p.data.data
    }
  }
}
</script>
