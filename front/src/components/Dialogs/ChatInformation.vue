<template>
  <q-dialog ref="dialog" @hide="onDialogHide">
    <q-card class="q-dialog-plugin container">
      <div class="text-h6">Chat</div>
      <b>Usuario: {{chat.user}}</b><br>
      <b>Tipo: {{chat.type}}</b><br>
      <hr>
      <div v-html="chat.message"></div>
      <ckeditor :editor="editor" v-model="chat.answer" :config="editorConfig"></ckeditor>
      <q-card-actions align="right">
        <q-btn color="primary" label="OK" @click="onOKClick" />
        <q-btn color="primary" label="Cancel" @click="onCancelClick" />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script>
import { functions } from '../../functions.js'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  mixins: [functions],
  data () {
    return {
      chat: {},
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the editor.
      }
    }
  },
  props: ['chatToEdit'],
  mounted () {
    this.chat = this.chatToEdit
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
      this.$emit('ok', this.chat)
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
