<template>
    <div class="row">
        <div class="col-12 chat">
            <div class="row">
                <div class="col-md-6 col-xs-1"></div>
                <div v-if="!chatingMode" class="col-md-3 col-xs-10 container box" @click="chatingMode = true">PQRS</div>
                <div v-else class="col-md-3 col-xs-10 box">
                    <div class="title" @click="chatingMode = false">
                        PQRS
                    </div>
                    <div class="content">
                        <q-select color="grey-3" bg-color="white" label-color="primary" filled v-model="chat.type" :options="options" label="Tipo" required :rules="[val => !!val || 'Este campo es necesario']">
                            <template v-slot:append>
                            <q-icon name="check" color="primary" />
                            </template>
                        </q-select>
                        <ckeditor :editor="editor" v-model="chat.message" :config="editorConfig"></ckeditor>
                        <br>
                        <q-btn color="primary" @click="validateForm([chat.type, chat.message], sendMsg)" class="full-width" label="Enviar"></q-btn>
                    </div>
                </div>
                <div class="col-md-1 col-xs-1"></div>
            </div>
        </div>
    </div>
</template>

<script>
import ChatService from '../../services/ChatService'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { functions } from '../../functions.js'

export default {
  name: 'chat-component',
  mixins: [functions],
  props: ['mode'],
  data () {
    return {
      chatingMode: false,
      chat: {},
      options: ['Peticion', 'Queja', 'Reclamo', 'Sugerencia'],
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the editor.
      }
    }
  },
  mounted () {
  },
  methods: {
    async sendMsg () {
      this.chat.token = localStorage.getItem('token')
      this.chat.idusuario = localStorage.getItem('user')
      try {
        this.activateLoading('Cargando')
        const p = await ChatService.addChat(this.chat)
        if (p.status === 201) {
          this.chatingMode = false
          this.alert('positive', 'Mensaje enviado')
          this.chat = {}
        }
      } catch (error) {
        this.alert('negative', 'Se ha presentado un error al enviar el mensaje')
      }
      this.disableLoading()
    }
  }
}
</script>
<style lang="scss" scoped>
.chat {
    position: fixed;
    bottom: 0px;
    .container {
        background: $primary;
        color: white;
        padding: 5px 20px;
        border-radius: 10px 10px 0px 0px;
        cursor: pointer;
    }
}
.right {
  float: right;
}
.title {
  border-radius: 10px 10px 0px 0px;
  background: $primary;
  color: white;
  padding: 5px 20px;
  cursor: pointer;
}
.content {
  background: white;
  padding: 7px;
}
</style>
