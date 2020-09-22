<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="text-h3 q-pa-md">
                    Proyectos
                    <div class="right">
                        <q-btn color="secondary" label="Crear Proyecto" @click="createProyect"></q-btn>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-1"></div>
            <div class="col-10 container">
                <div class="row">
                    <div v-for="(item, id) in proyects" :key="id"  class="col-md-6 col-xs-12">
                        <div v-if="proyects.length==0">
                            Ningun proyecto hasta el momento
                        </div>
                        <q-card v-else class="my-card" flat bordered>
                            <q-card-section horizontal>
                                <q-card-section class="cards">
                                    <div class="text-h6">{{item.name}}</div>
                                    {{item.descripcion}}
                                </q-card-section>

                                <q-img
                                class="col-5"
                                src="https://cdn.quasar.dev/img/parallax2.jpg"
                                />
                            </q-card-section>
                            <q-separator/>

                            <q-card-actions>
                                <q-btn flat color="primary">
                                Ver
                                </q-btn>
                                <q-btn flat color="primary" @click="editProyect(item)">
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
import ProyectService from '../services/ProyectService'
import AddProyect from './Dialogs/AddProyect.vue'
import EditProyect from './Dialogs/EditProyect.vue'
import { functions } from '../functions.js'

export default {
  name: 'proyects-component',
  mixins: [functions],
  props: [],
  data () {
    return {
      proyects: []
    }
  },
  mounted () {
    this.organizarCards()
    this.getProyects()
  },
  methods: {
    async organizarCards () {
      const cards = await document.getElementsByClassName('cards')
      let widthSize = 0
      let heightSize = 0

      for (let i = 0; i < cards.length; i++) {
        if (widthSize <= cards[i].clientHeight) widthSize = cards[i].clientWidth
        if (heightSize <= cards[i].clientWidth) heightSize = cards[i].clientHeight
      }
      for (let i = 0; i < cards.length; i++) {
        document.getElementsByClassName('cards')[i].style.minHeight = heightSize + 'px'
        document.getElementsByClassName('cards')[i].style.minWidth = widthSize + 'px'
      }
    },
    async getProyects () {
      try {
        this.activateLoading('Cargando')
        const us = await ProyectService.getProyects({ token: localStorage.getItem('token') })
        const proyects = us.data.proyects
        this.proyects = proyects
      } catch (error) {
        console.log(error)
      }
      this.disableLoading()
    },
    createProyect () {
      this.$q.dialog({
        component: AddProyect,
        parent: this,
        text: 'Hola'
      }).onOk(async (data) => {
        data.token = localStorage.getItem('token')
        try {
          this.activateLoading('Cargando')
          const p = await ProyectService.newProyect(data)
          this.getProyects()
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
        const p = await ProyectService.deleteProyect({ id: id, token: localStorage.getItem('token') })
        if (p.status === 200) {
          this.getProyects()
          this.alert('positive', 'Eliminado correctamente')
        }
      } catch (error) {
        this.alert('negative', 'Se presentó un error')
      }
      this.disableLoading()
    },
    editProyect (params) {
      this.$q.dialog({
        component: EditProyect,
        parent: this,
        proyectToEdit: params
      }).onOk(async (data) => {
        data.token = localStorage.getItem('token')
        try {
          this.activateLoading('Cargando')
          const p = await ProyectService.modifyProyect(data)
          this.getProyects()
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
.cards {
  min-width: 58.5%;
}
</style>
