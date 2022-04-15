require('./bootstrap');

import Vue from 'vue';

const requireModulesVueFiles = (moduleVueFiles) => {
    moduleVueFiles.keys().map(key => {
        Vue.component(
            key.split('/').pop().split('.')[0],
            moduleVueFiles(key).default
        )
    })
}

requireModulesVueFiles(require.context(
    '../../../addons',
    true,
    /\.*\.vue$/i
))

requireModulesVueFiles(require.context(
    '../../../vendor/visiosoft',
    true,
    /\.vue$/i
))

const app = new Vue({
    el: '#openclassify'
});
