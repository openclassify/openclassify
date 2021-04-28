
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.Vue = require('vue');

const requireModulesVueFiles = (moduleVueFiles) => {
    moduleVueFiles.keys().map(key => {
        Vue.component(
            key.split('/').pop().split('.')[0],
            moduleVueFiles(key).default
        )
    })
}

requireModulesVueFiles(require.context(
    '../../../addons/default/visiosoft',
    true,
    /\.vue$/i
))

requireModulesVueFiles(require.context(
    '../../../vendor/visiosoft',
    true,
    /\.vue$/i
))

// Vue.component('example', require('./components/Example.vue').default);

const app = new Vue({
    el: '#openclassify'
});
