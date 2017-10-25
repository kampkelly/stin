//import router from './routes';
var VueTruncate = require('vue-truncate-filter')
Vue.use(VueTruncate)

let self = ''; //set self equal to empty string to be used in axios
var app1 = new Vue({
  el: '#login',
  data: {
    email: '',
    password: '',
  	login: true,  //normal login button
    loading: false,  //loading login button
  	disabled: false,  //disable buttons
    request_status: '',
    message: '',
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
            self.styleObject.color = 'blue';  //set style color in vue data
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




