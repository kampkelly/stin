<template>
<div>

        <div class="col-xs-7 col-sm-3 col-md-3 col-lg-8">
             <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
                <div class="container-fluid" v-show="loaded">
                 <div class="alert alert-success notifications_panel" role="alert" v-show="status" style="position: fixed; top: 80px; width: 30%; z-index: 60;">
                    {{returnmessage}}
                </div>
                 <h4 class="text-center">A single thread</h4>
                    <h4 class="small text-info" id="viewnewthread" style="cursor: pointer;">Create new thread with {{user.fullname}}<span class="small-font"> (click to show)</span></h4>
                    <h4 class="small text-warning" id="hidenewthread" style="cursor: pointer; display: none;">Create new thread with this {{user.fullname}}<span class="small-font"> (click to hide)</span></h4>
                    <div id="expand_thread" style="display: none;">
                        <form action="/messages" method="POST" class="form-horizontal" role="form">
                        <!--csrf field-->
                         <div class="form-group">
                                <label for="title" class="control-label">Thread Title</label>
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Thread Title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message" class="control-label">Message</label>
                                <div class="col-sm-10 col-sm-offset-2">
                                    <textarea name="message" id="message" class="form-control" rows="5" style="resize:none;" placeholder="Enter Message"></textarea>
                                </div>
                            </div>
                            <input type="text" name="user_id" :value="user.id" hidden="true">
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary btn-block">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h4 class="text-center">Thread - {{thread.title}}</h4>
                  
                    
                    <ul class="list-group row thread_message">
                        <span v-for="message in messages"> 
                            <li class="list-group-item col-lg-8 col-lg-offset-0" v-if="message.user_id == auth.id"><span class="pull-right smallest-font text-muted">Sent by me {{ postedOn(message) }}</span><span class="small">{{message.body}}</span></li>
                            <li class="list-group-item col-lg-8 col-lg-offset-4" v-else><span class="pull-right small smallest-font text-muted">Sent by {{user.fullname}} {{ postedOn(message) }}</span><span class="small">{{message.body}}</span></li>
                        </span>
                        <div id="usb"></div>
                    </ul>
                      <form :action="'/threads/' + user.username + '/' + thread.slug" method="POST" value="PUT" class="form-horizontal" role="form" v-on:submit.prevent="sendMessage('/threads/' + user.username + '/' + thread.slug)">
                      <!--csrf field-->
                          <div class="form-group">
                              <label for="message" class="control-label">Reply</label>
                              <div class="col-sm-10 col-sm-offset-2">
                                  <textarea name="message" id="message" class="form-control msg" rows="5" style="resize:none;" placeholder="Enter Message" v-model="message"></textarea>
                              </div>
                          </div>
                          <input type="text" name="user_id" :value="user.id" hidden="true">
                          <div class="form-group">
                              <div class="col-sm-10 col-sm-offset-2">
                                  <button type="submit" class="btn btn-primary btn-block send-msg" v-show="messagesend">
                                      Send Reply
                                  </button>
                                  <button class="btn btn-primary btn-block send-msg" v-show="messageloading">
                                      Sending <img src="/Ellipsis.svg">
                                  </button>
                              </div>
                          </div>
                      </form>
                    <input type="text" name="myid" :value="thread.id" id="myid" hidden="true" />
                    <input type="text" name="myid" :value="auth.id" id="thid" hidden="true" />
                   
                </div>

        </div>

</div>
</template>


