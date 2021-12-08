/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Alpine from "alpinejs";
window.Alpine = Alpine;

import Vue from "vue";
import VueChatScroll from 'vue-chat-scroll';
import store from './store'

Vue.use(VueChatScroll);


import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);








Alpine.start();



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
*/

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('chat-component', require('./components/Chat.vue').default);
Vue.component('ChatUserList', require('./components/ChatUserList.vue').default);
Vue.component('ChatArea', require('./components/ChatArea.vue').default);
Vue.component('ChatMessage', require('./components/ChatMessage.vue').default);
Vue.component('CreateRoom', require('./components/CreateRoom.vue').default);
Vue.component('RoomList', require('./components/RoomList.vue').default);
Vue.component('TheRoom', require('./components/Room.vue').default);
Vue.component('RoomUserList', require('./components/RoomUserList.vue').default);
Vue.component('RoomChatMessage', require('./components/RoomChatMessage.vue').default);
Vue.component('RoomChatArea', require('./components/RoomChatArea.vue').default);

Vue.component('TheMain', require('./components/Main.vue').default);
Vue.component('TheGame', require('./components/inGame/Game.vue').default);
Vue.component('TheProfile', require('./components/Profile.vue').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    router: new VueRouter(routes)
});
