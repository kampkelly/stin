<template>
<div class="col-xs-2 col-sm-12 col-md-8 col-lg-8 col-xl-7 second-row" id="secondDiv" style="padding-top: 70px; margin-right: 0px !important;">
        <div>
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div> 
        <div class="container-fluid" v-show="loaded">
              <h4 class="text-center" style="color: gray; display:none;" id="newconnect_container">Connection Requests</h4>
              <ul class="list-unstyled">
                  <li id="newconnect"></li>
              </ul>
              <div v-if="countrequests >= 1">
                <h4 class="text-center" style="color: gray;">Connection Requests</h4>
                <!--connection request logic here-->

                <div v-for="request in requests">
                    <ul class="list-unstyled"> 
                    <div v-for="user in all_users" v-if="user.id == request.sender_id">
                        
                            <li>
                               <router-link tag="a" :to="'/innovator/profile/' + user.username" class="small">
                                <a style="color: #003B7D !important;">{{user.fullname}}</a> <span class="smal">message: {{request.message}}</span>
                              </router-link> 
                              <a :href="theurl" class="btn btn-info btn-sm small" v-on:click.prevent="acceptconnect($event, '/accept_request/' + user.username)">Accept Request</a> <a :href="theurl" class="btn btn-warning btn-sm small" v-on:click.prevent="rejectconnect($event, '/reject_request/' + user.username)">Reject Request</a></li>
                        
                    </div>
                    </ul>
                </div>
                <!--connection request logic here-->
                <hr>
                </div>
               <!--end if request-->
            <h5 class="text-center" style="color: #242525;">My Connections({{countfriends}})</h5>
                <hr>
                <div id="myconnect"></div>
            <div v-if="countfriends >= 1">
          <!--if count of my friends >= 1-->
             <!--for each friend-->
            <div class="row suggestion" style="background-color: #fafafa;" v-for="friend in friends">
                <div class="col-3 col-sm-3 col-md-3 col-lg-2">
                  <img :src="'https://api.adorable.io/avatars/181/' + friend.email + '.png'" class="img-fluid rounded-circle" style="height: 56px; filter: grayscale(50%);" v-if="friend.image == 'default_profile.jpeg'">
                    <img :src="'uploads/profile-pic/' + friend.image" class="img-fluid rounded-circle" style="height: 56px;" v-else>
                </div>
                <div class="col-9 col-sm-9 col-md-9 col-lg-9">
                     <router-link tag="a" :to="'/innovator/profile/' + friend.username">
                        <a>{{friend.fullname}}</a>
                      </router-link> 
                    <div class="pull-right">
                        <ul class="list-unstyled">
                            <li>
                            <router-link tag="a" :to="'/innovator/profile/' + friend.username" class="btn btn-primary btn-sm">
                              <a  style="text-transform: none; color: white !important; margin-right: 2px;">Message</a>
                            </router-link>
                            <a class="btn btn-warning btn-sm pul-right d-none" href="#" style="text-transform: none; color: white !important; margin-right: 2px;" v-on:click.prevent="removeconnect($event, '/unconnect_friend/' + friend.username)">Unconnect</a>
                            <a class="btn btn-danger btn-sm float-riht" href="/unfollow_friend/username" style="text-transform: none; color: white !important; display:none;" v-on:click.prevent="blockconnect($event, '/block_friend/' + friend.username)">Block</a>
                            </li>
                        </ul>
                    </div>
                    <br> <span class="small-font">{{friend.profession}}</span>
                </div><br>
            </div>
            <img src="/Ellipsis.svg" class="w-100" v-show="adding_connections" style="height: 3.35em;">
            <h6 v-on:click="moreconnections()" v-show="not_finished" class="text-center mt-2 text-info">Show more</h6>
            <div id="addmore_connections"></div>
             <!--end foreach friend-->
        </div>
          <!---else of count of friends-->
        <div v-else>
            <p style="color: gray;" class="small">You have no connections yet, get involved by Connecting with people. See below</p>
        </div>
         <!--end if count of friends-->
        <h5 style="color: #242525" class="text-center mt-3">Some Suggested Connections</h5>
        <section>  <!--suggested connections-->
        <p class="text-center sent-message btn btn-success btn-sm" v-show="showrequestmessage" style="color: white; visibility: visible; position: fixed; top: 100px; left: 10%; z-index: 10;">{{sent}}</p> <!--connection sent message-->
              <!--for each user_of_friends-->
              <div >
              <!--if auth is friend with-->

            <!--else auth-->
                <div class="row contaner-fluid bg-light suggestions mt-3" style="background-color: #fafafa;" v-for="friend in suggested">
                    <div class="col-3 col-sm-3 col-md-3 col-lg-2">
                        <img :src="'https://api.adorable.io/avatars/181/' + friend.email + '.png'" class="img-fluid rounded-circle" style="height: 56px; filter: grayscale(50%);" v-if="friend.image == 'default_profile.jpeg'">
                        <img :src="'uploads/profile-pic/' + friend.image" class="img-fluid rounded-circle" style="height: 56px;" v-else>
                    </div>
                    <div class="col-9 col-sm-9 col-md-9 col-lg-9">
                        <router-link tag="a" :to="'/innovator/profile/' + friend.username" class="text-capitalize pull-left">
                          <a style="color: #227FBB !important;">{{friend.fullname}}</a>
                        </router-link> 
                        <div class="pull-right">
                        <ul class="list-unstyled">
                            <li>
                            <a class="btn btn-success btn-sm pul-right" :href="theurl" v-on:click.prevent="sendconnect($event, '/connect/' + friend.username)" style="text-transform: none; color: white !important; margin-right: 2px; display:none;">Connect</a>
                             <a class="btn btn-success btn-sm pul-right" :href="theurl" v-on:click.prevent="show($event, friend.username, friend.fullname)" style="text-transform: none; color: white !important; margin-right: 2px; cursor:pointer;">Connect</a>
                            </li>
                        </ul>
                        </div>
                        <br> <span class="small-font pull-left">{{friend.profession}}</span>
                    </div><br>
                </div>
             <!--end auth-->
             </div>
              <!--end foreach user_of_friends-->
            </section>   
                  
                
                <!--LOOP STARTUP ENDS-->
            </div>
            <!--starts///////////////-->
        </section>
    </div> 
