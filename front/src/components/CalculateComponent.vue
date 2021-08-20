<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 container">
                <div class="title">
                  <div class="text-h4">
                      Fórmulas
                  </div>
                </div>
                <div class="row">
                    <div v-for="formula in formulas" :key="formula.id" class="col-md-6 col-xs-12">
                        <q-card :class="`my-card bg-green-7 text-white`" style="margin: 5px;" flat bordered>
                            <q-card-section horizontal class="cards">
                                <q-card-section>
                                    <div class="text-h6">{{formula.name}}</div>
                                </q-card-section>
                            </q-card-section>
                            <q-card-actions align="right">
                                <q-btn class="bg-green" flat @click="goTo('calculate/' + formula.id)">
                                Calcular
                                </q-btn>
                            </q-card-actions>
                        </q-card>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</template>

<script>
import { functions } from '../functions.js'

export default {
  name: 'calculate-component',
  mixins: [functions],
  data () {
    return {
      formulas: [
        { name: 'Enfriamentos de sistemas abiertos', id: 1 },
        { name: 'Parametros vapor', id: 2 },
        { name: 'Polimeros - Aplicaciones Industriales', id: 3 },
        { name: 'Polimeros - Comparacion tecnica', id: 4 },
        { name: 'Polimeros - Laboratorio', id: 5 },
        { name: 'Rata de Flujo', id: 6 },
        { name: 'Aplicaciones Antiincrustantes', id: 7 }
      ]
    }
  },
  mounted () {
  },
  methods: {
    async organizarCards () {
      const cards = await document.getElementsByClassName('cards')
      // let widthSize = 0
      let heightSize = 0

      for (let i = 0; i < cards.length; i++) {
        // if (widthSize <= cards[i].clientWidth) widthSize = cards[i].clientWidth
        if (heightSize <= cards[i].clientHeight) heightSize = cards[i].clientHeight
      }
      for (let i = 0; i < cards.length; i++) {
        document.getElementsByClassName('cards')[i].style.height = heightSize + 'px'
        // document.getElementsByClassName('cards')[i].style.minWidth = widthSize + 'px'
      }
    }
  }
}
</script>
