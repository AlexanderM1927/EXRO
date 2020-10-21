<template>
  <q-dialog ref="dialog" @hide="onDialogHide">
    <q-card class="q-dialog-plugin container">
      <div class="text-h6">Máximos y mínimos</div>
      <q-separator />
      <q-input type="number" color="grey-3" bg-color="white" label-color="primary" filled v-model="variable.max" label="Máximo">
        <template v-slot:append>
          <q-icon name="flip_to_front" color="primary" />
        </template>
      </q-input>
      <q-input type="number" color="grey-3" bg-color="white" label-color="primary" filled v-model="variable.min" label="Mínimo">
        <template v-slot:append>
          <q-icon name="flip_to_back" color="primary" />
        </template>
      </q-input>
      <div class="text-h6">Razón por tomar valor fuera de rango</div>
      <ckeditor :editor="editor" v-model="variable.razon_outrange" :config="editorConfig"></ckeditor>
      <q-card-actions align="right">
        <q-btn color="primary" label="OK" @click="onOKClick" />
        <q-btn color="primary" label="Cancel" @click="onCancelClick" />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { functions } from '../../functions.js'

export default {
  mixins: [functions],
  data () {
    return {
      variable: {},
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the editor.
      }
    }
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
      this.$emit('ok', this.variable)
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
