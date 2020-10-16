import { InertiaApp } from '@inertiajs/inertia-vue'
import Vue from 'vue'

import hasError from './mixins/hasError.js'
import HasError from './components/HasError.vue'

import gate from './mixins/gate.js'

require('./plugins/progress')
require('./plugins/ziggy')
require('./plugins/echo')
require('./plugins/meta')
require('./plugins/bootstrap')

Vue.use(InertiaApp)

const app = document.getElementById('app')

new Vue({
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => require(`./pages/${name}`).default
        }
    })
}).$mount(app)

Vue.mixin(gate)
Vue.mixin(hasError)
Vue.component('has-error', HasError)
