
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));  //i commented this out due to error compiling

const app = new Vue({
    el: '#app'
});
/*
import Pusher from 'pusher-js'
import Echo from "laravel-echo"
window.Echo = new Echo({
       broadcaster: 'pusher',
       key: 'ddc158fa13ebad9c3fdf',
       cluster: 'us2',
       encrypted: true
  }); 

 window.Echo.channel('threadmessage')
    .listen('NewThreadMessage', (e) => {
   // var user = this.users.find((user) => user.id === e.id);
        // check if user exists on leaderboard
        console.log(e);
        console.log('received an event');
        alert('cool');
    //    alert('good');
        
    }); */
