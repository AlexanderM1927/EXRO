<template>
  <q-dialog ref="dialog" @hide="onDialogHide">
    <q-card class="q-dialog-plugin container">
      <div class="text-h6">Editar Proyecto</div>
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
      <q-file color="grey-3" bg-color="white" label-color="primary" filled v-model="project.photo" label="Img" required :rules="[val => !!val || 'Este campo es necesario']">
        <template v-slot:prepend>
          <q-icon name="attach_file" color="primary" />
        </template>
      </q-file><br>
      <q-card-actions align="right">
        <q-btn color="primary" label="OK" @click="onOKClick" />
        <q-btn color="primary" label="Cancel" @click="onCancelClick" />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script>
import { functions } from '../../functions.js'

export default {
  mixins: [functions],
  data () {
    return {
      project: {}
    }
  },
  props: ['projectToEdit'],
  mounted () {
    this.project = this.projectToEdit
  },
  methods: {
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
    // on OK, it is REQUIRED to
    // emit "ok" event (with optional payload)
    // before hiding the QDialog
      var data = new FormData()
      data.append('name', this.project.name)
      data.append('descripcion', this.project.descripcion)
      data.append('photo', this.project.photo)
      this.$emit('ok', data)
      // or with payload: this.$emit('ok', { ... })

      // then hiding dialog
      this.hide()
    },

    onCancelClick () {
      // we just need to hide dialog
      this.hide()
    }
  }
}
</script>