<script>
import moment from 'moment';
var myid;
var threadd_id;
let date = Date();
//myid = document.getElementById('myid').value;
    export default {
        data() {
            return {
                threads: [],
                loading: '',
                loaded: '',
                thread: '',
                messages: '',
                user: '',
                auth: '',
                game: '',
                message: '',
                auth_id: '',
                thread_id: '',
                status: '',
                returnmessage: '',
                messageloading: false,
                messagesend: true

            }
        },
         beforeRouteUpdate: function(to, from, next) {
            console.log("beforeRouteEnter");
            var cb = function(vm) {
              //  $(window).on('hashchange', function(e){  //detect url change
               // this.fetchData();
           //   vm.setData(fakeJson);
            };
          //  this.fetchData();
            next();
            this.fetchData();
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this,
          //  $(window).on('hashchange', function(e){  //detect url change
            this.fetchData();
          //  }); this.$router.go()
     
        },
        methods: {
            fetchData () {
                axios.post('/thisthread/' + this.$route.params.username + '/' + this.$route.params.slug)
              //  axios.post('/thisthread')
             //   .then(({data}) => this.categories = data);  //object desturcturing syntax in ecma 6(ES2015)
                .then(function(response) { 
            //    console.log(response.data),
                self.game = response.data
           //     console.log(response.data[0]),
             //   console.log(response.data[1]),
              //  console.log(response.data[2]),
                self.thread = response.data[0],
                self.thread_id = response.data[0].id,
                self.messages = response.data[1],
                self.user = response.data[2], 
                self.auth = response.data[3], 
                self.auth_id = response.data[3].id, 
              //  response => this.categories = response.data,
                self.loading = false,
                self.loaded = true,
                myid = self.auth_id;
                threadd_id = self.thread_id;
                setInterval(function() {
               //   myid = self.thread_id;
               
                }, 2000);
                mysock(myid, threadd_id);
                }); 
            },
            socke() {
         /*       var myname = document.getElementById('myusername').value;
                var socket = io.connect('http://theinnovestors.dev:8890');
                socket.on('message', function (data) {
                    data = jQuery.parseJSON(data);
              //      console.log(data.body);
                //    $( "#messages" ).append( "<strong>"+data.title+":</strong><p>"+data.body+"</p>" );
                 //   if(data.user_id == myname){
                    
                    if(data.user_id == myname){
                        $( "#usb" ).prepend(
                         '<li class="list-group-item col-lg-8 col-lg-offset-0"><span class="pull-right smallest-font text-muted">Sent by me '+data.created_at+'</span><span class="small">'+data.body+'</span></li>' 
                         ); 
                    } else{
                        $( "#usb" ).prepend(
                         '<li class="list-group-item col-lg-8 col-lg-offset-4"><span class="pull-right smallest-font text-muted">Sent by '+data.username+' '+data.created_at+'</span><span class="small">'+data.body+'</span></li>' 
                         ); 
                    }

              }); */
            },
            sendMessage(sendurl) {  //save location method
              self = this,
              this.messagesend = false,
              this.messageloading = true
               axios({ 
                  method: 'post',
                  url: sendurl,
                  data: {
                    message: self.message,
                    user_id: self.auth_id,
                    thread_id: self.thread_id   //<li class="list-group-item col-lg-8 col-lg-offset-0" v-if="message.id == auth.id"><span class="pull-right smallest-font text-muted">Sent by me {{ postedOn(message) }}</span><span class="small">{{message.body}}</span></li>
                  }
                })
               .then(function(response) { 
             //     console.log(response);
                  self.messagesend = true,
                  self.messageloading = false,
                  self.status = true,  //set message status to be shown to be true
                  self.returnmessage = response.data  //set message to be shown on saved to response from controller
                  $( "#usb" ).append(
                       '<li class="list-group-item col-lg-8 col-lg-offset-0" v-if="message.id == auth.id"><span class="pull-right smallest-font text-muted">Sent by me '+moment(date).fromNow()+'</span><span class="small">'+self.message+'</span></li>' 
                       ); 
                  self.message = '',
             //     socke();
                  setTimeout(function(){   
                       self.status = false //set message status to false after xxx seconds
                    }, 7000);
               });
            },
            postedOn(message) {
                return moment(message.created_at).fromNow();
            }
        },
    }
    //event
    //var myid = document.getElementById('myid').value;
   // var thisthread_id = document.getElementById('thid').value;
   // console.log(myid);
   // console.log('nice');
  //  console.log(thisthread_id); 
import Pusher from 'pusher-js'
import Echo from "laravel-echo"
    function mysock(myid, threadd_id) {
        console.log(myid);
        console.log(threadd_id);
        console.log('this got');
        window.Echo = new Echo({  //start of echo and pusher receive
               broadcaster: 'pusher',
               key: 'ddc158fa13ebad9c3fdf',
               cluster: 'us2',
               encrypted: true
          });

            window.Echo.channel('threadmessage')
            .listen('NewThreadMessage', (e) => {
           // var user = this.users.find((user) => user.id === e.id);
                // check if user exists on leaderboard
                console.log('sjksk');
                console.log(e.message.auth_id);
                console.log(e.message.user_id);
                console.log(e.message.username);
                console.log('from the message vue received an event');
                if( (e.message.auth_id != myid) && (e.message.thread_id == threadd_id) && (e.message.user_id == myid) ) {
                  $( "#usb" ).append(
                   '<li class="list-group-item col-lg-8 col-lg-offset-4" ><span class="pull-right smallest-font text-muted">Sent by '+ e.message.username + moment(date).fromNow()+'</span><span class="small">'+e.message.body+'</span></li>' 
                   ); 
                } 
            });     //end of echo and pusher receive
    }
    

   
    //event
</script>
