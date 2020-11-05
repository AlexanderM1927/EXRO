<template>
  <q-layout view="lHh Lpr lFf">
    <q-header class="bg-white text-black" elevated>
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
          <q-img src="../assets/logo.png" style="width: 100px;" />
        </q-toolbar-title>
        <q-btn flat round dense icon="login" @click="goTo('logout')" />
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      content-class="bg-white text-black"
    >
      <div class="box profile" id="v-step-0">
        <q-img src="../assets/profile.png" style="height: 100px; width: 100px;" /><br>
        {{user.name}}
      </div>
      <q-list>
        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
          :view="view"
          :rank="user.rank"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <!-- THIS IS FOR ALL COMPONENTS -->
      <home-component :user="user" v-if="view === 'home'" @tour="activateTour"></home-component>
      <users-component v-if="view === 'users'"></users-component>
      <user-component v-if="view === 'user'"></user-component>
      <projects-component v-if="view === 'projects'"></projects-component>
      <project-component v-if="view === 'project'"></project-component>
      <vars-component v-if="view === 'vars'"></vars-component>
      <var-component v-if="view === 'var'"></var-component>
      <reports-component :user="user" v-if="view === 'reports'"></reports-component>
      <new-report-component :user="user" v-if="view === 'new-report'"></new-report-component>
      <report-component :user="user" v-if="view === 'report'"></report-component>
      <graphics-component v-if="view === 'graphics'"></graphics-component>
      <calculate-component v-if="view === 'calculate'"></calculate-component>
      <calculate-form-component v-if="view === 'calculate-form'"></calculate-form-component>
      <v-tour name="myTour" :steps="steps"></v-tour>
    </q-page-container>
  </q-layout>
</template>

<script>
import EssentialLink from 'components/EssentialLink.vue'
import UsersComponent from 'components/UsersComponent.vue'
import UserComponent from 'components/UserComponent.vue'
import ProjectsComponent from 'components/ProjectsComponent.vue'
import ProjectComponent from 'components/ProjectComponent.vue'
import VarsComponent from 'components/VarsComponent.vue'
import VarComponent from 'components/VarComponent.vue'
import ReportsComponent from 'components/ReportsComponent.vue'
import NewReportComponent from 'components/NewReportComponent.vue'
import ReportComponent from 'components/ReportComponent.vue'
import GraphicsComponent from 'components/GraphicsComponent.vue'
import HomeComponent from 'components/HomeComponent.vue'
import CalculateComponent from 'components/CalculateComponent.vue'
import CalculateFormComponent from 'components/CalculateFormComponent.vue'
import { functions } from '../functions.js'
import UserService from '../services/UserService'

const linksData = [
  {
    title: 'Inicio',
    icon: 'home',
    link: 'home',
    minRank: 1
  },
  {
    title: 'Usuarios',
    icon: 'business',
    link: 'users',
    minRank: 3
  },
  {
    title: 'Proyectos',
    icon: 'library_books',
    link: 'projects',
    minRank: 3
  },
  {
    title: 'Variables',
    icon: 'description',
    link: 'vars',
    minRank: 3
  },
  {
    title: 'Informes',
    icon: 'article',
    link: 'reports',
    minRank: 1
  },
  {
    title: 'Graficas',
    icon: 'analytics',
    link: 'graphics',
    minRank: 1
  },
  {
    title: 'Formulas',
    icon: 'calculate',
    link: 'calculate',
    minRank: 2
  }
]

export default {
  name: 'MainLayout',
  components: {
    EssentialLink,
    UsersComponent,
    UserComponent,
    ProjectsComponent,
    ProjectComponent,
    HomeComponent,
    CalculateComponent,
    CalculateFormComponent,
    VarsComponent,
    VarComponent,
    ReportsComponent,
    NewReportComponent,
    ReportComponent,
    GraphicsComponent
  },
  mixins: [functions],
  data () {
    return {
      leftDrawerOpen: false,
      essentialLinks: linksData,
      user: {},
      steps: [
        {
          target: '#home', // We're using document.querySelector() under the hood
          header: {
            title: 'Inicio'
          },
          content: 'Plataforma donde se registran los distintos programas químicos, también se realizan calculos de dosificaciones y sugerencias de nuestros productos químicos.'
        },
        {
          target: '#users',
          overlay: '#users',
          header: {
            title: 'Sección de Usuarios'
          },
          content: 'En este apartado puedes agregar clientes, ingenieros y administradores.',
          params: { placement: 'bottom' }
        },
        {
          target: '#projects',
          overlay: '#projects',
          header: {
            title: 'Sección de Proyectos'
          },
          content: 'Gestiona los proyectos que manejas actualmente.',
          params: { placement: 'bottom' }
        },
        {
          target: '#vars',
          overlay: '#vars',
          header: {
            title: 'Sección de Variables'
          },
          content: 'Agrega variables a la aplicación para usarlos en tratamientos.',
          params: { placement: 'bottom-right' }
        }
      ]
    }
  },
  props: ['view'],
  mounted () {
    this.verifySession()
  },
  methods: {
    async verifySession () {
      try {
        this.activateLoading('Cargando')
        const u = await UserService.getMyUser({ token: localStorage.getItem('token') })
        this.user = u.data
      } catch (error) {
        this.goTo('login')
      }
      this.disableLoading()
    },
    activateTour () {
      if (this.leftDrawerOpen === false) this.leftDrawerOpen = true
      setTimeout(this.$tours.myTour.start, 1000)
    }
  }
}
</script>
<style lang="scss" scoped>
.profile {
  cursor: pointer;
  background: white;
  color: black;
  width: 95%;
  margin-left: auto;
  margin-right: auto;
  padding: 5px;
  text-align: center;
  margin-top: 9px;
  margin-bottom: 10px;
  word-wrap: break-word;
}
</style>
