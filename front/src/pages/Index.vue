<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
        <div class="row">
          <div class="center col-md-4 col-sm-4 col-xs-10">
            <q-img src="../assets/logo.png" style="width: 100%;" />
          </div>
        </div>
        <div class="row">
            <div class="login box col-md-4 col-sm-4 col-xs-10">
                <div class="text-h6">
                  Login
                </div>
                <q-separator />
                <LoginComponent />
            </div>
        </div>
    </q-page-container>
  </q-layout>
</template>

<script>
import LoginComponent from 'src/components/LoginComponent.vue'

export default {
  name: 'Index',
  components: {
    LoginComponent
  },
  data () {
    return {
    }
  },
  methods: {
  }
}
</script>
