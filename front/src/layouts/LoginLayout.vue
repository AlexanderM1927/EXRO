<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
        <div class="row">
            <div class="login col-md-4 col-xs-10">
                <q-form @submit="login">
                    <q-input color="grey-3" bg-color="white" label-color="black" filled v-model="email" label="Correo" required :rules="[val => !!val || 'Este campo es necesario']">
                        <template v-slot:append>
                        <q-icon name="mail" color="primary" />
                        </template>
                    </q-input>
                    <br>
                    <q-input color="grey-3" bg-color="white" label-color="black" v-model="password" filled :type="isPwd ? 'password' : 'text'" label="Clave" required :rules="[val => !!val || 'Este campo es necesario']">
                        <template v-slot:append>
                            <q-icon color="primary" :name="isPwd ? 'visibility_off' : 'visibility'" @click="isPwd = !isPwd"/>
                        </template>
                    </q-input>
                    <br>
                    <q-btn color="primary" type="submit" class="full-width" label="Login"></q-btn>
                </q-form>
            </div>
        </div>
    </q-page-container>
  </q-layout>
</template>

<script>
import { functions } from '../functions.js'

export default {
  name: 'MainLayout',
  mixins: [functions],
  data () {
    return {
      email: '',
      password: '',
      isPwd: true
    }
  },
  methods: {
    async login () {
      console.log('x')
    }
  }
}
</script>
