<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="text-h4">Bienvenido, {{user.name}}.</div><br>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit ducimus doloribus rerum necessitatibus, earum cupiditate voluptatibus eligendi architecto libero. Placeat ipsum ipsa atque minima fugit similique est a, quidem eligendi.
                <br>
                <q-separator />
                <br>
                <center>
                    <q-btn label="Activar tour" @click="startTour" color="primary"></q-btn>
                </center>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { functions } from '../functions.js'

export default {
  name: 'home-component',
  mixins: [functions],
  props: ['user'],
  data () {
    return {
    }
  },
  mounted () {
  },
  methods: {
    startTour () {
      this.$emit('tour')
    }
  }
}
</script>
