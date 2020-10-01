<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
        <div class="row">
            <div class="login box col-md-4 col-xs-10">
                <div class="text-h6">
                  Cambiar clave
                </div>
                <q-separator />
                <q-form @submit="change">
                    <q-input color="grey-3" bg-color="white" label-color="primary" v-model="password" filled :type="isPwd ? 'password' : 'text'" label="Clave" required :rules="[val => !!val || 'Este campo es necesario']">
                        <template v-slot:append>
                            <q-icon color="primary" :name="isPwd ? 'visibility_off' : 'visibility'" @click="isPwd = !isPwd"/>
                        </template>
                    </q-input>
                    <q-input color="grey-3" bg-color="white" label-color="primary" v-model="passwordConfirm" filled :type="isPwd2 ? 'password' : 'text'" label="Clave" required :rules="[val => !!val || 'Este campo es necesario']">
                        <template v-slot:append>
                            <q-icon color="primary" :name="isPwd2 ? 'visibility_off' : 'visibility'" @click="isPwd2 = !isPwd2"/>
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
import UserService from '../services/UserService'

export default {
  name: 'MainLayout',
  mixins: [functions],
  data () {
    return {
      email: '',
      password: '',
      passwordConfirm: '',
      isPwd: true,
      isPwd2: true
    }
  },
  methods: {
    async change () {
      if (this.password === this.passwordConfirm) {
        const data = {}
        data.token = this.$route.params.token
        data.password = this.password
        const p = await UserService.changePassword(data)
        if (p.status === 200) {
          this.alert('positive', 'Clave actualizada correctamente')
        } else {
          this.alert('negative', 'No se encontró el token')
        }
      } else {
        this.alert('negative', 'Las claves no coinciden')
      }
    }
  }
}
</script>
