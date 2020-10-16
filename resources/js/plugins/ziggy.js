import { Ziggy } from '../ziggy'
import route from 'ziggy'
import Vue from 'vue'

window.Ziggy = Ziggy

Vue.prototype.$route = (...args) => route(...args)
