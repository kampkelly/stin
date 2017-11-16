import router from './routes';
import VueTinymce from 'vue-tinymce';
Vue.use(VueTinymce)


var globalauthid = document.getElementById('globalauthid').value;
let	globalauth = jQuery.parseJSON(globalauthid);

var parent = new Vue({
  el: '#app',
  router,
  data: {
  //  notifynewmessage: false
	},
    methods: {
    	notifynewmessage() {
    		this.notifynewmessage = true
    	}
    }
});


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
    if(e.message.user_id == globalauth.id){
    	document.getElementById('notifymessage').style.display = 'block';
    	document.getElementById('notifymessage').innerHTML = '<h5 class="alert alert-info">You have a new message, <a href="#">see messages</a></h5>';
    	setTimeout(function(){   
         //  $('#notifymessage').hide;
           document.getElementById('notifymessage').style.display = 'none';
        }, 5000);
    }
        
    });

     window.Echo.channel('acceptconnection')
    .listen('AcceptConnection', (e) => {
    		console.log('this connection has been accepted');
    		console.log(e.user.fullname);
    		console.log(e.auth.fullname);
    		if(e.user.id == globalauth.id){
    			document.getElementById('notifyconnection').style.display = 'block';
		    	document.getElementById('notifyconnection').innerHTML = '<h5 class="alert alert-info">You are now connected with '+e.auth.fullname+', <a href="#">view connections</a></h5>';
		    	setTimeout(function(){   
		         //  $('#notifymessage').hide;
		           document.getElementById('notifyconnection').style.display = 'none';
		        }, 5000);
    		}
    	});

    window.Echo.channel('sendconnection')
    .listen('SendConnection', (e) => {
    		console.log('this connection has been sent');
    		console.log(e.user.fullname);
    		if(e.user.id == globalauth.id){
    			document.getElementById('notifyconnection').style.display = 'block';
		    	document.getElementById('notifyconnection').innerHTML = '<h5 class="alert alert-info">You just have a new connection request, <a href="#">view connections</a></h5>';
		    	setTimeout(function(){   
		         //  $('#notifymessage').hide;
		           document.getElementById('notifyconnection').style.display = 'none';
		        }, 5000);
    		}
    	});

       window.Echo.channel('sendconnection')
        .listen('SendConnection', (e) => {
          if(e.user.id == globalauth.id){
              //  document.getElementById('newconnect_container').style.display = 'block';
              $('#notifynewconnection').fadeIn();
                $( "#notifynewconnection" ).append(
                   ' <div style="position: fixed; bottom: 0%; right: 3%; z-index: 99" id="reques_modal">\
                    <div class="alert aler-info col-xs-12 col-sm-4 col-md-4 col-lg-4 col-sm-offset-1 small" role="alert" style="width: 100%; background-color: #FFFFFF; z-index: 17">\
					<span>Connection Request(s):</span><ul class="list-unstyled"> \
					<li><a href="/innovator/profile/username" style="color: #003B7D;">'+globalauth.fullname +'</a><router-link tag="li" to="/'+ globalauth.username+'/connections"> <a href="/dashboard#/'+ globalauth.username+'/connections">See requests</a></router-link></li>\
                    </ul></div></div>\
                   ' 
                   ); 
                setTimeout(function(){   
		           $('#notifynewconnection').fadeOut(4000);
		         //  document.getElementById('notifyconnection').style.display = 'none';
		        }, 5000);
                console.log('connection notified')
          }

         });

        window.Echo.channel('innovationadded')
        .listen('InnovationCreated', (e) => {
          if(e.user.id != globalauth.id){
             document.getElementById('notifyinnovation').style.display = 'block';
		    	document.getElementById('notifyinnovation').innerHTML = '<h5 class="alert alert-info">New Innovation by'+ e.user.fullname+', <a href="#">view it</a></h5>';
		    	setTimeout(function(){   
		         //  $('#notifymessage').hide;
		           document.getElementById('notifyinnovation').style.display = 'none';
		        }, 7000);
          }

         });
   
