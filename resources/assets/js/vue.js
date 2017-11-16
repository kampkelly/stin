//import router from './routes';
//var VueTruncate = require('vue-truncate-filter')
//Vue.use(VueTruncate)
Vue.use(require('vue-truncate'));


let self = ''; //set self equal to empty string to be used in axios
var app1 = new Vue({
  el: '#loginn',
  data: {
    email: '',
    password: '',
  	login: true,  //normal login button
    loading: false,  //loading login button
  	disabled: false,  //disable buttons
    request_status: '',
    message: '',
    type: 'Choose what you want to request for',
    featured: 'all', 
    styleObject: {  //this is for styling the message in login view
        color: ''
      }
    },
    methods: {
      showloading() {  //function triggered on form submit
        this.login = false,
        this.loading = true,
        $('.dont-show').css("visibility", "visible");
        this.disabled = true,
        self = this  //set self equal to this(which is the vue data)
        axios({  //ajax request to login controller
          method: 'post',
          url: '/login',
          data: {  //data to be sent along with ajax request
            email: self.email,  //email from vue data
            password: self.password  //password from vue data
          }
        })
        .then(function(response) {  //response
          console.log(response);
          if(response.status == 200) {
            self.message = 'Logged in successful, redirecting to dashboard...';  //set message in vue data
            self.styleObject.color = '#52a6d5';  //set style color in vue data
            self.disabled = true;  //set disabled in view data
            setTimeout(function(){   //redirect to dashboard after certain seconds
                 window.location.href = '/login'  
              }, 2000);
          }
        })
          .catch(function (error) {  //error
            console.log(error.response);
            if(error.response.status == 422) {
              self.message = error.response.data.email;
              self.login = true;
              self.loading = false;
              self.styleObject.color = 'red';
              self.disabled = false;  //set disabled in view data
            }
        });
      }
    }
});

Vue.component('startup', require('./components/Request-startup.vue'));
Vue.component('startup-auth', require('./components/Request-startup-auth.vue'));
Vue.component('idea', require('./components/Request-idea.vue'));
Vue.component('idea-auth', require('./components/Request-idea-auth.vue'));




