<template>
    <div>
        <div class="row">
            <div v-for="table in tables" :key="table.id" class="col-md-6 col-xs-12">
                <!------- tabla ---->
                <div class="table">
                    <div class="box" style="padding: 5px;">
                        <div class="row">
                            <div class="col-12"><b>{{table.name}}</b></div>
                        </div>
                        <div v-for="field in table.fields" :key="field.id" class="row">
                            <div class="col-6">{{field.name}}</div>
                            <div class="col-6">
                                <input type="text" v-model="field.value" class="full-width full-height" />
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fin tabla ---->
            </div>
        </div>
    </div>
</template>

<script>
import { functions } from '../../functions.js'

export default {
  name: 'form-1-component',
  mixins: [functions],
  data () {
    return {
      tables: [
        {
          id: 1,
          name: 'Calidad agua de Reposicion (Ingreso a la Torre)',
          fields: [
            { id: 1, name: 'pH', value: '' },
            { id: 2, name: 'Dureza ppm CaCO3', value: '' },
            { id: 3, name: 'Alcalinidad Total ppm CaCO3', value: '' },
            { id: 4, name: 'Silice ppm SiO2', value: '' },
            { id: 5, name: 'Solidos disueltos ppm', value: '' },
            { id: 6, name: 'conductividad uS/cm', value: '' },
            { id: 7, name: 'Hierro ppm Fe', value: '' },
            { id: 8, name: 'Cloruros ppm Cl', value: '' }
          ]
        }
      ]
    }
  },
  // operaciones
  updated () {
  },
  methods: {
  }
}
</script>
<style lang="scss" scoped>
.table {
    padding: 5px;
}
</style>
