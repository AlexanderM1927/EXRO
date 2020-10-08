<template>
    <div class="q-pa-md">
        <div class="row">
          <div class="col-1"></div>
          <div class="col-10" style="padding: 10px;">
              <div class="text-h4" :style="`float: left;`">Proyectos</div>
              <div class="right" :style="`${ $q.screen.xs ? 'width: 40%;' : ''}`">
                <q-btn color="positive" round icon="add" @click="createProject"></q-btn>
              </div>
          </div>
          <div class="col-1"></div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 container">
                <div class="row">
                    <div v-if="projects.length === 0">
                      Ningun proyecto hasta el momento
                    </div>
                    <div v-for="(item, id) in projects" :key="id"  class="col-md-6 col-xs-12">
                        <q-card class="my-card" flat bordered>
                            <q-card-section horizontal class="cards">
                                <q-card-section style="width: 58.5%;">
                                    <div class="text-h6">{{item.name}}</div>
                                    {{item.descripcion}}
                                </q-card-section>

                                <q-img
                                class="col-5"
                                :src="getImgUrl(item.urlimg)"
                                />
                            </q-card-section>
                            <q-separator/>

                            <q-card-actions v-if="mode === 'select'">
                                <q-btn flat color="primary" @click="$emit('selectproject', item.id)">
                                Seleccionar
                                </q-btn>
                            </q-card-actions>
                            <q-card-actions v-else>
                                <q-btn flat color="primary" @click="goTo('project/' + item.id)">
                                Ver
                                </q-btn>
                                <q-btn flat color="primary" @click="editProject(item)">
                                Editar
                                </q-btn>
                                <q-btn flat color="negative" @click="eliminar(item.id)">
                                Eliminar
                                </q-btn>
                            </q-card-actions>
                        </q-card>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import ProjectService from '../services/ProjectService'
import AddProject from './Dialogs/AddProject.vue'
import EditProject from './Dialogs/EditProject.vue'
import { functions } from '../functions.js'

export default {
  name: 'projects-component',
  mixins: [functions],
  props: ['mode'],
  data () {
    return {
      projects: []
    }
  },
  mounted () {
    this.getProjects()
  },
  methods: {
    async organizarCards () {
      const cards = await document.getElementsByClassName('cards')
      // let widthSize = 0
      let heightSize = 0

      for (let i = 0; i < cards.length; i++) {
        // if (widthSize <= cards[i].clientWidth) widthSize = cards[i].clientWidth
        if (heightSize <= cards[i].clientHeight) heightSize = cards[i].clientHeight
      }
      for (let i = 0; i < cards.length; i++) {
        document.getElementsByClassName('cards')[i].style.minHeight = heightSize + 'px'
        // document.getElementsByClassName('cards')[i].style.minWidth = widthSize + 'px'
      }
    },
    async getProjects () {
      try {
        this.activateLoading('Cargando')
        const us = await ProjectService.getProjects({ token: localStorage.getItem('token') })
        const projects = us.data.projects
        this.projects = projects
        this.organizarCards()
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    },
    createProject () {
      this.$q.dialog({
        component: AddProject,
        parent: this
      }).onOk(async (data) => {
        data.token = localStorage.getItem('token')
        try {
          this.activateLoading('Cargando')
          const p = await ProjectService.newProject(data)
          this.getProjects()
          if (p.status === 201) {
            this.alert('positive', 'Proyecto creado exitosamente')
          }
        } catch (error) {
          this.alert('negative', 'Se ha presentado un error al crear el Proyecto')
        }
        this.disableLoading()
      }).onCancel(() => {
        // console.log('Cancel')
      }).onDismiss(() => {
        // console.log('Called on OK or Cancel')
      })
    },
    async eliminar (id) {
      try {
        this.activateLoading('Cargando')
        const p = await ProjectService.deleteProject({ id: id, token: localStorage.getItem('token') })
        if (p.status === 200) {
          this.getProjects()
          this.alert('positive', 'Eliminado correctamente')
        }
      } catch (error) {
        this.alert('negative', 'Se presentó un error')
      }
      this.disableLoading()
    },
    editProject (params) {
      this.$q.dialog({
        component: EditProject,
        parent: this,
        projectToEdit: params
      }).onOk(async (data) => {
        data.id = params.id
        data.token = localStorage.getItem('token')
        try {
          this.activateLoading('Cargando')
          const p = await ProjectService.modifyProject(data)
          this.getProjects()
          if (p.status === 200) {
            this.alert('positive', 'Proyecto editado exitosamente')
          }
        } catch (error) {
          this.alert('negative', 'Se ha presentado un error al editar el Proyecto')
        }
        this.disableLoading()
      }).onCancel(() => {
        // console.log('Cancel')
      }).onDismiss(() => {
        // console.log('Called on OK or Cancel')
      })
    }
  }
}
</script>
<style lang="scss" scoped>
.right {
  float: right;
}
</style>
