window._ = require('lodash')
window.Popper = require('popper.js').default
window.Chart = require('chart.js')

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

/* ============
 * Vue
 * ============
 *
 * Vue.js is a library for building interactive web interfaces.
 * It provides data-reactive components with a simple and flexible API.
 *
 * http://rc.vuejs.org/guide/
 */
import Vue from 'vue'

import BootstrapVue from 'bootstrap-vue'

Vue.config.debug = process.env.NODE_ENV !== 'production'

try {
  window.$ = window.jQuery = require('jquery')

  require('bootstrap')
} catch (e) {
}

window.CustomToolTips = function CustomTooltips(s){let e,t,a=this,o="above",n="below",l="chartjs-tooltip",i="no-transform",c="tooltip-body",r="tooltip-body-item",d="tooltip-body-item-color",p="tooltip-body-item-label",m="tooltip-body-item-value",h="tooltip-header",u="tooltip-header-item",v={DIV:"div",SPAN:"span",TOOLTIP:(this._chart.canvas.id||(e=function(){return(65536*(1+Math.random())|0).toString(16)},t="_canvas-"+(e()+e()),a._chart.canvas.id=t))+"-tooltip"},y=document.getElementById(v.TOOLTIP);if(y||((y=document.createElement("div")).id=v.TOOLTIP,y.className=l,this._chart.canvas.parentNode.appendChild(y)),0!==s.opacity){if(y.classList.remove(o,n,i),s.yAlign?y.classList.add(s.yAlign):y.classList.add(i),s.body){let f=s.title||[],N=document.createElement(v.DIV);N.className=h,f.forEach(function(e){let t=document.createElement(v.DIV);t.className=u,t.innerHTML=e,N.appendChild(t)});let b=document.createElement(v.DIV);b.className=c,s.body.map(function(e){return e.lines}).forEach(function(e,t){let a=document.createElement(v.DIV);a.className=r;let o=s.labelColors[t],n=document.createElement(v.SPAN);if(n.className=d,n.style.backgroundColor=o.backgroundColor,a.appendChild(n),1<e[0].split(":").length){let l=document.createElement(v.SPAN);l.className=p,l.innerHTML=e[0].split(": ")[0],a.appendChild(l);let i=document.createElement(v.SPAN);i.className=m,i.innerHTML=e[0].split(": ").pop(),a.appendChild(i)}else{let c=document.createElement(v.SPAN);c.className=m,c.innerHTML=e[0],a.appendChild(c)}b.appendChild(a)}),y.innerHTML="",y.appendChild(N),y.appendChild(b)}let C=this._chart.canvas.offsetTop,T=this._chart.canvas.offsetLeft;y.style.opacity=1,y.style.left=T+s.caretX+"px",y.style.top=C+s.caretY+"px"}else y.style.opacity=0}

require('pace-progress')
require('perfect-scrollbar')
require('@coreui/coreui/dist/js/coreui.min')

Vue.use(BootstrapVue)

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

/* ============
 * Axios
 * ============
 *
 * Promise based HTTP client for the browser and node.js.
 * Because Vue Resource has been retired, Axios will now been used
 * to perform AJAX-requests.
 *
 * https://github.com/mzabriskie/axios
 */
import Axios from 'axios'

Axios.defaults.baseURL = process.env.API_LOCATION
Axios.defaults.headers.common.Accept = 'application/json'

// Bind Axios to Vue.
Vue.$http = Axios
Object.defineProperty(Vue.prototype, '$http', {
  get () {
    return Axios
  }
})

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
  Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

/* ============
 * Laravel Echo
 * ============
 *
 * Laravel Echo is a JavaScript library that makes it painless to subscribe
 * to channels and listen for events broadcast by Laravel.
 *
 * https://github.com/laravel/echo
 */
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

window.Pusher = Pusher

const echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  authEndpoint: process.env.MIX_BROADCAST_AUTH_ENDPOINT
})

// Bind Laravel Echo to Vue.
Vue.$echo = echo
Object.defineProperty(Vue.prototype, '$echo', {
  get () {
    return echo
  }
})
