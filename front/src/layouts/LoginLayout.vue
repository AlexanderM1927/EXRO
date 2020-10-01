<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
      <login-component v-if="view === 'login'"></login-component>
      <recovery-component v-if="view === 'recovery'"></recovery-component>
      <change-password-component v-if="view === 'changepassword'"></change-password-component>
    </q-page-container>
  </q-layout>
</template>

<script>
import RecoveryComponent from '../components/RecoveryComponent.vue'
import LoginComponent from '../components/LoginComponent.vue'
import ChangePasswordComponent from '../components/ChangePasswordComponent.vue'
import { functions } from '../functions.js'

export default {
  name: 'MainLayout',
  mixins: [functions],
  components: { LoginComponent, RecoveryComponent, ChangePasswordComponent },
  data () {
    return {
    }
  },
  props: ['view'],
  methods: {
  }
}
</script>
