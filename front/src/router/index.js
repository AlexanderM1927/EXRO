import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import VueTour from 'vue-tour'

// imports custom

import FullCalendar from 'vue-full-calendar'
import Highcharts from 'highcharts'
import Treemap from 'highcharts/modules/treemap'
import Itemseries from 'highcharts/modules/item-series'
import HighchartsVue from 'highcharts-vue'
import loadExporting from 'highcharts/modules/exporting'
import loadExportingData from 'highcharts/modules/export-data'

require('vue-tour/dist/vue-tour.css')

Treemap(Highcharts)
Itemseries(Highcharts)
loadExporting(Highcharts)
loadExportingData(Highcharts)
Vue.use(VueTour)
Vue.use(VueRouter)
Vue.use(Highcharts, Treemap, Itemseries, HighchartsVue)
Vue.use(FullCalendar)

/*
 * If not building with SSR mode, you can
 * directly export the Router instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Router instance.
 */

export default function (/* { store, ssrContext } */) {
  const Router = new VueRouter({
    scrollBehavior: () => ({ x: 0, y: 0 }),
    routes,

    // Leave these as they are and change in quasar.conf.js instead!
    // quasar.conf.js -> build -> vueRouterMode
    // quasar.conf.js -> build -> publicPath
    mode: process.env.VUE_ROUTER_MODE,
    base: process.env.VUE_ROUTER_BASE
  })
  Router.beforeEach(async (to, from, next) => {
    document.title = to.meta.title
    // si es logout
    if (to.name === 'logout') {
      try {
        localStorage.removeItem('user')
        localStorage.removeItem('token')
      } catch (error) {
        localStorage.removeItem('user')
        localStorage.removeItem('token')
      }
      location.href = 'login'
    }

    const reqSession = to.matched.some(route => route.meta.requireSession)

    if (!reqSession) {
      if (to.name === 'login' && localStorage.getItem('token')) {
        next({ name: 'home' })
      } else {
        next()
      }
    } else if (localStorage.getItem('token')) {
      next()
    } else {
      next({ name: 'login' })
    }
  })

  return Router
}
