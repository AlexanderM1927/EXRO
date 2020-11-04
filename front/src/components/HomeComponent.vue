<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="text-h4">Bienvenido, {{user.name}}.</div><br>
                Plataforma donde se registran los distintos programas químicos, también se realizan calculos de dosificaciones y sugerencias de nuestros productos químicos.
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
