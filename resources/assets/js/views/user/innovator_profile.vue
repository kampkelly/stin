<template>
<div class="col-xs-2 col-sm-12 col-md-8 col-lg-8 col-xl-7 second-row" id="secondDiv" style="padding-top: 70px; margin-right: 0px !important;">
        <div>
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <div class="container-fluid" v-show="loaded">
            <div>
                 <form action="/upload_profile_pic" method="post" enctype="multipart/form-data" id="formId_profilepage" style="position: relative;" v-if="user.id == auth.id">
                    <input type="hidden" name="_token" :value="csrf">
                    <div v-if="user.image == 'default_profile.jpeg'">
                      <img :src="'https://api.adorable.io/avatars/181/' + user.email + '.png'" class="img-fluid rounded-circle oval d-block d-xl-none" style="filter: grayscale(50%); height: 50px; width:60px">
                    </div>
                    <div v-else>
                    <img :src="'uploads/profile-pic/' + user.image" class="img-fluid rounded oval d-block d-sm-none">
                     <img :src="'uploads/profile-pic/' + user.image" class="img-fluid rounded oval d-none d-sm-block">
                   </div>
                    <span class="glyphicon glyphicon-camera" style="color: white; position: absolute; font-size: 150%; top: 100; margin-top:40px; left: 9%; z-index:90; cursor:pointer;"></span>
                      <input type="file" id="my_file_profilepage" name="my_file" style="position: absolute; bottom: 200; margin-top:30px; cursor:pointer; font-size: 200%; opacity: 0.001; width:20%; z-index:91;"/>
                </form>
                <div v-else>
                   <img :src="'https://api.adorable.io/avatars/181/' + user.email + '.png'" class="img-fluid rounded-circle oval" style="filter: grayscale(50%);" v-if="user.image == 'default_profile.jpeg'">
                    <img :src="'uploads/profile-pic/' + user.image" class="img-fluid rounded oval  d-block d-sm-none" v-else>
                </div>
                <a :href="'https://api.adorable.io/avatars/181/' + user.email + '.png'" target="blank" v-if="user.image == 'default_profile.jpeg'">View photo</a>
                <a :href="'uploads/profile-pic/' + user.image" target="blank" v-else>View photo</a>

                 <img :src="'uploads/profile-pic/' + user.image" class="img-responsive img-rounded oval show-only-smartphone" style="display: none;">
                 <img :src="'uploads/profile-pic/' + user.image" class="img-responsive img-rounded oval" style="display: none;">
                 <h4 v-if="auth.id == user.id" class=""><span style="font-size: 80%;">My Profile</span> </h4>
                 <h5 v-else><span style="font-size: 80%;">You are viewing</span> {{user.fullname}}'s <span style="font-size: 80%;">Profile</span></h5><br>
                 <ul class="list-unstyled">
                    <li class="text-muted" v-if="auth.id == user.id"><small>About me: {{user.bio}}</small></li>
                    <li class="text-muted" v-else><small>About {{user.fullname}}: {{user.bio}}</small></li>
                    <li class="text-muted"><small>Interests: {{user.interests}}</small></li>
                    <li class="text-muted"><small>Address: {{user.interests}}</small></li>
                    <li class="text-muted"><small>Website: <i class="text-muted">{{user.website}}</i></small></li>
                    <li class="text-muted"><small>Facebook: {{user.facebook}}</small></li>
                    <li class="text-muted"><small>Twitter: {{user.twitter}}</small></li>
                    <li class="text-muted"><small>Linkedin: {{user.linkedin}}</small></li>
                 </ul>
                  <p class="text-center sent-message btn btn-success btn-md" v-show="showrequestmessage" style="color: white; visibility: visible; position: fixed; top: 100px; left: 10%; z-index: 10;">{{sent}}</p> <!--connection sent message-->
                 <div v-if="auth.id != user.id">
                  <div v-if="isfriend === true">
                        <router-link tag="a" :to="'/innovator/profile/' + user.username" class="btn btn-primary btn-sm d-none" >
                        <a  style="text-transform: none; color: white !important; margin-right: 2px;">Message</a>
                        </router-link>
                        <a class="btn btn-warning btn-sm pul-right" href="#" style="text-transform: none; color: white !important; margin-right: 2px;" v-on:click.prevent="removeconnect($event, '/unconnect_friend/' + friend.username)">Unconnect</a><a class="btn btn-danger btn-sm pull-riht" href="/unfollow_friend/username" style="text-transform: none; color: white !important; display:none;" v-on:click.prevent="blockconnect($event, '/block_friend/' + friend.username)">Block</a>

                        <div class="message_container mt-3">
                            <h6 class="text-center">Your messages with {{user.fullname}}</h6>
                            <div class="alert alert-success notifications_panel" role="alert" v-show="status" style="position: fixed; top: 80px; width: 30%; z-index: 60;">
                                {{returnmessage}}
                            </div>
                            <ul class="list-group row thread_message d-block p-5 bg-info" style="overflow-y: scroll; max-height:360px; height:360px; padding-bottom:40px; border-top: 1px solid #f2f2f2; border-bottom: 1px solid #f2f2f2;">
                                <div v-if="countmessages >= 1">
                                    <span v-for="message in messages" class="clearfix"> 
                                        <li class="list-group-item bg-light col-sm-8 col-lg-8 col-lg-offset-0 mb-3 float-right w-75 border-0" v-if="message.user_id == auth.id"><span class="float-right smallest-font text-muted">Me; {{ postedOn(message) }}</span><span class="small">{{message.body}}</span></li>
                                        <li class="list-group-item col-sm-8 col-lg-8 col-lg-offset-4 mb-3 border-0" v-else><span class="float-right small smallest-font text-muted"> {{user.fullname}}; {{ postedOn(message) }}</span><span class="small">{{message.body}}</span></li>
                                    </span>
                                </div>
                                <div v-else>
                                    <p>No messages yet</p>
                                </div>
                                <div id="usb"></div>
                            </ul>
                            <form :action="'/threads/' + user.username + '/' + thread.slug" method="POST" value="PUT" class="form-horizontal mt-3" role="form" v-on:submit.prevent="sendMessage('/threads/' + user.username + '/' + thread.slug)">
                              <!--csrf field-->
                               <input type="hidden" name="_token" :value="csrf">
                               <input type="text" name="user_id" :value="user.id" hidden="true">
                                  <div class="form-group row">
                                    <div class="input-group col-sm-12 pl-5 pr-5">
                                        <input type="text" class="form-control msg d-none" name="message" id="message" v-model="message"
                                        placeholder="Type Message"> 
                                        <textarea class="form-control msg" name="message" id="message" v-model="message"
                                        placeholder="Type Message" rows="1" resize="none"></textarea>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary send-msg" v-show="messagesend">
                                                <i class="fa fa-paper-plane" aria-hidden="true" style="height: 1.35em; color:white;"></i>
                                            </button>
                                            <button class="btn btn-primary btn-block send-msg" v-show="messageloading">
                                              <i class="fa fa-paper-plane" aria-hidden="true" style="height: 1.35em; color:white;"></i> <img src="/Ellipsis.svg" style="height: 1.35em;">
                                          </button>
                                        </span>
                                    </div>
                                  </div>
                              </form>
                              <input type="text" name="myid" :value="thread.id" id="myid" hidden="true" />
                                <input type="text" name="myid" :value="auth.id" id="thid" hidden="true" />
                        </div>

                        <!--delete this block-->
                 
                        <!--delete this block-->
                  </div>
                  <div v-else>
                    <!--request-->
                    <div v-if="friendrequestfrom === true">
                        {{user.fullname}} sent you a request
                                <a :href="theurl" class="btn btn-info btn-sm small" v-on:click.prevent="acceptconnect($event, '/accept_request/' + user.username)">Accept Request</a> <a :href="theurl" class="btn btn-warning btn-sm small" v-on:click.prevent="rejectconnect($event, '/reject_request/' + user.username)">Reject Request</a>
                    </div>
                    <div v-else-if="sentfriendrequest == true">
                        <span class="text-warning">You have sent a friend request to {{user.fullname}}</span>
                    </div>
                    <div v-else>
                        <a class="btn btn-success btn-sm pul-right" :href="theurl" v-on:click.prevent="show($event)" style="text-transform: none; color: white !important; margin-right: 2px; cursor:pointer;">Connect With {{user.fullname}}</a>
                        <a class="btn btn-success btn-sm pul-right" :href="theurl" v-on:click.prevent="sendconnect($event, '/connect/' + user.username + '/' + connectform_message)" style="text-transform: none; color: white !important; margin-right: 2px; cursor:pointer; display: none;">Send Connect</a>
                  </div>
                  <!--request-->
                </div> 
            </div>
            <div style="height:40px;"></div>
                
                <div id="viewmore_div" class="d-none">  <!--view more-->
                    <p id="viewmore" class="text-center text-primary" style="background-color: lightgrey; border-bottom: 6px solid darkgrey; border-radius: 2%; cursor: pointer;">View More</p>
                    <p id="hidemore" class="text-center text-primary" style="background-color: lightgrey; border-bottom: 6px solid darkgrey; border-radius: 2%; cursor: pointer; display: none;">Hide</p>
                </div>
                <hr>
                <div id="expand_profile" class="d-none">
                    <h6>Address</h6>
                    <ul class="list-unstyled" style="padding-left: 40px;">
                        <div v-if="auth.is_permission == 4">
                            <li><p class="small">Address: {{user.address}}</p></li>
                            <li><p class="small">State: {{user.state}}</p></li>
                        </div>
                        <li><p class="small">Country: {{user.country}}</p></li>
                    </ul>
                    <h6>Social</h6>
                    <ul class="list-unstyled social" style="padding-left: 40px; padding-right: 40px;">
                        <li><span class="btn disabled">Website(s):</span> <i class="small">{{user.website}}</i> </li>
                        <li><span class="btn  disabled">Facebook:</span> <i class="small">{{user.facebook}}</i> </li>
                        <li><span class="btn disabled">Twitter:</span> <i class="small">{{user.twitter}}</i></li>
                        <li><span class="btn disabled">Linkedin:</span> <i class="small">{{user.linkedin}}</i></li>
                    </ul>
                </div>
                                        <!--view more-->
            <div v-if="auth.id != user.id">
                 <h6>({{countuserfriends}}) connections</h6> 
                 <h6>Mutual Connections ({{countmutualfriends}})</h6> 
                 <div v-if="countmutualfriends >= 1">  <!--mutualconnections-->
                    <ul class="list-unstyled list-inline" id="scrolly">
                        <li v-for="mutual in mutual_friends" class="suggest panel">
                               <h5>
                                    <router-link tag="a" :to="'/innovator/profile/' + mutual.username">
                                        {{mutual.fullname}}
                                    </router-link>
                               </h5>
                                <img :src="'uploads/profile-pic/' + mutual.image" class="img-responsive img-thumbnail" style="height: 60px;" width="90%" v-if="mutual.image == Null">
                            <div v-else>
                                    <img src="man.png" class="img-responsive img-thumbnail" style="height: 60px;" width="90%" v-if="mutual.gender == 'Male'">
                                    <img src="woman.jpg" class="img-responsive img-thumbnail" style="height: 60px;" width="90%" v-else>
                            </div>
                            <p class="smallest-font text-justify" style="font-size: 70%;">{{mutual.bio}}</p>
                        </li>

                    </ul>
                 </div>    <!--mutualconnections-->
            </div>  
            <div v-else>
                <h6>You have ({{countuserfriends}}) connections</h6> 
            </div>                          
                 <h6 class="text-center">Innovations</h6>    <!--innovations-->
                 <div v-if="countstartups >= 1">
                    <div class="row" v-for="startup in startups">
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3">
                            <div class="row pan panel-success">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <h5 class="text-ceter">
                                    <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                    <a class="text-muted">{{ truncateString(startup.title, 70) }}</a>
                                  </router-link>
                                    <span class="small"> by {{startup.group_name}}</span>
                                    <span class="small pull-right">{{ postedOn(startup) }}</span><br><span class="small pull-right"><div class="rw-ui-container" v-bind:data-title="startup.id"></div></span></h5>
                                    <hr>
                                    <div class="row cntainer-fluid">
                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                            <img v-bind:src="'uploads/startup_photos/' + startup.image" width="100%" class="img-responsive">
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                             <p class="text-justify"><span style="text-decoration: underline;"> Brief description:</span> <span v-html="startup.short_desc"></span><br>
                                             <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                                <a>More...</a>
                                              </router-link>
                                              </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>    
                <div v-else> 
                    <div v-if="user.id == auth.id"><p>You have no innovations yet!</p></div>
                    <div v-if="user.id != auth.id"><p>{{user.fullname}} has no innovations yet!</p></div>
                </div>                                          <!--innovations-->
                <h6 class="text-center">Videos</h6> 
                <div class="row" v-if="countyoutubevideos >= 1">
                     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" v-for="video in youtubevideos">
                            <iframe width="100%" height="250" :src="'https://www.youtube.com/embed/' + video.video_id" frameborder="0" allowfullscreen></iframe>
                            <p class="sm-medium-font"> <span style="text-decoration: underline;">Title:</span> {{video.title}}<br>
                            <span style="text-decoration: underline;">Description:</span> {{video.description}}</p>
                    </div>
                </div>

            </div>
        </div>

        </section>
    </div> 
