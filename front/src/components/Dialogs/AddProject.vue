<template>
  <q-dialog ref="dialog" @hide="onDialogHide">
    <q-card class="q-dialog-plugin container">
      <div class="text-h6">Crear proyecto</div>
      <q-separator />
      <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="project.name" label="Nombre" required :rules="[val => !!val || 'Este campo es necesario']">
        <template v-slot:append>
          <q-icon name="description" color="primary" />
        </template>
      </q-input>
      <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="project.descripcion" type="textarea" label="Descripcion" required :rules="[val => !!val || 'Este campo es necesario']">
        <template v-slot:append>
          <q-icon name="topic" color="primary" />
        </template>
      </q-input>
      <q-file color="grey-3" accept=".jpg, image/*" bg-color="white" label-color="primary" filled v-model="project.photo" label="Img" required :rules="[val => !!val || 'Este campo es necesario']">
        <template v-slot:append>
          <q-icon name="attach_file" color="primary" />
        </template>
      </q-file>
      <q-btn color="primary" class="full-width" v-if="project.idcliente === undefined || project.idcliente === ''" label="Agregar cliente" icon="add" @click="addClient" />
      <q-btn color="primary" outline class="full-width" v-else label="Cambiar cliente" icon="edit" @click="addClient" />
      <br>
      <q-card-actions align="right">
        <q-btn color="primary" label="OK" @click="validateForm([project.name, project.photo, project.descripcion], onOKClick)" />
        <q-btn color="primary" label="Cancel" @click="onCancelClick" />
      </q-card-actions>
      <q-dialog
        v-model="dialog"
        persistent
        transition-show="slide-up"
        transition-hide="slide-down"
      >
        <q-card style="width: 800px; max-width: 80vw;">
        <q-card-section>
            <users-component mode="project" @add="add"></users-component>
        </q-card-section>
        </q-card>
      </q-dialog>
    </q-card>
  </q-dialog>
</template>

<script>
import UsersComponent from '../UsersComponent'
import { functions } from '../../functions.js'

export default {
  mixins: [functions],
  components: { UsersComponent },
  data () {
    return {
      project: {},
      options: [],
      dialog: false
    }
  },
  methods: {
    add (params) {
      this.project.idcliente = params.id
      this.dialog = false
    },

    addClient () {
      this.dialog = true
    },
    // following method is REQUIRED
    // (don't change its name --> "show")
    show () {
      this.$refs.dialog.show()
    },

    // following method is REQUIRED
    // (don't change its name --> "hide")
    hide () {
      this.$refs.dialog.hide()
    },

    onDialogHide () {
      // required to be emitted
      // when QDialog emits "hide" event
      this.$emit('hide')
    },

    onOKClick () {
      if (this.project.idcliente !== undefined && this.project.idcliente !== null && this.project.idcliente > 0) {
        var data = new FormData()
        data.append('name', this.project.name)
        data.append('descripcion', this.project.descripcion)
        data.append('idcliente', this.project.idcliente)
        data.append('photo', this.project.photo)
        this.$emit('ok', data)
        this.hide()
      } else {
        this.alert('warning', 'Debes agregar un cliente antes de crear el proyecto')
      }
    },

    onCancelClick () {
      // we just need to hide dialog
      this.hide()
    }
  }
}
</script>
