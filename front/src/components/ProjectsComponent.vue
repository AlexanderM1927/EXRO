<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 container">
              <div class="row">
                <div class="col-12">
                  <div class="title">
                    <div class="text-h4">
                        Tratamientos
                        <div class="right">
                          <div class="projects--header">
                            <q-input
                              dense
                              color="grey-3"
                              bg-color="white"
                              label-color="primary"
                              filled
                              debounce="300"
                              v-model="filter"
                              placeholder="Buscar"
                            >
                              <template v-slot:append>
                                  <q-icon name="search" />
                              </template>
                            </q-input>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div v-if="projects.data.length === 0">
                    Ningun tratamiento hasta el momento
                  </div>
                  <div v-for="item in projects.data" :key="item.id" class="col-md-6 col-xs-12">
                      <q-card class="my-card" style="margin: 5px;" flat bordered>
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
                          </q-card-actions>
                      </q-card>
                  </div>
              </div>
              <div class="row">
                <Paginator
                  v-if="projects.data"
                  @getAction="getProjects"
                  :data="paginator"
                ></Paginator>
              </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import ProjectService from '../services/ProjectService'
import EditProject from './Dialogs/EditProject.vue'
import { functions } from '../functions.js'
import Paginator from './Paginator.vue'
import { debounce } from 'quasar'

export default {
  components: {
    Paginator
  },
  name: 'projects-component',
  mixins: [functions],
  props: ['mode'],
  data () {
    return {
      projects: [],
      paginator: {},
      filter: ''
    }
  },
  watch: {
    filter () {
      debounce(this.getProjects(), 1500)
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
        document.getElementsByClassName('cards')[i].style.height = heightSize + 'px'
        // document.getElementsByClassName('cards')[i].style.minWidth = widthSize + 'px'
      }
    },
    async getProjects (newPage = 1) {
      try {
        this.activateLoading('Cargando')
        const us = await ProjectService.getProjects(newPage, {
          name: this.filter,
          token: localStorage.getItem('token')
        })
        this.paginator = {
          currentPage: us.data.projects.current_page,
          lastPage: us.data.projects.last_page,
          data: us.data.projects.data,
          url: ''
        }
        const projects = us.data.projects
        this.projects = projects
        this.organizarCards()
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    },
    eliminar (id) {
      this.$q.dialog({
        title: 'Confirmar',
        message: 'Seguro que deseas eliminar este tratamiento?',
        cancel: true,
        persistent: true
      }).onOk(async () => {
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
      }).onOk(() => {
      }).onCancel(() => {
      }).onDismiss(() => {
      })
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
            this.alert('positive', 'Tratamiento editado exitosamente')
          }
        } catch (error) {
          this.alert('negative', 'Se ha presentado un error al editar el Tratamiento')
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