</div>
</template>


<script>
import moment from 'moment';
var csr;
var myid;
var threadd_id;
let date = Date();
    export default {
        data() {
            return {
                loading: '',
                loaded: '',
                auth: '',
                user: '',
                users: '',
                authfriends: '',
                userfriends: '',
                mutual_friends: '',
                startups: '',
                youtubevideos: '',
                thread: '',
                messages: '',
                requests: '',
                isfriend: '',
                friendrequestfrom: '',
                sentfriendrequest: '',
                countrequests: '',
                countstartups: '',
                countauthfriends: '',
                countuserfriends: '',
                countmutualfriends: '',
                countyoutubevideos: '',
                countmessages: '',
            //    countthreads: '',
                showrequestmessage: false,
                connectform_message: 'the message',
                sent: '',
                csrf: '',
                messageloading: false,
                messagesend: true,
                thread_id: '',
                auth_id: '',
                status: '',
                returnmessage: '',
                message: ''

            }
        },
        beforeRouteUpdate: function(to, from, next) {
            next();
        //    showmore();
            this.fetchData();
        }, 
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this,
       //     showmore();
            this.fetchData();
        },
        mounted(){
            this.csrf = window.Laravel.csrfToken
        },
        methods: {
             fetchData () {
                axios.post('/myprofile/' + this.$route.params.username)
                .then(function(response) { 
                $(document).scrollTop(1);
                console.log(response.data[1]),
                self.threads = response.data[0],
                self.auth = response.data[0],
                self.user = response.data[1],
                self.users = response.data[2],
                self.authfriends = response.data[3],
                self.userfriends = response.data[4],
                self.mutual_friends = response.data[5],
             //   self.startups = response.data[6],
                self.startups = self.user.startups,
                self.youtubevideos = response.data[7],
                self.thread = response.data[8],
                self.requests = response.data[9],
                self.isfriend = response.data[10],
                self.friendrequestfrom = response.data[11],
                self.sentfriendrequest = response.data[12],
                self.messages = response.data[13],
              //  self.countstartups = response.data[6].length,
                self.countmessages = self.messages.length,
                self.countstartups = self.user.startups.length,
                self.countauthfriends = response.data[3].length,
                self.countuserfriends = response.data[4].length,
                self.countmutualfriends = response.data[5].length,
                self.countyoutubevideos = response.data[7].length,
               // self.countthreads = response.data[8].length,
                self.countrequests = response.data[9].length,
                self.thread_id = self.thread.id,
                self.auth_id = self.auth.id,
                console.log(response.data[11]),
                console.log(response.data[12]),
              //  response => this.categories = response.data,
                self.loading = false,
                self.loaded = true,
                responsive();
                //csr = document.getElementById('csrf').innerHTML,
               // console.log(csr),
               // document.getElementById('csval').innerHTML= csr,
                //document.getElementById('csvalone').innerHTML= csr,
                //console.log(document.getElementById('csvalone').innerHTML),
                myid = self.auth_id;
                threadd_id = self.thread_id;
                mysock(myid, threadd_id);
                }); 
            },
            //connection events
            show(e) {
                let clickedElement;
                clickedElement = e.currentTarget;
                var connectform_message;
                self = this,
                    swal({
                              //width: 500,
                              background: '#FAFAFA',
                             // input: 'text',
                          html: `<h3>Connect with ${self.user.fullname} ${self.connectform_message}</h3>
                          <h4>Send a message (optional)</h4>
                <textarea name="messa" id="messa" resize="none" rows="2" class="form-control"></textarea>`,
                        confirmButtonText: 'Send Connect!',
                        confirmButtonColor: 'green',
                        showCloseButton: true,
                        focusConfirm: false,
                        })
                    .then(function () {
                        connectform_message = $('#messa').val();
                    var connecturl = `/connect/${self.user.username}/${connectform_message}`; 
                    self.sendconnect(clickedElement, connecturl);
              })
            },
            sendconnect(e, connecturl) {
                let clickedElement;
                clickedElement = e.currentTarget;  //set clickedelement to the element that trigerred this function
                clickedElement = e;  //set clickedelement to the element that trigerred this function
                self = this,
               axios({ 
                  method: 'post',
                  url: connecturl
                })
               .then(function(response) { 
                  self.sent = 'Connection Request Sent!',
               //   self.sent = response.data,
                  self.showrequestmessage = true,
                  $(clickedElement).text('request sent');
                  $(clickedElement).attr("disabled", true);  
                  $('#messa').val() == '';
                  setTimeout(function(){   //timeout
                       self.showrequestmessage = false
                    }, 7000); 
               }); 
            },
            acceptconnect(e, connecturl) {
                let clickedElement;
                clickedElement = e.currentTarget;  //set clickedelement to the element that trigerred this function
                self = this,
               axios({ 
                  method: 'post',
                  url: connecturl
                })
               .then(function(response) { 
                  self.sent = 'You have accepted this connection!',
                  self.showrequestmessage = true,
                  $(clickedElement).text('connection accepted');
                  $(clickedElement).attr("disabled", true);  
                  setTimeout(function(){   //timeout
                       self.showrequestmessage = false
                    }, 7000);
               }); 
            },
            rejectconnect(e, connecturl) {
                let clickedElement;
                clickedElement = e.currentTarget;  //set clickedelement to the element that trigerred this function
                self = this,
               axios({ 
                  method: 'post',
                  url: connecturl
                })
               .then(function(response) { 
                  self.sent = 'You rejected this connection!',
                  self.showrequestmessage = true,
                  $(clickedElement).text('connection rejected');
                  $(clickedElement).attr("disabled", true);  
                  setTimeout(function(){   //timeout
                       self.showrequestmessage = false
                    }, 7000);
               }); 
            },
            removeconnect(e, connecturl) {
                let clickedElement;
                clickedElement = e.currentTarget;  //set clickedelement to the element that trigerred this function
                self = this,
               axios({ 
                  method: 'post',
                  url: connecturl
                })
               .then(function(response) { 
                  self.sent = 'Connection removed!',
                  self.showrequestmessage = true,
                  $(clickedElement).text('connection removed');
                  $(clickedElement).attr("disabled", true);  
                  setTimeout(function(){   //timeout
                       self.showrequestmessage = false
                    }, 7000);
               }); 
            },
            blockconnect(e, connecturl) {
                let clickedElement;
                clickedElement = e.currentTarget;  //set clickedelement to the element that trigerred this function
                self = this,
               axios({ 
                  method: 'post',
                  url: connecturl
                })
               .then(function(response) { 
                  self.sent = 'Connection blocked!',
                  self.showrequestmessage = true,
                  $(clickedElement).text('connection blocked');
                  $(clickedElement).attr("disabled", true);  
                  setTimeout(function(){   //timeout
                       self.showrequestmessage = false
                    }, 7000);
               }); 
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
                    thread_id: self.thread_id 
                  }
                })
               .then(function(response) { 
                  self.messagesend = true,
                  self.messageloading = false,
                  self.status = true,  //set message status to be shown to be true
                  self.returnmessage = response.data  //set message to be shown on saved to response from controller
                  $( "#usb" ).append(
                       '<li class="list-group-item col-lg-8 col-lg-offset-0" style="margin-top:10px;" v-if="message.id == auth.id"><span class="pull-right smallest-font text-muted">Me; '+moment(String(date)).format('MMMM Do YYYY hh:mm:ss a')+'</span><span class="small">'+self.message+'</span></li>' 
                       ); 
                        $('.thread_message').animate({scrollTop: 
                            $('.thread_message').prop("scrollHeight")}, 500);  
                  self.message = '',
                  setTimeout(function(){   
                       self.status = false //set message status to false after xxx seconds
                    }, 7000);
               });
            },
            //connection events
            truncateString(str, num) {
              if (str.length <= num) {
                return str;
              } else {
                return str.slice(0, num > 3 ? num - 3 : num) + '...';
              }
            },
            postedOn(startup) {
                return moment(startup.created_at).fromNow();
            },
            postedOn(thread) {
                return moment(thread.created_at).fromNow();
            },
            postedOn(message) {
                return moment(String(message.created_at)).format('MMMM Do YYYY hh:mm:ss a');
            }
        }
    }


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
                console.log('sjksk');
                console.log(e.message.auth_id);
                console.log(e.message.user_id);
                console.log(e.message.username);
                console.log('from the message vue received an event');
                if( (e.message.auth_id != myid) && (e.message.thread_id == threadd_id) && (e.message.user_id == myid) ) {
                  $( "#usb" ).append(
                   '<li class="list-group-item col-lg-8 col-lg-offset-4" style="margin-top:10px;"><span class="pull-right smallest-font text-muted"> '+ e.message.username +'; '+ moment(String(date)).format('MMMM Do YYYY hh:mm:ss a')+'</span><span class="small">'+e.message.body+'</span><div style="height:40px;"></div></li>' 
                   ); 
                  $('.thread_message').animate({scrollTop: 
                    $('.thread_message').prop("scrollHeight")}, 500); 
                } 
            });     //end of echo and pusher receive
    }


    function showmore() {
    $("#viewmore").click(function(){
                $("#expand_profile").slideDown("slow");
                $("#viewmore").hide();
                $("#hidemore").show();
            });
            $("#hidemore").click(function(){
                $("#expand_profile").slideUp("slow");
                $("#viewmore").show();
                $("#hidemore").hide();
            });
    }

    function responsive() {
        $("#showthread_form").click(function(){
                alert('show thread na');
                $("#threadformshow").slideDown("slow");
            });
      if ($(window).width() > 1199) {
         $(".first-row").show();
         $("#innovator_top_div").hide(); //innovator profile top div
          $('.first-row').css("position", "fixed");
         $('.first-row').css("width", "16.666667%");
         $('.second-row').css("margin-left", "16.666667%");
          //  $("wrapper").hide();
            var offsetHeight = document.getElementById('secondDiv').offsetHeight;
            var firstHeight = document.getElementById('firstDiv').offsetHeight;
            diffHeight = offsetHeight - firstHeight;
            document.getElementById("k").innerHTML = offsetHeight;
            document.getElementById("kk").innerHTML = firstHeight;
            document.getElementById("kkk").innerHTML = diffHeight;
               $(window).scroll(function () {
                var scrollTop = $(window).scrollTop(); 
                if (scrollTop > diffHeight) {
                   $('.first-row').css("position", "fixed");
                    $('.first-row').css("top", "0px");
                   //added to make it fixed
                } else {
                $('.first-row').css("position", "fixed");
                $('.first-row').css("top", "0px");
                }
            });
               $('first-row').scrollTop(diffHeight);
        }else{
            $('.first-row').css("position", "absolute");
            $(".first-row").hide();
            $("#innovator_top_div").show(); //innovator profile top div
            $('.second-row').css("margin-left", "0%");
        }
           $("#viewmore").click(function(){   //////view more slide down
                $("#expand_profile").slideDown("slow");
                $("#viewmore").hide();
                $("#hidemore").show();
            });
            $("#hidemore").click(function(){
                $("#expand_profile").slideUp("slow");
                $("#viewmore").show();
                $("#hidemore").hide();
            });      
    }


</script>

