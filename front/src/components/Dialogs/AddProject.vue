<template>
  <q-dialog ref="dialog" @hide="onDialogHide">
    <q-card class="q-dialog-plugin container">
      <div class="text-h6">Crear tratamiento</div>
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
      <q-card-actions align="right">
        <q-btn color="primary" label="OK" @click="validateForm([project.name, project.photo, project.descripcion], onOKClick)" />
        <q-btn color="primary" label="Cancel" @click="onCancelClick" />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script>
import { functions } from '../../functions.js'

export default {
  mixins: [functions],
  props: ['clientId'],
  data () {
    return {
      project: {},
      options: [],
      dialog: false
    }
  },
  methods: {

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
      var data = new FormData()
      data.append('name', this.project.name)
      data.append('descripcion', this.project.descripcion)
      data.append('idcliente', this.clientId)
      data.append('photo', this.project.photo)
      this.$emit('ok', data)
      this.hide()
    },

    onCancelClick () {
      // we just need to hide dialog
      this.hide()
    }
  }
}
</script>
