<template>
  <q-dialog ref="dialog" @hide="onDialogHide">
    <q-card class="q-dialog-plugin container">
      <div class="text-h6">Crear variable</div>
      <q-separator />
      <q-input v-model="variable.name" label="Nombre de la variable" color="grey-3" bg-color="white" label-color="primary">
        <template v-slot:append>
            <q-icon name="title" color="primary" />
        </template>
      </q-input>
      <q-card-actions align="right">
        <q-btn color="primary" label="OK" @click="validateForm([variable.name], onOKClick)" />
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
      variable: {}
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
      this.$emit('ok', this.variable)
      this.hide()
    },

    onCancelClick () {
      // we just need to hide dialog
      this.hide()
    }
  }
}
</script>
