<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
        <div class="row">
          <div class="center col-md-4 col-sm-4 col-xs-10">
            <q-img src="../assets/logo.png" style="width: 100%;" />
          </div>
        </div>
        <div class="row">
            <div class="login box col-md-4 col-sm-4 col-xs-10">
                <div class="text-h6">
                  Login
                </div>
                <q-separator />
                <q-form @submit="login">
                    <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="email" label="Correo" required :rules="[val => !!val || 'Este campo es necesario']">
                        <template v-slot:append>
                        <q-icon name="mail" color="primary" />
                        </template>
                    </q-input>
                    <br>
                    <q-input color="grey-3" bg-color="white" label-color="primary" v-model="password" filled :type="isPwd ? 'password' : 'text'" label="Clave" required :rules="[val => !!val || 'Este campo es necesario']">
                        <template v-slot:append>
                            <q-icon color="primary" :name="isPwd ? 'visibility_off' : 'visibility'" @click="isPwd = !isPwd"/>
                        </template>
                    </q-input>
                    <div class="right">
                      <a class="link" @click="goTo('recovery')">He olvidado mi clave</a>
                    </div>
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
      isPwd: true
    }
  },
  methods: {
    async login () {
      try {
        const u = await UserService.login({ email: this.email, password: this.password })
        const user = u.data
        if (u.status === 200) {
          localStorage.setItem('token', this.getToken(user))
          localStorage.setItem('user', JSON.stringify(user.user))
          this.goTo('home')
        } else {
          this.alert('negative', 'Credenciales invalidas')
        }
      } catch (error) {
        this.alert('negative', 'Credenciales invalidas')
      }
    }
  }
}
</script>
