<template>
  <q-dialog ref="dialog" @hide="onDialogHide">
    <q-card class="q-dialog-plugin container">
      <div class="text-h6">Registra un nuevo usuario</div>
      <q-separator />
      <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="user.name" label="Nombre" required :rules="[val => !!val || 'Este campo es necesario']">
        <template v-slot:append>
          <q-icon name="account_circle" color="primary" />
        </template>
      </q-input>
      <q-input color="grey-3" bg-color="white" label-color="primary" filled v-model="user.email" label="Email" required :rules="[val => !!val || 'Este campo es necesario']">
        <template v-slot:append>
          <q-icon name="mail" color="primary" />
        </template>
      </q-input>
      <q-input color="grey-3" bg-color="white" label-color="primary" v-model="user.password" filled :type="isPwd ? 'password' : 'text'" label="Clave" required :rules="[val => !!val || 'Este campo es necesario']">
        <template v-slot:append>
          <q-icon color="primary" :name="isPwd ? 'visibility_off' : 'visibility'" @click="isPwd = !isPwd"/>
        </template>
      </q-input>
      <q-input color="grey-3" bg-color="white" label-color="primary" v-model="user.passwordconfirm" filled :type="isPwd2 ? 'password' : 'text'" label="Confirmar clave" required :rules="[val => !!val || 'Este campo es necesario']">
        <template v-slot:append>
          <q-icon color="primary" :name="isPwd2 ? 'visibility_off' : 'visibility'" @click="isPwd2 = !isPwd2"/>
        </template>
      </q-input>
      <q-select color="grey-3" bg-color="white" label-color="primary" filled v-model="user.rank" :options="options" label="Tipo" required :rules="[val => !!val || 'Este campo es necesario']">
        <template v-slot:append>
          <q-icon name="check" color="primary" />
        </template>
      </q-select>
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
      user: {},
      isPwd: true,
      isPwd2: true,
      options: [
        'Cliente', 'Ingeniero', 'Administrador'
      ]
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
      if (this.user.password === this.user.passwordconfirm) {
        // on OK, it is REQUIRED to
        // emit "ok" event (with optional payload)
        // before hiding the QDialog
        this.$emit('ok', this.user)
        // or with payload: this.$emit('ok', { ... })

        // then hiding dialog
        this.hide()
      } else {
        this.alert('negative', 'Las claves no coinciden')
      }
    },

    onCancelClick () {
      // we just need to hide dialog
      this.hide()
    }
  }
}
</script>