</div>
</template>

<script>
import moment from 'moment';
var globalauth_id = window.Laravel.globa;
    export default {
        data() {
            return {
                connections: [],
                loading: '',
                loaded: '',
                countfriends: '',
                suggested: '',
                friends: '',
                requests: '',
                countrequests: '',
                all_users: '',
                theurl: '',
                showrequestmessage: false,
                sent: '',
                x: 0,
                y: 1,
                not_finished: true,
                adding_connections: false
            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this 
            axios.post('/showconnections')
            .then(function(response) { 
               $(document).scrollTop(1);
                response => this.connections = response.data,
                self.loading = false,
                self.loaded = true
                self.friends = response.data[0]
                self.suggested = response.data[1]
                self.requests = response.data[2]
                self.countrequests = response.data[2].length
                self.all_users = response.data[3],
                self.countfriends = response.data[4].length,
                console.log('show friends inbetween'),
                console.log(self.friends),
                console.log(self.friends),
                console.log('show friends inbetween'),
                responsive();
             //   realtimerequest();
                }); 
        },
        methods: {
          moreconnections() {
            self = this,
            this.x = this.x + 1, //= 1
            this.y = this.x + 1, //= 2
            this.adding_connections = true,
            axios.post('/moreconnections/' + this.x + '/' + this.y)
            .then(function(response) { 
                self.not_finished = response.data[1],
                self.adding_connections = false,
                console.log(response.data[1])
                console.log(response.data[0][0].fullname)
                var people = response.data[0];
                people.forEach(function(person) {
                    console.log(person);
                    append_person(person);
                });
                
             });
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
               //   self.sent = 'Connection Request Sent!',
                  self.sent = response.data,
                  self.showrequestmessage = true,
                  $(clickedElement).text('request sent');
                  $(clickedElement).attr("disabled", true); 
                  $('#messa').val() == ''; 
                  setTimeout(function(){   //timeout
                       self.showrequestmessage = false
                    }, 7000);
               }); 
            },
            show(e, theusername, thefullname) {
                let clickedElement;
                clickedElement = e.currentTarget;
                var connectform_message;
                self = this,
                    swal({
                              background: '#FAFAFA',
                          html: `<h3>Connect with ${thefullname}</h3>
                          <h4>Send a message (optional)</h4>
                <textarea name="messa" id="messa" resize="none" rows="2" class="form-control"></textarea>`,
                        confirmButtonText: 'Send Connect!',
                        confirmButtonColor: 'green',
                        showCloseButton: true,
                        focusConfirm: false,
                        })
                    .then(function () { 
                        connectform_message = $('#messa').val();
                    var connecturl = `/connect/${theusername}/${connectform_message}`; 
                    self.sendconnect(clickedElement, connecturl);
              })
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
                       location.reload();
                    }, 3000);
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
        }
    }
    import Pusher from 'pusher-js'
    import Echo from "laravel-echo"
 //function realtimerequest() {
             //   var globalauthid = document.getElementById('globalauthid').value;
               // let globalauth = jQuery.parseJSON(globalauthid);
                
                window.Echo = new Echo({
                       broadcaster: 'pusher',
                       key: 'ddc158fa13ebad9c3fdf',
                       cluster: 'us2',
                       encrypted: true
                  }); 
                 window.Echo.channel('sendconnection')
                    .listen('SendConnection', (e) => {
                      if(e.user.id == globalauth_id){
                        /*    document.getElementById('newconnect_container').style.display = 'block';
                            $( "#newconnect" ).append(
                               `<li> <router-link tag="a" to="/innovator/profile/${globalauth.username}" class="small">
                                <a style="color: #003B7D !important;">${globalauth.username}</a>
                              </router-link> 
                              <a :href="theurl" class="btn btn-info btn-xs small" onclick="acceptconnect($event, '/accept_request/${e.auth.username}'); return false;">Accept Request</a> <a :href="theurl" class="btn btn-warning btn-xs small" onclick.prevent="rejectconnect($event, '/reject_request/${e.auth.username}')">Reject Request</a></li>`
                               );  */
                               $('#newconnect').append('<p>refreshing page...</p>');
                            setTimeout(function(){   //timeout
                               location.reload();
                            }, 3000);
                      }

                     });

                  window.Echo.channel('acceptconnection')
                    .listen('AcceptConnection', (e) => {
                        if(e.user.id == globalauth_id){
                          //  document.getElementById('notifyconnection').style.display = 'block';
                          /*  $( "#myconnect" ).append(
                                ` <div class="row contaner-fluid panel panel-succes suggestions" style="background-color: #e9e9e9;">
                                    <div class="col-xs-2 col-sm-3 col-md-3 col-lg-2">
                                        <img src="/woman.jpg" class="img-responsive img-rounded" style="height: 56px;">
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                         <router-link tag="a" to="/innovator/profile/ ${e.auth.username}">
                                            <a>${e.auth.fullname}</a>
                                          </router-link> 
                                        <div class="pull-right">
                                        <ul class="list-unstyled">
                                            <li>
                                                <router-link tag="a" to="/innovator/profile/ ${e.auth.username}" class="btn btn-primary btn-xs">
                                                  <a  style="text-transform: none; color: white !important; margin-right: 2px;">Message</a>
                                                </router-link>
                                                <a class="btn btn-warning btn-xs pul-right" href="#" style="text-transform: none; color: white !important; margin-right: 2px;" v-on:click.prevent="removeconnect($event, '/unconnect_friend/'  ${e.auth.username})">Unconnect</a><a class="btn btn-danger btn-xs pull-riht" href="/unfollow_friend/username" style="text-transform: none; color: white !important;" v-on:click.prevent="blockconnect($event, '/block_friend/'  ${e.auth.username})">Block</a></br><h6 class="text-success">New</h6>
                                            </li>
                                        </ul>
                                        </div>
                                        <br> <span class="small-font">${e.auth.profession}: ${e.auth.bio}</span>
                                    </div><br>
                                </div>
                                `
                            ); */
                             $('#newconnect').append('<p>refreshing page...</p>');
                            setTimeout(function(){   //timeout
                               location.reload();
                            }, 3000);
                            
                        }
                    });
         //   }

    function responsive() {
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
    }

    function append_person(person) {
        $('#addmore_connections').append(
            `
            <div class="row suggestion mt-2" style="background-color: #fafafa;">
                <div class="col-2 col-sm-2 col-md-3 col-lg-2">
                    <img src="uploads/profile-pic/${person.image}" class="img-fluid rounded" style="height: 56px;">
                </div>
                <div class="col-10 col-sm-10 col-md-9 col-lg-9">
                        <a href="/dashboard#/innovator/profile/${person.username}" style="color:#2980B9;">${person.fullname}</a>
                    <div class="pull-right">
                        <ul class="list-unstyled">
                            <li>
                              <a href="/dashboard#/innovator/profile/${person.username}" class="btn btn-primary btn-sm" style="text-transform: none; color: white !important; margin-right: 2px;">Message</a>
                            </li>
                        </ul>
                    </div>
                    <br> <span class="small-font"> ${person.profession}:  ${person.bio}</span>
                </div><br>
            </div>
            `
            );
    }
</script>

