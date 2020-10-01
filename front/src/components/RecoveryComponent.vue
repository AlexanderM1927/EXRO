<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
        <div class="row">
            <div class="login box col-md-4 col-xs-10">
                <div class="text-h6">
                  Recupera tu clave
                  <div class="right">
                    <q-btn @click="goTo('login')" icon="login" color="primary"></q-btn>
                  </div>
                </div>
                <br>
                <q-separator />
                <br>
                <q-form @submit="recovery">
                    <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="email" label="Correo" required :rules="[val => !!val || 'Este campo es necesario']">
                        <template v-slot:append>
                        <q-icon name="mail" color="primary" />
                        </template>
                    </q-input>
                    <br>
                    <q-btn color="primary" type="submit" class="full-width" label="Enviar correo"></q-btn>
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
      email: ''
    }
  },
  methods: {
    async recovery () {
      try {
        this.activateLoading('Cargando')
        const p = await UserService.recovery({ email: this.email })
        this.disableLoading()
        if (p.status === 200) {
          this.alert('positive', 'Correo enviado correctamente')
        } else {
          this.alert('negative', 'No se encontró el correo')
        }
      } catch (error) {
        this.alert('negative', error)
      }
    }
  }
}
</script>
