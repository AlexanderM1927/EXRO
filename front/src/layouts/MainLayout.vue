<template>
  <q-layout view="lHh Lpr lFf">
    <q-header class="header" elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>
          My App
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      content-class="menu"
    >
      <q-list>
        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
          :view="view"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <!-- THIS IS FOR ALL COMPONENTS -->
      <users-component v-if="view === 'users'"></users-component>
    </q-page-container>
  </q-layout>
</template>

<script>
import EssentialLink from 'components/EssentialLink.vue'
import UsersComponent from 'components/UsersComponent.vue'
import { functions } from '../functions.js'
import UserService from '../services/UserService'

const linksData = [
  {
    title: 'Inicio',
    icon: 'home',
    link: 'home'
  },
  {
    title: 'Usuarios',
    icon: 'business',
    link: 'users'
  },
  {
    title: 'Proyectos',
    icon: 'library_books',
    link: 'proyects'
  },
  {
    title: 'Variables',
    icon: 'description',
    link: 'vars'
  },
  {
    title: 'Informes',
    icon: 'article',
    link: 'reports'
  },
  {
    title: 'Graficas',
    icon: 'analytics',
    link: 'graphis'
  },
  {
    title: 'Formulas',
    icon: 'calculate',
    link: 'calculate'
  },
  {
    title: 'Salir',
    icon: '',
    link: 'logout'
  }
]

export default {
  name: 'MainLayout',
  components: { EssentialLink, UsersComponent },
  mixins: [functions],
  data () {
    return {
      leftDrawerOpen: false,
      essentialLinks: linksData
    }
  },
  props: ['view'],
  mounted () {
    this.verifySession()
  },
  methods: {
    async verifySession () {
      try {
        const u = await UserService.getUser({ token: localStorage.getItem('token') })
        console.log(u)
      } catch (error) {
        this.goTo('login')
      }
    }
  }
}
</script>
