<template>
  <div ref="content">
    <div class="row">
      <div class="col-12">
        <center>
          <div class="text-h4">
            {{ formName }}
          </div>
          <img style="max-width: 100%" src="../../assets/form7.png" />
        </center>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <b>{{ configuration.messageCalculate }}</b>
      </div>
    </div>
  </div>
</template>

<script>
import { functions } from "../../functions.js";

export default {
  props: ['configuration'],
  name: "form-7-component",
  mixins: [functions],
  data() {
    return {
      formName: "Filtración - Aplicaciones Antiincrustantes",
    };
  },
  // operaciones
  updated() {},
  mounted() {},
  methods: {},
};
</script>
<style lang="scss" scoped>
</style>
